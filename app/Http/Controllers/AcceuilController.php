<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcceuilController extends Controller {


    public function index()
    {
        # code...
        return Inertia::render('Acceuil/Acceuil');
    }
}
