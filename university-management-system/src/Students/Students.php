<?php

namespace App\Students;

use PDO;

session_start();

class Students
{
    private $name;
    private $email;
    private $contactno;
    private $registerDate;
    private $address;
    private $department;
    private $stuid;
    private $password;
    private $sturegno;
    private $coursecode;
    private $grade;

    public function setData($data='')
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->contactno = $data['contactno'];
        $this->registerDate = $data['date'];
        $this->address = $data['address'];
        $this->department = $data['department'];

        $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
        $stmt = $pdo->prepare("SELECT * FROM register_student WHERE dept_name = '$this->department'");
        $stmt->execute();
        $allData = $stmt->fetchAll();
        $regid = count($allData) + 1;
        $this->stuid =   $this->department. "-" .date('Y') . "-00" . $regid;
        $this->password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

        $this->sturegno = $data['stuid'];
        $this->coursecode = $data['course'];
        $this->grade = $data['grade'];

        return $this;
    }

    public function addStudent()
    {

            /*$to = "sharminriya138@gmail.com";
            $subject = "University Management System";
            $message  = "<h4>Successfully Registered the student</h4>";
            $message .= "<p>This student id and password helps you to login<p>
                    ------------------------<br>
                    Student id: '.$this->stuid.'<br>
                    Password: '. $this->password.'<br>
                    ------------------------";
            $headers = 'From: myemail@egmail.com' . "\r\n" .
            'Reply-To: myemail@gmail.com' . "\r\n";

           $send_mail = mail($to,$subject,$message,$headers);*/

            $photo = $this->uploadImage();
            if(isset($photo) || empty($photo)) {
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                    $stmt = $pdo->prepare('INSERT INTO register_student(id, stu_id, password, name, email, contactno, registerDate, address, dept_name, photo, created_at) 
                                        VALUES(:id, :stdid, :password, :sname, :email, :contact, :rdate, :address, :department, :photo, :created_at)');
                    $status = $stmt->execute(
                        array(
                            ':id' => NULL,
                            ':stdid' => $this->stuid,
                            ':password' => $this->password,
                            ':sname' => $this->name,
                            ':email' => $this->email,
                            ':contact' => $this->contactno,
                            ':rdate'  => $this->registerDate,
                            ':address' => $this->address,
                            ':department' => $this->department,
                            ':photo'  => $photo,
                            ':created_at' => date('Y-m-d h:i:s')
                        )
                    );

                    if ($status) {
                        $_SESSION['success'] = "Successfully student added.";
                        header("location: addStudent.php");

                    } else {
                        $_SESSION['message'] = "Email Address must be unique";
                        header("location: addStudent.php");
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
    }

    private function uploadImage(){
        $type = explode('.', $_FILES['studentPhoto']['name']);
        $type = $type[count($type)-1];
        $url = "../../image/students/".uniqid(rand()). "." .$type;

        if(in_array($type, array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG'))){
            if(is_uploaded_file($_FILES['studentPhoto']['tmp_name'])){
                if(move_uploaded_file($_FILES['studentPhoto']['tmp_name'], $url)){
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

    public function getStudent()
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT department.code, department.dname, register_student.id, register_student.stu_id, register_student.password, register_student.name, register_student.address, register_student.email, register_student.contactno, register_student.registerDate,register_student.dept_name, 
                                  register_student.photo FROM register_student INNER JOIN department ON register_student.dept_name = department.code ORDER BY register_student.dept_name ASC");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getAllStudent(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT * FROM register_student ORDER BY register_student.dept_name ASC");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getGradeLetter(){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare("SELECT * FROM grade");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function storeStudentResult(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('INSERT INTO result(id, stuRegNo, courseid, grade, created_at) 
                                        VALUES(:id, :stuRegNo, :courseid, :grade, :created_at)');
            $status = $stmt->execute(
                array(
                    ':id' => NULL,
                    ':stuRegNo' =>  $this->sturegno,
                    ':courseid' =>  $this->coursecode,
                    ':grade' => $this->grade,
                    ':created_at' => date('Y-m-d h:i:s')
                )
            );

            if ($status) {
                $_SESSION['success'] = "Successfully student added.";
                header("location: addStudentResult.php");

            } else {
                $_SESSION['message'] = "Email Address must be unique";
                header("location: addStudentResult.php");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getStudentResult(){
        $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
        $stmt = $pdo->prepare("SELECT courses.course_code, courses.cname,  register_student.stu_id, register_student.name, result.stuRegNo, result.grade 
                                FROM ((result INNER JOIN courses ON courses.id = result.courseid) INNER JOIN register_student ON register_student.id = result.stuRegNo)");
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

}