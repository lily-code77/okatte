@extends('layouts.default')

@section('content')
<section class="">
    <form action="{{ route('article.update', ['article' => $article->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" class="" value="{{ old('title', $article->title) }}" placeholder="記事タイトル"><br>
        <input type="text" name="tags" class="" value="{{ old('tags', $article->tags) }}" placeholder="タグをスペース区切りで入力してください（最大5つまで）"><br>
        <img src="{{ asset('storage/'. $article->image) }}" alt="">
        <input type="file" name="image" accept='image/*' class=""><br>
        <div id="editor">
            <textarea type="text" name="content" id="" placeholder="食材、調理方法、味付け、調理器具など共有/記録したい内容を書いてください。">{{ old('content', $article->content) }}</textarea>
        </div>
        <p class="">
        <button class="" type="submit" name="status" value="draft">下書き保存</button>
        <button class="" type="submit" name="status" value="publish">公開設定</button>
        </p>
    </form>
</section>

<!-- <script>
    const quill = new Quill('#editor', {
        placeholder: '食材、調理方法、味付け、調理器具など共有/記録したい内容を書いてください。',
        theme: 'snow'
    });
</script> -->
@endsection