<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('sayhello/{name}', function (){
    return "<h1>Hello Laravel".request()->name."</h1>";
});

Route::get('pets/all', function (){
    $pets = App\Models\Pet::all();
    dd($pets->toArray()); //Dump & Die
});
Route::get('pets/{id}', function (){
    $pets = App\Models\Pet::find(request()->id);
    dd($pets->toArray()); //Dump & Die
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
