<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\AllocateClassroom\AllocateClassroom;

$obj = new AllocateClassroom();
$obj->setData($_POST)->store();
