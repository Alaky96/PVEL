<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //setlocale("en", "en");
        $user = auth()->user();
        $lang = ['fr' => 'Francais', 'en'=>'English'];
        return view('profile')->withUser($user)->withLanguages($lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        //Validation

        //Validate email
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with("error",trans("profile.Invalid Email"));
        }
        //Validation, seulement s'il y a tentative de changement de mot de passe
        if(!empty($request->newPassword))
        {
            if (!(Hash::check($request->password, $user->password)))
                return redirect()->back()->with("error", trans("profile.Invalid Current Password"));

            //Check pour que le nouveau mdp et la confirmation sont identiques
            if(!(strcmp($request->newPassword, $request->confirmNewPassword) == 0))
                return redirect()->back()->with("error", trans("profile.Password does not match"));

            //Check pour que le nouveau mdp soit différent de l'ancien
            if($request->password === $request->newPassword)
                return redirect()->back()->with("error", trans("profile.Same Password"));

            //Ici, on peut sécuritairement changer le mot de passe, le nouveau est valide
            $user->password = bcrypt($request->newPassword);
            $user->save();
        }

        //Update des infos générales
        $user->pref_lang = $request->lang;
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        session(['userLocale' => $user->pref_lang]);
        return redirect()->back()->with("success",trans("profile.success"));

    }

    private function ValidateChangePassword(Request $request)
    {
        $user = auth()->user();
        //Check pour ancien mot de passe valide
        if (!(Hash::check($request->password, $user->password)))
            return redirect()->back()->with("error", trans("profile.Invalid Current Password"));

        //Check pour que le nouveau mdp et la confirmation sont identiques
        if(!$request->newPassword === $request->confirmNewPassword)
            return redirect()->back()->with("error", trans("profile.Password does not match"));

        //Check pour que le nouveau mdp soit différent de l'ancien
        if($request->password === $request->newPassword)
            return redirect()->back()->with("error", trans("profile.Same Password"));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //User need to be logged in to view this
        $this->middleware('auth');
        $this->middleware('multilanguages');
    }
}
