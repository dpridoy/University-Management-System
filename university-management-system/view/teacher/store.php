<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Teachers\Teachers;
use App\Assigncourse\Assigncourse;

$obj = new Teachers();
$obj->setData($_POST)->addTeacher();

$obj1 = new Assigncourse();
$obj1->setData($_POST)->updateRemainingCredit();
$obj1->setData($_POST)->courseAssignToTeacher();

