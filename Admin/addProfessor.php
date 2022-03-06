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
      //connect to my database
      $db = new mysqli("127.0.0.1","root","","RMS");

      if(isset($_POST["submit"])) // if the submit is clicked
      {
        $uname = $_POST["proName"];
        $usurname = $_POST["proSurname"];
        $upass1 = $_POST["proPassword"];
        $upass2 = $_POST["proPassword2"];

        // check the passwards are match or not
        if($upass1 != $upass2)
        {
          echo "<div class='warning-msg'>Passwords don't match!</div>";
        }else
        {
          // select the last row of system parameters that administrators entered
          $result = $db -> query("SELECT * FROM SystemManage ORDER BY parametersId DESC LIMIT 1");
          // Check if password is greater than or equals $row["minPwd"], and less than or equals $row["maxPwd"]
          if($result -> num_rows != 0){
            while($row = $result -> fetch_assoc()){
              if(($row["minPwd"] <= strlen($upass1)) && (strlen($upass1) <= $row["maxPwd"]))
              {
                // insert the info that administrators inputed to the database
                $stuResult = $db -> query("INSERT INTO Professor (proName, proSurname, proPassword) VALUES('$uname','$usurname','$upass1')"); 
                
                echo "<div class='success-msg'>Professor with the name <span class='highlight'>$uname</span> is created.</div>";
              } else{
                echo "<div class='warning-msg'>Check your password length again!</div>";
              }
            }
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
        <h2>Define a New Professor</h2>
        <form action="addProfessor.php" method="post">
          <label>Professor Name: </label>
          <input type="text" name="proName"><br/>
          <label>Professor Surname: </label>
          <input type="text" name="proSurname"><br/>
          <label>Professor Password: </label>
          <input type="password" name="proPassword"><br/>
          <?php
              $result = $db -> query("SELECT * FROM SystemManage ORDER BY parametersId DESC LIMIT 1");

              if($result -> num_rows != 0){
                while($row = $result -> fetch_row()){
                  echo "<span class='warning-msg'>Reminder: password length must between " . $row[1] . " and " . $row[2] . "</span><br>";
                  echo "<br>";            
                };
              };
          ?>
          <label>Professor Password(Again): </label>
          <input type="password" name="proPassword2"><br/>
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
