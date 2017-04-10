<?php
header("Content-Type: text/html;charset=utf-8");
$_POST['dir'] = urldecode($_POST['dir']);

if( file_exists($_POST['dir']) && substr($_POST['dir'],0,13) =="Product.wiki/") {
	$files = scandir($_POST['dir']);
	natcasesort($files);
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		$echodata = "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		foreach( $files as $file ) {
			$setfile = file_exists($_POST['dir'] . $file);
			$setin = !in_array($file, ['.', '..', '.DS_Store','media','.git','源文件']);
			$setdir = is_dir($_POST['dir'] . $file);
			$sethz = 1;

			if ($setfile && $setin && $sethz && $setdir) {
				if($_POST['dir'] == 'Product.wiki/30000|原型文档/' && file_exists($_POST['dir'] . $file. "/html/index.html")){
					$echodata .= "<li class=\"file ext_html\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file . "/html/index.html") . "\">" . htmlentities($file) . "</a></li>";
				}elseif(substr($_POST['dir'],12,7) == '/40000|' && substr($file,-3) == 'img'){
					$echodata .= "<li class=\"file ext_png\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file. "/index.png") . "\">" . htmlentities($file) . "</a></li>";
				}elseif(substr($_POST['dir'],12,7) == '/40000|' && substr($file,-4) == 'down'){
					$echodata .= "<li class=\"file ext_png\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file. "/index.down") . "\">" . htmlentities($file) . "</a></li>";
				}else{
					$echodata .= "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
				}
			}
		}
		foreach( $files as $file ) {
			$setfile = file_exists($_POST['dir'] . $file);
			$setin = !in_array($file,['.','..','.DS_Store']);
			$setdir = !is_dir($_POST['dir'] . $file);
			$ext = preg_replace('/^.*\./', '', $file);
			$sethz = (in_array($ext,['md','doc','xls','ppt','docx','xlsx','pptx']) or substr($file,-10)==='index.html');
			if( $setfile && $setin && $sethz && $setdir) {
				$echodata .= "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
			}
		}
		$echodata .=  "</ul>";
	}
	echo $echodata;
}

?>