<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Products\Product;

class ProductController extends ApiController
{
    public function index() {
        $products = Product::all();
        return $this->showAll($products);
    }
    public function actives() {
        $products = Product::where('status',1)->get();
        return $this->showAll($products);
    }
}
