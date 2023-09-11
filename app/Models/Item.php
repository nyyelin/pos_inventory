<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'bar_code','brand'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function stocks(){
        return $this->hasMany(Stock::class)
        ->whereNull('expired_date')
        ->orWhere('stocks.expired_date', '>', date('Y-m-d'));
    }
}
