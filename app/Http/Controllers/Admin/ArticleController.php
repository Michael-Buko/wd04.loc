<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        Article::create($request->all());
        return redirect()->route('admin.articles');
    }

    public function edit(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->fill($request->all());
        $article->save();
        return redirect()->route('admin.articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('admin.articles');
    }
}
