<?php 
    require_once __DIR__ . '/load.php';

    get_header(function(){
        page_title('Login');
    });

    view('frontend.auth.login');

    get_footer();