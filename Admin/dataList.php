<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MIS 233｜Project2</title>
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
        <h2>Show Lists</h2>
        <?php
          $db = new mysqli("127.0.0.1","root","","RMS");
          $result = $db -> query("SELECT * FROM Administrator");
          $proResult = $db -> query("SELECT * FROM Professor");
          $stuResult = $db -> query("SELECT * FROM Student");
          $courseResult = $db -> query("SELECT * FROM Course");
        ?>
        <form action="dataList.php" method="post">
          <select id="userList" name="chooseList">
            <option selected>choose</option>
            <option>Administrators</option>
            <option>Professors</option>
            <option>Students</option>
            <option>Courses</option>
          </select>
          <input type="submit" name="submit" value="SUBMIT" class="submit-table">
          <br>
          <br>
        </form>
        <?php
          if(isset($_POST["submit"])){
            $select_value=$_POST["chooseList"];
            if($select_value == "Administrators"){
              echo "<table>";
              echo "<thead><tr><th>ID</th><th>Name</th><th>Surname</th><th>Password</th></tr></thead>"; 
              while($row = $result -> fetch_row()){
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
              }
              echo "</table>";
            }else if($select_value == "Professors"){
              echo "<table border=1>";
              echo "<thead><tr><th>ID</th><th>Name</th><th>Surname</th><th>Password</th></tr></thead>"; 
              while($row = $proResult -> fetch_row()){
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>";
              }
              echo "</table>";
            }else if($select_value == "Students"){
              echo "<table border=1>";
              echo "<thead><tr><th>ID</th><th>Name</th><th>Surname</th><th>Password</th></tr></thead>"; 
              while($row = $stuResult -> fetch_row()){
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>";
              }
              echo "</table>";
            }else{
              echo "<table border=1>";
              echo "<thead><tr><th>ID</th><th>Course Name</th><th>Intro</th><th>Quota</th><th>Credit</th><th>Consent</th><th>Professor</th></tr></thead>"; 
              while($row = $courseResult -> fetch_row()){
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td>";
              }
              echo "</table>";
            }
          }
        ?>
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
