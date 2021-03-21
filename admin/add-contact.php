<?php 
    require_once __DIR__ . '/../load.php';

    get_header(function(){
        page_title('Add new contact');
    });

    view('backend.contact.add');

    get_footer();