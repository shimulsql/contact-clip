<?php

    require __DIR__ . '/load.php';

    // Page Title
    
    // Get Header
    get_header(function(){
        page_title('Home');
    });
    

    view('frontend.home.index');

    get_footer();


?>