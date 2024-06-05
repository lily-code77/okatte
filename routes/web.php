<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
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
    $myArticles = Article::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    $myRecipes = Recipe::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    return view('dashboard', ['myQuestions' => $myQuestions, 'myArticles' => $myArticles, 'myRecipes' => $myRecipes]);
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
// ↓を適用させると、マイページ画面にエラーが出る。
// Route::get('/questions/{question}', [QuestionController::class, 'edit'])->middleware(['auth', 'verified'])->name('question.edit');
Route::get('/questions/edit', [QuestionController::class, 'edit'])->middleware(['auth', 'verified'])->name('question.edit');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->middleware(['auth', 'verified'])->name('question.destroy');

//記事
Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware(['auth', 'verified'])->name('article.destroy');

//レシピ
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipe.store');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->middleware(['auth', 'verified'])->name('recipe.destroy');

//検索
//キーワードを受け取って検索結果を表示するルーティング
Route::get('/search/find', [SearchController::class, 'find'])->name('search.find');
