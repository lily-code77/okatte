<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/postSelection',function() {
    return view('postSelection');
});

//認証
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//質問
Route::get('/questions', [QuestionController::class, 'index'])->name('question.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->name('question.create');
Route::post('/questions/store', [QuestionController::class, 'store'])->name('question.store');
