<?php
include_once('vendor/autoload.php');
use App\Utility\Utility;
use App\Users\Users;

$obj = new Users();
$obj->matchLoginData($_POST);