<?php
session_start();
$courseProfessor = $_POST["id"];

$db = new mysqli("127.0.0.1","root","","RMS");

// count how many courses does the professor teach
$result = $db -> query("SELECT COUNT(*) FROM Course WHERE courseProfessor = '$courseProfessor'"); 
$row = $result -> fetch_row();
$courseNumber = $row[0]; // $row zero index value 就等於被接受的 consent 數量

if($courseNumber > 0){
  echo "You can not deactivate this professor, he/she might have a course"; // use it as the response of ajax
}else{
  $result = $db -> query("UPDATE Professor SET activeStatus = 'Deactive' WHERE proName='$courseProfessor'");
  echo "Professor $courseProfessor is deactivated";
}
?>