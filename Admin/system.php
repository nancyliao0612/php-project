<?php
  session_start();
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
  </head>
  <body>
    <?php
      if(isset($_POST["submit"])) // if the submit is clicked
      {
        $minPwd = $_POST["minPwd"];
        $maxPwd = $_POST["maxPwd"];
        $maxStuCourse = $_POST["maxStuCourse"];
        $maxProfCourse = $_POST["maxProfCourse"];
        
        //connect to my database
        $db = new mysqli("127.0.0.1","root","","RMS");
        // insert the info that users inputed to the database
        $result = $db -> query("INSERT INTO SystemManage (minPwd, maxPwd, maxStuCourse, maxProfCourse) VALUES('$minPwd','$maxPwd','$maxStuCourse', '$maxProfCourse')"); //string
        
        $_SESSION["minPwd"] = $minPwd;
        $_SESSION["maxPwd"] = $maxPwd;
        $_SESSION["maxStuCourse"] = $maxStuCourse;
        $_SESSION["maxProfCourse"] = $maxProfCourse;

        echo "<p class='success-msg'>You successfully set these system parameters!</p>";
      }
    ?>
    <div id="top">
      <h1>Registration Management System</h1>
      <?php
        echo "<p>👋 Hi Administrator " .  $_SESSION['uname'] .  "</p>";
      ?>    
    </div>
    <div class="wrapper">
      <?php
        include "menu2.php";
      ?>
      <div id="main">
        <h1>Management of System Parameters</h1>
        <form action="system.php" method="post">
          <label>Minimum Password: </label>
          <input type="text" name="minPwd"><br/>
          <label>Maximum Password: </label>
          <input type="text" name="maxPwd"><br/>
          <label>Maximum Student Course: </label>
          <input type="text" name="maxStuCourse"><br/>
          <label>Maximum Professor Course: </label>
          <input type="text" name="maxProfCourse"><br/>
          <input type="submit" name="submit" value="REGISTER" class="submit-btn"><br/>
        </form>
      </div>
      <div id="ann">
        <h3>Announcements</h3>
        <p><a href="../logout.php" target="_blank">Logout</a></p>
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
