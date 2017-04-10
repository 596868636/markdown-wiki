<?php
/** 
 * Ric License
 *
 * @author     Ric
 * @copyright  Copyright (c) 2014-2016 Ric Inc. (https://www.Ric.tv)
 * @license    http://www.yiqizuo.xin/ Ric License
 * @Date: 16/7/14
 * @Time: 15:08
 */
header("Content-Type: text/html;charset=utf-8");
//md文件处理
require 'vendor/autoload.php';
$md = $_GET['md']?:"Product.wiki/README.md";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ric技术部文档中心</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.5.0/css/amazeui.min.css" />
    <link rel="stylesheet" href="styles/viewer.min.css">
    <link rel="stylesheet" type="text/css" href="styles/Ricmd.css" />
    <script src="styles/raphael.js"></script>
    <script src="styles/jquery3.js"></script>
    <script src="styles/jqueryTree.js"></script>
    <script src="styles/flowchart-latest.js"></script>
    <script src="styles/hdaqw.js"></script>
    <script src="styles/underscore.js"></script>
    <script src="styles/sequence-diagram-min.js"></script>
</head>
<body>
<div id="containerleft"></div>
<div id="md">
    <script>
        $.post("mdjson.php",{md:decodeURI('<?php echo $md ?>')}, function(data){
            $('#md').html(data);
        }, "html");
    </script>
</div>
</body>
</html>