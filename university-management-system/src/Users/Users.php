<?php

Namespace App\Users;
use PDO;

session_start();

class Users
{
    private $username;
    private $password;

    public function matchLoginData($data = ''){
        if(isset($data['username']) && !empty($data['username'])){
            $this->username = "'" .$data['username']. "'";
        }
        else{
            $_SESSION['username'] = "Email field is required";
            header('location: login.php');
        }

        if(isset($data['password']) && !empty($data['password'])){
            $this->password = "'" .$data['password']. "'";
        }
        else{
            $_SESSION['password'] = "Password field is required";
            header('location: login.php');
        }

        $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
        $query = "SELECT * FROM users WHERE username =$this->username AND password = $this->password";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();
        if(!empty($data)){
            $_SESSION['userid'] = $data;
            header('location: view/index.php');
        }
        else{
            $_SESSION['message'] = "Enter Your Valid Username Or Password";
            header('location: login.php');
        }
    }


}