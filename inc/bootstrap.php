<?php
    define("PROJECT_ROOT_PATH", __DIR__ . "/../");

    //include main configuration file
    require_once PROJECT_ROOT_PATH . "/inc/config.php";

    //include the base controller file
    require_once PROJECT_ROOT_PATH . "/controller/Api/BaseController.php";

    //include the use model file
    require_once PROJECT_ROOT_PATH . "/model/UserModel.php";
?>