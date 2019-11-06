<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\PurchaseOrderDet;
use App\PurchaseOrders;
use App\Shipment;
use App\ShipmentDet;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use PayPal\Api\PaymentExecution;
use App\Cart;
use App\Service\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;

class PaymentController extends Controller
{

    protected $cartService;
    public function __construct()
    {
        $this->cartService = new CartService();
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );

        $stripe_conf = \Config::get("stripe");
        \Stripe\Stripe::setApiKey($stripe_conf['apikey']);
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->middleware('auth');
        $this->middleware('multilanguages');
    }

    public function payWithpaypal(Request $request)
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();

            $subtotal = 0;
            $shipping = 0;

            $carts = Cart::where("fk_owner", auth()->user()->id)->get();
            foreach ($carts as $cart) {
                $item_1 = new Item();
                $item_1->setName($cart->product->name)/** item name **/
                ->setCurrency('CAD')
                    ->setQuantity($cart->qty)
                    ->setPrice($cart->product->price);
                /** unit price **/
                $subtotal += $cart->product->price * $cart->qty;
                $shipping += $cart->product->shipping_price * $cart->qty;
                $item_list->addItem($item_1);
            }


            $details = new Details();
            $details->setSubtotal($subtotal)
                ->setShipping($shipping);
            $amount = new Amount();
            $amount->setCurrency('CAD')
                ->setTotal($subtotal + $shipping)
                ->setDetails($details);
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');
            $redirect_urls = new RedirectUrls();
            $payment = new Payment();
            $redirect_urls->setReturnUrl(URL::route('review'))/** Specify return URL **/
            ->setCancelUrl(URL::route('cart.show'));
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/

            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }


    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::pull('paymentId');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Session::pull('PayerID')) || empty(Session::pull('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('home');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Session::pull('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            return Redirect::route('cart');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('cart');
    }

    public function checkout(Request $request)
    {
        $subtotal = 0.0;
        $shipping = 0.0;

        $carts = Cart::where("fk_owner", auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $subtotal += $cart->product->price * $cart->qty;
            $shipping += $cart->product->shipping_price * $cart->qty;
        }

        \Stripe\Stripe::setApiKey('sk_test_l9qe9FaOZ8cWJvgoxWWZ6U720046QeKc1a');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;
        $charge = \Stripe\Charge::create([
            'amount' => ($subtotal + $shipping) * 100,
            'currency' => 'cad',
            'description' => trans("cart.PVEL Order"),
            'source' => $token,
            'capture' => false,
        ]);

        $po = new PurchaseOrders();
        $po->fk_customer = auth()->user()->id;
        $po->purchase_date = now();
        $po->subtotal = $subtotal;
        $po->shipping_cost = $shipping;
        $po->total = $subtotal + $shipping;
        $po->status = 'H';
        $po->first_name = $request->firstname;
        $po->last_name = $request->lastname;
        $po->phone = $request->phone;
        $po->adresse_line_1 = $request->address1;
        $po->adresse_line_2 = $request->address2;
        $po->city = $request->city;
        $po->postal_code = $request->postalcode;
        $po->prov = $request->prov;
        $po->country = $request->country;
        $po->save();

        foreach($carts as $cart)
        {
            $line = new PurchaseOrderDet();
            $line->fk_po = $po->id;
            $line->fk_product = $cart->product->id;
            $line->fk_vendor = $cart->product->fk_owner;
            $line->qty = $cart->qty;
            $line->unit_price = $cart->product->price;
            $line->save();
        }

        return redirect()->route("review", ['po' => $po, 'method'=>"s", 'id'=>$charge->id]);
    }

    public function review(Request $request, $po = null, $id = null, $method = null)
    {
        $paymentID = (is_null($id) ? $request->get("token"):$id);
        $paymentMethod = (is_null($method) ? 'p':$method);

        if($paymentMethod === 'p')
        {
            $carts = Cart::where("fk_owner", auth()->user()->id)->get();
            $subtotal = 0;
            $shipping = 0;
            foreach($carts as $cart)
            {
                $subtotal += $cart->product->price * $cart->qty;
                $shipping += $cart->product->shipping_price * $cart->qty;
            }
            $payment_id = $request->get('paymentId');
            $payment = Payment::get($payment_id, $this->_api_context);
            $payerInfo = $payment->getPayer()->getPayerInfo();
           // return var_dump($payerInfo->shipping_address);
            $actualPO = new PurchaseOrders();
            $actualPO->fk_customer = Auth::id();
            $actualPO-> purchase_date = now();
            $actualPO-> subtotal = $subtotal;
            $actualPO-> shipping_cost = $shipping;
            $actualPO-> taxes_cost = 0;
            $actualPO-> total = $subtotal + $shipping;
            $actualPO-> status = 'H';
            $actualPO-> adresse_line_1 =   $payerInfo->shipping_address->getLine1();
            $actualPO-> adresse_line_2 =   $payerInfo->shipping_address->getLine2();
            $actualPO-> first_name =   $payerInfo->getFirstName();
            $actualPO-> last_name =   $payerInfo->getLastName();
            $actualPO-> country =   $payerInfo->shipping_address->getCountryCode();
            $actualPO->city = $payerInfo->shipping_address->getCity();
            $actualPO->prov = $payerInfo->shipping_address->getState();
            $actualPO->postal_code = $payerInfo->shipping_address->getPostalCode();
            $actualPO-> phone =   $payerInfo->getPhone();
            $actualPO->save();

            foreach($carts as $cart)
            {
              $line = new PurchaseOrderDet();
              $line->fk_po = $actualPO->id;
              $line->fk_product = $cart->product->id;
              $line->fk_vendor = $cart->product->fk_owner;
              $line->qty = $cart->qty;
              $line->unit_price = $cart->product->price;
              $line->save();
            }

            Session::put("paymentId", $request->get("paymentId"));
            Session::put("token", $request->get("token"));
            Session::put("PayerID", $request->get("PayerID"));
        }
        else if ($paymentMethod === 's')
        {
            $actualPO = PurchaseOrders::find($po);
        }

        return view("confirmOrder", ['po' => $actualPO, 'method'=>$paymentMethod, 'id'=>$paymentID]);
    }

    public function confirm(Request $request, $ans, $id, $method, $po)
    {

        $PO = PurchaseOrders::find($po);

        if($method === "s")
        {
            $charge = \Stripe\Charge::retrieve($id);
            if($charge->captured)
                return abort(403);
            if($ans === "1")
            {
                $charge->capture();
                $PO->status = "P";
                $PO->save();
                $this->createShipment($PO);
                Mail::to('g.brunet96@gmail.com')->send(new OrderConfirmation($PO));
               return $this->cartService->showView("sucess", trans("cart.confirmOrder"));
            }

            else
            {
                $re = \Stripe\Refund::create([
                    "charge" => $charge->id
                ]);
                $PO->status = "C";
                $PO->save();
                return $this->cartService->showView("failed", trans("cart.orderFailed"));
            }

        }
        else if($method ==="p")
        {
            if($ans === "1")
            {
                /** Get the payment ID before session clear **/
                $payment_id = $request->get('paymentId');
                /** clear the session payment ID **/
                Session::forget('paypal_payment_id');
                if (empty($request->get('PayerID')) || empty($request->get('token'))) {
                    return $this->cartService->showView("failed", trans("cart.orderFailed"));
                }
                $payment = Payment::get($payment_id, $this->_api_context);
                $execution = new PaymentExecution();
                $execution->setPayerId($request->get('PayerID'));
                /**Execute the payment **/
                $result = $payment->execute($execution, $this->_api_context);
                if ($result->getState() == 'approved') {
                    $PO->status = "P";
                    $PO->save();
                    $carts = Cart::where("fk_owner", auth()->user()->id)->get();
                    return $this->cartService->showView("sucess", trans("cart.confirmOrder"));
                }
                return $this->cartService->showView("failed", trans("cart.orderFailed"));
            }

            else
            {
              $PO->status = "C";
              $PO->save();
            }
        }

    }

    protected function createShipment(PurchaseOrders $po)
    {
        $shipment = new Shipment();

        foreach($po->lines as $line)
        {
            //Si aucun shipment existe avec ce vendeur
            $result = $this->checkForVendorInShipments($po->id, $line->product->fk_owner);
            if($result === null)
            {
                //On crée le shipment et on ajoute la ligne
                $shipment = new Shipment();

                //populate shipment
                $shipment->fk_po = $po->id;
                $shipment->fk_vendor = $line->product->fk_owner;
                $shipment->status = 'H';
                $shipment->save();
                Mail::to('g.brunet96@gmail.com')->send(new NewOrder($shipment));

                $shipmentLine = new ShipmentDet();

                //populate shipmentDet
                $shipmentLine->fk_product = $line->product->id;
                $shipmentLine->qty = $line->qty;
                $shipment->lines()->save($shipmentLine);
            }

            //Si(non) il y a déjà un shipment qui existe avec ce vendeur
            else
            {
                //On ajoute simplement la ligne au shipment actuel
                $shipmentLine = new ShipmentDet();
                $shipmentLine->fk_product = $line->product->id;
                $shipmentLine->qty = $line->qty;
                $result->lines()->save($shipmentLine);
            }
        }

    }

    //Check if there is a shipment with specified vendor.
    //return true if a shipment with this vendor already exists
    protected function checkForVendorInShipments($poID, $vendorID)
    {
        $shipments = Shipment::where("fk_vendor", $vendorID)->where("fk_po",$poID)->get();
        return $shipments->first();
    }
}
