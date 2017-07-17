<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Department\Department;

$obj = new Department();
$obj->setDepartment($_POST)->storeDepartment();
