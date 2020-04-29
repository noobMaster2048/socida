<?php

namespace App\Http\Controllers;

use App\Lexique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LexiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Lexique/Index', [
            'lexiques' => function() {
                $lexiques = Lexique::paginate(10);
                return $lexiques;
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
        return Inertia::render('Lexique/Create');
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
            'sigle' => ['required', 'max:50']
        ]);
        Lexique::Create([
            'sigle' => $request->get('sigle'),
            'description' => $request->get('description')
        ]);
        return Redirect::route('lexiques')->with('success', 'Le lexique a été enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lexique  $lexique
     * @return \Illuminate\Http\Response
     */
    public function show(Lexique $lexique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit(int $id)
    {
        //
        $lexique = Lexique::FindOrFail($id);
        return Inertia::render('Lexique/Edit', [
            'lexique' => $lexique
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        //
        $request->validate([
            'sigle' => ['required', 'max:50']
        ]);
        $lexique = Lexique::FindOrFail($id);
        $lexique->update([
            'sigle' => $request->get('sigle'),
            'description' => $request->get('description')
        ]);
        return Redirect::route('lexiques')->with('success', 'Le lexique ' .$lexique->sigle. ' a été enregistré');
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
        $lexique = Lexique::FindOrFail($id);
        $lexique->delete();
        return Redirect::route('lexiques')->with('success', 'Le lexique ' .$lexique->sigle. ' a été supprimé');
    }
}
