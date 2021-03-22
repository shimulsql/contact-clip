<?php

    require_once __DIR__ . '/../load.php';

    use App\Model\Contact;
    $contact = new Contact;

    get_header(function(){
        page_title('Add new contact');
    });


    // receive requests

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // create contact
        if(isset($_REQUEST['_create'])){
            echo "Contact created";
        }

        // update contact
        if(isset($_REQUEST['_update'])){

        }


    }





    view('backend.contact.add');

    get_footer();