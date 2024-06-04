<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:255',
            'tags' => 'nullable | min:1',
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'content'   => 'required',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）
        $article = new Article();
        $article->user_id = Auth::user()->id;
        $article->title = $request->input('title');
        $article->tags = $request->input('tags');
        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }
        $article->content = $request->input('content');
        $article->status = $request->input('status'); // 'draft' もしくは 'publish'
        $article->save();

        return redirect()->route('index')->with('success', '記事が保存されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        Storage::disk('public')->delete($article->image);

        return to_route('dashboard')->with('success', '記事を削除しました');
    }
}
