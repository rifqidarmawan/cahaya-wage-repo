<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    const PENDING = 0;
    const PROCESSED = 1;
    const SHIPPED = 2;
    const FINISHED = 3;

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case self::PENDING:
                return 'Pending';
            case self::PROCESSED:
                return 'Diproses';
            case self::SHIPPED:
                return 'Dikirim';
            case self::FINISHED:
                return 'Selesai';
            default:
                return '';
        }
    }

    protected $guarded = ['id'];

    public function getBuyable(): Buyable
    {
        return $this->buyable;
    }

    public function buyable()
    {
        return $this->morphTo();
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
public function products()
{
    return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
        ->withPivot('kuantitas', 'total_harga', 'options', 'status')->withTimestamps();
}

    // public function items()
    // {
    //     return $this->belongsToMany(Product::class, 'orders', 'id', 'product_id')->withPivot('kuantitas', 'total_harga', 'options', 'status');
    // }
}
