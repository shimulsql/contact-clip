<?php

use App\Core\Cookie;
use App\Core\Session;

function cookie(){
        return new Cookie;
    }

    function session(){
        return new Session;
    }