<?php

namespace App\Http\Controllers;

use App\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Marque/Index', [
            'marques' => function () {
                $marques = Marque::paginate(10);
                return $marques;
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
        return Inertia::render('Marque/Create');
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
            'nom' => ['required', 'max:50'],
        ]);
        Marque::Create([
            'nom' => $request->get('nom'),
            'description' => $request->get('description')
        ]);
        return Redirect::route('marques')->with('success', 'Marque crée');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function show(Marque $marque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marque  $marque
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        //
        $marque = Marque::FindOrFail($id);
        return Inertia::render('Marque/Edit', [
            'marque' => $marque
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marque  $marque
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Marque $marque)
    {
        //;
        $request->validate([
            'nom' => ['required', 'max:50']
        ]);
        $marque->update([
            'nom' => $request->get('nom'),
            'description' => $request->get('description')
        ]);
        return Redirect::route('marques')->with('success', 'La marque ' .$marque->nom. ' a été enregistré');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        //
        $marque = Marque::FindOrFail($id);
        $marque->delete();
        return Redirect::route('marques')->with('success', 'La marque ' .$marque->nom. ' a été supprimé');
    }
}
