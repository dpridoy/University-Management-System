<?php

namespace App\Semesters;
use PDO;

session_start();

class Semesters
{

    private $department;
    private $semester;


    public function setSemester($data = ''){
        $this->department = $data['department'];
        $this->semester = $data['semester'];
        return $this;
    }

    public function storeSemester(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('INSERT INTO semester(id, dept_name, name, created_at) VALUES(:id, :department, :semester, :created_at)');
            $status = $stmt->execute(
                array(
                    ':id' => NULL,
                    ':department' => $this->department,
                    ':semester' => $this->semester,
                    ':created_at' => date('Y-m-d h:i:s')
                )
            );

            if ($status) {
                $_SESSION['success'] = "Successfully semester data inserted.";
                header("location: addSemester.php");
            } else {
                $_SESSION['message'] = "Oops! Database Connection Error.";
                header("location: addSemester.php");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getSemeter(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM semester ORDER BY dept_name ASC');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}