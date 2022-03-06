<?php
  session_start();
  if(isset($_POST["save"])){

    for($i=1; $i<=count($_SESSION['courseId']); $i++){
      $db = new mysqli("127.0.0.1","root","","RMS");
      
      $courseId = $_SESSION['courseId'][$i];

      $result = $db -> query("UPDATE storeCourse SET courseId$i = '$courseId' WHERE stuName = '$uName'");
      var_dump($result);
      // $result = $db -> query("INSERT INTO storeCourse (courseId$i) VALUES ('$courseId') WHERE stuName = '$uName'");
    }
  }else{
    echo "Can not save your course!";
  }
?>