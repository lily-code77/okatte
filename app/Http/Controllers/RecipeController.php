<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $posts = $request->all();
        // dd($posts);

        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:255',
            'tags' => 'nullable | min:1',
            'intro' => 'nullable | min:1',
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'ing' => 'nullable | max:255',
            'comment' => 'nullable | max:255',
            'memo' => 'nullable | max:255',
            'version_name' => 'nullable | max:255',
            'steps' => 'required | max:255',

        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        //以下にRecipesテーブルへの登録処理を記述（Eloquentモデル）
        $recipe = new Recipe();
        $recipe->user_id = Auth::user()->id;
        $recipe->title = $request->input('title');
        $recipe->tags = $request->input('tags');
        $recipe->intro = $request->input('intro');
        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }
        $recipe->ing = $request->input('ing');
        $recipe->comment = $request->input('comment');
        $recipe->memo = $request->input('memo');
        $recipe->status = $request->input('status'); // 'draft' もしくは 'publish'
        $recipe->save();

        //以下にStepsテーブルへの登録処理を記述
        // $steps = new Step();
        $comment = $request->input('version_name');
        $recipe_id = $recipe->id;
        $steps = [];
        foreach($posts['steps'] as $key => $step){
            $steps[$key] = [
                'recipe_id' => $recipe_id,
                'version_name' => $comment,
                'step_number' => $key + 1,
                'description' => $step,
                'created_at' => now(),
            ];
        }
        Step::insert($steps);

        return redirect()->route('myPage')->with('success', 'レシピが保存されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::with(['steps', 'user', 'favorites'])
            ->where('recipes.id', $id)
            ->first();
        // dd($recipe);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::with(['steps', 'user'])
            ->where('recipes.id', $id)
            ->first()->toArray();

        // dd($recipe);
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posts = $request->all();
        
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:255',
            'tags' => 'nullable | min:1',
            'intro' => 'nullable | min:1',
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'ing' => 'nullable | max:255',
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
        $recipe->comment = $request->input('comment');
        $recipe->memo = $request->input('memo');
        $recipe->status = $request->input('status'); // 'draft' もしくは 'publish'
        $recipe->save();

        //以下にStepsテーブルへの登録処理を記述（手順は「上書き保存」ではなく「名前をつけて保存」）
        $comment = $request->input('version_name');
        $recipe_id = $recipe->id;
        $steps = [];
        foreach($posts['steps'] as $key => $step){
            $steps[$key] = [
                'recipe_id' => $recipe_id,
                'version_name' => $comment,
                'step_number' => $key + 1,
                'description' => $step,
                'created_at' => now(),
            ];
        }
        Step::insert($steps);

        return redirect()->route('myPage')->with('success', 'レシピが保存されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        Storage::disk('public')->delete($recipe->image);

        return to_route('myPage')->with('success', 'レシピを削除しました');
    }

    public function changeHistory(string $recipe_id, string $step_id)
    {
        // $recipe = Recipe::find($id);

        $recipe = Recipe::with(['steps', 'user'])
            ->where('recipes.id', $recipe_id)
            ->first()->toArray();

        $step = $step_id;
        // return view('recipes.changeHistory', ['recipe' => $recipe]);
        return view('recipes.changeHistory', compact('recipe', 'step'));
    }

    public function reflectHistory(Request $request, string $recipe_id, string $step_id)
    {
        $posts = $request->all();
        $recipe = Recipe::with(['steps', 'user'])
            ->where('recipes.id', $recipe_id)
            ->first()->toArray();

        return view('recipes.reflectHistory', compact('posts', 'recipe', 'step_id'));
    }

    public function clone(string $id)
    {
        // 複製元を取得（リレーションデータ付き）
        $recipe = Recipe::with('steps')->findOrFail($id);

        // 画像を複製
        if ($recipe->image) {
            $originalImagePath = $recipe->image;
            $imageExtension = pathinfo($originalImagePath, PATHINFO_EXTENSION);
            $newImagePath = 'recipes/' . uniqid('copy_') . '.' . $imageExtension;
            Storage::disk('public')->copy($originalImagePath, $newImagePath);
        }

        // 複製
        $newRecipe = $recipe->replicate();
        $newRecipe->title = 'コピー_'. $recipe->title;
        $newRecipe->image = $newImagePath; // 新しい画像パスを設定
        $newRecipe->save();

        // 複製元データのリレーションデータを複製
        $recipe->steps->each(function ($step) use ($newRecipe) {
            $newStep = $step->replicate();
            $newStep->recipe_id = $newRecipe->id; //外部キーに複製後のidを指定
            $newStep->created_at = $step->created_at;
            $newStep->save();
        });

        return to_route('myPage');
    }
}
