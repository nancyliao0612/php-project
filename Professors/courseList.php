<?php
  session_start();
  // session_destroy();
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
      <p>User Type: Students</p>
    </div>
    <div class="wrapper">
      <?php
        include "proMenu.php";
      ?>
      <div id="main">
  
        <?php
          $uName = $_SESSION["uname"];
          echo "<h2>Hi $uName, this is your course list</h2>";
        ?>
        <?php
        // array name: $_SESSION['courseId']

        $db = new mysqli("127.0.0.1","root","","RMS");
        // $nameInsert = $db -> query("INSERT INTO storeCourse (stuName) VALUES ('$uName')");
                  
        echo "<table border=1 id='course-table'>";
        echo "<thead><tr><th>ID</th><th>Course Name</th><th>Intro</th><th>Quota</th><th>Credit</th><th>Consent</th><th>Professor</th><th>Enrolled Students</th></tr></thead>";

        $result = $db -> query("SELECT Course.courseId, Course.courseName, Course.courseIntro, Course.courseQuota, Course.courseCredit, Course.courseConsent, Course.courseProfessor, Professor.proName FROM Course JOIN Professor ON Course.courseProfessor = Professor.proName");

        
        while($row = $result -> fetch_row()){
          echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td class='highlight-cell'>";      
        }
        
        $_SESSION["grabStudent"]= $row[0];
        
        for($i=0; $i<6; $i++){        
          $result = $db -> query("SELECT Course.courseId, Course.courseProfessor, storeCourse.courseId$i, storeCourse.stuName FROM Course JOIN storeCourse ON Course.courseId = storeCourse.courseId$i and Course.courseProfessor = '$uName'");
          
          while($row = $result -> fetch_assoc()){
            echo $row["stuName"] . ",<br>" ;
          } 
        }
        echo "</td></tr></table>";

          
        ?>
      </div>
      <div id="ann">
        <h3>Announcements</h3>
        <p><a href="login.php" target="_blank">Login</a></p>
        <p><a href="register.php" target="_blank">Register</a></p>
      </div>
    </div>
    <div id="bottom">
      <table id="category">
        <tr>
          <td class="cellitem">
            &nbsp;&nbsp;&nbsp;&nbsp; Company&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td class="cellitem">&nbsp;&nbsp;About&nbsp;&nbsp;</td>
          <td class="cellitem">&nbsp;&nbsp;Mission&nbsp;&nbsp;</td>
          <td class="cellitem">&nbsp;&nbsp;Comment&nbsp;&nbsp;</td>
        </tr>
      </table>
      <p>MIS 233.01 - Web Based Application Programming</p>
    </div>
  </body>
  </html>

