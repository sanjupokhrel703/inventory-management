@extends('Frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between ">
            <h2>Products</h2>

            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>Rs {{ $product->price }}</td>
                        <td>{{ number_format($product->total_price, 2) }}</td>
                        {{-- <td>{{ $product->quantity * $product->price, 2 }}</td> --}}
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure want to delete this ?') ">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3"> <span>Total Products: <strong>{{ $products->total() }}</strong></span></td>
                    <td><strong>{{ $products->sum('quantity') }}</strong></td>
                    <td><strong>Rs {{ number_format($products->sum('price'), 2) }}</strong></td>
                    <td><strong>Rs {{ number_format($products->sum('total_price'), 2) }}</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
