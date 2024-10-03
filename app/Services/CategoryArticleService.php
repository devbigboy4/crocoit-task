<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Category;

class CategoryArticleService
{
    /**
     * Get all Articles based on selected categories and their subcategories.
     *
     * @param array $categoryIds
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function getArticlesByCategories(array $categoryIds)
    {
        // Get the selected categories and their subcategories
        $categories = Category::whereIn('id', $categoryIds)->with('allChildren')->get();

        // Collect all category IDs (including subcategories)
        $allCategoryIds = $this->getAllCategoryIds($categories);

        // Fetch posts associated with these category IDs
        $articles = Article::whereHas('categories', function ($query) use ($allCategoryIds) {
            $query->whereIn('categories.id', $allCategoryIds);
        })->get();

        return $articles;
    }

    /**
     * Recursively get all category IDs including subcategories.
     *
     * @param \Illuminate\Database\Eloquent\Collection $categories
     * @return array
     */

    private function getAllCategoryIds($categories)
    {
        $categoryIds = [];

        foreach ($categories as $category) {
            $categoryIds[] = $category->id;

            if ($category->allChildren->isNotEmpty()) {
                $categoryIds = array_merge($categoryIds, $this->getAllCategoryIds($category->allChildren));
            }
        }

        return $categoryIds;
    }
}
