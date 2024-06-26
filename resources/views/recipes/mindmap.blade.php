<x-app-layout>
<section>
    <div id="jsmind_container" style="background-color:white; width: 100%; height: 600px; border: 1px solid black;"></div>

    <div class="operation container m-3">
        <p class="tcl text-lg">操作方法</p>
        <div class="my-2">
            addchild : Insert / Ctrl + Enter<br>
            addbrother : Enter<br>
            editnode : F2<br>
            delnode : Delete<br>
            toggle : Space<br>
            left : ←<br>
            up : ↑<br>
            right : →<br>
            down : ↓<br>
        </div>
    </div>
</section>


<script>
    var mind = {
    "meta":{
        "name":"jsMind remote",
        "author":"hizzgdev@163.com",
        "version":"0.2"
    },
    "format":"node_tree",
    "data":{"id":"root","topic":"料理名","children":[
        {"id":"ingredients","topic":"材料","direction":"left","children":[
            {"id":"ingredients1","topic":"野菜"},
            {"id":"ingredients2","topic":"肉/魚"},
            {"id":"ingredients3","topic":"調味料"},
            {"id":"ingredients4","topic":"隠し味"}
        ]},
        {"id":"tools","topic":"調理器具","direction":"right","children":[
            {"id":"tools1","topic":"Press Enter"},
            {"id":"tools2","topic":"Press Enter"}
        ]},
        {"id":"methods","topic":"調理方法","direction":"right","children":[
            {"id":"methods1","topic":"Press Enter"},
            {"id":"methods2","topic":"Press Enter"},
            {"id":"methods3","topic":"Press Enter"}
        ]},
        {"id":"tips","topic":"コツ","direction":"left","children":[
            {"id":"tips1","topic":"Press Enter"},
            {"id":"tips2","topic":"Press Enter"}
        ]}
    ]}
};

    var options = {
        container: 'jsmind_container',
        editable: true,
        theme: 'asphalt',
        shortcut:{
            enable:true, 		// whether to enable shortcut
            handles:{}, 			// Named shortcut key event processor
            mapping:{ 			// shortcut key mapping
                addchild : [45, 4096+13], 	// <Insert>, <Ctrl> + <Enter>
                addbrother : 13, // <Enter>
                editnode : 113, 	// <F2>
                delnode : 46, 	// <Delete>
                toggle : 32, 	// <Space>
                left : 37, 		// <Left>
                up : 38, 		// <Up>
                right : 39, 		// <Right>
                down : 40, 		// <Down>
            }
        },
    };

    var jm = new jsMind(options);
    jm.show(mind);
</script>
</x-app-layout>