<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Passe l'utilisateur à la vue 'dashboard'
        return view('dashboard', compact('user'));
    }

}
