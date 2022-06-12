<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            Storage::disk('public')->delete(str_replace('storage', '', $product->image));
            Storage::disk('public')->delete(str_replace('storage', '', $product->thumbnail));
        });
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getKiloPrice()
    {
        $price = $this->price;
        $weight = $this->value;
        $gramPrice = $this->price / $this->value;

        return round($gramPrice * 1000, 2);
    }

    public function getPiecePrice()
    {
        $price = $this->price / $this->value;

        return round($price, 2)  . ' /  kg';
    }


    public function getPrice()
    {
        if ($this->type == 'gram') {
            return $this->getKiloPrice();
        }

        return $this->getPiecePrice() . ' / pcs';
    }

}
