<?php
    require_once __DIR__ . '/../load.php';


    use App\Core\ApiHandler;
    use App\Model\Auth\Login;

    $api = new ApiHandler();
    $api->secure = false;

    $api->post(function($login){

        $response = $login->login($_POST);
        
        api()->encode($response);
        
    }, new Login);



    $api->delete(function($login){
        
        $response = $login->logout();

        api()->encode($response);

    }, new Login);