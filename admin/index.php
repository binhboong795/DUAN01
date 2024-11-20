<?php

session_start();
require_once '../commons/function.php';
require_once 'controllers/accController.php';
require_once 'models/accModel.php';




$act = $_GET['act'] ?? '/';
match ($act) {
    '/'    => (new accController())->home(),
};
