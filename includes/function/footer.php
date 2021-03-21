<?php

    use App\Core\Footer;
    $GLOBALS['footer'] = new Footer;

    function get_footer(){
        global $footer;
        $footer->get_footer();
    }