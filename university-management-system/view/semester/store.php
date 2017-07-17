<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Semesters\Semesters;

$obj = new Semesters();
$obj->setSemester($_POST)->storeSemester();
