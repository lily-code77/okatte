<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookmarkedArticles = $user->bookmarkedArticles()->with('user')->get();

        return view('bookmarks.index', compact('bookmarkedArticles'));
    }

    public function store(Request $request, $articleId)
    {
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        $bookmark = new Bookmark();
        $bookmark->user_id = $user->id;
        $bookmark->article_id = $article->id;
        $bookmark->save();

        return redirect()->back()->with('success', 'Article bookmarked successfully');
    }

    public function destroy(Request $request, $articleId)
    {
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        $bookmark = Bookmark::where('user_id', $user->id)
                            ->where('article_id', $article->id)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
        }

        return redirect()->back()->with('success', 'Article unbookmarked successfully');
    }
}
