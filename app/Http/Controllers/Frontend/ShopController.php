<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest()->paginate(10);
        return view('landingpage.shops.index', compact('products'));
    }
}
