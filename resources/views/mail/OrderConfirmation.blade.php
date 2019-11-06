
<body>
<style>
    .content
    {
        font-family: 'Raleway', sans-serif;
        background-color: #c5c5c5;
        border-radius: 10px;
        width: 50vw;
        padding: 10px;
    }

    .box{
        background: white;
        border-radius: 10px;
        padding: 10px;
    }

    button
    {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        background: #1d99ff;
        color: #ffffff;
        min-height: 55px;
        width: 100%;
        line-height: 38px;
        font-size: 22px;
        font-weight: 500;
        border-radius: 3px;
        border: 0;
        cursor: pointer;
    }
</style>
<div class = "content" style=" font-family: 'Raleway', sans-serif;
        background-color: #c5c5c5;
        border-radius: 10px;
        width: 50vw;
        padding: 10px;">
    <div class = "box" style=" background: white;
        border-radius: 10px;
        padding: 10px;">
        <h1 style ="font-weight: bolder">PVEL</h1>
        <h2>Merci de votre achat!</h2>

        <p>
            Félicitation pour votre nouvel équipement. <br/>
            Votre commande #{{sprintf('%06d', $order->id)}} à bien été reçu et sera traité par nos fournisseurs dans les plus brefs délais.<br/>
            Il vous est possible, à tout moment, de consulter le status de votre commande en cliquant <a href = "{{route("customerOrder.index")}}">ici</a>.
            <br/><br/>Merci de votre confiance,<br/>
            L'Équipe PVEL
        </p>
        <div style="text-align:center">
            <a href ="{{route("customerOrder.index")}}" ><button style=" display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        background: #1d99ff;
        color: #ffffff;
        min-height: 55px;
        width: 100%;
        line-height: 38px;
        font-size: 22px;
        font-weight: 500;
        border-radius: 3px;
        border: 0;
        cursor: pointer;">Consulter le status de votre commande</button></a>
        </div>
    </div>
    <p style="text-align:center">Contactez-nous : <a href="mailto:info@PVEL.com">info@PVEL.com</a></p>
</div>

</body>
