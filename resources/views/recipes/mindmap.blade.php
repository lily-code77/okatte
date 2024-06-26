<x-app-layout>
<section>
    <div id="jsmind_container" style="width: 100%; height: 600px; border: 1px solid black;"></div>
</section>


<script>
    var mind = {
    "meta":{
        "name":"jsMind remote",
        "author":"hizzgdev@163.com",
        "version":"0.2"
    },
    "format":"node_tree",
    "data":{"id":"root","topic":"jsMind","children":[
        {"id":"easy","topic":"Easy","direction":"left","children":[
            {"id":"easy1","topic":"Easy to show"},
            {"id":"easy2","topic":"Easy to edit"},
            {"id":"easy3","topic":"Easy to store"},
            {"id":"easy4","topic":"Easy to embed"}
        ]},
        {"id":"open","topic":"Open Source","direction":"right","children":[
            {"id":"open1","topic":"on GitHub"},
            {"id":"open2","topic":"BSD License"}
        ]},
        {"id":"powerful","topic":"Powerful","direction":"right","children":[
            {"id":"powerful1","topic":"Base on Javascript"},
            {"id":"powerful2","topic":"Base on HTML5"},
            {"id":"powerful3","topic":"Depends on you"}
        ]},
        {"id":"other","topic":"test node","direction":"left","children":[
            {"id":"other1","topic":"I'm from local variable"},
            {"id":"other2","topic":"I can do everything"}
        ]}
    ]}
};

    var options = {
        container: 'jsmind_container',
        editable: true,
        theme: 'primary'
    };

    var jm = new jsMind(options);
    jm.show(mind);
</script>
</x-app-layout>