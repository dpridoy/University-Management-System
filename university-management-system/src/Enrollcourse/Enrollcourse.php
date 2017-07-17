<?php
/**
 * Created by PhpStorm.
 * User: Boolooddd
 * Date: 5/12/2017
 * Time: 8:31 PM
 */

namespace App\Enrollcourse;

use PDO;

session_start();

class Enrollcourse
{
    private $stuRegNo;
    private $department;
    private $course;
    private $enrolldate;

    public function setData($data='')
    {
        $this->stuRegNo = $data['stuid'];
        $this->department = $data['department'];
        $this->course = $data['course'];
        $this->enrolldate = $data['date'];

        return $this;
    }

    public function addEnrollCourse()
    {
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                $stmt = $pdo->prepare('INSERT INTO enrollinacourse(id, stuRegNo, dept_name, course,	enrolldate, created_at) 
                                        VALUES(:id, :stuRegNo, :dept_name, :course, :enrolldate, :created_at)');
                $status = $stmt->execute(
                    array(
                        ':id' => NULL,
                        ':stuRegNo' => $this->stuRegNo,
                        ':dept_name' => $this->department,
                        ':course' => $this->course,
                        ':enrolldate' => $this->enrolldate,
                        ':created_at' => date('Y-m-d h:i:s')
                    )
                );

                if ($status) {
                    $_SESSION['success'] = "Successfully enroll in a course.";
                    header("location: enrollCourse.php");

                } else {
                    $_SESSION['message'] = "Database connection error";
                    header("location: enrollCourse.php");
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }


    public function getEnrollCourse(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM enrollinacourse WHERE stuRegNo = 6');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}