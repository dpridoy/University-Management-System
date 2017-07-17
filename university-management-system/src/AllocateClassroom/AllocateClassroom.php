<?php
namespace App\AllocateClassroom;
use PDO;

session_start();

class AllocateClassroom
{
    private $department;
    private $course;
    private $roomno;
    private $day;
    private $from;
    private $to;


    public function setData($data='')
    {
        if(isset($data['department']) && !empty($data['department'])){
            $this->department = $data['department'];
        }
        else{
            $_SESSION['department'] = "Department is required";
            header('location: addAllocateClassroom.php');
        }

        if(isset($data['course']) && !empty($data['course'])){
            $this->course = $data['course'];
        }
        else{
            $_SESSION['course'] = "Course is required";
            header('location: addAllocateClassroom.php');
        }
        if(isset($data['roomno']) && !empty($data['roomno'])){
            $this->roomno = $data['roomno'];
        }
        else{
            $_SESSION['roomno'] = "Room No is required";
            header('location: addAllocateClassroom.php');
        }
        if(isset($data['day']) && !empty($data['day'])){
            $this->day = $data['day'];
        }
        else{
            $_SESSION['day'] = "Day is required";
            header('location: addAllocateClassroom.php');
        }
        if(isset($data['from']) && !empty($data['from'])){
            $this->from = $data['from'];
        }
        else{
            $_SESSION['from'] = "Starting time is required";
            header('location: addAllocateClassroom.php');
        }
        if(isset($data['to']) && !empty($data['to'])){
            $this->to = $data['to'];
        }
        else{
            $_SESSION['to'] = "Ending time is required";
            header('location: addAllocateClassroom.php');
        }

        return $this;
    }

    public function store()
    {
        $status=false;
        $somossa=0;
        $o=new AllocateClassroom();
        $d=$o->getClassroom();
        $morning="07:59";
        $evening="20:01";

        foreach ($d as $item)
        {
            if($this->day == $item['day'])
            {
                if($this->roomno==$item['roomno'])
                {
                    if(($this->from < $item['from'] && $this->to <= $item['from']
                            && $this->from<$this->to && $this->from>$morning && $this->to<$evening)
                        || ($item['to'] <= $this->from   && $item['to'] <$this->to
                            && $this->from<$this->to && $this->from>$morning && $this->to<$evening))
                    {
                        $status=true;
                    }
                    else
                    {
                        $somossa++;
                    }
                }
            }

        }

        if($somossa==0){
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
                $stmt = $pdo->prepare('INSERT INTO allocate_classroom(`id`, `department`, `course`, `roomno`, `day`, `from`, `to`) VALUES(:i,:de,:c,:r,:d,:f,:t)');

                $stmt->execute(array(
                    ':i'=>null,
                    ':de' => $this->department,
                    ':c'=>$this->course,
                    ':r'=>$this->roomno,
                    ':d'=>$this->day,
                    ':f'=>$this->from,
                    ':t'=>$this->to
                ));


                if($stmt){
                    $_SESSION['success'] = "Successfully added.";
                    header("location: addAllocateClassroom.php");
                }
                else{
                    $_SESSION['message'] = "Something went wrong";
                    header("location: addAllocateClassroom.php");
                }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        else{
            $_SESSION['message'] = "Check the time!!";
            header("location: addAllocateClassroom.php");
        }

    }

    public function getClassroom()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM `allocate_classroom`');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getRoomNo()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM `roomno`');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getDays()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM `days`');
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}