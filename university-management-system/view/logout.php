<?php
session_start();
if(!empty($_SESSION['userid'])){
    unset($_SESSION['userid']);
    header('location: ../login.php?logout=successfull');

}