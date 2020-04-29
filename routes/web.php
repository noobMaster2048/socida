<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *  Gestion de la connexion
 */

Route::get('connexion')->uses('Auth\LoginController@showLoginForm')->name('connexion')->middleware('guest');
Route::post('connexion')->uses('Auth\LoginController@login')->name('connexion')->middleware('guest');
Route::post('deconnexion')->uses('Auth\LoginController@logout')->name('deconnexion');

Route::get('/', 'AcceuilController@index')->name('acceuil')->middleware('auth');

/**
 *  Page d'erreur
 */
Route::get('500', function () {
    echo 'Page non trouvé';
});

/**
 *  Gestion des routes pour les utilisateurs
 */
Route::get('utilisateurs', 'UtilisateurController@index')->name('users')->middleware('auth');
Route::get('utilisateur/new', 'UtilisateurController@create')->name('user.create')->middleware('auth');
Route::post('utilisateur', 'UtilisateurController@store')->name('user.store')->middleware('auth');
Route::get('utilisateur/{id}/edit', 'UtilisateurController@edit')->name('user.edit')->middleware('auth');
Route::put('utilisateur/{id}', 'UtilisateurController@update')->name('user.update')->middleware('auth');
Route::delete('utilisateur/{id}', 'UtilisateurController@destroy')->name('user.delete')->middleware('auth');

/**
 * Gestion des routes pour les categories de véhicules
 */
Route::get('categories', 'CategorieController@index')->name('categories')->middleware('auth');
Route::get('categorie/new', 'CategorieController@create')->name('categorie.create')->middleware('auth');
Route::post('categorie', 'CategorieController@store')->name('categorie.store')->middleware('auth');
Route::get('categorie/{id}/edit', 'CategorieController@edit')->name('categorie.edit')->middleware('auth');
Route::put('categorie/{categorie}', 'CategorieController@update')->name('categorie.update')->middleware('auth');
Route::delete('categorie/{id}', 'CategorieController@destroy')->name('categorie.delete')->middleware('auth');

/**
 * Gestion des routes pour les marques de vehicules
 */
Route::get('marques', 'MarqueController@index')->name('marques')->middleware('auth');
Route::get('marque/new', 'MarqueController@create')->name('marque.create')->middleware('auth');
Route::get('marque/{id}/edit', 'MarqueController@edit')->name('marque.edit')->middleware('auth');
Route::post('marque', 'MarqueController@store')->name('marque.store')->middleware('auth');
Route::put('marque/{marque}', 'MarqueController@update')->name('marque.update')->middleware('auth');
Route::delete('marque/{marque}', 'MarqueController@destroy')->name('marque.delete')->middleware('auth');

/**
 * Gestion des routes pour le lexique
 */

Route::get('lexiques', 'LexiqueController@index')->name('lexiques')->middleware('auth');
Route::get('lexique/new', 'LexiqueController@create')->name('lexique.create')->middleware('auth');
Route::get('lexique/{lexique}/edit', 'LexiqueController@edit')->name('lexique.edit')->middleware('auth');
Route::post('lexique', 'LexiqueController@store')->name('lexique.store')->middleware('auth');
Route::put('lexique/{lexique}', 'LexiqueController@update')->name('lexique.update')->middleware('auth');
Route::delete('lexique/{lexique}', 'LexiqueController@destroy')->name('lexique.delete')->middleware('auth');

/**
 * Gestion des routes pour les tests drives
 */

Route::get('test-drives', 'TestDriveController@index')->name('drives')->middleware('auth');
Route::get('test-drive/new', 'TestDriveController@create')->name('drive.create')->middleware('auth');
Route::get('test-drive/{drive}/edit', 'TestDriveController@edit')->name('drive.edit')->middleware('auth');
Route::post('test-drive', 'TestDriveController@store')->name('drive.store')->middleware('auth');
Route::put('test-drive/{drive}', 'TestDriveController@update')->name('drive.update')->middleware('auth');
Route::delete('test-drive/{drive}', 'TestDriveController@destroy')->name('drive.delete')->middleware('auth');

/**
 * Gestion des routes pour les articles
 */

Route::get('articles', 'ArticleController@index')->name('articles')->middleware('auth');
Route::get('article/new', 'ArticleController@create')->name('article.create')->middleware('auth');
Route::get('article/{id}/edit', 'ArticleController@edit')->name('article.edit')->middleware('auth');
Route::post('article', 'ArticleController@store')->name('article.store')->middleware('auth');
Route::put('article/{id}', 'ArticleController@update')->name('article.update')->middleware('auth');
Route::delete('article/{id}', 'ArticleController@destroy')->name('article.delete')->middleware('auth');

/**
 * Gestion des routes pour les vehicules
 */
Route::get('vehicules', 'VehiculeController@index')->name('vehicules')->middleware('auth');
Route::get('vehicule/new', 'VehiculeController@create')->name('vehicule.create')->middleware('auth');
Route::get('vehicule/{vehicule}/edit', 'VehiculeController@edit')->name('vehicule.edit')->middleware('auth');
Route::post('vehicule', 'VehiculeController@store')->name('vehicule.store')->middleware('auth');
Route::put('vehicule/{vehicule}', 'VehiculeController@update')->name('vehicule.update')->middleware('auth');
Route::delete('vehicule/{vehicule}', 'VehiculeController@destroy')->name('vehicule.delete')->middleware('auth');

/**
 *  Gestion des routes pour les offres
 */
Route::get('offres', 'OffreController@index')->name('offres')->middleware('auth');
Route::get('offre/new', 'OffreController@create')->name('offre.create')->middleware('auth');
Route::get('offre/{offre}/edit', 'OffreController@edit')->name('offre.edit')->middleware('auth');
Route::post('offre', 'OffreController@store')->name('offre.store')->middleware('auth');
Route::put('offre/{offre}', 'OffreController@update')->name('offre.update')->middleware('auth');
Route::delete('offre/{offre}', 'OffreController@destroy')->name('offre.delete')->middleware('auth');


