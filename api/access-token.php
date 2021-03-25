<?php
    require_once __DIR__ . '/../load.php';

    use App\Core\AuthToken;
    use App\Core\ApiHandler;

    $api = new ApiHandler;

    $api->secure = false;

    $api->post(function($auth){

        $response = $auth->get_token();

        // any kind of error
        if(authToken()->is_error($response)){
            api()->error_handler($response['response']);
        }

        // successful response
        if(authToken()->is_success($response)){
            authToken()->access_token($response);
        }

    }, new AuthToken);