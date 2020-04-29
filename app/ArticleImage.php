<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    //
    public $table = 'article_images';

    public $fillable = [
        'article_id',
        'article_img_path',
        'article_img_caption'
    ];

    public function article() {
        return $this->belongsTo(Article::class);
    }

}
