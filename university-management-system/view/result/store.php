<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Students\Students;

$obj = new Students();
$obj->setData($_POST)->storeStudentResult();