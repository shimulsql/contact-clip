<?php

use App\Database\Database;

require __DIR__ . '/load.php';
    
    // Get Header

    get_header(function(){
        page_title('Home');
    });
    
    
    view('frontend.home.index');

    get_footer();



?>