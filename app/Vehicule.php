<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    //
    public $table = 'vehicules';

    public function marque() {
        return $this->belongsTo(Marque::class, 'marque_id');
    }
    public function categorie() {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    protected $fillable = [
        'nom',
        'disponible',
        'marque_id',
        'categorie_id',
        'consommation',
        'description',
        'prix',
        'hauteur',
        'longueur',
        'largeur',
        'nb_places',
        'cp_coffre',
        'ray_braq',
        'lien_visuel_ext',
        'lien_visuel_int',
        'img_path',
        'slug',
        'ordre',
    ];

    public function vehicules_images() {
        return $this->hasMany(VehiculeImage::class);
    }

    public function offres() {
        return $this->hasMany(Offre::class, 'vehicule_id');
    }

}
