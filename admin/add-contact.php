<?php

    require_once __DIR__ . '/../load.php';

    use App\Model\Contact;
    $contact = new Contact;

    get_header(function(){
        page_title('Add new contact');
    });


    





    view('backend.contact.add');

    get_footer();