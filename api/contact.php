<?php
    require_once __DIR__ . '/../load.php';


    use App\Core\ApiHandler;
    use App\Model\Contact;

    $api = new ApiHandler();

    $api->post(function($model){
        $data = $model->create($_POST);
        
        
    }, new Contact);