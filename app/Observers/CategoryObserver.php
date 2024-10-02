<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{

    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->name_en);
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    public function updating(Category $category)
    {
        if ($category->isDirty('name_en')) {
            $category->slug = Str::slug($category->name_en);
        }
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
