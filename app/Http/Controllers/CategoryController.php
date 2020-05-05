<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories($status = null)
    {
        $context = [
            'categories'=>Category::all()->groupBy('status'),
            'tab'=> $status == null? Category::STATUS_ACTIVE : $status
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
        $context = [
            'posts' => Post::whereIn('category_id', [null, Category::where('name', Category::UNCATEGORIEZED)->first()->id])->get()
        ];
        return view('backend.categories.create_category', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        todo perform validation
        $new_category = Category::create($request->all());
        if (isset($request->posts)) {
            foreach ($request->posts as $post_id) {
                Post::find(intval($post_id))->update(['category_id'=>$new_category->id]);
            }
        }
        $new_category->resolveStuff();
        Session::flash("success", 'New Category successfully created.');
        return redirect(route('categories', $new_category->status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
