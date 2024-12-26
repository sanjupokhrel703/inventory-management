@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Supplier</h2>
        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $supplier->name }}" required>
            </div>
            <div class="form-group">
                <label for="primary_number">Primary Number</label>
                <input type="text" name="primary_number" id="primary_number" class="form-control"
                    value="{{ $supplier->primary_number }}" required>
            </div>
            <div class="form-group">
                <label for="Secondary_number">Secondary Number</label>
                <input type="text" name="Secondary_number" id="Secondary_number" class="form-control"
                    value="{{ $supplier->secondary_number }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}"
                    required>
            </div>
            <div class="form-group">
                <label for="cows">Number of Cows</label>
                <input type="number" name="cows" id="cows" class="form-control" value="{{ $supplier->cows }}"
                    min="0">
            </div>
            <div class="form-group">
                <label for="buffaloes">Number of Buffaloes</label>
                <input type="number" name="buffaloes" id="buffaloes" class="form-control"
                    value="{{ $supplier->buffaloes }}" min="0">
            </div>
            <button type="submit" class="mt-3 btn btn-success">Update</button>
        </form>
    </div>
@endsection
