<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Recipe;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function find(Request $request)
    {
        $keyword = $request->keyword;
        
        $articleResults = Article::where("title", "LIKE", "%{$keyword}%")
                            ->orWhere("tags", "LIKE", "%{$keyword}%")
                            ->orWhere("content", "LIKE", "%{$keyword}%")->get();

        $recipeResults = Recipe::where("title", "LIKE", "%{$keyword}%")
                            ->orWhere("tags", "LIKE", "%{$keyword}%")
                            ->orWhere("intro", "LIKE", "%{$keyword}%")
                            ->orWhere("comment", "LIKE", "%{$keyword}%")->get();
        
        return view('result', compact('articleResults','recipeResults'));
    }

}
