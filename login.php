<?php 
    require_once __DIR__ . '/load.php';

    // access only unauthorized person
    auth()->only_guest();

    get_header(function(){
        page_title('Login');
    });

    view('frontend.auth.login');

    get_footer();