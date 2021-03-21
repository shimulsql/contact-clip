<?php

    use App\Core\Header;

    $GLOBALS['header'] = new Header;


    function get_header($callback){
        $callback();
        global $header;
        $header->get_header();
    }
    
    function page_title($title){
        global $header;
        $header->set_page_title($title);
    }