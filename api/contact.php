<?php
    require_once __DIR__ . '/../load.php';


    use App\Core\ApiHandler;
    use App\Model\Contact;

    $api = new ApiHandler();

    $api->post(function($model){

        $response = $model->create($_POST);

        api()->encode($response);

        
    }, new Contact);