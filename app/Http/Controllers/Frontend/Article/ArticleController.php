<?php

namespace App\Http\Controllers\Frontend\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fronend\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use App\Traits\FileControlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    use FileControlTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        return view('frontend.articles.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        // Start the database transaction
        DB::beginTransaction();

        try {
            // Get validated data
            $articleData = $request->validated();

            // Assign user_id from the authenticated user
            $articleData['user_id'] = Auth::user()->id;

            // Handle file upload if image is present
            if ($request->hasFile('image')) {
                $articleData['image'] = $this->uploadFile($request->file('image'), 'articles');
            }

            // Create the article
            $article = Article::create($articleData);

            // Attach categories if provided
            if ($request->has('categories_ids')) {
                $article->categories()->attach($request->input('categories_ids'));
            }

            // Commit the transaction if everything is successful
            DB::commit();

            // Prepare the notification message
            $notification = [
                'message' => "Article created successfully!",
                'alert-type' => 'success',
            ];

            // Redirect with success notification
            return redirect()->route('my-articles')->with($notification);

        } catch (\Exception $e) {
            // Rollback transaction in case of an error
            DB::rollBack();

            // Optionally log the error for debugging purposes
            // \Log::error('Article Creation Error: ', ['error' => $e->getMessage()]);
            $notification = [
                'message' => "Something went wrong! Please try again.'",
                'alert-type' => 'error',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $related_articles = Article::where('id', '!=', $article->id)
            ->where('status', 'active')
            ->orderby('id', 'DESC')
            ->limit(4)
            ->get();

        return view('frontend.articles.show', compact('article','related_articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
