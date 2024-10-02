<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\FileControlTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use FileControlTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();

        $categories = Category::filter($query)
            ->with('parent:id,name')
            ->withCount(['articles as articles_count' => function ($query) {
                $query->where('status', 'active');
            }])
            ->latest()
            ->paginate(10);

        $parents = Category::whereNull('parent_id')->get();

        return view('admin.category.index', compact('categories', 'parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        // dd($categories);
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $this->uploadFile($request->file('icon'), 'categories/icons');
        }

        $category = Category::create($data);

        $notification = [
            'message' => "Category {$category->name} Created successfully!",
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parents = Category::select([
            'id',
            'name',
        ])
            ->where('id', '<>', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->Orwhere('parent_id', '<>', $category->id);
            })
            ->get();

        return view('admin.category.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('icon')) {
                $this->deleteFile($category->icon);
                $data['icon'] = $this->uploadFile($request->file('icon'), 'categories/icons');
            }

            $category->update($data);

            $notification = [
                'message' => 'Category Updated successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->route('admin.categories.index')->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Update Fail Try again ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->route('admin.categories.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->children()->exists()) {
            $notification = [
                'message' => 'This category has subcategories and cannot be deleted.',
                'alert-type' => 'error',
            ];
            return redirect()->route('admin.categories.index')->with($notification);
        }

        $category->delete();

        $notification = [
            'message' => 'Category deleted successfully.',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.categories.index')->with($notification);

    }

    public function trash()
    {
        $categories =  Category::onlyTrashed()->paginate(5);

        return view('admin.category.trash', compact('categories'));
    }

    public function restore(string $category)
    {
        $category = Category::onlyTrashed()->findOrFail($category);
        $category->restore();

        $notification = [
            'message' => 'Category Restored successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.categories.trash')->with($notification);

    }

    public function forceDelete(string $category)
    {
        $category = Category::onlyTrashed()->findOrFail($category);
        $category->forceDelete();

        if ($category->icon) {
            $this->deleteFile($category->image);
        }

        $notification = [
            'message' => 'Category Completely Deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.categories.trash')->with($notification);

    }
}
