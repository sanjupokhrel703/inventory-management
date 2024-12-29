@extends('Frontend.layouts.app')
@section('content')
    <div class="container">
        <h1>Add Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="mt-3 btn btn-success">Add Category</button>
            <a href="{{ route('categories.index') }}" class="mt-3 btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
