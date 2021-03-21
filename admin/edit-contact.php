<?php 
    require_once __DIR__ . '/../load.php';

    get_header(function(){
        page_title('Edit contact');
    });

    view('backend.contact.edit');

    get_footer();