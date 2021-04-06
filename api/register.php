<?php


    require_once __DIR__ . '/../load.php';

    use App\Core\ApiHandler;
    use App\Model\Auth\Register;

    $api = new ApiHandler;
    $api->secure = false;
    
    $api->post(function($model){

        $request = $model->create($_POST);

        api()->encode($request);
        

    }, new Register);