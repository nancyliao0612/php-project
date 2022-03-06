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
    <!-- JQuery CDN Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <div id="top">
      <h1>Registration Management System</h1>
      <?php
        $uname = $_SESSION['uname'];
        echo "<p>👋 Hi Professor " .  $uname .  "</p>";
      ?>    
    </div>
    <div class="wrapper">
      <?php
        include "./proMenu.php";
      ?>
      <div id="main">
        <h1>Consent</h1>
        <?php

          $db = new mysqli("127.0.0.1","root","","RMS");
          $result = $db -> query("SELECT * FROM Consent a, Course b WHERE a.courseId = b.courseId and b.courseProfessor = '$uname' and a.result = 0");
          $row = $result -> fetch_row();
          $getCourseId= $row[2];

          $result = $db -> query("SELECT * FROM Consent a, Student b WHERE a.stuName = b.stuName and a.result = 0 and a.courseId = '$getCourseId'");

          echo "<table border=1 id='course-table'>";
          echo "<thead><tr><th>Course ID</th><th>Consent Decision</th><th>Student Name</th></tr></thead>";
          
          while($row = $result -> fetch_assoc()){
            echo "<tr><td>" . $row["courseId"] . "</td><td><button class='sendConsent' id=a" . $row["consentId"] . ">Accept</button>";
            echo "&nbsp&nbsp<button class='sendConsent' id=r" . $row["courseId"] . ">Reject</button></td>";
            echo "<td>" . $row["stuName"] . "</td></tr>";
          }
          echo "</table>";  
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
    <script type="text/javascript">
      $(document).ready(function () {
          $("button[id^='a']").click(function(){ 
            $(this).closest('tr').remove();
            // button id is starting with a
            //whenever this button is clicked, I have to check the remaining part
            // send this id to php
            $.ajax({
              type: "POST",
              url: "acceptConsent.php",
              data: {id: $(this).attr('id')}, // this button's id - a1/a2/a3....
              success: function(response){
                alert(response); // echo "consent id accepted";
                // 如果接受了 consent request，就要把學生的 consent 要求移除
                // substr 的原因，因為我們要的是 1 而不是 s1
              },
              error: function(){
                alert("I couldn't do your operation!");
              }
            });       
          });

          $("button[id^='r']").click(function(){
            $(this).closest('tr').remove();
            //alert("Consent is rejected!");
            $.ajax({
              type: "POST",
              url: "rejectConsent.php",
              data: {rejId: $(this).attr('id')}, 
              success: function(response){
                alert("Consent is rejected!"); 
                alert(response);
              },
              error: function(){
                alert("I couldn't do your operation!");
              }
            });
          });
      });
    </script>
  </body>
</html>
