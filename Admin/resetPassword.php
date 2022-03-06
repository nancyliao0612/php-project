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
        $uName = $_POST["uName"];
        $uSurname = $_POST["uSurname"];
        $uPass1 = $_POST["uPassword"];
        $uPass2 = $_POST["uPassword2"];

        // check the passwards are match or not
        if($uPass1 != $uPass2)
        {
          echo "Passwords are not matching!";
        }else
        {
          //connect to my database
            $db = new mysqli("127.0.0.1","root","","RMS");
            // insert the info that users inputed to the database
            $proResult = $db -> query("UPDATE Professor SET proPassword = '$uPass1' WHERE proName = '$uName' and proSurname = '$uSurname'");

            $stuResult = $db -> query("UPDATE Student SET stuPassword = '$uPass1' WHERE stuName = '$uName' and stuSurname = '$uSurname'");

            $admResult = $db -> query("UPDATE Administrator SET admPassword = '$uPass1' WHERE admName = '$uName' and admSurname = '$uSurname'");

            if($proResult == true || $stuResult == true || $admResult == true) // if the result is true
            {
              echo "<p class='success-msg'>Your user password with the name <span class='highlight'>$uName</span> is reseted. The user may login right now</p>";
            } else
            {
              echo "<p class='warning-msg'>something is wrong. Please try again</p>";
            }
        }
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
        <h1>Reset Password</h1>
        <form action="resetPassword.php" method="post">
          <label>Name: </label>
          <input type="text" name="uName"><br/>
          <label>Surname: </label>
          <input type="text" name="uSurname"><br/>
          <label>New Password: </label>
          <input type="password" name="uPassword"><br/>
          <label>New Password(Again): </label>
          <input type="password" name="uPassword2"><br/>
          <input type="submit" name="submit" value="RESET" class="submit-btn"><br/>
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
