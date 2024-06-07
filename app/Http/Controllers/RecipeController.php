<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
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
        return view('recipes.create');
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
            'intro' => 'nullable | min:1',
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'ing' => 'required | max:255',
            'ins' => 'required | max:255',
            'comment' => 'nullable | max:255',
            'memo' => 'nullable | max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //以下に登録処理を記述（Eloquentモデル）
        $recipe = new Recipe();
        $recipe->user_id = Auth::user()->id;
        $recipe->title = $request->input('title');
        $recipe->tags = $request->input('tags');
        $recipe->intro = $request->input('intro');
        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }
        $recipe->ing = $request->input('ing');
        $recipe->ins = $request->input('ins');
        $recipe->comment = $request->input('comment');
        $recipe->memo = $request->input('memo');
        $recipe->status = $request->input('status'); // 'draft' もしくは 'publish'
        $recipe->save();

        return redirect()->route('dashboard')->with('success', '記事が保存されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:255',
            'tags' => 'nullable | min:1',
            'intro' => 'nullable | min:1',
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'ing' => 'required | max:255',
            'ins' => 'required | max:255',
            'comment' => 'nullable | max:255',
            'memo' => 'nullable | max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $recipe = Recipe::findOrFail($id);

        //画像を変更する場合
        if ($request->hasFile('image')) {
            // 変更前の画像を削除
            Storage::disk('public')->delete($recipe->image);
            // 変更後の画像をアップロード、保存パスを更新対象データにセット
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }
        
        $recipe->title = $request->input('title');
        $recipe->tags = $request->input('tags');
        $recipe->intro = $request->input('intro');
        $recipe->ing = $request->input('ing');
        $recipe->ins = $request->input('ins');
        $recipe->comment = $request->input('comment');
        $recipe->memo = $request->input('memo');
        $recipe->status = $request->input('status'); // 'draft' もしくは 'publish'
        $recipe->save();

        return redirect()->route('dashboard')->with('success', '記事が保存されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        Storage::disk('public')->delete($recipe->image);

        return to_route('dashboard')->with('success', 'レシピを削除しました');
    }
}
