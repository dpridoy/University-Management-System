<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Assigncourse\Assigncourse;

$obj1 = new Assigncourse();
$obj1->setData($_POST)->courseAssignToTeacher();

