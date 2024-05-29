<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() 
    {
        $meditations = DB::table('meditations')->limit(4)->orderBy('created_at', 'desc')->get();
        $articles = DB::table('articles')->limit(4)->orderBy('created_at', 'desc')->get();
        $psychologists = DB::table('psychologists')->where('status', 'active')->limit(4)->get();
        return view('Home.index', compact('meditations', 'articles', 'psychologists'));
    }
}
