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
        echo "<p>👋 Hi Professor " .  $_SESSION['uname'] .  "</p>";
      ?>
    </div>
    <div class="wrapper">
      <?php
        include "proMenu.php";
      ?>
      <div id="main">
        <h1>Professors Page</h1>
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
