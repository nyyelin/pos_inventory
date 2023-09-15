<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'storage_id',
         'qty',
          'expired_date',
             'buy_price',
            'total_amount'
        ];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function category()
    {
        return $this->hasOneThrough(Category::class,Item::class,'id','id','item_id','category_id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
