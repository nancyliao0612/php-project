
<?php
  session_start();
  $uName = $_SESSION["uname"];
  $newArrayId = $_SESSION['courseId'];

  $removeBtn = $_POST["removeBtn"];
  // echo $removeBtn;
  $db = new mysqli("127.0.0.1","root","","RMS");
  
  if($removeBtn >=0){
    $insertId = $db -> query("UPDATE storeCourse SET courseId$removeBtn = -1 WHERE stuName = '$uName'");
    $newArrayId[$removeBtn] = -1;
    //echo $newArrayId;
    echo "Removed course!";
    //$_SESSION['changeArray'] = true;
    // for($i=0; $i<count($newArrayId); $i++){
      //   echo $newArrayId[$i];
      // }
    }else{
      echo "Something went wrong!";
    }
  //$_SESSION['newArrayId'] = $newArrayId;








    // $result = $db -> query("SELECT * FROM Course WHERE courseId in ($courseId, $courseId2)");

  //   echo "<table border=1>";
  //   echo "<thead><tr><th>ID</th><th>Course Name</th><th>Intro</th><th>Quota</th><th>Credit</th><th>Consent</th><th>Professor</th></tr></thead>"; 
  //   while($row = $result -> fetch_row()){
  //     echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td>" ."<td>
  //     <button id='$row[0]'>Remove</button></td></tr>";
  //   }
  //   echo "</table>";
  // }else{
  //   echo "Cannot find the course!";
  // }


?>