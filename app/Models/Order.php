<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

protected $fillable = ['code','total_qty','total_amount','shopping_date','pay','change','discount','user_id'];

public function user(){
    return $this->belongsTo(User::class);
}
}
