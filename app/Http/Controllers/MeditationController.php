<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeditationController extends Controller
{
    public function index()
    {
        $meditations = DB::table('meditations')->get();
        return view('Meditations.index', compact('meditations'));
    }
}
