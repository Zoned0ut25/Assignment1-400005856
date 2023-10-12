<?php
    require 'autoloader.php';
    require 'config.php';

    $auth = new AuthenticationController();
    $auth->logOutUser();
    