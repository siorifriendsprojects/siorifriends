<?php
    $url = $_POST['src'];
    if(isset($url))
    {            
        $html = file_get_contents($url);
        $html = mb_convert_encoding($html, mb_internal_encoding(), "auto" );
        if ( preg_match( "/<title>(.*?)<\/title>/i", $html, $matches) ) 
        {
            echo $matches[1];
            
        }
        else 
        {
        echo '見つかりません';
        }
    }
?>