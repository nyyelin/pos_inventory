<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RetailTransaction;
use Datatables;
use App\ModelService;

class ReportController extends Controller
{
    use ModelService;
    public function incomeReports(){
        return view('report.income_list');
    }

    public function getAjaxIncomes(Request $request) {
        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => false,
         'canAjaxEdit' => false,
         'canDetail' => true,
     ];
     $auth = \Auth::user();
        $query = Order::query()->whereHas('user', function($q) use ($auth){
            $q->where('id',$auth->id);
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

    public function getAjaxRestockTrans(Request $request) {
        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => true,
         'canAjaxEdit' => false,
         'canDetail' => false,
     ];
     $auth = \Auth::user();
        $query = RetailTransaction::query()
        ->with('storage','item')
        ->whereHas('storage', function($q) use ($auth){
            $q->where('user_id',$auth->id);
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

    public function restockTrans(Request $request){
        $trans = RetailTransaction::all();
        return view('report.retail_trans', compact('trans'));
    }

    public function orderDetail($id)
    {
        $order = Order::find($id);
        $items = OrderDetail::join('items','items.id','order_details.item_id')
        ->join('orders','orders.id','order_details.order_id')
        ->join('storages','storages.id','order_details.storage_id')
        ->join('inventories',function($q){
            $q->on('inventories.item_id','order_details.item_id')
            ->on('inventories.storage_id','order_details.storage_id');
        })
        ->where('orders.id',$id)
        ->selectRaw('orders.code as ordercode, orders.shopping_date as shoped_at,storages.prefix as stg_prefix, storages.serial as stg_serial, inventories.barcode as barcode, order_details.*')
        ->get();
        
        
        return view('report.order_detail', compact('items','order'));
    }
}
