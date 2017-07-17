<?php

namespace App\Courses;
use PDO;

session_start();

class Courses
{
    private $code;
    private $name;
    private $credit;
    private $department;
    private $semester;

    public function setCourse($data = ''){
        if(isset($data['code']) && !empty($data['code'])){
            $this->code = $data['code'];
        }
        else {
            $_SESSION['code'] = "Course code filed is required";
            header('location: addCourses.php');
        }

        if( strlen($data['code']) >= 5 ){
            $this->code = $data['code'];
        }
        else{
            $_SESSION['codemsg'] = "Course code must be at least five characters long";
            header('location: addCourses.php');
        }


        if(isset($data['cname']) && !empty($data['cname'])){
            $this->name = $data['cname'];
        }
        else {
            $_SESSION['cname'] = "Course name filed is required";
            header('location: addCourses.php');
        }

        if(isset($data['credit']) && !empty($data['credit'])){
            $this->credit  = $data['credit'];
        }
        else {
            $_SESSION['credit'] = "Credit filed is required";
            header('location: addCourses.php');
        }

        if($data['credit'] > 0.5 && $data['credit'] < 5.0 ){
            $this->credit  = $data['credit'];
        }
        else {
            $_SESSION['creditmsg'] = "Credit cannot be less than 0.5 and more than 5.0.";
            header('location: addCourses.php');
        }


        if(isset($data['department']) && !empty($data['department'])){
            $this->department = $data['department'];
        }
        else {
            $_SESSION['department'] = "Department filed is required";
            header('location: addCourses.php');
        }

        if(isset($data['semester']) && !empty($data['semester'])){
            $this->semester = $data['semester'];
        }
        else {
            $_SESSION['semester'] = "Semester filed is required";
            header('location: addCourses.php');
        }
        return $this;

    }


    public function storeCourses(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('INSERT INTO courses(id, course_code, cname, credit, dept_name, semester, created_at) 
                                VALUES(:id, :code, :cname, :credit, :department, :semester, :created_at)');
            $status = $stmt->execute(
                array(
                    ':id' => NULL,
                    ':code' => $this->code,
                    ':cname' => $this->name,
                    ':credit' => $this->credit,
                    ':department' => $this->department,
                    ':semester'   => $this->semester,
                    ':created_at' => date('Y-m-d h:i:s')
                )
            );

            if ($status) {
                $_SESSION['success'] = "Successfully courses added.";
                header("location: addCourses.php");
            } else {
                $_SESSION['message'] = "Course code and name must be unique";
                header("location: addCourses.php");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCourse(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM courses ORDER BY course_code ASC');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}