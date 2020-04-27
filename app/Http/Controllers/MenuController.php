<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuItem;
use App\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menus()
    {
        $context = [
            'menus' => Menu::all(),
            'pages' => Page::all()
        ];
        return view('backend.menus.menus', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_menu(Request $request)
    {
        $new_menu = Menu::create($request->all());
        foreach ($request->page as $i => $page_id) {
            MenuItem::create([
                'menu_id' => $new_menu->id,
                'page_id' => doubleval($page_id),
                'label' => Page::find(doubleval($page_id))->title,
            ]);
        }
//        todo success message
        return redirect(route('menus'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit_menu(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete_menu(Menu $menu)
    {
        $menu->delete();
//        todo checks and message
        return redirect(route('menus'));
    }
}
