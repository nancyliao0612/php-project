<?php
  session_start(); // for being able to use session variable
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MIS 233｜Lab2</title>
    <!-- CSS Style -->
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
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
      // check if the submit button is clicked or not
      if(isset($_POST["submit"]))
      {
        $uname = $_POST["uname"];
        $upass = $_POST["upass"];

        // check the name & passward from the database 
        // when the submit button is clicked, just conncects to databese 連結資料庫
        $db = new mysqli("127.0.0.1","root","","RMS");

        $result = $db -> query("SELECT * FROM Administrator WHERE admName = '$uname' and admPassword = '$upass'");

        $stuResult = $db -> query("SELECT * FROM Student WHERE stuName = '$uname' and stuPassword = '$upass'");

        $proResult = $db -> query("SELECT * FROM Professor WHERE proName = '$uname' and proPassword = '$upass' and activeStatus = 'Active'");

        if($result -> num_rows != 0){
          $_SESSION["uname"] = $uname;
          header("Location: Admin/administrator.php");
        }else if($stuResult -> num_rows != 0){
          $_SESSION["uname"] = $uname;
          header("Location: Students/students.php");
        }else if($proResult -> num_rows != 0){
          $_SESSION["uname"] = $uname;
          header("Location: Professors/professors.php");
        }else{
          echo "<p class='warning-msg'>Username or password is wrong!!</p>";
        }
        
      }
    ?>
    <div id="top">
      <h1>Registration Management System</h1>
    </div>
    <div class="wrapper">
      <?php
        include "menu.php";
      ?>
      <div id="main">
        <h1>Home Page</h1>
      </div>
      <div id="ann">
        <h3>Announcements</h3>
        <p><a href="login.php" target="_blank">Login</a></p>
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
