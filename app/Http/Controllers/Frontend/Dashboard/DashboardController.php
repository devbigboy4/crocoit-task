<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Services\CategoryArticleService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $categoryArticleService;

    public function __construct(CategoryArticleService $categoryArticleService)
    {
        $this->categoryArticleService = $categoryArticleService;
    }

    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {

        $categoryIds = $request->input('categories_ids', []);

        if (!empty($categoryIds)) {
            $articles = $this->categoryArticleService->getArticlesByCategories($categoryIds);
        } else {
            $articles = Article::with('categories:id,name')->get();
        }


        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('dashboard', compact('categories', 'articles'));
    }
}
