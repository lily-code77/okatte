<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MindmapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
use App\Models\Article;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $articles = Article::latest('updated_at')->paginate(3);
    $recipes = Recipe::latest('updated_at')->paginate(3);
    return view('index', ['articles' => $articles, 'recipes' => $recipes]);
})->name('index');

// Route::get('/postSelection',function() {
//     return view('postSelection');
// })->name('postSelection');

//認証
Route::get('/dashboard', function () {
    $myArticles = Article::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    $myRecipes = Recipe::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    return view('dashboard', ['myArticles' => $myArticles, 'myRecipes' => $myRecipes]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/myPage', function () {
    $myArticles = Article::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    $myRecipes = Recipe::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
    return view('myPage', ['myArticles' => $myArticles, 'myRecipes' => $myRecipes]);
})->middleware(['auth', 'verified'])->name('myPage');

require __DIR__.'/auth.php';

//記事
Route::get('/index/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/dashboard/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/myPage/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
Route::get('/articles/{article}', [ArticleController::class, 'edit'])->middleware(['auth', 'verified'])->name('article.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware(['auth', 'verified'])->name('article.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware(['auth', 'verified'])->name('article.destroy');


//レシピ
Route::get('/index/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/dashboard/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/myPage/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipe.store');
Route::get('/recipes/{recipe}', [RecipeController::class, 'edit'])->middleware(['auth', 'verified'])->name('recipe.edit');
// レシピの更新は、「手順だけ」上書き保存ではなく、名前をつけて保存
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->middleware(['auth', 'verified'])->name('recipe.update');
//Recipe_idが削除されたら、そのrecipe_idに紐づくStepsテーブルのidも削除される
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->middleware(['auth', 'verified'])->name('recipe.destroy');


// 変更履歴を作成中のレシピに反映させる
Route::get('/recipes/change_history/{recipe}/{step}', [RecipeController::class, 'changeHistory'])->middleware(['auth', 'verified'])->name('recipe.changeHistory');
Route::post('/recipes/reflect_history/{recipe}/{step}', [RecipeController::class, 'reflectHistory'])->middleware(['auth', 'verified'])->name('recipe.reflectHistory');

// レシピを複製する
Route::post('/recipes/{recipe}', [RecipeController::class, 'clone'])->middleware(['auth', 'verified'])->name('recipe.clone');

//検索
//キーワードを受け取って検索結果を表示するルーティング
Route::get('/search/find', [SearchController::class, 'find'])->name('search.find');

// LIKE機能
Route::post('articles/{article}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('articles/{article}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::post('recipes/{recipe}/favorite', [FavoriteController::class, 'recipeStore'])->name('favorites.recipeStore');
Route::delete('recipes/{recipe}/favorite', [FavoriteController::class, 'recipeDestroy'])->name('favorites.recipeDestroy');

// Bookmark機能
Route::post('articles/{article}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
Route::delete('articles/{article}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
Route::get('bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

Route::post('recipes/{recipe}/bookmark', [BookmarkController::class, 'recipeStore'])->name('bookmarks.recipeStore');
Route::delete('recipes/{recipe}/unbookmark', [BookmarkController::class, 'recipeDestroy'])->name('bookmarks.recipeDestroy');

// Mind map
Route::get('/recipes/{recipe}/mindmap', [MindmapController::class, 'show'])->name('mindmap.show');
Route::post('/recipes/{recipe}/save-mindmap', [MindmapController::class, 'store'])->name('mindmap.store');
Route::get('/recipes/{recipe}/mindmap-plusSelectBox', [MindmapController::class, 'selectBox'])->name('mindmap.selectBox');

