<?php

namespace App\Department;
use PDO;

session_start();


class Department
{

    private $code;
    private $name;


    public function setDepartment($data = ''){
        if(isset($data['code']) && !empty($data['code'])){
            $this->code = $data['code'];
        }
        else{
            $_SESSION['code'] = "Code field is required";
            header('location: addDepartment.php');
        }

        if(isset($data['dname']) && !empty($data['dname'])){
            $this->name = $data['dname'];
        }
        else{
            $_SESSION['dname'] = "Name field is required";
            header('location: addDepartment.php');
        }
        return $this;
    }

    public function storeDepartment(){
        if(strlen($this->code) < 2 || strlen($this->code) > 7){
            $_SESSION['codelen'] = "Code must be two to seven characters long.";
            header("location: addDepartment.php");
        }
        else{
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                $stmt = $pdo->prepare('INSERT INTO department(id, code, dname, created_at) VALUES(:id, :code, :dname, :created_at)');
                $status = $stmt->execute(
                    array(
                        ':id' => NULL,
                        ':code' => $this->code,
                        ':dname' => $this->name,
                        ':created_at' => date('Y-m-d h:i:s')
                    )
                );

                if ($status) {
                    $_SESSION['success'] = "Successfully department added.";
                    header("location: addDepartment.php");
                } else {
                    $_SESSION['message'] = "Department code and name must be unique";
                    header("location: addDepartment.php");
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }


    public function getDepartmentData(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT * FROM department");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }



}