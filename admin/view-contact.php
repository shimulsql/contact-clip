<?php 
    require_once __DIR__ . '/../load.php';

    get_header(function(){
        page_title('John Doe - Contact');
    });

    view('backend.contact.view');

    get_footer();