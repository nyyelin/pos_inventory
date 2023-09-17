<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Inventory;
use App\Models\Item;

class PosController extends Controller
{
    public function index(){
        return view('pos.table_view');
    }

    public function checkout(Request $request)
    {
     $list= json_decode($request->list,true);
     $pay = $request->pay;
     $change = $request->change;
     $last_order = Order::orderBy('id','desc')->first();
    
     $order_num = sprintf("ORD-".\Auth::user()->shop->id."%05d", !is_null($last_order) ? ($last_order->id +1) : 0);
     $order = Order::create([
        'code' => $order_num,
        'total_qty' => $request->total_qty,
        'total_amount' => $request->total,
        'shopping_date' => date('Y-m-d'),
        'pay' => $request->pay,
        'change' => $request->change,
        'user_id' => \Auth::user()->id
     ]);
        foreach($list as $item)
        {
           
            $inventory = Inventory::find($item['id']);
            $product = Item::find($inventory->item_id);

            OrderDetail::create([
                'order_id' => $order->id,
                'item_id' => $product->id,
                'storage_id' => $inventory->storage_id,
                'qty' =>$item['qty'],
                'sell_price' => $item['sell_price'],
            
            ]);

        }

        return response()->json([
            'status' => true,
            'msg' => 'Successfullt checout!'
        ]);
        
    }
}
