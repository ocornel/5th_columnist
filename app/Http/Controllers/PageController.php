<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuItem;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'pages' => Page::all(),
        ];
        return view('backend.pages.pages', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_page()
    {
        $context = [
            'menus' => Menu::all()
        ];
        return view('backend.pages.create_page', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_page(Request $request)
    {
//        todo perform validation
        $new_page = Page::create($request->all());
        if (isset($request->menus)) {
            foreach ($request->menus as $menu_id) {
                MenuItem::create([
                    'menu_id' => intval($menu_id),
                    'label' => $new_page->title,
                    'page_id' => $new_page->id
                ]);
            }
        }
        Session::flash("success", 'New Page successfully created.');
        return redirect(route('pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_page(Page $page)
    {
        $context = [
            'page' => $page
        ];
        return view('backend.pages.show_page', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_page(Page $page)
    {
        $context = [
            'page' => $page,
            'menus' => Menu::all()
        ];
        return view('backend.pages.create_page', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Page $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_page(Request $request, Page $page)
    {
        $page->update($request->all());
        foreach (MenuItem::where('page_id', $page->id)->get() as $item) $item->delete();
        if (isset($request->menus)) {
            foreach ($request->menus as $menu_id) {
                MenuItem::create([
                    'menu_id' => intval($menu_id),
                    'label' => $page->title,
                    'page_id' => $page->id
                ]);
            }
        }
        Session::flash("success", 'Page details successfully updated.');
        return redirect(route('show_page', [$page, $page->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Page $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete_page(Page $page)
    {
        $page->delete();
        Session::flash("success", 'Page deleted successfully.');
        return redirect(route('pages'));
    }
}
