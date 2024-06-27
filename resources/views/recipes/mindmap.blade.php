<x-app-layout>
<section>
    <div id="jsmind_container" style="background-color:white; width: 100%; height: 600px; border: 1px solid black;"></div>

    <form id="mindmapForm" method="POST" action="{{ route('mindmap.store',  ['recipe' => $recipe->id]) }}">
        @csrf
        <input type="hidden" id="mindmapData" name="mindmapData">
        <button class="m-3 focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="button" onclick="saveMindMap()">Save Mind Map</button>
    </form>
    
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
        "meta": {
            "name": "jsMind remote",
            "author": "hizzgdev@163.com",
            "version": "0.2"
        },
        "format": "node_tree",
        "data": {
            "id": "root",
            "topic": "料理名",
            "children": [
                {"id": "ingredients", "topic": "材料", "direction": "left", "children": [
                    {"id": "ingredients1", "topic": "野菜"},
                    {"id": "ingredients2", "topic": "肉/魚"},
                    {"id": "ingredients3", "topic": "調味料"},
                    {"id": "ingredients4", "topic": "隠し味"}
                ]},
                {"id": "tools", "topic": "調理器具", "direction": "right", "children": [
                    {"id": "tools1", "topic": "Press Enter"},
                    {"id": "tools2", "topic": "Press Enter"}
                ]},
                {"id": "methods", "topic": "調理方法", "direction": "right", "children": [
                    {"id": "methods1", "topic": "Press Enter"},
                    {"id": "methods2", "topic": "Press Enter"},
                    {"id": "methods3", "topic": "Press Enter"}
                ]},
                {"id": "tips", "topic": "コツ", "direction": "left", "children": [
                    {"id": "tips1", "topic": "Press Enter"},
                    {"id": "tips2", "topic": "Press Enter"}
                ]}
            ]
        }
    };

    var options = {
        container: 'jsmind_container',
        editable: true,
        theme: 'asphalt',
        shortcut: {
            enable: true,  // whether to enable shortcut
            handles: {},  // Named shortcut key event processor
            mapping: {  // shortcut key mapping
                addchild: [45, 4096 + 13],  // <Insert>, <Ctrl> + <Enter>
                addbrother: 13,  // <Enter>
                editnode: 113,  // <F2>
                delnode: 46,  // <Delete>
                toggle: 32,  // <Space>
                left: 37,  // <Left>
                up: 38,  // <Up>
                right: 39,  // <Right>
                down: 40,  // <Down>
            }
        },
    };

    var mindMapData = null;
    @if(isset($recipe->mindmaps) && $recipe->mindmaps->isNotEmpty())
        mindMapData = JSON.parse('<?=json_encode($recipe->mindmaps->first()->data)?>');
    @endif

    var jm = new jsMind(options);

    if (mindMapData) {
        jm.show(mindMapData);
    } else {
        jm.show(mind);
    }

    function saveMindMap() {
        var mindMapData = jm.get_data('node_tree');
        document.getElementById('mindmapData').value = JSON.stringify(mindMapData);
        document.getElementById('mindmapForm').submit();
    }
</script>
</x-app-layout>
