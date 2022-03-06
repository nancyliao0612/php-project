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
        $cName = $_POST["courName"];
        $cPro = $_POST["courPro"];
        $cIntro = $_POST["courIntro"];
        $cQuota = $_POST["courQuota"];
        $cCredit = $_POST["courCredit"];
        $cConsent = $_POST["courConsent"];

        //connect to my database
        $db = new mysqli("127.0.0.1","root","","RMS");
        // insert the course info that users inputed to the database
        $result = $db -> query("INSERT INTO Course (courseName, courseIntro, courseQuota, courseCredit, courseConsent, courseProfessor) VALUES('$cName','$cIntro','$cQuota', '$cCredit', '$cConsent', '$cPro')"); //string
    
        if($result) // if the result is true
        {
          echo "<p class='success-msg'>Your course with the name <span class='highlight'>$cName</span> is created.</p>";
        } else
        {
          echo "<p class='warning-msg'>something is wrong. Please try again</p>";
        }
      
      }
    ?>
    <div id="top">
      <h1>Registration Management System</h1>
      <p>User Type: Administrators</p>
    </div>
    <div class="wrapper">
      <?php
        include "menu2.php";
      ?>
      <div id="main">
        <h2>Define a New Course</h2>
        <form action="addCourse.php" method="post">
          <label>Course Name: </label>
          <input type="text" name="courName"><br/>
          <label>Course Professor: </label>
          <input type="text" name="courPro"><br/>
          <label>Course Intro: </label>
          <textarea name="courIntro" cols="50" rows="6"></textarea><br/>
          <label>Course Quota: </label>
          <input type="text" name="courQuota"><br/>
          <label>Course Credit: </label>
          <input type="text" name="courCredit"><br/>
          <label>Course Consent: </label>
          <input type="radio" name="courConsent" value=1>Yes
          <input type="radio" name="courConsent" value=0>No<br/>
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
