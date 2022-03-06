<?php
  session_start();
  // echo $_SESSION["uname"];
  // echo $_SESSION["maxStuCourse"];
  // session_destroy();
  // if(isset($_POST["remove"])){
  //   echo $_SESSION['newArray'];
  //   for($i=0; $i<count($newArrayId); $i++){
  //   echo $newArrayId[$i];
  //   }
  // }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MIS 233｜Lab2</title>
    <!-- CSS Style -->
    <link rel="stylesheet" href="../index.css?v=<?php echo time(); ?>">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <!-- JQuery CDN Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <div id="top">
      <h1>Registration Management System</h1>
      <?php
        $uName = $_SESSION["uname"];
        echo "<p>👋 Hi Student <span class='name-highlight'>" . $uName .  "</span></p>";
      ?>    </div>
    <div class="wrapper">
      <?php
        include "stuMenu.php";
      ?>
      <div id="main">
        <?php

          echo "<h2>Hi $uName, You can add Course</h2>";
          //connect to my database
          $db = new mysqli("127.0.0.1","root","","RMS");
          // select the last row of system parameters that administrators entered
          $result = $db -> query("SELECT * FROM SystemManage ORDER BY parametersId DESC LIMIT 1");
          if($result -> num_rows != 0){
            while($row = $result -> fetch_row()){
              echo "<span class='warning-msg'>Maxmium courses you can select: " . $row[3] . "</span><br>";
              echo "<br>";
              $maxCourse = $row[3];
            }
          }
        ?>
        <form action="addCourse.php" method="post">
          <label>Course ID: </label>
          <input type="text" name="courseId" value="">   
          <button id="submit" name="send" type="submit" class="submit-table">Submit</button>
          <p id="result">Your Course List</p>
        <!-- <form action="saveCourse.php" method="post">
          <button id="save" name="save" type="submit" class="submit-table">Save</button>
        </form> -->
        <?php
          // for($i=1; $i<=$_SESSION["maxStuCourse"]; $i++){
          //   echo "<label>Course ID: </label>";
          //   echo "<input type='text' class ='courseId' id='courseId$i'/><br/>";
          // }
          
        if (!is_array($_SESSION['courseId'])) {
          $_SESSION['courseId'] = array();
          // array name: $_SESSION['courseId']
        }
        $db = new mysqli("127.0.0.1","root","","RMS");
        $uName = $_SESSION["uname"];
        // $nameInsert = $db -> query("INSERT INTO storeCourse (stuName) VALUES ('$uName')");
          
        if (isset($_POST['send']) && isset($_POST['courseId'])) {
          //$insertId = $_POST['courseId'];
          // if(isset($_POST["remove"])){
          //   for($i=0; $i<count($_SESSION['newArrayId']); $i++){
          //     echo $_SESSION['newArrayId'][$i];
          //   }
          // }
          if($_SESSION['status']){
            for($i=0; $i<$maxCourse; $i++){
              $insertId = $db -> query("UPDATE storeCourse SET courseId$i = 0 WHERE stuName = '$uName'");
            }
            echo "<script type='text/javascript'>alert('You already have your course list, do you want to rewrite it?')</script>";
          }else{
            // if(isset($_POST["save"])){
            //   $result = $db -> query("SELECT Course.courseId, Course.courseName, Course.courseIntro, Course.courseQuota, Course.courseCredit, Course.courseConsent, Course.courseProfessor, storeCourse.courseId$i, storeCourse.stuName FROM Course INNER JOIN storeCourse ON Course.courseId = storeCourse.courseId$i and storeCourse.courseId$i > 0");
            // }
  
            $_SESSION['courseId'][] = $_POST['courseId'];
            
            echo "<table border=1 id='course-table'>";
            echo "<thead><tr><th>ID</th><th>Course Name</th><th>Intro</th><th>Quota</th><th>Credit</th><th>Consent</th><th>Professor</th><th>Remove</th></tr></thead>";
            
            
            // $_SESSION['courseId'][0] = "";
            for($i=0; $i<count($_SESSION['courseId']); $i++){
                $courseId = $_SESSION['courseId'][$i];
               // echo $courseId;
            
                $insertId = $db -> query("UPDATE storeCourse SET courseId$i = '$courseId' WHERE stuName = '$uName'");
            
                $result = $db -> query("SELECT * FROM Course WHERE courseId = '$courseId'");
  
                while($row = $result -> fetch_row()){
                  echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td><button id='$i' name='remove' type='submit' class='btnDelete'>Remove</button></td></tr>";      
                }
                echo $_SESSION["couseName"];              
              }     
              echo "</table>";  
            }
            $_SESSION['status'] = false;
        }      
        ?>
        <button id="save" name="save" type="submit" class="save-btn">save</button>
        </form>
        <?php
          for($i=0; $i<$maxCourse; $i++){
            $result = $db -> query("SELECT COUNT(*) FROM storeCourse WHERE stuName = '$uName' and courseId$i > 0");
            $row = $result -> fetch_row();
            $selectCourse += $row[0];
          }
          //echo "selected course: " . $selectCourse;

          if(isset($_POST["save"])){
            if($maxCourse >= $selectCourse){
              // reset array
              $_SESSION['courseId'] = array_diff( $_SESSION['courseId'], $_SESSION['courseId']);
              // session_destroy();
              $_SESSION['status'] = true;
              header("Location: courseList.php");
              //echo $_SESSION['status'];
              // echo $_SESSION['newArrayId'];

            }else {
              echo "You have reached your course select limit!";
            }
          }
        ?>
        
        <?php
          // echo strlen($upass1) . "<br>";
          // echo $_SESSION["minPwd"] . "<br>";
          // if(($_SESSION["minPwd"] >= strlen($upass1)) || (strlen($upass1) >= $_SESSION["maxPwd"])){
          //   echo "<span class='warning-msg'>*password length must between " . $_SESSION["minPwd"] . " and " . $_SESSION["maxPwd"] . "</span><br>";
          // }
        ?>
      </div>
      <div id="ann">
        <h3>Announcements</h3>
        <p><a href="../logout.php" target="_blank">Logout</a></p>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function () {
        // $(".save-btn").click {
        //   function(){
        //     $(this).css("visibility", "visible")
        //   }
        // };
        $("#course-table").on('click', '.btnDelete', function (e) {
          e.preventDefault(); 
          $(this).closest('tr').remove();

          $.ajax({
            type: "POST",
            url: "getCourse.php",
            data: {
              removeBtn: $(this).attr('id'),
              // courseId: $("#courseId").val(),
              submit: "submit",
            },
            success: function(response){
              alert(response);
              // $("#result").html(response);
            },
            error: function(){
              alert("I couldn't do your operation!");
            },
          }); 
        });

        // $(".btnDelete").click(function(){
        //   alert("hi");

        //   $.ajax({
        //     type: "POST",
        //     url: "getCourse.php",
        //     data: {
        //       removeBtn: $(this).attr('id'),
        //       // courseId: $("#courseId").val(),
        //       submit: "submit",
        //     },
        //     success: function(response){
        //       alert(response);
        //       // $("#result").html(response);
        //     },
        //     error: function(){
        //       alert("I couldn't do your operation!");
        //     },
        //   }); 
        // }
      });

    </script>
  </body>
  </html>


  <!-- // $(".btnDelete").click(function(){

  //   $.ajax({
  //     type: "POST",
  //     url: "getCourse.php",
  //     data: {
  //       removeBtn: $(this).attr('class'),
  //       // courseId: $("#courseId").val(),
  //       submit: "submit",
  //     },
  //     success: function(response){
  //       alert(response);
  //       // $("#result").html(response);
  //     },
  //     error: function(){
  //       alert("I couldn't do your operation!");
  //     },
  //   }); 
  // } -->
  
  <!-- //whenever this button is clicked, I have to check the remaining part

  // $(".courseId").on('input', function () {
  //   console.log( $(this).val() );
  // })
  // $(".courseId").each(function() {
  //     id.push($(this).val());
  // });

  // $.ajax({
  //   type: "POST",
  //   url: "getCourse.php",
  //   data: {
  //     // courseId: $("#courseId").val(),
  //     submit: "submit",
  //   },
  //   success: function(response){
  //     $("#result").html(response);
  //   },
  //   error: function(){
  //     alert("I couldn't do your operation!");
  //   },
  // }); 