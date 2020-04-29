<?php

namespace App\Http\Controllers;

use App\Offre;
use App\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Offre/Index', [
            'offres' => function() {
                $offres = Offre::with('vehicule')->paginate(10);
                return $offres;
            }
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //
        return Inertia::render('Offre/Create',[
            'vehicules' => function() {
            $vehicules = Vehicule::all();
            return $vehicules;
            }
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'date_debut' => ['required'],
            'vehicule_id' => ['required'],
            'prix_promo' => ['required', 'numeric'],
        ]);
        Offre::create([
            'lien_video' => $request->get('lien_video'),
            'statut' => $request->get('statut'),
            'date_debut' => $request->get('date_debut'),
            'date_fin' => $request->get('date_fin'),
            'vehicule_id' => $request->get('vehicule_id'),
            'prix_promo' => $request->get('prix_promo'),
        ]);
        return Redirect::route('offres')->with('success', 'Offre enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Inertia\Response
     */
    public function edit(int $id)
    {
        //
        $offre = Offre::findOrFail($id);
        return Inertia::render('Offre/Edit', [
            'offre' => $offre,
            'vehicules' => function() {
            $vehicules = Vehicule::all();
            return $vehicules;
            }
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'date_debut' => ['required'],
            'vehicule_id' => ['required'],
            'prix_promo' => ['required', 'numeric'],
        ]);
        $offre = Offre::findOrfail($id);
        $offre->lien_video = $request->get('lien_video');
        $offre->statut = $request->get('statut');
        $offre->date_debut = $request->get('date_debut');
        $offre->date_fin = $request->get('date_fin');
        $offre->vehicule_id = $request->get('vehicule_id');
        $offre->prix_promo = $request->get('prix_promo');
        $offre->save();
        return Redirect::route('offres')->with('success', 'Offre ' .$offre->id. 'enregistré avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        //
        $offre = Offre::findOrFail($id);
        $offre->delete();
        return Redirect::route('offres')->with('success', 'Offre ' .$offre->id. ' a été supprimé');
    }
}
