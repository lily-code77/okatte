@extends('layouts.default')

@section('content')
<section class="">
    <form action="{{ route('question.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="" placeholder="質問のタイトル"><br>
        <input type="text" name="tags" class="" placeholder="タグをスペース区切りで入力してください（最大5つまで）"><br>
        <input type="file" name="image" accept='image/*' class=""><br>
        <textarea type="text" name="content" id="" placeholder="ここに解決したい内容を書いてください"></textarea>
        <p class="">
            <button class="" type="submit" name="status" value="draft">下書き保存</button>
            <button class="" type="submit" name="status" value="publish">質問を投稿</button>
        </p>
    </form>
</section>



@endsection