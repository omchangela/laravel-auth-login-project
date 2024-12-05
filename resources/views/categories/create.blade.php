@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4 md:px-0">
    <div class="bg-white shadow rounded-lg p-6 md:max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create a New Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" id="name" class="block w-full border border-gray-300 rounded-lg shadow-sm p-2.5 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Enter category name" required>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                <input type="file" name="image" id="image" class="block w-full border border-gray-300 rounded-lg shadow-sm p-2.5 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="text-center">
                <button type="submit" class="w-full text-white md:w-auto bg-blue-500 text-black px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
