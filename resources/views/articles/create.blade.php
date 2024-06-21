<x-app-layout>
<section class="container mx-3">
    <form action="{{ route('article.store') }}" method="post" name="postArticle" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="" placeholder="記事タイトル"><br>
        <input type="text" name="tags" class="" placeholder="タグをスペース区切りで入力してください（最大5つまで）"><br>
        <input type="file" name="image" accept='image/*' class=""><br>
        <div id="editor" style="height: 300px;" class="bg-white"></div>
        <input type="hidden" name="content">
        <p class="">
            <button class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="draft">下書き保存</button>
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
