<?php
    require_once __DIR__ . '/../load.php';


    use App\Core\ApiHandler;
    use App\Model\Group;

    $api = new ApiHandler();

    $api->get(function($model){
        
        $response = $model->get_groups(auth()->user()->id);

        api()->encode($response);

    }, new Group);

    $api->post(function($model){

        $response = $model->insertGroup($_POST);

        api()->encode($response);

        
    }, new Group);