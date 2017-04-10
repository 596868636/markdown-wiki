/**
 * Created by ric on 16/7/16.
 */
window.onload = function () {
    //流程图处理
    lct();

    //目录
    $('#containerleft').fileTree({
        root: 'Product.wiki/',
        script: 'jqueryFileTree.php',
        expandSpeed: 300,
        collapseSpeed: 300,
        loadMessage:" Loading...",
        multiFolder: false
    }, function(file) {
        $.post("mdjson.php",{md:decodeURI(file)}, function(data){
                $('#md').html(data);
        }, "html");//这里返回的类型有：json,html,xml,text
    });
};

function hddow(dir){
    window.location.href="postzip.php?dir="+decodeURI(dir);
}

//流程图处理
function lct(){
    $(".language-flow").each(function(index){
        var id = "langflow"+index;
        $(this).parent().after("<div id="+id+"></div>");
        $(this).parent().hide();
        var chart;
        var cd = $(this)[0];
        var code = cd.innerText;
        if (chart) {
            chart.clean();
        }
        chart = flowchart.parse(code);
        chart.drawSVG(id, {
            // 'x': 30,
            // 'y': 50,
            'line-width': 3,
            'line-length': 50,
            'text-margin': 10,
            'font-size': 14,
            'font': 'normal',
            'font-family': 'Helvetica',
            'font-weight': 'normal',
            'font-color': 'black',
            'line-color': 'black',
            'element-color': 'black',
            'fill': 'white',
            'yes-text': 'yes',
            'no-text': 'no',
            'arrow-end': 'block',
            'scale': 1,
            'symbols': {
                'start': {
                    'font-color': 'red',
                    'element-color': 'green',
                    'fill': 'yellow'
                },
                'end':{
                    'class': 'end-element'
                }
            },
            'flowstate' : {
                'past' : { 'fill' : '#CCCCCC', 'font-size' : 12},
                'current' : {'fill' : 'yellow', 'font-color' : 'red', 'font-weight' : 'bold'},
                'future' : { 'fill' : '#FFFF99'},
                'request' : { 'fill' : 'blue'},
                'invalid': {'fill' : '#444444'},
                'approved' : { 'fill' : '#58C4A3', 'font-size' : 12, 'yes-text' : 'APPROVED', 'no-text' : 'n/a' },
                'rejected' : { 'fill' : '#C45879', 'font-size' : 12, 'yes-text' : 'n/a', 'no-text' : 'REJECTED' }
            }
        });
    });

    $(".language-sequence").each(function(index){
        var chart;
        var cd = $(this)[0];
        var code = cd.innerText;
        if (chart) {
            chart.clean();
        }

        $(this).parent().after("<div id='langsequence"+index+"'>"+code+"</div>");
        $(this).parent().hide();
        $("#langsequence"+index).sequenceDiagram({theme: 'simple'});
    });
}