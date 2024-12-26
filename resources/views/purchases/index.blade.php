@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between">
            <h2>Purchase List</h2>
            <a href="{{ route('purchases.create') }}" class="btn btn-primary">Create Purchase</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User Name</th>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        <td>{{ $purchase->created_at->format('H:i:s') }}</td>
                        <td>{{ $purchase->user->name }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm ">Edit</a>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
