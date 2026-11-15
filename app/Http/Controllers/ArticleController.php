<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('articles.index', [
            'title'    => 'Artikel',
            'articles' => Article::with('author')->latest()->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::with('author')->where('slug', $slug)->firstOrFail();
        $more = Article::where('id', '!=', $article->id)->latest()->limit(3)->get();

        return view('articles.show', [
            'title'    => $article->judul,
            'metaDesc' => Str::limit(strip_tags($article->isi), 155),
            'article'  => $article,
            'more'     => $more,
        ]);
    }
}
