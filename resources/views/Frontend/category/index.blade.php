@extends('Frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between">
            <h2>Category List</h2>
            <a href="{{ route('categories.create') }}" class=" btn btn-primary">Add Category</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>created At</th>
                    <th>updated At</th>
                    <th>Delay</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        <td>{{ $category->created_at->format('H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('H:i:s') }}</td>
                        <td>
                            {{-- Calculate the time difference in hours and minutes --}}
                            @php
                                $createdAt = $category->created_at;
                                $updatedAt = $category->updated_at;

                                // Get the difference in total minutes
                                $diffInMinutes = $createdAt->diffInMinutes($updatedAt);

                                // Calculate hours and minutes
                                $hours = floor($diffInMinutes / 60);
                                $minutes = $diffInMinutes % 60;

                                // Format the difference as HH:mm
                                $timeDifference = sprintf('%02d:%02d', $hours, $minutes);
                            @endphp

                            <span>{{ $timeDifference }} hours</span>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are You Sure Want to Delete ??')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
