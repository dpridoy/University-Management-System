<?php
include_once('../../vendor/autoload.php');
use App\Utility\Utility;
use App\Students\Students;

$obj = new Students();
$data = $obj->getStudent();
$grade = $obj->getGradeLetter();

if(!isset($_SESSION['userid'])){
    header('location: ../../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result - University Course &amp; Result Management System</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="../../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../../assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="../../assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="../../assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/styling/switch.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="../../assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="../../assets/js/core/app.js"></script>
    <script type="text/javascript" src="../../assets/js/pages/form_validation.js"></script>

    <script type="text/javascript" src="../../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>

    <script type="text/javascript" src="../../assets/js/pages/form_select2.js"></script>

    <script type="text/javascript" src="../../assets/js/core/libraries/jquery_ui/datepicker.min.js"></script>

    <!-- /theme JS files -->



</head>

<body class="navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="../index.php">University Management System<!--<img src="../../assets/images/logo_light.png" alt="">--></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <?php if(isset($_SESSION['userid']['image'])):?>
                        <img src="<?php echo $_SESSION['userid']['image']?>" alt="">
                    <?php else:?>
                        <img src="../../assets/images/placeholder.jpg" alt="">
                    <?php endif;?>
                    <span>
                            <?php if(isset($_SESSION['userid']['name'])):
                                echo $_SESSION['userid']['name'];
                            endif;
                            ?>
                        </span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="../logout.php"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-fixed">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left">
                                <?php if(isset($_SESSION['userid']['image'])):?>
                                    <img src="<?php echo $_SESSION['userid']['image']?>" class="img-circle img-sm" alt="">
                                <?php else:?>
                                    <img src="../../assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <?php endif;?>
                            </a>
                            <div class="media-body">
									<span class="media-heading text-semibold">
                                        <?php if(isset($_SESSION['userid']['name'])):
                                            echo $_SESSION['userid']['name'];
                                        endif;
                                        ?>
                                    </span>
                                <div class="text-size-mini text-muted">
                                    <?php if(isset($_SESSION['userid']['designation'])):
                                        echo $_SESSION['userid']['designation'];
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="#"><i class="icon-cog3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li><a href="../index.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                            <li>
                                <a href="#"><i class="icon-stack2"></i> <span>Department</span></a>
                                <ul>

                                    <li><a href="../department/addDepartment.php">Add Department</a></li>
                                    <li><a href="../department/viewDepartment.php">View All Department</a></li>


                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-copy"></i> <span>Semester</span></a>
                                <ul>
                                    <li><a href="../semester/addSemester.php" id="layout2">Add Semester</a></li>
                                    <li><a href="../semester/viewSemester.php" id="layout3">View All Semester</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-copy"></i> <span>Courses</span></a>
                                <ul>
                                    <li><a href="../course/addCourses.php" id="layout2">Add Courses</a></li>
                                    <li><a href="../course/viewCoureses.php" id="layout3">View All Courses</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-users"></i> <span>Teachers</span></a>
                                <ul>
                                    <li><a href="../teacher/addTeacher.php">Add Teacher</a></li>
                                    <li><a href="../teacher/viewAllTeacher.php">View All Teachers</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-user"></i> <span>Course Assign To Teacher</span></a>
                                <ul>
                                    <li><a href="../assign/assignCourse.php">Assign Course</a></li>
                                    <li><a href="../assign/courseAssignInfo.php">Course Information</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-users"></i> <span>Students</span></a>
                                <ul>
                                    <li><a href="../student/addStudent.php">Register Sutdent</a></li>
                                    <li><a href="../student/viewAllStudent.php">View All Students</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="icon-pencil3"></i> <span>Classrooms</span></a>
                                <ul>
                                    <li><a href="../allocateClassroom/addAllocateClassroom.php">Allocate Classroom</a></li>
                                    <li><a href="../allocateClassroom/viewClassroom.php">View Class Schedule</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-users"></i> <span>Enroll Student In a Course </span></a>
                                <ul>
                                    <li><a href="../enroll/enrollCourse.php">Enroll In a Course</a></li>
                                    <li><a href="../enroll/viewEnrollCourse.php">View Enroll Course</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-user"></i> <span>Student Result</span></a>
                                <ul>
                                    <li class="active"><a href="../result/addStudentResult.php">Add Result</a></li>
                                    <li class="active"><a href="../result/viewStudentResult.php">View Result</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                            <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Result</h4>
                    </div>
                </div>



                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="../index.php"><i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Result</li>
                    </ul>

                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">
                <!-- Highlighting rows and columns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Student's Result</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($_SESSION['message'])){?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php }elseif (isset($_SESSION['success'])){?>
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>


                        <form class="form-horizontal form-validate-jquery" action="#">
                            <fieldset class="content-group">
                                <!-- Basic text input -->
                                <div class="form-group">
                                    <label class="control-label col-lg-2"> Student Reg. No. : <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <select class="select-search" data-placeholder="-----Select a student-----" name="stuid" id="stuid" required="required">
                                            <option></option>
                                            <optgroup label="All register student">
                                                <?php if(isset($data)):
                                                    foreach($data as $item):
                                                        ?>
                                                        <option value="<?php echo $item['id'];?>"><?php echo $item['stu_id'];?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>


                                <div id="studentDetails">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Student Name : <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="stuname" value="" class="form-control" required="required" placeholder="-----View student name-----" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Student Email : <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="stuemail" value="" class="form-control" required="required" placeholder="-----View student email-----" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Department : <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="department" id="department" value="" class="form-control" required="required" placeholder="-----View a department-----" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right">
                                <a href="../pdf.php" class="btn btn-primary" target="_blank" style="margin-bottom: 20px" >Make pdf </a>

                            </div>
                        </form>

                        <table class="table table-bordered table-hover datatable-highlight">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Grade</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /highlighting rows and columns -->



                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2017. <a href="#">Dynamic Group. </a> All Right Reserved.
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<!-- /Datepicker-->
<script>
    $('#date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

</script>
<!-- /Datepicker-->

<!-- Select teacher for collecting the credit which his to be taken -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#stuid').change(function(){
            var sid = $(this).val();
            $.ajax({
                url: "../load.php",
                data: {sid: sid},
                type: "POST",
                dataType:"text",
                success:function(data){
                    $("#studentDetails").html(data);
                }
            });
        });
    });
</script>

<!-- Select teacher for collecting the credit which his to be taken -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#stuid').change(function(){
            var result = $(this).val();
            $.ajax({
                url: "../load.php",
                data: {result: result},
                type: "POST",
                dataType:"text",
                success:function(data){
                    $("#table").html(data);
                }
            });
        });
    });
</script>



</body>
</html>

