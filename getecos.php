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
require 'vendor/autoload.php';
$url = $_REQUEST['url'];
$text = file_get_contents($url);
$regex4="/<div class=\"doc-style\">(.*?)<\/div>

                    <hr \/>/ism";
preg_match_all($regex4, $text, $matches);
echo htmlspecialchars($matches[1][0]);