<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() 
    {
        $meditations = DB::table('meditations')->limit(4)->orderBy('created_at', 'desc')->get();
        $articles = DB::table('articles')->limit(4)->orderBy('created_at', 'desc')->get();
        $psychologists = Psychologist::with('user')->where('status', 'active')->get()->map(function ($psychologist) {
            return [
                'users_id' => $psychologist->users_id,
                'photo' => $psychologist->user->photo,
                'name' => $psychologist->user->name,
            ];
        });

        return view('Home.index', compact('meditations', 'articles', 'psychologists'));
    }
}
