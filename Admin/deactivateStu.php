<?php
session_start();
$courseStudent = $_POST["stuId"];
// $stuName = $_SESSION['uname'];

$db = new mysqli("127.0.0.1","root","","RMS");

// for($i = 0; $i < 6; $i++){
//   $result = $db -> query("SELECT * FROM storeCourse WHERE stuName = '$courseStudent' AND courseId$i != 0"); 
//   $row = $result -> fetch_row();
//   $course = $row[0];
// }
for($i=0; $i<6; $i++){
  $result = $db -> query("SELECT COUNT(*) FROM storeCourse WHERE stuName = '$courseStudent' and courseId$i > 0");
  $row = $result -> fetch_row();
  $course += $row[0];
}

if($course != 0){
  echo "You can not deactivate this student, he/she has enrolled $course course(s)"; // use it as the response of ajax
}else{
  $result = $db -> query("UPDATE Student SET activeStatus = 'Deactive' WHERE stuName='$courseStudent'");
  echo "Student $courseStudent is deactivated";
}



?>