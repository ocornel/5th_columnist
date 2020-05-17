<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
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
    public function posts($status = null, $category = null)
    {
        foreach (Post::whereCategoryId(null)->get() as $post) $post->update(['category_id' => Category::whereName(Category::UNCATEGORIEZED)->first()->id]);
        $context = [
            'posts_by_category' => $status ? Post::whereStatus($status)->get()->groupBy('category_name') : Post::all()->groupBy('category_name'),
            'tab' => $category,
            'status' => $status
        ];
        return view('backend.posts.posts', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $context = [
            'tags' => Tag::all(),
            'categories' => Category::all()
        ];
//        TODO create form
        return view('backend.posts.create_post', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request['publish_date'] = date_create($request['publish_date']);
        $post = Post::create($request->all());

        if ($request->hasFile('image_upload')) {
            $post->feature_image = $request->image_upload->store('posts');
            $post->save();
        }
        $post->status = $post->publish_date > now() ? Post::STATUS_DRAFT : Post::STATUS_PUBLISHED;
        $post->save();

        $post->resolveStuff();
        Session::flash('success', 'Post created');
        return redirect(route('posts', [$post->status, $post->category_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        $context = [
            'post' => $post
        ];
        return view('backend.posts.show_post', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $context = [
            'post' => $post,
            'categories' => Category::all()
        ];
        return view('backend.posts.create_post', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        $request['publish_date'] = date_create($request['publish_date']);
        $post->update($request->all());
        $post->status = $post->publish_date > now() ? Post::STATUS_DRAFT : Post::STATUS_PUBLISHED;
        $post->save();
//        TODO Update feature image
        Session::flash("success", 'Page details successfully updated.');
        $post->resolveStuff();
        return redirect(route('show_post', [$post, $post->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $status = $post->status;
        $category = $post->category_name;
        $post->delete();
        Session::flash("success", 'Post deleted successfully.');
        return redirect(route('posts', [$status, $category]));
    }
}
