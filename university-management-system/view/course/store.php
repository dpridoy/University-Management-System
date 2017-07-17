<?php
include_once ("../../vendor/autoload.php");
use App\utility\Utility;
use App\Courses\Courses;

$obj = new Courses();
$obj->setCourse($_POST)->storeCourses();