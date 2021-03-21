<?php 
    require_once __DIR__ . '/../load.php';

    get_header(function(){
        page_title('Add new group');
    });

    view('backend.group.add');

    get_footer();