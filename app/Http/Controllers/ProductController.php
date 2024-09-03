<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            'products' => Product::latest()->take(4)->get()
        ]);
    }

    public function shop()
    {
        return view('shop', [
            'products' => Product::latest()->paginate(8),
            'categories' => Category::all()
        ]);
    }

    public function admin()
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(10),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'availability' => ['nullable']
        ]);

        if (request()->file('photo') !== null) {
            $attributes['photo'] = request()->file('photo')->store('photos', 'public');
        }

        Product::create($attributes);

        return redirect('/products')->with('success', 'Artikl uspješno kreiran');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'description' => ['required'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'availability' => ['nullable']
        ]);

        $product = Product::findOrFail($id);

        if (request()->file('photo') !== null) {
            $attributes['photo'] = request()->file('photo')->store('photos', 'public');
        }

        $product->update($attributes);

        return redirect('/products')->with('success', 'Artikl uspješno izmijenjen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/products')->with('success', 'Artikl uspješno izbrisan');
    }
}
