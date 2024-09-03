<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $products = Product::where('category_id', request('q'))->paginate(8);
        $categories = Category::all();

        return view('shop', ['products' => $products, 'categories' => $categories]);
    }

    public function admin()
    {
        $products = Product::where('category_id', request('q'))->paginate(10);
        $categories = Category::all();

        return view('products.index', ['products' => $products, 'categories' => $categories]);
    }
}
