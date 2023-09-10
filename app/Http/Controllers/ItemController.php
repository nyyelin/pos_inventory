<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Stock;
use App\Models\StockTransaction;
use DNS1D;
use Datatables;
use App\ModelService;

class ItemController extends Controller
{
    use ModelService;

    protected $defModel;

    public function __construct(User $model){
        $this->defModel = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $auth = \Auth::user();
            
            
            $data = \App\Models\Item::with('category:id,name')->whereHas('category', function($q) use ($auth){
                $q->whereHas('shop', function($q) use ($auth){
                    $q->where('user_id', $auth->id);
                });
            })->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="remove btn btn-danger btn-sm">Remove</a>
                           <a href="javascript:void(0)" class="edit btn btn-warning btn-sm">Edit</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

            
        }
        return view('grocery.item.index');
    }

    public function getItems(Request $request){
       $options = $request->all();
       $auth = \Auth::user();
       $action = [
        'canEdit' => true,
        'canDelete' => true,
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
        // validataion left 
        $inputs = $request->all();
    
        $item = Item::create([
            'name' => $inputs['name'],
            'category_id' => $inputs['category_id'],
           'bar_code' => ''
        ]);

        $item->bar_code =  444564565 + $item->id;
        $item->save();

        $stock = Stock::create([
            'item_id' => $item->id,
            'qty' => 0,
            'expired_date' => $inputs['expired_date'] ?? null,
            'brand' => $inputs['brand'],
            'sell_price' => $inputs['sell_price'],
            'origin_price' => $inputs['price'],
        ]);

        $stock_transaction = StockTransaction::create([
            'item_id' => $item->id,
            'stock_id' => $stock->id,
            'qty' => $inputs['qty'],
            'price_per_one' => $inputs['price'],
            'brand_name' => $item->name,
            'unit' => '1',
            'total_price' => $item['price'] * $inputs['qty']
        ]);

        return redirect()->route('grocery.item.index');


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
        //
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
        //
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
