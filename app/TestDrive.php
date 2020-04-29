<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDrive extends Model
{
    //
    public $table = 'test_drives';

    protected $fillable = [
        'nom_demandeur',
        'tel_demandeur',
        'email_demandeur',
        'vehicule_id',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin'
    ];
}
