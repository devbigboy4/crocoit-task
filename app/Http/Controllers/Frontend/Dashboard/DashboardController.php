<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        $articles = Article::get();


        return view('dashboard', compact('categories', 'articles'));
    }
}
