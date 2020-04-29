<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    //
    public $table = 'marques';

    public function vehicules() {
        return $this->hasMany(Vehicule::class, 'marque_id');
    }

    protected $fillable = [
        'nom',
        'description'
    ];
}
