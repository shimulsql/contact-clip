<?php 
    require_once __DIR__ . '/../load.php';

    // access protection
    auth()->protect();
    
    get_header(function(){
        page_title('Groups ');
    });

    view('backend.group.list');

    get_footer();