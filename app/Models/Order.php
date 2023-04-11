<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }



    //商品購買成功後要跑的 更新庫存
    public function updateProductStock()
    {
        foreach ($this->products as $product) {
            $quantity = $product->pivot->quantity;
            $product->decrement('quantity', $quantity);
            if ($product->quantity === 0) {
                $product->state = 'draft';
                $product->save();
            }
        }
    }

}
