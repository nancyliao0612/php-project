
<?php
  session_start();
  $uName = $_SESSION["uname"];
  // $courseId = $_SESSION['courseId'];
  $courseId = $_POST["courseId"];

  $db = new mysqli("127.0.0.1","root","","RMS");

  $result = $db -> query("INSERT INTO Consent (stuName, courseId, result) VALUES ('$uName', '$courseId', '0')");
  
  if($result){
    echo "Successfully sent consent!";
  }else{
    echo "Something went wrong!";
  }


?>