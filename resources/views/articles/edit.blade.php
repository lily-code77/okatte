<x-app-layout>
<section class="container mx-3">
    <form action="{{ route('article.update', ['article' => $article->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="relative m-3">
            <input type="text" id="title_create" name="title" value="{{ old('title', $article->title) }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
            <label for="title_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">レシピのタイトル</label>
        </div>
        <div class="relative m-3">
            <input type="text" id="tags_create" name="tags" value="{{ old('tags', $article->tags) }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
            <label for="tags_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">タグをスペース区切りで入力してください（最大5つまで）</label>
        </div>
        <img class="w-80 mx-5" src="{{ asset('storage/'. $article->image) }}" alt="">
        <div class="m-3">
            <label class="tcl block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_create">画像</label>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image_create" type="file" accept='image/*'>
        </div>
        
        <div id="editor" style="height: 300px;" class="bg-white">
            <textarea type="text" name="content" id="" placeholder="食材、調理方法、味付け、調理器具など共有/記録したい内容を書いてください。">{{ old('content', $article->content) }}</textarea>
        </div>
        <p class="">
            <button class="my-3 focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="draft">下書き保存</button>
            <button class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="publish">公開設定</button>
        </p>
    </form>
</section>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: {
            container: [['bold', 'italic', 'underline', 'strike'],
                [{'color': []}, {'background': []}],
                ['link', 'blockquote', 'image', 'video'],
                [{list: 'ordered'}, {list: 'bullet'}]],
            handlers: {
                image: imageHandler
            }
            }
        },
    }); 

    function imageHandler() {
        var range = this.quill.getSelection();
        var value = prompt('What is the image URL');
        this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
    }

    // フォームのsubmitイベントにリスナーを追加
    document.querySelector('form[name="postArticle"]').addEventListener('submit', function(event) {
        // Quillの内容をhidden inputに代入
        document.querySelector('input[name=content]').value = quill.root.innerHTML;
    });
</script>
</x-app-layout>