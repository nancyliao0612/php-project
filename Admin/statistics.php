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
        <h1>Statistics Page</h1>
        <span>Number of deactive professors: </span>
        <?php
          $db = new mysqli("127.0.0.1","root","","RMS");
          // count how many professors are deactived
          $result = $db -> query("SELECT COUNT(*) FROM Professor WHERE activeStatus = 'Deactive'");
          $row = $result -> fetch_row();
          $numProDeactive = $row[0]; 
          // echo $numDeactive;
          $_SESSION["numProDeactive"] = $numProDeactive;

          // count how many professors are actived
          $result = $db -> query("SELECT COUNT(*) FROM Professor WHERE activeStatus = 'Active'");
          $row = $result -> fetch_row();
          $numProActive = $row[0]; 
          // echo $numActive;
          $_SESSION["numProActive"] = $numProActive;

          echo "</span>" . "<span class='highlight'>" . $_SESSION['numProDeactive'] . "</span>" . "<br>"
        ?> 
        <?php
          echo "<br><span>Number of active professors: </span>" . "<span class='highlight'>" . $_SESSION['numProActive'] . "</span>" . "<br>";
        ?>
        <?php
          // count how many students are deactived
          $result = $db -> query("SELECT COUNT(*) FROM Student WHERE activeStatus = 'Deactive'");
          $row = $result -> fetch_row();
          $numStuDeactive = $row[0]; 
          // echo $numDeactive;
          $_SESSION["numStuDeactive"] = $numStuDeactive;

          // count how many students are actived
          $result = $db -> query("SELECT COUNT(*) FROM Student WHERE activeStatus = 'Active'");
          $row = $result -> fetch_row();
          $numStuActive = $row[0]; 
          // echo $numActive;
          $_SESSION["numStuActive"] = $numStuActive;
        ?>
        <?php
          echo "<br><span>Number of active students: </span>" . "<span class='highlight'>" . $_SESSION['numStuDeactive'] . "</span>" . "<br>";
        ?>        
        <?php
          echo "<br><span>Number of active students: </span>" . "<span class='highlight'>" . $_SESSION['numStuActive'] . "</span>" . "<br>";
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
