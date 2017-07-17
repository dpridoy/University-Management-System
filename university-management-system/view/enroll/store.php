<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Enrollcourse\Enrollcourse;

$obj = new Enrollcourse();
$obj->setData($_POST)->addEnrollCourse();