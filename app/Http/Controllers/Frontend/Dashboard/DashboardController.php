<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('dashboard', compact('categories'));
    }
}
