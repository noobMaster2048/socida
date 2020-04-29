<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Article/Index', [
            'articles' => function() {
                $articles = DB::table('articles')
                    ->select('id', 'titre', 'contenu','slug',
                        DB::raw('case 
                                when type_article = "txt" then "Texte"
                                when type_article = "img" then "Image"
                                when type_article = "vid" then "Vidéo"
                                else ""
                             end as type_article'))
                    ->paginate(15);
                return $articles;
            }
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //
        return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titre' => ['required'],
            'contenu' => ['required'],
            'type_article' => ['required']
        ]);
        $images = $request->images;
        $user = Auth::user()->id;
        $photo = $request->file('couverture');
        $file = $photo->getClientOriginalExtension();
        Storage::disk('uploads')->put('/article/' .$photo->getFilename() . '.' .$file, File::get($photo) );
       $article = Article::create([
            'titre' => $request->get('titre'),
            'contenu' => $request->get('contenu'),
            'slug' => Str::slug($request->get('titre')),
            'type_article' => $request->get('type_article'),
            'couverture' => $photo->getFilename() . '.' .$file,
            'auteur' => $user,
        ]);
       if (!empty($images)) {
           foreach ($images as $image) {
               $imagepath = Storage::disk('uploads')->put('/articles/' .$article->id, $image );
               ArticleImage::create([
                   'article_img_path' => '/uploads/' .$imagepath,
                   'article_id' => $article->id,
                   'article_img_caption' => $article->titre
               ]);
           }
       }
        return Redirect::route('articles')->with('success', 'Article crée');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);
        return Inertia::render('Article/Edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'titre' => ['required'],
            'contenu' => ['required'],
            'type_article' => ['required']
        ]);

        $article = Article::findOrFail($id);
        $user = Auth::user()->id;
        $photo = $request->file('couverture');
        $file = $photo->getClientOriginalExtension();
        Storage::disk('uploads')->put('/article/' .$photo->getFilename() . '.' .$file, File::get($photo) );
        $article->titre = $request->get('titre');
        $article->slug = Str::slug($request->get('titre'));
        $article->contenu = $request->get('contenu');
        $article->type_article = $request->get('type_article');
        $article->couverture = $photo->getFilename() . '.' .$file;
        $article->auteur = $user;
        $article->save();

       return Redirect::route('articles')->with('success', 'Article ' .$article->titre. ' a été enregistré');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $article = Article::findOrFail($id);
        $article->delete();
        return Redirect::route('articles')->with('success', 'Article ' .$article->titre. ' a été supprimé');
    }
}
