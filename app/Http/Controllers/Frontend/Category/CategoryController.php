<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categoryId = $request->input('categoryId');

        $categories = Category::whereNull('parent_id')->get();

        if ($categoryId) {
            $category = Category::findOrFail($categoryId);

            $articles = Article::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })->with('categories')->get();

        } else {
            $articles = Article::with('categories:id,name')->get();
        }

        return view('frontend.categories.index', compact('categories', 'articles'));
    }

}
