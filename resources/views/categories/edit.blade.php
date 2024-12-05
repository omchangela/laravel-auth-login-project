@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4 md:px-0">
    <div class="bg-white shadow rounded-lg p-6 md:max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" id="name" 
                       value="{{ $category->name }}" 
                       class="block w-full border border-gray-300 rounded-lg shadow-sm p-2.5 focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Enter category name" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                <input type="file" name="image" id="image" 
                       class="block w-full border border-gray-300 rounded-lg shadow-sm p-2.5 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @if($category->image)
                <div class="mt-3">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $category->image) }}" 
                         alt="{{ $category->name }}" 
                         class="inline-block rounded-lg shadow border mt-2" width="150" height="150">
                </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="w-full text-white md:w-auto bg-blue-500 px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
