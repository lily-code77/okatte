<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $article = Article::findOrFail($articleId);

        $favorite = Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
        ]);

        $favorite->save();

        return back()->with('success', 'Article favorited successfully!');
    }

    public function destroy($articleId)
    {
        $article = Article::findOrFail($articleId);

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('article_id', $article->id)
            ->firstOrFail();

        $favorite->delete();

        return back()->with('success', 'Article unfavorited successfully!');
    }
}
