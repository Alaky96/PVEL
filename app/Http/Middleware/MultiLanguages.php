<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Session;

class MultiLanguages {

    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = "";
        //Priorité pour la langue affiché
        //1- L'utilisateur a, au cours de sa session, lui même sélectiooné une langue
        //2- La langue du profil de l'utilisateur
        //3- La langue par défaut de l'apps

        if (Session::has('userLocale'))
            $locale = session('userLocale');
        else if(Auth::user() != null)
        {
            $locale = Auth::user()->pref_lang;
            session(['userLocale' => $locale]);
        }
        else
            $locale = config('app.locale');
        $this->app->setLocale(session('userLocale', $locale));

        return $next($request);
    }

}