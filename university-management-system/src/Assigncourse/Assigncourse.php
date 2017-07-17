<?php

namespace App\Assigncourse;
use PDO;

session_start();

class Assigncourse
{
    private $tid;
    private $remainingCredit;
    private $courseCredit;
    private $courseCode;

    public function setData($data = '')
    {
        $this->tid = $data['teachers'];
        $this->courseCode = $data['course_code'];
        $this->totalCredit = $data['takenCredit'];
        $this->courseCredit = $data['course_credit'];
        $this->remainingCredit = $data['takenCredit'] - $data['course_credit'];
        return $this;

    }

    public function courseAssignToTeacher()
    {
        /*$pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM courses');
        $stmt->execute();
        $data = $stmt->fetchAll();

        if($this->tid != $data['t_id'] ) {*/
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                $stmt = $pdo->prepare('UPDATE teachers SET remaining_credit = :remaining WHERE id = '. $this->tid);
                $status = $stmt->execute(
                    array(
                        ':remaining'=>   $this->remainingCredit,
                    )
                );

                $id = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
                $tid = $id->prepare('UPDATE courses SET t_id = :tid WHERE id = '. $this->courseCode);
                $data = $tid->execute(
                    array(
                        ':tid'=> $this->tid,
                    )
                );

                if ($status == TRUE) {
                    if ($data == TRUE) {
                        $_SESSION['success'] = "Successfully course assigned to teacher.";
                        header("location: assignCourse.php");
                    }

                } else {
                    $_SESSION['message'] = "Oops! Database Connection Error.";
                    header("location: assignCourse.php");
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        /*}
        else{
            $_SESSION['message'] = "A course cannot be assigned to more than one teacher";
            header("location: assignCourse.php");
        }*/

    }

   public function getCoursesInfo(){
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


    public function assignToTeacher(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM courses INNER JOIN teachers ON courses.t_id = teachers.id');
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}