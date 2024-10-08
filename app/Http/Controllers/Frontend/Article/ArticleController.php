<?php

namespace App\Http\Controllers\Frontend\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fronend\ArticleStoreRequest;
use App\Http\Requests\Fronend\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Traits\FileControlTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    use FileControlTrait;

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

        return view('frontend.articles.show', compact('article', 'related_articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::with('categories')->findOrFail($id);

        if ($article->user_id != Auth::id()) {
            $notification = [
                'message' => "Something went wrong!",
                'alert-type' => 'error',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);
        }

        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        $selectedCategories = $article->categories->pluck('id')->toArray();

        return view('frontend.articles.edit', compact('article', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {

        if ($article->user_id != Auth::id()) {
            $notification = [
                'message' => "Something went wrong!",
                'alert-type' => 'error',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);
        }
        try {

            DB::beginTransaction();

            $data = $request->validated();

            if ($request->hasFile('image')) {
                $this->deleteFile($article->image);
                $data['image'] = $this->uploadFile($request->file('image'), 'articles');
            }

            $article->update($data);

            if ($request->has('categories_ids')) {
                $article->categories()->sync($request->input('categories_ids'));
            } else {
                // If no facilities are selected, remove all facilities associated with the room
                $article->categories()->sync([]);
            }

            DB::commit();

            $notification = [
                'message' => 'Article Updated successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->route('articles.edit', $article->id)->with($notification);

        } catch (Exception $e) {
            DB::rollBack();

            $notification = [
                'message' => "Something went wrong! Please try again.'",
                'alert-type' => 'error',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $user = User::find(Auth::user()->id);
            if (!$user || $user->id != $article->user_id) {
                $notification = [
                    'message' => "Something went wrong!",
                    'alert-type' => 'error',
                ];
                // Return with error notification
                return redirect()->back()->with($notification);
            }

            $this->deleteFile($article->image);


            $article->categories()->detach();

            $article->delete();

          $notification = [
                'message' => "Article deleted suceess'",
                'alert-type' => 'success',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);

        } catch (Exception $e) {

             $notification = [
                'message' => "Something went wrong! Please try again.'",
                'alert-type' => 'error',
            ];
            // Return with error notification
            return redirect()->back()->with($notification);
        }
    }
}
