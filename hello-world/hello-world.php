<?php
/**
 *Plugin Name: Hello world 
 *Description: This is the first Plugin
*/
    function hello_world_function(){
        $information = "This is very basic plugin";
        return $information;
    }
    add_shortcode('example', 'hello_world_function');
?>  