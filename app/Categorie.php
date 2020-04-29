<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    public $table = 'categories';

    public function vehicules() {
        return $this->hasMany(Vehicule::class, 'categorie_id');
    }

    protected $fillable = [
      'nom'
    ];

    public function scopeFilters($query, array $filters) {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('nom', 'like', '%'.$search.'%');
        });
    }
}
