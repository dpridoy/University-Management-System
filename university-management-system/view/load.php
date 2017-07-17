<?php
include_once ("../vendor/autoload.php");
?>

<?php
$value = '';

//Fetch data for semester in a department........................................................
if(isset($_POST['dept_id'])){
    //$dept_id = "'".$_POST['dept_id']."'";
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT id, name FROM semester WHERE dept_name ='".$_POST["dept_id"]."'");
    $stmt->execute();
    $data = $stmt->fetchAll();

    $value .= "<optgroup label='All semesters'>";
    foreach ($data as $row){
        $value .= "<option value='".$row['name']."'>".$row['name']." semester</option>";
    }
    $value .= "</optgroup>";
    echo $value;

}

//Fetch data for teacher in a department...........................................................
if(isset($_POST['deptid'])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT id, name FROM teachers WHERE dept_name ='".$_POST["deptid"]."'");
    $stmt->execute();
    $data = $stmt->fetchAll();

    $value .= "<optgroup label='All teachers'>";
    foreach ($data as $row){
        $value .= "<option value='".$row['id']."'>".$row['name']."</option>";
    }
    $value .= "</optgroup>";
    echo $value;

}

//Fetch data for credit to be taken of a teacher...........................................................
if(isset($_POST['tid'])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT id, credit_to_be_taken, remaining_credit FROM teachers WHERE id = '".$_POST['tid']."'");
    $stmt->execute();
    $data = $stmt->fetch();

    $value .= '<div class="form-group">';
    $value .= '<label class="control-label col-lg-2">Credit to be taken : <span class="text-danger">*</span></label>';
    $value .= '<div class="col-lg-10">';
    $value .= '<input type="text" name="takenCredit" value="'.$data['credit_to_be_taken'].'" class="form-control" required="required" readonly="readonly">';
    $value .= '</div>';
    $value .= '</div>';

    $value .= '<div class="form-group">';
    $value .= '<label class="control-label col-lg-2">Remaining Credit : <span class="text-danger">*</span></label>';
    $value .= '<div class="col-lg-10">';
    $value .= '<input type="text" name="remainingCredit" value="'.$data['remaining_credit'].'" class="form-control" required="required" readonly="readonly">';
    $value .= '</div>';
    $value .= '</div>';

    echo $value;

}

//Fetch course data in a department................................................................
if(isset($_POST['deptcode'])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT id, course_code FROM courses WHERE dept_name ='".$_POST['deptcode']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();

    $value .= "<optgroup label='All courses'>";
    foreach ($data as $row){
        $value .= "<option value='".$row['id']."'>".$row['course_code']."</option>";
    }
    $value .= "</optgroup>";
    echo $value;

}

//Fetch course credit in a courses table................................................................
if(isset($_POST["course_id"])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = '".$_POST["course_id"]."'");
    $stmt->execute();
    $data = $stmt->fetch();
    $value .= '<div class="form-group">';
    $value .= '<label class="control-label col-lg-2">Credit to be taken : <span class="text-danger">*</span></label>';
    $value .= '<div class="col-lg-10">';
    $value .= '<input type="text" name="takenCredit" value="'.$data['cname'].'" class="form-control" required="required" readonly="readonly">';
    $value .= '</div>';
    $value .= '</div>';

    $value .= '<div class="form-group">';
    $value .= '<label class="control-label col-lg-2">Remaining Credit : <span class="text-danger">*</span></label>';
    $value .= '<div class="col-lg-10">';
    $value .= '<input type="text" name="remainingCredit" value="'.$data['credit'].'" class="form-control" required="required" readonly="readonly">';
    $value .= '</div>';
    $value .= '</div>';
    echo $value;

}

//Fetch course code by department id
if(isset($_POST['department_id'])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT id, course_code FROM courses WHERE dept_name ='".$_POST['department_id']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();

    $value .= "<optgroup label='All courses'>";
    foreach ($data as $row){
        $value .= "<option value='".$row['course_code']."'>".$row['course_code']."</option>";
    }
    $value .= "</optgroup>";
    echo $value;

}

//get schedule of course code by department

if(isset($_POST['dept'])){
    $pdo = new PDO('mysql:host=localhost;dbname=universitysystem', 'root', '');
    $stmt = $pdo->prepare("SELECT allocate_classroom.id, allocate_classroom.department, allocate_classroom.course, 
                          allocate_classroom.roomno, allocate_classroom.day, allocate_classroom.from, allocate_classroom.to, 
                          courses.cname FROM allocate_classroom INNER JOIN courses on allocate_classroom.course=courses.course_code 
                          WHERE department='".$_POST['dept']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();
    $var=0;

    foreach ($data as $row){
        $value .="<tr>";
        $value .="<td>".++$var."</td>";
        $value .= "<td>".$row['course']."</td>";
        $value .="<td>".$row['cname']."</td>";
        $value .="<td>"."Room No:".$row['roomno'].";".$row['day'].";".$row['from']."-".$row['to']."</td>";
        $value .="<td class=\"text-center\">
                           <ul class=\"icons-list\">
                                  <li class=\"dropdown\">
                                     <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                         <i class=\"icon-menu9\"></i>
                                     </a>
                                     <ul class=\"dropdown-menu dropdown-menu-right\">
                                          <li><a href=\"department/editDepartment.php?".$row['id']."\"><i class=\"icon-pencil\"></i>Edit</a></li>
                                          <li><a href=\"department/deleteDepartment.php?".$row['id']."\"><i class=\"icon-trash\"></i>Delete</a></li>
                                     </ul>                
                              </li>
                           </ul>
                   </td>";
        $value .="</tr>";
    }

    echo $value;

}


//Fetch all student details from student table...........................................................................

if(isset($_POST['sid'])){
    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'amarproshnoo_universitysystem', 'sharmin123');
    $stmt = $pdo->prepare("SELECT * FROM register_student WHERE id = '".$_POST['sid']."'");
    $stmt->execute();
    $data = $stmt->fetch();

    $value ='<div class="form-group">';
    $value .= '<label class="control-label col-lg-2">Student Name : <span class="text-danger">*</span></label>';
    $value .='<div class="col-lg-10">';
    $value .='<input type="text" name="stuname" value="'.$data['name'].'" class="form-control" required="required">';
    $value .='</div>
             </div>';
    $value .='<div class="form-group">';
    $value .='<label class="control-label col-lg-2">Student Email : <span class="text-danger">*</span></label>';
    $value .='<div class="col-lg-10">';
    $value .='<input type="text" name="stuemail" value="'.$data['email'].'" class="form-control" required="required">';
    $value .='</div>
              </div>';
    $value .='<div class="form-group">';
    $value .='<label class="control-label col-lg-2">Department : <span class="text-danger">*</span></label>';
    $value .='<div class="col-lg-10">';
    $value .='<input type="text" name="department" id="department" value="'.$data['dept_name'].'" class="form-control" required="required">';
    $value .='</div>
              </div>';

    echo $value;
}


