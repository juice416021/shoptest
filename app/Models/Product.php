<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'state',
        'user_id',
        'category_id',
        'quantity',
    ];

    protected $indexes = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
