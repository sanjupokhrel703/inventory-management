@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between ">
            <h2>Supplier List</h2>
            <a href="{{ route('suppliers.create') }}" class=" btn btn-primary">Add Supplier</a>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User Name</th>
                    <th>Supplier Name</th>
                    <th>Primary Number</th>
                    <th>Secondary Number</th>
                    <th>Address</th>
                    <th>Cows</th>
                    <th>Buffaloes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->created_at->format('Y-m-d') }}</td>
                        <td>{{ $supplier->created_at->format('H:i:s') }}</td>
                        <td>{{ $supplier->user->name }}</td>
                        <td>
                            <a href="{{ route('suppliers.purchases', $supplier->id) }}">
                                {{ $supplier->name }}
                            </a>
                        </td>
                        <td>{{ $supplier->primary_number }}</td>
                        <td>{{ $supplier->secondary_number }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->cows }}</td>
                        <td>{{ $supplier->buffaloes }}</td>
                        <td>
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8" class="text-right">Total: <span>{{ $totalSupplier }}</span> </th>
                    <th>{{ $totalCows }}</th>
                    <th>{{ $totalBuffaloes }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
