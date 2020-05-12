<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories($status = null)
    {
        $context = [
            'categories' => Category::all()->groupBy('status'),
            'tab' => $status == null ? Category::STATUS_ACTIVE : $status
        ];
        return view('backend.categories.categories', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $posts = Post::all()->filter(function ($post) {
            return $post->category_id == Category::where('name', Category::UNCATEGORIEZED)->first()->id ||
                $post->category_id == null;
        });
        $context = [
            'posts' => $posts
        ];
        return view('backend.categories.create_category', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        todo perform validation
        $new_category = Category::create($request->all());
        if (isset($request->posts)) {
            foreach ($request->posts as $post_id) {
                Post::find(intval($post_id))->update(['category_id' => $new_category->id]);
            }
        }
        $new_category->resolveStuff();
        Session::flash("success", 'New Category successfully created.');
        return redirect(route('categories', $new_category->status));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $context = [
            'category' => $category
        ];
        return view('backend.categories.category_show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $posts = Post::all()->filter(function ($post) use ($category) {
            return $post->category_id == Category::where('name', Category::UNCATEGORIEZED)->first()->id ||
                $post->category_id == $category->id ||
                $post->category_id == null;
        });
        $context = [
            'category' => $category,
            'posts' => $posts
        ];
        return view('backend.categories.create_category', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        foreach (Post::where('category_id', $category->id)->get() as $post) $post->update(['category_id' => null]);
        if (isset($request->posts)) {
            foreach ($request->posts as $post_id) {
                Post::find(intval($post_id))->update(['category_id' => $category->id]);
            }
        }
        $category->resolveStuff();
        Session::flash("success", 'Category details successfully updated.');
        return redirect(route('show_category', [$category, $category->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Category $category)
    {
        $status = $category->status;
        foreach (Post::where('category_id', $category->id)->get() as $post) $post->update(['category_id' => null]);
        $category->delete();
        Session::flash("success", 'Category deleted successfully.');
        return redirect(route('categories', $status));
    }
}
