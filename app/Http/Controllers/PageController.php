<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
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
    public function pages()
    {
        $context = [
            'pages'=>Page::all(),
        ];
        return view('backend.pages.pages', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_page()
    {
        dd('Tool for creating new page comes here.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show_page(Page $page)
    {
        $context = [
            'page'=>$page
        ];
        dd('Page details coming here', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit_page(Page $page)
    {
        $context = [
            'page' =>$page
        ];

        dd('Editing page tool coming here', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete_page(Page $page)
    {
        $page->delete();
//        todo create message
        return redirect(route('pages'));
    }
}
