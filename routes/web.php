<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecipeController;
use App\Models\Article;
use App\Models\Question;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::get('/', function () {
    $questions = Question::all();
    $articles = Article::all();
    $recipes = Recipe::all();
    return view('index', ['questions' => $questions, 'articles' => $articles, 'recipes' => $recipes]);
})->name('index');

Route::get('/postSelection',function() {
    return view('postSelection');
})->name('postSelection');

//認証
Route::get('/dashboard', function () {
    $myQuestions = Question::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    return view('dashboard', ['myQuestions' => $myQuestions]);
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

//記事
Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');

//レシピ
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipe.store');


