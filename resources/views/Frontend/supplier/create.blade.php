@extends('Frontend.layouts.app')

@section('content')
    <div class="container">
        <h2>Create Supplier</h2>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="primary_number">Primary Number</label>
                <input type="text" class="form-control" id="primary_number" name="primary_number">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="secondary_number">Secondary Number</label>
                <input type="text" class="form-control" id="secondary_number" name="secondary_number">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="cows">Cows</label>
                <input type="number" class="form-control" id="cows" name="cows" value="0">
            </div>
            <div class="form-group">
                <label for="buffaloes">Buffaloes</label>
                <input type="number" class="form-control" id="buffaloes" name="buffaloes" value="0">
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
