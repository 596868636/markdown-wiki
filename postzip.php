<?php
//获取列表
$dir = $_REQUEST['dir'] ? $_REQUEST['dir'] : 0;
if(!$dir || !file_exists($dir) || substr($dir,0,19) !="Product.wiki/40000|" || substr($dir,-4) != 'down'){
    echo "非法目录！";exit;
}
$dir = str_replace(['|','../'],['\|',''],$dir);
$zip = "/var/data/update/Ricui".time().".zip";
$shell = '/bin/tar -C '.pathinfo($dir)['dirname'].' -zcvf '.$zip.' '.pathinfo($dir)['filename'];
exec($shell);

$get_url = urldecode($zip);
$file_name = basename($get_url);
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename='.$file_name);
header("Connection: close");
readfile($get_url);
