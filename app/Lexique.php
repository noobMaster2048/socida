<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lexique extends Model
{
    //
    public $table = 'lexiques';

    protected $fillable = [
        'sigle',
        'description'
    ];
}
