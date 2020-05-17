<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
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
    public function comments($status = null)
    {
        $context = [
            'comments_by_status' => $status ? Comment::whereStatus($status)->get()->groupBy('status') : Comment::all()->groupBy('status'),
            'tab' => $status
        ];
        return view('backend.comments.comments', $context);
    }

    public function approve_comment(Comment $comment, $status=null)
    {
        if ($comment) {
            $comment->update(['status' => Comment::STATUS_APPROVED]);
        }
        Session::flash('success', 'Comment Approved.');
        return redirect(route('comments', $status));
    }

    public function decline_comment(Comment $comment, $status=null)
    {
        if ($comment) {
            $comment->update(['status' => Comment::STATUS_DECLINED]);
        }
        Session::flash('success', 'Comment Declined.');
        return redirect(route('comments', $status));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //x
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $status = $comment->status;
        foreach ($comment->children as $child) {
            $child->update(['parent_id' => null]);
        }
        $comment->delete();
        Session::flash('success', 'Comment deleted.');
        return redirect(route('comments', $status));
    }
}
