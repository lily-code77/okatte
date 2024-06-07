<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        // $myQuestions = Question::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);;
        return view('questions.index', ['questions' => $questions]); //&& view('dashboard', ['myQuestions' => $myQuestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
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
        $question = new Question();
        $question->user_id = Auth::user()->id;
        $question->title = $request->input('title');
        $question->tags = $request->input('tags');
        if ($request->hasFile('image')) {
            $question->image = $request->file('image')->store('questions', 'public');
        }
        $question->content = $request->input('content');
        $question->status = $request->input('status'); // 'draft' もしくは 'publish'
        $question->save();

        return redirect()->route('dashboard')->with('success', '記事が保存されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', ['question' => $question]);
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
            'image' => 'nullable|file|mimes:jpeg,png,pdf,docx',
            'content'   => 'required',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $question = Question::findOrFail($id);

        //画像を変更する場合
        if ($request->hasFile('image')) {
            // 変更前の画像を削除
            Storage::disk('public')->delete($question->image);
            // 変更後の画像をアップロード、保存パスを更新対象データにセット
            $question->image = $request->file('image')->store('questions', 'public');
        }
        
        $question->title = $request->input('title');
        $question->tags = $request->input('tags');
        $question->content = $request->input('content');
        $question->status = $request->input('status'); // 'draft' もしくは 'publish'
        $question->save();

        return redirect()->route('dashboard')->with('success', '記事が保存されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        // dd($id);
        $question = Question::findOrFail($id);
        $question->delete();
        Storage::disk('public')->delete($question->image);

        return to_route('dashboard')->with('success', '質問/回答を削除しました');
    }
}
