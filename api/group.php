<?php
    require_once __DIR__ . '/../load.php';


    use App\Core\ApiHandler;
    use App\Model\Group;

    $api = new ApiHandler();

    $api->post(function($model){

        $response = $model->insertGroup($_POST);

        api()->encode($response);

        
    }, new Group);