if(isset($_POST['stu_detail'])){
    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'amarproshnoo_universitysystem', 'sharmin123');
    $stmt = $pdo->prepare("SELECT * FROM register_student WHERE id='".$_POST['stu_detail']."'");
    $stmt->execute();
    $data = $stmt->fetch();

    $value .="<p style='font-size: 16px'><b>Student Id :</b> ".$data['stu_id']." </p>";
    $value .="<p><b>Name :</b> ".$data['name']." </p>";
    $value .="<p><b>Department :</b> ".$data['dept_name']." </p>";

    echo $value;

}


//get enroll course info of student id by enrollinacourse

if(isset($_POST['stu_id'])){
    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'amarproshnoo_universitysystem', 'sharmin123');
    $stmt = $pdo->prepare("SELECT courses.course_code, courses.dept_name, courses.cname, enrollinacourse.id, enrollinacourse.stuRegNo, enrollinacourse.dept_name, enrollinacourse.course,enrollinacourse.enrolldate  
                          FROM enrollinacourse INNER JOIN courses ON enrollinacourse.course=courses.id
                          WHERE enrollinacourse.stuRegNo ='".$_POST['stu_id']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();
    $var=0;

    foreach ($data as $row){

        $value .="<tr>";
        $value .="<td>".++$var."</td>";
        $value .= "<td>".$row['course_code']."</td>";
        $value .="<td>".$row['cname']."</td>";
        $value .="<td>".$row['enrolldate']."</td>";
        $value .='<td class="text-center">
                           <ul class="icons-list">
                                  <li class="dropdown">
                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                         <i class="icon-menu9"></i>
                                     </a>
                                     <ul class="dropdown-menu dropdown-menu-right">
                                          <li><a href="department/editDepartment.php"><i class="icon-pencil"></i>Edit</a></li>
                                          <li><a href="department/deleteDepartment.php"><i class="icon-trash"></i>Delete</a></li>
                                     </ul>                
                              </li>
                           </ul>
                   </td>';
        $value .="</tr>";
    }

    echo $value;
}

//Fetch course data in a department................................................................
if(isset($_POST['stu_course'])){
    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'amarproshnoo_universitysystem', 'sharmin123');
    $stmt = $pdo->prepare("SELECT courses.course_code, courses.dept_name, courses.cname, courses.id, enrollinacourse.stuRegNo,enrollinacourse.course 
                          FROM enrollinacourse INNER JOIN courses ON enrollinacourse.course=courses.id
                          WHERE enrollinacourse.stuRegNo ='".$_POST['stu_course']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();

    $value .= "<optgroup label='All courses'>";
    foreach ($data as $row){
        $value .= "<option value='".$row['id']."'>".$row['cname']."</option>";
    }
    $value .= "</optgroup>";
    echo $value;

}

//get enroll course info of student id by enrollinacourse

if(isset($_POST['result'])){
    $pdo = new PDO('mysql:host=localhost;dbname=amarproshnoo_universitysystem', 'amarproshnoo_universitysystem', 'sharmin123');
    $stmt = $pdo->prepare("SELECT courses.course_code, courses.cname, result.id, result.stuRegNo, result.courseid, result.grade  
                          FROM result INNER JOIN courses ON result.courseid=courses.id
                          WHERE result.stuRegNo ='".$_POST['result']."'");
    $stmt->execute();
    $data = $stmt->fetchAll();
    $var=0;

    foreach ($data as $row){

        $value .="<tr>";
        $value .="<td>".++$var."</td>";
        $value .= "<td>".$row['course_code']."</td>";
        $value .="<td>".$row['cname']."</td>";
        $value .="<td>".$row['grade']."</td>";
        $value .='<td class="text-center">
                           <ul class="icons-list">
                                  <li class="dropdown">
                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                         <i class="icon-menu9"></i>
                                     </a>
                                     <ul class="dropdown-menu dropdown-menu-right">
                                          <li><a href="department/editresult.php"><i class="icon-pencil"></i>Edit</a></li>
                                          <li><a href="department/deleteresult.php"><i class="icon-trash"></i>Delete</a></li>
                                     </ul>                
                              </li>
                           </ul>
                   </td>';
        $value .="</tr>";
    }

    echo $value;
}

?>