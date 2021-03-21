<?php 
    require_once __DIR__ . '/load.php';

    get_header(function(){
        page_title('Register');
    });

    view('frontend.auth.register');

    get_footer();