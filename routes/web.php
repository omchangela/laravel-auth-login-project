<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

// Welcome Route
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $categories = Category::all(); // Fetch all categories
    return view('dashboard', compact('categories')); // Pass to view
})->middleware(['auth', 'verified'])->name('dashboard');

// Google Login Redirect
Route::get('login/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

// Google Login Callback
Route::get('login/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Find the user by email or create a new user
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(16)), // Random password for Google login users
            ]
        );

        // Log the user in
        Auth::login($user, true);

        // Redirect to the dashboard
        return redirect()->intended('/dashboard');
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Google Login Error: ' . $e->getMessage());

        // Redirect to login page with an error message
        return redirect('/login')->withErrors(['msg' => 'Google login failed. Please try again.']);
    }
});

Route::middleware(['auth'])->resource('categories', CategoryController::class);

Route::middleware(['auth'])->group(function () {
    // Index: List all categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Create: Show form to create a new category
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    // Store: Save the new category
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    // Show: Display a single category (optional)
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Edit: Show form to edit a category
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    // Update: Update the category in storage
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    // Destroy: Delete a category
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Auth Routes
require __DIR__.'/auth.php';
