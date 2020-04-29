<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Categorie/Index', [
            'categories' => function () {
                $categories = Categorie::paginate(10);
                return $categories;
            }
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return Inertia::render('Categorie/Create');
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
        Categorie::Create(
            $request->validate([
                'nom' => ['required', 'max:25']
            ])
        );
        return Redirect::route('categories')->with('success', 'Modèle enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        //
        $categorie = Categorie::findOrFail($id);
        return Inertia::render('Categorie/Edit', [
            'categorie'  => $categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request ,int $id)
    {
        //
        $categorie = Categorie::FindOrFail($id);
        $categorie->update(
            $request->validate([
                'nom' => ['required', 'max:25']
            ])
            );
            return Redirect::route('categories')->with('success', 'Le modèle a été enregistré');
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
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return Redirect::route('categories')->with('success', 'Modèle supprimé');
    }
}
