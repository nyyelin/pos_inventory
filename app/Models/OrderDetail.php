<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'item_id', 'storage_id','qty','sell_price','discount'];

    public function inventory()
    {
        return \DB::table('inventories')->join('order_details',function($q){
            $q->on('order_details.item_id','inventories.item_id')
            ->on('order_details.storage_id','inventories.storage_id');
        
        })->get()[0];
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
