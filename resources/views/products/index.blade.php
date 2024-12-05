@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="py-3">ID</th>
                    <th scope="col" class="py-3">Name</th>
                    <th scope="col" class="py-3">Image</th>
                    <th scope="col" class="py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="fw-bold py-3">{{ $category->id }}</td>
                    <td class="py-3">{{ $category->name }}</td>
                    <td class="py-3">
                        @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="rounded border" style="display: block; margin: 0 auto;" width="100" height="100">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td class="py-3">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection
