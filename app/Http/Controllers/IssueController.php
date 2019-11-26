<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('multilanguages');
    }

    public function index()
    {
        $user = Auth::user();
        if($user->type === 'su')
            $issues = Issue::where('fk_supplier', $user->id)->paginate(10);

        else if($user->type === 'cu')
            $issues = Issue::where('fk_author', $user->id)->paginate(10);
        else if($user->type === 'ad')
            $issues = Issue::paginate(10);

        return view("issues.index", ['issues'=>$issues]);
    }

    public function create()
    {
        return view("issues.form");
    }
}
