<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelService;
use App\Models\Inventory;
use App\Models\Storage;
use Datatables;
class InventoryController extends Controller
{
    use ModelService;
    public function index(){

        return view('grocery.inventory.index');
    }

    public function getInventories(Request $request)
    {
        $options = $request->all();
        $auth = \Auth::user();
        $action = [
         'canEdit' => false,
         'canDelete' => true,
         'canAjaxEdit' => false,
         'canQtyDec' => true,
         'canQtyInc' => true,
     ];
        $query = Inventory::query()->with(
            'item','storage','category'
        )->whereHas('storage', function($q) use ($auth){
            $q->where('user_id', $auth->id);
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

    public function qtyAdjust(Request $request)
    {
        $inputs = $request->all();
        $inventory = Inventory::find($inputs['item_id']);
        $storage = Storage::find($inventory->storage_id);
        if($inputs['mtype'] == 'inc') {
           
            if($storage->qty > 0){
                $inventory->qty = $inventory->qty + $inputs['inventory_qty'];
                $storage->qty -=  $inputs['inventory_qty'];
            }
        }

        if($inputs['mtype'] == 'decs') {

            if($inventory->qty > 0 && $inputs['inventory_qty'] <= $inventory->qty){
                
                $inventory->qty = $inventory->qty - $inputs['inventory_qty'];
                $storage->qty +=  $inputs['inventory_qty'];
            }

        }

        $inventory->save();
        $storage->save();

        return 'success';
    }

    public function barcodeSearch(Request $request)
    {
        $kw = $request->keyword;
        $product = Inventory::with('item')->where('barcode',$kw)->first();
        return response()->json([
            'status' => is_null($product) ? false : true,
            'result' => $product
        ]);
    }
}
