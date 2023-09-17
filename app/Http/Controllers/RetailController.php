<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Storage;
use App\Models\RetailTransaction;
use App\Models\Inventory;
use App\ModelService;
use Datatables;

class RetailController extends Controller
{  use ModelService;
    //
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('grocery.retail.index', compact('categories','items'));
    }

    public function getStockTrans(Request $request)
    {
        

        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => true,
         'canAjaxEdit' => false
     ];
        $query = \App\Models\RetailTransaction::query()->with(
            'category','item'
        )->whereHas('storage',function($q) {
            $q->where('user_id', \Auth::user()->id);
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

    public function create()
    {
        $auth = \Auth::user();
        $categories = Category::whereHas('shop', function($q){
            $q->where('user_id', \Auth::user()->id);
        });
        
        $items = Item::whereHas('category.shop',function($q) use ($auth){
            $q->where('user_id',$auth->id);
        })->get();
        return view('grocery.retail.create', compact('categories','items'));
    }

    public function retailing(Request $request)
    {
       
        $validated = $request->validate([
            'item_id' => 'required',
            'total_qty' => 'required|min:1',
            'sell_price' => 'required',
        ]);
        
        $inputs = $request->all();
      
        $storage = null;
        //stg => storage

        $serial_number = $this->generateCode($inputs);
        $perfix = 'stg-'.\Auth::user()->shop->id.'-';

        
            $storage = Storage::create([
                'item_id' => $inputs['item_id'],
                'serial' => $serial_number,
                'prefix' => $perfix,
                'qty' => $inputs['storage_qty'],
                'user_id' => \Auth::user()->id,
                'shop_id' => \Auth::user()->shop->id
            ]);

    

        RetailTransaction::create([
            'item_id' => $inputs['item_id'],
            'storage_id' => $storage->id,
            'qty' => $inputs['total_qty'],
            'expired_date' => $inputs['expired_date'],
            'buy_price' => $inputs['buy_price'],
            'total_amount' => $inputs['buy_price'] * $inputs['total_qty']
        ]);

        Inventory::create([
            'item_id' => $inputs['item_id'],
            'storage_id' => $storage->id,
            'qty' => $inputs['inventory'],
            'sell_price' => $inputs['sell_price'],
            'expired_date' => $inputs['expired_date'],
            'barcode' => intval($serial_number.$inputs['item_id'])
        ]);


        return back()->with([
            'msg' => 'successfully added',
            'status' => true
        ]);



        

        
    }


    public function generateCode($inputs = [])
    {
        $latest = Storage::where('item_id', $inputs['item_id'])->where('user_id', \Auth::user()->id)->first();

        if (is_null($latest)) {
            $i = str_pad(1, 6, '0', STR_PAD_LEFT);
            return $i;
        } else {
            $serial_number = intval($latest->serial_num);
            $number = str_pad(($serial_number + 1), 6, '0', STR_PAD_LEFT);
            return $number;
        }

    }
}

