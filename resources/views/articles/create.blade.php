<x-app-layout>
<body class="bg-white text-black transition-colors duration-300 dark:bg-gray-900 dark:text-white">
    <section class="container mx-3">
        <form action="{{ route('article.store') }}" method="post" name="postArticle" enctype="multipart/form-data">
            @csrf
            <!-- <p id="toggle-dark-mode" class="px-4 py-2 my-3 bg-blue-500 text-white rounded">ダークモード切り替え</p> -->
            <div class="relative m-3">
                <input type="text" id="title" name="title" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 appearance-none dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
                <label for="title" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">記事タイトル</label>
            </div>
            <div class="relative m-3">
                <input type="text" id="tags" name="tags" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 appearance-none dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
                <label for="tags" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">タグをスペース区切りで入力してください（最大5つまで）</label>
            </div>
            <div class="m-3">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_create">画像</label>
                <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image_create" type="file" accept='image/*'>
            </div>
            
            <div id="editor" style="height: 300px;" class="bg-white dark:bg-gray-700 dark:text-white"></div>
            <input type="hidden" name="content" class="">
            <p>
                <button class="my-3 focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="draft">下書き保存</button>
                <button class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="publish">公開設定</button>
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

        // ダークモード
        // document.getElementById('toggle-dark-mode').addEventListener('click', function () {
        //     document.documentElement.classList.toggle('dark');
        // });

    </script>
</body>
</x-app-layout>
