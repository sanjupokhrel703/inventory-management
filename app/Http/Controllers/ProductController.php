<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::Paginate('10');

        $products = Product::select('*', DB::raw('quantity * price AS total_price'))->paginate(50);
        // dd($products);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {Log::info('Product data being stored', $request->all());

    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'category' => 'nullable|string|max:255',
    //         'quantity' => 'required|integer|min:0',
    //         'price' => 'required|numeric|min:0',
    //     ]);

    //     Product::create($validatedData);
    //     return redirect()->route('product.index')->with('success', 'product Create Successfully');}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if the product exists
        $product = Product::where('name', $validatedData['name'])->first();

        if ($product)

        //     // If the product exists, add the new quantity
        //     $product->quantity += $validatedData['quantity'];
        //     $product->save();
        // }
        {
            // Validate the price matches the fixed price for the product
            if ($product->price != $validatedData['price']) {
                return redirect()->back()->withErrors(['price' => 'The price for this product must be ' . $product->price]);
            }

            // If the product exists, update the quantity
            $product->quantity += $validatedData['quantity'];
            $product->save();
        } else {
            // If the product doesn't exist, create a new one
            Product::create($validatedData);
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Ensures the selected category exists
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        // dd($validatedData, $product);
        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'product delete Successfully');
    }
}