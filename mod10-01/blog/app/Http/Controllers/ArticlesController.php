<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{
    function showArticles() {
        $articles = Article::all();
        return view('articles.articles_list', compact('articles'));
    }

    function show($id) {
        $article = Article::find($id);
        return view('articles.single_article', compact('article'));
    }

    function create(){
        return view('articles.article_create');
    }

    function store(Request $request){
        $new_article = new Article();
        $new_article->title = $request->title;
        $new_article->content = $request->content;
        $new_article->save();
        
        return redirect('/articles');
    }
    
    function delete($id) {
        $article = Article::find($id);
        $article->delete();
        
        return redirect('/articles');
    }
    
    function edit($id) {
        $article = Article::find($id);
        return view('articles.article_edit', compact('article'));
    }
    
    function update($id, Request $request) {
        $edit_article = Article::find($id);
        $edit_article->title = $request->title;
        $edit_article->content = $request->content;
        $edit_article->save();
        
        return redirect('/articles');
    }
}
