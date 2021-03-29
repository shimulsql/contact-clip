<?php 
    require_once __DIR__ . '/../load.php';

    // access protection
    auth()->protect();
    
    get_header(function(){
        page_title('Edit contact');
    });

    view('backend.contact.edit');

    get_footer();