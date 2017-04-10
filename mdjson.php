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
$file = $_POST['md'];
if(pathinfo($file)['extension'] == 'md'){
    $my_text = file_get_contents($file);
    $Parsedown = new Parsedown();
    $my_text .= "\r\n<script>lct();</script>";
    $data = "<div>网址：<input type='text' style='width: 400px;' value='".$_SERVER['HTTP_HOST']."?md=".$file."'></div>".$Parsedown->text($my_text);
}elseif(substr($file,12,7) == '/60000|' && in_array(pathinfo($file)['extension'],['doc','xls','ppt','docx','xlsx','pptx'])){
    $dfile = time().rand(0,10000).".".pathinfo($file)['extension'];
    $dir = "/var/data/wordup/".$dfile;
    $shell = '/bin/cp /var/data/Product/'.str_replace(['|',' '],['\|','\ '],$file).' '.$dir;
    exec($shell);
    $data = "<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http%3A%2F%2FdocRicnw%2ERic%2Ecn%2Ecom%3A80%2F".$dfile."&wdStartOn=1&wdEmbedCode=0&wdPrint=0' width='1024px' height='850px' frameborder='0'></iframe>";
}elseif(substr($file,12,7) == '/30000|' && pathinfo($file)['basename'] == 'index.html'){
    $data = "<script>window.open('".$file."');</script>";
}elseif(substr($file,12,7) == '/40000|' && pathinfo($file)['basename'] == 'index.png'){
    $files = scandir(substr($file,0,-9));
    if( count($files) > 2 ) {
        $data = "<div>网址：<input type='text' style='width: 400px;' value='".$_SERVER['HTTP_HOST']."?md=".$file."'></div><ul id='dowebok'>";
        $data .= getimg($files,$file);
        $data .= '</ul><script src="styles/viewer.min.js?'.time().'"></script><script>var viewer = new Viewer(document.getElementById("dowebok"), {url: "data-original"});</script>';
    }
}elseif(substr($file,12,7) == '/40000|' && pathinfo($file)['basename'] == 'index.down'){
    $files = scandir(substr($file,0,-10));
    if( count($files) > 2 ) {
        $data = "<div>网址：<input type='text' style='width: 400px;' value='".$_SERVER['HTTP_HOST']."?md=".$file."'>
                 <button onclick=\"hddow('".pathinfo($file)['dirname']."')\">下载本页图</button></div><ul id='dowebok'>";
        $data .= getimg($files,$file);
        $data .= '</ul><script src="styles/viewer.min.js?'.time().'"></script><script>var viewer = new Viewer(document.getElementById("dowebok"), {url: "data-original"});</script>';
    }
}

echo $data;

function getimg($files,$file){
    $data = '';
    foreach( $files as $tofile ) {
        $ext = preg_replace('/^.*\./', '', $tofile);
        if(in_array($ext,['png','jpg','gif'])){
            $data .= '<li><img data-original="'.pathinfo($file)['dirname'].'/'.$tofile.'" src="'.pathinfo($file)['dirname'].'/'.$tofile.'" alt="'.$tofile.'"></li>';
        }elseif(!in_array($tofile, ['.', '..', '.DS_Store','.git'])){
            $newfiles = substr($file,0,-10).$tofile."/";
            $data .= getimg(scandir($newfiles),$newfiles."index.down");
        }
    }
    return $data;
}