<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use Illuminate\Http\Request;
use App\ModelService;
use Datatables;

class StockTransactionController extends Controller
{
    use ModelService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('grocery.stock.transactions');
    }

    public function getStockTrans(Request $request){
        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => false,
         'canDetail' => true
     ];
        $query = \App\Models\StockTransaction::query()->with('item', 'item.category');
         
        $query = $this->optionsQuery($query, $options);
        $data = $query->get();
        return Datatables::of($data)
        ->addIndexColumn()
       ->addColumn('category_name', function($row){
        return $row->item->category->name;
             
       })
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
        $items = \App\Models\Item::withSum('stocks','qty')->with('category')->get();
        
        return view('grocery.stock.transactions_create',compact('items'));
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
        $item = \App\Models\Item::find($inputs['item_id']);
        $stock = \App\Models\Stock::create([
            'item_id' => $item->id,
            'qty' => $inputs['new_qty'],
            'expired_date' => $inputs['expired_date'] ?? null,
            'brand' => null,
            'sell_price' => $inputs['sell_price'],
            'origin_price' => $inputs['price'],

        ]);

        $stock_transaction = \App\Models\StockTransaction::create([
            'item_id' => $item->id,
            'stock_id' => $stock->id,
            'qty' => $inputs['new_qty'],
            'price_per_one' => $inputs['price'],
            'brand_name' => $item->name,
            'unit' => '1',
            'total_price' => $item['price'] * $inputs['new_qty']
        ]);

        return redirect()->route('grocery.item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockTransaction  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockTransaction  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockTransaction  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransaction $stockTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockTransaction  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockTransaction $stockTransaction)
    {
        //
    }
}
