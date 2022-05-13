<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function getKiloPrice()
    {
        $price = $this->price;
        $weight = $this->value;
        $gramPrice = $this->price / $this->value;

        return round($gramPrice * 1000, 2) . ' /  kg';
    }

    public function getPiecePrice()
    {
        $price = $this->price / $this->value;

        return round($price, 2) . ' / pcs';
    }


    public function getPrice()
    {
        if ($this->type == 'gram') {
            return $this->getKiloPrice();
        }

        return $this->getPiecePrice();
    }
}
