<x-app-layout>
<section>
    <div id="jsmind_container" style="background-color:white; width: 100%; height: 600px; border: 1px solid black;"></div>
    <form id="mindmapForm" method="POST" action="">
        @csrf
        <input type="hidden" id="mindmapData" name="mindmapData">
        <button class="m-3 focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="button" onclick="saveMindMap()">Make Notes</button>
    </form>
</section>

<script>
    var options = {
        container: 'jsmind_container',
        editable: false,
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
        alert('No Mind Map.');

        var routeUrl = "{{ route('recipe.edit',  ['recipe' => $recipe->id]) }}";
        setTimeout(function() {
            window.location.href = routeUrl;
        }, 50); 

    }
</script>
</x-app-layout>