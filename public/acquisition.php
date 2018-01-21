<?php
$url = $_POST['url'];
if(!isset($url)) {
    return;
}
$html = file_get_contents($url);
$html = mb_convert_encoding($html, mb_internal_encoding(), "auto" );
$isMatched = preg_match( "/<title>(.*?)<\/title>/i", $html, $matches);
echo $isMatched ? $matches[1] : "";
