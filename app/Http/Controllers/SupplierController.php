<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all suppliers
        $suppliers = Supplier::all();
        $totalCows = Supplier::sum('cows');
        $totalBuffaloes = Supplier::sum('buffaloes');
        $totalSupplier = Supplier::count();
        // Fetch all suppliers
        $supplier = Supplier::with('purchases')->get();
        // $suppliers = Supplier::with('user')->get();
        // $users = User::pluck('name', 'id');

        // Pass the data to the index view
        return view('supplier.index', compact('suppliers', 'totalCows', 'supplier', 'totalBuffaloes', 'totalSupplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate the incoming data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'primary_number' => 'required|string|max:15|unique:suppliers',
    //         'secondary_number' => 'required|string|max:15|unique:suppliers',
    //         'address' => 'required|string|max:255',
    //         'cows' => 'nullable|integer|min:0',
    //         'buffaloes' => 'nullable|integer|min:0',
    //     ]);

    //     // Store the supplier in the database
    //     Supplier::create($validatedData);

    //     // Redirect to index page with success message
    //     return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            // 'primary_number' => 'required|string|max:15|unique:suppliers,primary_number',
            'primary_number' => [
                'required',
                'string',
                'regex:/^(98|97|96)\d{8}$/',
                'unique:suppliers,primary_number,',
            ],
            'secondary_number' => [
                'nullable',
                'string',
                'max:15',
                'unique:suppliers,secondary_number',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === $request->primary_number) {
                        $fail('Secondary number cannot be the same as the primary number.');
                    }
                },
            ],
            'address' => 'required|string|max:255',
            'cows' => 'nullable|integer|min:0',
            'buffaloes' => 'nullable|integer|min:0',
        ]);
        $validatedData['user_id'] = Auth::id();

        // Create the supplier in the database
        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        // Return the edit view with the specific supplier
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Supplier $supplier)
    // {
    //     // Validate the incoming data
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'primary_number' => 'required|string|max:15|unique:suppliers,primary_number,' . $supplier->id,
    //         'secondary_number' => 'required|string|max:15|unique:suppliers,secondary_number,' . $supplier->id,
    //         'address' => 'required|string|max:255',
    //         'cows' => 'nullable|integer|min:0',
    //         'buffaloes' => 'nullable|integer|min:0',
    //     ]);

    //     // Update the supplier
    //     $supplier->update($validatedData);

    //     // Redirect to index page with success message
    //     return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    // }

    public function update(Request $request, Supplier $supplier)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'primary_number' => [
                'required',
                'string',
                'regex:/^(98|97|96)\d{8}$/',
                'unique:suppliers,primary_number,' . $supplier->id,
            ],

            'secondary_number' => [
                'nullable',
                'string',
                'max:15',
                'unique:suppliers,secondary_number,' . $supplier->id,
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === $request->primary_number) {
                        $fail('Secondary number cannot be the same as the primary number.');
                    }
                },
            ],
            'address' => 'required|string|max:255',
            'cows' => 'nullable|integer|min:0',
            'buffaloes' => 'nullable|integer|min:0',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }

    public function showPurchases(Supplier $supplier)
    {
        // Fetch the supplier's purchases with product details
        $purchases = $supplier->purchases()
            ->with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        // $users = User::all();
        // Calculate the total quantity
        $totalQuantity = $purchases->sum('quantity');
        // $totalSupplier = Supplier::count();
        // $products = Product::all();
        $totalAmount = $purchases->sum(function ($purchase) {
            return $purchase->quantity * $purchase->product->price;
        });

        return view('supplier.purchases', compact('supplier', 'totalAmount', 'totalQuantity', 'purchases'));
    }
}
