<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderBy('id', 'DESC')->get();
        return view('shop.shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.shop.create');
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
            'shop_name' => 'required',
            'email' => 'required',
            'user_phone' => ['required', 'max:11'],
            'shop_phone' => ['required', 'max:11'],
            'shop_address' => 'required',
            'password' => ['required', 'min:8'],
        ]);
        // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->phone = $request->user_phone;
        $user->save();

        $shop = new Shop();
        $shop->name = $request->shop_name;
        $shop->phone = $request->shop_phone;
        $shop->address = $request->shop_address;
        // $shop->user_id = Auth::user()->id;
        $shop->user_id = $user->id;
        $shop->tax = $request->tax;
        $shop->save();

        return redirect()->route('shop.shop.index')->with('status', 'Data Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shop.shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'email' => 'required',
            'user_phone' => 'required',
            'shop_phone' => 'required',
            'shop_address' => 'required',
        ]);
        $user = User::find($shop->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->user_phone;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->assignRole('shopper');
        $user->save();

        $shop->name = $request->shop_name;
        $shop->phone = $request->shop_phone;
        $shop->address = $request->shop_address;
        $shop->user_id = $user->id;
        $shop->tax = $request->tax;
        $shop->save();

        return redirect()->route('shop.shop.index')->with('update_status', 'Data Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shop.shop.index');
    }

    public function change_password(Request $request)
    {
        $request->validate([
                'password' => ['required', 'min:8'],
        ]);

        $user = User::find(Auth()->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back();
    }
}
