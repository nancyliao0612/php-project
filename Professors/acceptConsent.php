<?php
session_start();
// Accept Consent
$consentId = $_POST["id"];
$consentId = substr($consentId, 1); // a2333 -> 2333 
$db = new mysqli("127.0.0.1","root","","RMS");

// count how many students of that course are accepted
$result = $db -> query("SELECT COUNT(*) FROM Consent WHERE consentId='$consentId' and result=1"); 
$row = $result -> fetch_row();
$acceptNumbers = $row[0]; // $row zero index value 就等於被接受的 consent 數量

// capture the limit of the course
// take the courseId of that consent
$result = $db -> query("SELECT courseId FROM Consent WHERE consentId='$consentId'"); 
$row = $result -> fetch_row();
$courseId = $row[0];

// find the limit of that course
$result = $db -> query("SELECT courseQuota FROM Course WHERE courseId='$courseId'"); 
$row = $result -> fetch_row();
$courseQuota = $row[0];


if($courseQuota > $acceptNumbers){
  $result = $db -> query("UPDATE Consent SET result = 1 WHERE consentId='$consentId'"); // 1 mean accept
  echo "Consent is accepted"; // use it as the response of ajax
}else{
  echo "Course limit is full";
}

// Reject Consent


?>