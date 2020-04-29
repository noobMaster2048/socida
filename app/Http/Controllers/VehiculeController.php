<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Marque;
use App\Vehicule;
use App\VehiculeImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Vehicule/Index', [
            'vehicules' => function() {
               // $vehicules = DB::select('select v.id, v.nom, v.disponible, m.nom as marque, c.nom as categorie from vehicules v, marques m, categories c where c.id = v.categorie_id and m.id = v.marque_id')->paginate(15);
                $vehicules = DB::table('vehicules')
                    ->join('marques', 'vehicules.marque_id', 'marques.id')
                    ->join('categories', 'vehicules.categorie_id', 'categories.id')
                    ->select('vehicules.id as id', 'vehicules.nom', 'vehicules.disponible', 'marques.nom as marque', 'categories.nom as categorie')
                    ->paginate(10);
                return $vehicules;
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
        $marques = Marque::all();
        $categories = Categorie::all();
        return Inertia::render('Vehicule/Create', [
            'marques' => $marques,
            'categories' => $categories
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
        DB::transaction(function () use ($request) {
            $request->validate([
                'nom' => ['required', 'max:50'],
                'marque_id' => ['required'],
                'categorie_id' => ['required'],
                'prix' => ['required'],
                'ordre' => ['required'],
            ]);

            $images = $request->images;
            $photo = $request->file('img_path');
            if (!empty($photo)) {
                $file = $photo->getClientOriginalExtension();
                Storage::disk('uploads')->put('/vehicule/' .$photo->getFilename() . '.' .$file, File::get($photo) );
            }
            $vehicule = Vehicule::Create([
                'nom' => $request->get('nom'),
                'slug' => STR::slug($request->get('nom')),
                'disponible' => $request->get('disponible'),
                'marque_id' => $request->get('marque_id'),
                'categorie_id' => $request->get('categorie_id'),
                'consommation' => $request->get('consommation'),
                'description' => $request->get('description'),
                'prix' => $request->get('prix'),
                'ordre' => $request->get('ordre'),
                'hauteur' => $request->get('hauteur'),
                'longueur' => $request->get('longueur'),
                'largeur' => $request->get('largeur'),
                'nb_places' => $request->get('nb_places'),
                'cap_coffre' => $request->get('cap_coffre'),
                'ray_braq' => $request->get('ray_braq'),
                'lien_visuel_ext' => $request->get('lien_visuel_ext'),
                'lien_visuel_int' => $request->get('lien_visuel_int'),
                'img_path' => !empty($photo) ? $photo->getFilename() . '.' .$file : null,
            ]);
            if (!empty($images)) {
                foreach ($images as $image) {
                    // ddd($image);
                    $imagepath = Storage::disk('uploads')->put('/vehicules/' .$vehicule->id, $image );
                    VehiculeImage::create([
                        'veh_img_path' => '/uploads/' .$imagepath,
                        'vehicule_id' => $vehicule->id,
                        'veh_img_caption' => $vehicule->nom
                    ]);
                }
            }

        });

            return Redirect::route('vehicules')->with('success', 'Véhicule créé');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  number $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        //
        $vehicule = Vehicule::FindOrFail($id);
        $marques = Marque::all();
        $categories = Categorie::all();
        return Inertia::render('Vehicule/Edit', [
            'vehicule' => $vehicule,
            'categories' => $categories,
            'marques' => $marques
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicule  $vehicule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        //
        $request->validate([
            'nom' => ['required', 'max:50'],
            'marque_id' => ['required'],
            'categorie_id' => ['required'],
            'prix' => ['required'],
        ]);

        $images = $request->get('images');
        $photo = $request->file('img_path');
        if (!empty($photo)) {
            $file = $photo->getClientOriginalExtension();
            Storage::disk('uploads')->put('/vehicule/' .$photo->getFilename() . '.' .$file, File::get($photo) );
        }

        $vehicule->update([
            'nom' => $request->get('nom'),
            'slug' => STR::slug($request->get('nom')),
            'disponible' => $request->get('disponible'),
            'marque_id' => $request->get('marque_id'),
            'categorie_id' => $request->get('categorie_id'),
            'consommation' => $request->get('consommation'),
            'description' => $request->get('description'),
            'prix' => $request->get('prix'),
            'hauteur' => $request->get('hauteur'),
            'longueur' => $request->get('longueur'),
            'largeur' => $request->get('largeur'),
            'nb_places' => $request->get('nb_places'),
            'cap_coffre' => $request->get('cap_coffre'),
            'ray_braq' => $request->get('ray_braq'),
            'lien_visuel_ext' => $request->get('lien_visuel_ext'),
            'lien_visuel_int' => $request->get('lien_visuel_int'),
            'img_path' => !empty($photo) ? $photo->getFilename() . '.' .$file : null,
        ]);

        if (!empty($images)) {
            foreach ($images as $image) {
                $imagepath = Storage::disk('uploads')->put('/vehicules/' .$vehicule->id, $image );
                VehiculeImage::update([
                    'veh_img_path' => '/uploads/' .$imagepath,
                    'vehicule_id' => $vehicule->id,
                    'veh_img_caption' => $vehicule->nom

                ]);
            }
        }
        return Redirect::route('vehicules')->with('success', 'Le véhicule ' .$vehicule->nom. ' a été enregistré');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->delete();
        return Redirect::route('vehicules')->with('success', 'Le véhicule ' .$vehicule->nom. ' a été supprimé');
    }

}
