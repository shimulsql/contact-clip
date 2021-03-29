<?php

    use App\Core\Authentication;
    use App\Core\AuthToken;

    function authToken(){
        return new AuthToken;
    }

    function auth(){
        return new Authentication;
    }

    function is_auth(){
        if(auth()->is_logged_in())
        {
            return true;
        }
        else
        {
            return false;
        }
    }