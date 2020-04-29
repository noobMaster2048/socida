<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UtilisateurController extends Controller
{
    //

    public function index() {
        return Inertia::render('Users/Index', [
            'users' => function() {
            $users = User::paginate(10);
            return $users;
            }
        ]);
    }

    public function create() {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email'=> ['required', 'email', Rule::unique('users')],
            'password'=> ['required'],
        ]);

        User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return Redirect::route('users')->with('success', 'Utilisateur enregistré');
    }

    public function edit($id) {
        $user = User::FindOrFail($id);
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email'=> ['required', 'email', Rule::unique('users')],
            'password'=> ['required'],
        ]);
        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('first_name')),
        ]);
        return Redirect::route('users')->with('success', 'Utilisateur modifié');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::route('users')->with('success', 'Utilisateur supprimé');
    }
}
