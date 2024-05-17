<?php
    require __DIR__ . "/inc/bootstrap.php";
    
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri = explode('/', $uri);

    //(isset($uri[4]) && $uri[4] != "user") || !isset($uri[5])
    if( (isset($uri[4]) && $uri[4] == "user") && isset($uri[5])){
        require PROJECT_ROOT_PATH . "/controller/Api/UserController.php";
        $objFeedController = new UserController();
        $strMethodName = $uri[5] . "Action";
        //call method named listAction
        $objFeedController->{$strMethodName}();
    }
    else{
        header("HTTP/1.1 404 Not Found");
        exit();
    }
?>