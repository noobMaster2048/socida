<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculeImage extends Model
{
    //
    public $table = 'vehicule_images';

    public $fillable = ['vehicule_id', 'veh_img_path', 'veh_img_caption'];

    public function vehicule() {
        return $this->belongsTo(Vehicule::class);
    }
}
