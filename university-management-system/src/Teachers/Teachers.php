<?php

namespace App\Teachers;
use PDO;

//session_start();

class Teachers
{
    private $name;
    private $address;
    private $email;
    private $contact;
    private $designation;
    private $department;
    private $totalCredit;
    private $remainingCredit;

    public function setData($data='')
    {
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->email = $data['email'];
        $this->contact = $data['contactno'];
        $this->designation = $data['designation'];
        $this->department = $data['department'];
        $this->totalCredit = $data['takencredit'];
        $this->remainingCredit = $data['takencredit'];
        return $this;
    }

    public function addTeacher()
    {
        $photo = $this->uploadImage();
        if(isset($photo) || empty($photo)) {
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                $stmt = $pdo->prepare('INSERT INTO teachers(id, name, address, email, contact, designation, dept_name, credit_to_be_taken, photo, remaining_credit, created_at) 
                                        VALUES(:id, :tname, :address, :email, :contact, :designation, :department, :credit, :photo, :remaining, :created_at)');
                $status = $stmt->execute(
                    array(
                        ':id' => NULL,
                        ':tname' => $this->name,
                        ':address' => $this->address,
                        ':email' => $this->email,
                        ':contact' => $this->contact,
                        ':designation' => $this->designation,
                        ':department' => $this->department,
                        ':credit' => $this->totalCredit,
                        ':photo'  => $photo,
                        ':remaining'=>  $this->remainingCredit,
                        ':created_at' => date('Y-m-d h:i:s')
                    )
                );

                if ($status) {
                    $_SESSION['success'] = "Successfully teacher added.";
                    header("location: addTeacher.php");
                } else {
                    $_SESSION['message'] = "Email address must be unique";
                    header("location: addTeacher.php");
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    private function uploadImage(){
        $type = explode('.', $_FILES['teacherPhoto']['name']);
        $type = $type[count($type)-1];
        $url = "../../image/teachers/".uniqid(rand()). "." .$type;

        if(in_array($type, array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG'))){
            if(is_uploaded_file($_FILES['teacherPhoto']['tmp_name'])){
                if(move_uploaded_file($_FILES['teacherPhoto']['tmp_name'], $url)){
                    return $url;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function getTeachers()
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT department.code, department.dname,teachers.id, teachers.name, teachers.address, teachers.email, teachers.contact, teachers.designation, teachers.dept_name, teachers.credit_to_be_taken, 
                                  teachers.photo, teachers.remaining_credit FROM teachers INNER JOIN department ON teachers.dept_name = department.code");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getDesignation()
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT * FROM designation");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}