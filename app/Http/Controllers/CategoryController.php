<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shops = Shop::where('user_id',\Auth::user()->id)->get();
        // if ($request->ajax()) {
        //     $id = 1;
            
        //     $query = Category::orderBy('id', 'DESC')->paginate(10);
            
        // }
        $categories = Category::whereHas('shop',function($q){
            $q->where('user_id',\Auth::user()->id);
        })->orderBy('id', 'DESC')->get();
        return view('grocery.category.index', compact('shops', 'categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'shop' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->shop_id = $request->shop;
        $category->save();
        return redirect()->route('grocery.category.index')->with('status', 'Data added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_shop' => 'required',
        ]);

        $category = Category::find($request->id);
        $category->name = $request->edit_name;
        $category->shop_id = $request->edit_shop;
        $category->save();

        return redirect()->route('grocery.category.index')->with('update_status', 'Data Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::find($category->id);
        $category->delete();
        return redirect()->route('grocery.category.index');
    }
}
