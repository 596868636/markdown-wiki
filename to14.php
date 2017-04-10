<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <script src="styles/jquery3.js"></script>
    <script src="styles/htmltomd.js"></script>
    <title>HTML 转为 markdown</title>
</head>
<body>
    <input type="text" name="url" id="url">
    <br/>
    <br/>
    <br/>
    <button onclick="getecos();" type="button" value="下载内容" >下载内容</button>
        <br/>
        <br/>
        <br/>
        <br/>
    <div id="textWrap">
        <textarea rows="20" cols="78" name="code" class="code" id="code" spellcheck="false"></textarea>
        <div id="clear" title="点击清空输入框" style="display: block;">×</div>
    </div>
    <p class="clearfix">
        <button name="opsrate" type="button" onclick="tomarkdown();" value="tomarkdown">转换为MarkDown</button>
    </p>
        <script>
            function getecos(){
                var url = $("#url").val();
                $.post("getecos.php",{url:decodeURI(url)}, function(data){
                    $('#code').val(data);
                    tomarkdown();
                }, "text");//这里返回的类型有：json,html,xml,text
            }
        </script>
</body>
</html>