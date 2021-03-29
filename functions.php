<?php

    use App\Database\Database;
    

    $db = new Database;

    // setup authentication
    auth()->init();

    // auth()->logout();

    // cookie()->set('access_token',       'cad15706e05401940c95c0d29c93001c14b857a19ed8b77b3cea25c94cfc72c35b2a8007', time() + 8000);
