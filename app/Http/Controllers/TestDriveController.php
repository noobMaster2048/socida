<?php

namespace App\Http\Controllers;

use App\TestDrive;
use App\Vehicule;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class TestDriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Testdrive/Index', [
            'drives' => function() {
            $drives = DB::table('test_drives AS t')
                ->join('vehicules AS v', 't.vehicule_id', 'v.id')
                ->select('t.id', 't.nom_demandeur', 't.tel_demandeur', 't.email_demandeur', 't.date_debut', 't.date_fin', 't.heure_debut', 't.heure_fin', 'v.nom')
                ->paginate(10);
            return $drives;
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
        return Inertia::render('Testdrive/Create', [
            'vehicules' => function () {
            $vehicules = Vehicule::where('disponible', 1)->get();
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
            'nom_demandeur' => ['required'],
            'email_demandeur' => ['required', 'email'],
            'tel_demandeur' => ['required'],
            'vehicule_id' => ['required'],
        ]);

        TestDrive::create([
            'nom_demandeur' => $request->get('nom_demandeur'),
            'email_demandeur' => $request->get('email_demandeur'),
            'tel_demandeur' => $request->get('tel_demandeur'),
            'vehicule_id' => $request->get('vehicule_id'),
            'date_debut' => $request->get('date_debut'),
            'date_fin' => $request->get('date_fin'),
            'heure_debut' => $request->get('heure_debut'),
            'heure_fin' => $request->get('heure_fin')
        ]);
        return Redirect::route('drives')->with('success', 'Le test drive a été crée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TestDrive  $testDrive
     * @return \Illuminate\Http\Response
     */
    public function show(TestDrive $testDrive)
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
        $drive = TestDrive::FindOrFail($id);
        return Inertia::render('Testdrive/Edit', [
            'drive' => $drive,
            'vehicules' => function () {
                $vehicules = Vehicule::where('disponible', 1)->get();
                return $vehicules;
            }
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
            'nom_demandeur' => ['required'],
            'email_demandeur' => ['required', 'email'],
            'tel_demandeur' => ['required'],
            'vehicule_id' => ['required'],
        ]);
        $drive = TestDrive::FindOrFail($id);
        $drive->update([
            'nom_demandeur' => $request->get('nom_demandeur'),
            'email_demandeur' => $request->get('email_demandeur'),
            'tel_demandeur' => $request->get('tel_demandeur'),
            'vehicule_id' => $request->get('vehicule_id'),
            'date_debut' => $request->get('date_debut'),
            'date_fin' => $request->get('date_fin'),
            'heure_debut' => $request->get('heure_debut'),
            'heure_fin' => $request->get('heure_fin')
        ]);
        return Redirect::route('drives')->with('success', 'Le test drive a été modifié');
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
        $drive = TestDrive::findOrFail($id);
        $drive->delete();
        return Redirect::route('drives')->with('success', 'Le test drive ' .$drive->id. ' a été supprimé');
    }
}
