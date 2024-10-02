<?php

namespace App\Http\Controllers\Frontend\MyArticle;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->user()->id;
        $articles = Article::where('user_id', $user_id)
        ->get();

        return view('frontend.my-articles.index',compact('articles'));
    }
}
