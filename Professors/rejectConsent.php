<?php
session_start();
$consentId = $_POST["rejId"];
$consentId = substr($consentId, 1); // a2333 -> 2333 
$db = new mysqli("127.0.0.1","root","","RMS");

$insertId = $db -> query("UPDATE Consent SET result = -1 WHERE  consentId= '$consentId'");

for($i=0; $i<6; $i++){        
  $result = $db -> query("SELECT Consent.courseId, Consent.stuName, Consent.result, storeCourse.stuName, storeCourse.courseId$i FROM Consent JOIN storeCourse ON Consent.stuName = storeCourse.stuName and Consent.courseId = '$consentId' and storeCourse.courseId$i = '$consentId'");
  
  $row = $result -> fetch_row();
  $stuName = $row[1];
  
  // remove the course from student's course list
  if($result -> num_rows != 0){
    $result = $db -> query("UPDATE storeCourse SET courseId$i = -1 WHERE stuName = '$stuName'");
    echo "remove the course from student $stuName's course list";
  }
}
?>