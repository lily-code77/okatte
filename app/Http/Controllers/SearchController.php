<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function find(Request $request)
    {
        $keyword = $request->keyword;
        $questionResults = Question::where("title", "LIKE", "%{$keyword}%")
                            ->orWhere("tags", "LIKE", "%{$keyword}%")
                            ->orWhere("content", "LIKE", "%{$keyword}%")->get();
        // dd($results);
        return view('result', compact('questionResults'));
    }
}
