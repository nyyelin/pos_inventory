<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Stock;
use App\Models\StockTransaction;
use DNS1D;
use DB;
use Datatables;
use App\ModelService;

class ItemController extends Controller
{
    use ModelService;

    protected $defModel;

    public function __construct(Stock $model){
        $this->defModel = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::whereHas('shop', function($q){
            $q->where('user_id',\Auth::user()->id);
        })->get();
        return view('grocery.item.index',compact('categories'));

    }

    public function getItems(Request $request){
        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => true,
         'canAjaxEdit' => true
     ];
        $query = \App\Models\Item::query()->with('category:id,name')->whereHas('category', function($q) use ($auth){
             $q->whereHas('shop', function($q) use ($auth){
                 $q->where('user_id', $auth->id);
             });
         });
        $query = $this->optionsQuery($query, $options);
        $data = $query->get();
        return Datatables::of($data)
        ->addIndexColumn()
       
        ->addColumn('action', function($row) use ($action){
         return $action;
              
        })
        ->rawColumns(['action'])
        ->make(true);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('grocery.item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $inputs = $request->all();
       $data = Item::create($inputs);
       try { 
        DB::beginTransaction();

        // Do something and save to the db...
        
        // Commit the transaction

        return response()->json([
            'status' => true,
            'msg' => 'successfully created!'
        ]);
        
        DB::commit();
        
        } catch (\Exception $e) {
        
        // An error occured; cancel the transaction...
        
        DB::rollback();
        
        // and throw the error again.
        
        throw $e;
        
        }

    }

    // public function barcodeGenerate(){
    //     $barcode = ;
    //     reture $barcode;
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
       return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
       $inputs = $request;
       $item->name = $inputs['name'] ?? $item['name'];
       $item->brand = $inputs['brand'] ?? $item['brand'];
       $item->category_id = $inputs['category_id'] ?? $item['name'];
       $item->save();
       return response()->json([
        'status' => true,
        'msg' => 'successfully updated!'
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
