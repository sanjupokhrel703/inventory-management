{{-- resources/views/suppliers/purchases.blade.php  --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between">
            <h1>Purchase History for {{ $supplier->name }}</h1>
            <a href="{{ route('suppliers.index') }}" class="mb-3 btn btn-secondary">Back to Suppliers</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User Name</th>
                    <th>Supplier Name</th>

                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        <td>{{ $purchase->created_at->format('H:i:s') }}</td>
                        <td>{{ $purchase->user->name ?? 'N/A' }}</td>


                        <td>{{ $supplier->name }}</td>

                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->product->price }}</td>
                        <td>{{ $purchase->quantity * $purchase->product->price }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot class="font-weight-bold">
                <tr>
                    <th colspan="4" class="text-right"> <span>Total LTR :</span> </th>
                    <th>{{ $totalQuantity }}</th>
                    <th>{{ $totalAmount }}</th>
                </tr>
            </tfoot> --}}
            <tfoot class="font-weight-bold">
                <tr>
                    <th colspan="6" class="text-right">Total Quantity:</th>
                    <th>{{ $totalQuantity }}</th>
                    <th>Total Amount:</th>
                    <th>{{ number_format($totalAmount, 2) }}</th>
                </tr>
            </tfoot>

        </table>
    </div>
@endsection
