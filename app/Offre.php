<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    //
    public $table = 'offres';

    public $fillable = ['lien_video', 'statut', 'date_debut', 'date_fin', 'vehicule_id', 'prix_promo'];

    public function vehicule() {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }
}
