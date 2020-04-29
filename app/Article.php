<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $table = 'articles';

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'type_article',
        'auteur',
        'couverture'
    ];

    public function articles_images() {
        return $this->hasMany(ArticleImage::class);
    }
    public function auteur() {
        return$this->belongsTo(User::class);
    }
}
