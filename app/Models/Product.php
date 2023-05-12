<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// untuk otomatis slug
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;


    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%' );
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
    public function user()
{
    return $this->belongsToMany(User::class, 'user_product', 'product_id', 'user_id')
        ->withPivot('kuantitas', 'total_harga', 'options');
}

public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
        ->withPivot('kuantitas', 'total_harga', 'options', 'status');
}
}
