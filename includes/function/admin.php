<?php

    /**
     * @param $pageActive - string
     */
    function get_sidebar( string $pageActive = 'dashboard'){
        view('inc.admin.sidebar', compact('pageActive'));
    }