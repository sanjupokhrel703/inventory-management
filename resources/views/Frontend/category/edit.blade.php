@extends('Frontend.layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $category->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="mt-3 btn btn-success">Update Category</button>
            <a href="{{ route('categories.index') }}" class="mt-3 btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
