<?php

namespace App\Http\Controllers;

use App\Models\Mindmap;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MindmapController extends Controller
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
    public function create(string $id)
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Recipe $recipe)
    {
        Log::info('Request Data: ', $request->all()); // デバッグ用ログ

        $request->validate([
            'mindmapData' => 'required|json',
        ]);

        $user = Auth::user();

        // マインドマップデータを保存
        $mindMap = MindMap::updateOrCreate(
            ['recipe_id' => $recipe->id, 'user_id' => $user->id],
            ['data' => json_decode($request->mindmapData, true)]
        );

        return redirect()->route('recipe.edit', ['recipe' => $recipe->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::with(['mindmaps', 'user'])
            ->where('id', $id)
            ->first();

        return view('recipes.mindmap', compact('recipe'));
    }

    // selectbox付きのshowをする。
    public function selectBox(string $id)
    {
        $recipe = Recipe::with(['mindmaps', 'user'])
            ->where('id', $id)
            ->first();

        return view('recipes.plusSelectBox', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mindmap $mindmap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mindmap $mindmap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mindmap $mindmap)
    {
        //
    }
}
