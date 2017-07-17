<?php
include_once ('../vendor/mpdf/mpdf/mpdf.php');
include_once ('../vendor/autoload.php');
use App\Utility\Utility;
use App\Students\Students;

$obj = new Students();
$allData = $obj->getStudentResult();
$trs = "";
$serial = 0;

foreach($allData as $item){

    $trs .="<tr>";
    $trs .="<td>".++$serial."</td>";
    $trs .= "<td>".$item['stu_id']."</td>";
    $trs .= "<td>".$item['name']."</td>";
    $trs .= "<td>".$item['course_code']."</td>";
    $trs .="<td>".$item['cname']."</td>";
    $trs .="<td>".$item['grade']."</td>";
    $trs .= "</tr>";
}

$html = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Result</title>
</head>

<body>

 <h3 align="center">Student's Result</h3>
     <table border="1" style=" width:100%; border-collapse: collapse;">
         <thead>
              <tr>
                 <th>#</th>
                 <th>Student Id</th>
                 <th>Student Name</th>
                 <th>Course Code</th>
                 <th>Course Name</th>
                 <th>Grade</th>
              </tr>
         </thead>
         <tbody>
            echo $trs;
         </tbody>
     </table>
</body>
EOD;


$mpdf = new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

?>