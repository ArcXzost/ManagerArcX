<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function () {
    return view('task.index');
});

Route::get('/tasks/logged', function() {
    return view('task.logged');
});

Route::get('/task/login', function() {
    return Socialite::driver('google')->redirect();
})->name('login');

Route::get('/task/google/callback', function() {
    $user = Socialite::driver('google')->user();

        // Check if the user is from the @iiitg.ac.in domain
        // if (str_ends_with($user->email, '@iiitg.ac.in'))
            return view('task.logged')->with('user', $user);

        // Redirect or display an error message for unauthorized users
        // return redirect()->route('login')->with('error', 'Authentication failed. Only @iiitg.ac.in users are allowed.');
});