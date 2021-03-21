<?php 
    require_once __DIR__ . '/../load.php';

    get_header(function(){
        page_title('Dashboard');
    });


    view('backend.dashboard.index');

    get_footer();
