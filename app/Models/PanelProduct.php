<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class PanelProduct extends Product
{
    protected $table = 'products';

    protected static function booted()
    {
        //żadnych scopeów
    }
}
