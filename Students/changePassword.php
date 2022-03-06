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
    <?php
    //connect to my database
    $db = new mysqli("127.0.0.1","root","","RMS");

    if(isset($_POST["submit"])) // if the submit is clicked
    {
        $uname = $_SESSION["uname"];
        $uPass1 = $_POST["uPassword"];
        $uPass2 = $_POST["uPassword2"];

        // check the passwards are match or not
        if($uPass1 != $uPass2)
        {
          echo "<p class='warning-msg'>Passwords don't match!</p>";
        }else
        {
          // select the last row of system parameters that administrators entered
          $result = $db -> query("SELECT * FROM SystemManage ORDER BY parametersId DESC LIMIT 1");
          // Check if passwords have a minimum of $_SESSION["minPwd"] characters, and a maxinum of $_SESSION["maxPwd"] characters
          if($result -> num_rows != 0){
            while($row = $result -> fetch_assoc()){
              if(($row["minPwd"] <= strlen($uPass1)) && (strlen($uPass1) <= $row["maxPwd"]))
              {
                // insert the new passowrd that users inputed to the database
                $stuResult = $db -> query("UPDATE Student SET stuPassword = '$uPass1' WHERE stuName = '$uname'");
                echo "<p class='success-msg'>Your new password with the name <span class='highlight'>$uname</span> is reseted. You may login next time with the new password</p>";
              } else
              {
                echo "<p class='warning-msg'>Check your password length again!</p>";
              }
            }
          }
        }
      }
    ?>
    <div id="top">
      <h1>Registration Management System</h1>
      <?php
        echo "<p>👋 Hi Student <span class='name-highlight'>" .  $_SESSION['uname'] .  "</span></p>";
      ?>
    </div>
    <div class="wrapper">
      <?php
        include "stuMenu.php";
      ?>
      <div id="main">
        <h2>Change Password</h2>
        <?php
            $result = $db -> query("SELECT * FROM SystemManage ORDER BY parametersId DESC LIMIT 1");

            if($result -> num_rows != 0){
              while($row = $result -> fetch_row()){
                echo "<span class='warning-msg'>Reminder: password length must between " . $row[1] . " and " . $row[2] . "</span><br>";
                echo "<br>";            
              }
            }
        ?>
        <form action="changePassword.php" method="post">
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