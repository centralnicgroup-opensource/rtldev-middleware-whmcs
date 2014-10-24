<?php

function ispapi_hook_widget_hello_world($vars) {
 
    $content = '<p><strong>Hello World</strong> Sample Widget Content</p>';
 
    return array( 'title' => 'ISPAPI Hello World', 'content' => $content );
 
}

add_hook("AdminHomeWidgets",1,"ispapi_hook_widget_hello_world");

?>
