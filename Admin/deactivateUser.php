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
    <!-- JQuery CDN Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <h2>Deactivate User</h2>
        <?php
          echo "<section>";
          echo "<div>";
          echo "<span class='deactivate-type'>Deactivate Professor</span><br>"
        ?>
        <?php
          //connect to my database
          $db = new mysqli("127.0.0.1","root","","RMS");

          $proResult = $db -> query("SELECT * FROM Professor WHERE activeStatus = 'Active'");

          if($proResult -> num_rows != 0){
            echo "<br>";
            echo "<table border=1>";
            echo "<thead><tr><th>Name & Surname</th><th>Active Status</th></tr></thead>"; 
            while($row = $proResult -> fetch_row()){
              echo "<tr><td>$row[1] $row[2]</td><td><button id=$row[1] class='submit-table deactPro'>Deactivate</button></td></tr>";
            }
            echo "</table>";
            echo "<br>";
          }else{
            echo "<br>";
            echo "There isn't a value coming from your query.";
            echo "<br><br>";
          }
          echo "</div>";
        ?>
        <?php
          echo "<div>";
          echo "<span class='deactivate-type'>Deactivate Student</span><br>"
        ?>
        <?php
          $stuResult = $db -> query("SELECT * FROM Student WHERE activeStatus = 'active'");
          echo "<br>";
          if($stuResult -> num_rows != 0){
            echo "<table border=1>";
            echo "<thead><tr><th>Name & Surname</th><th>Active Status</th></tr></thead>"; 
            while($row = $stuResult -> fetch_row()){
              echo "<tr><td>$row[1] $row[2]</td><td><button id=$row[1] class='submit-table deactStudent'>Deactivate</button></td></tr>";
            }
            echo "</table>";
            echo "</div>";
            echo "</section>";
          }else{
            echo "There isn't a value coming from your query.";
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
    <script type="text/javascript">
      $(document).ready(function () {
          // when deactivated professor button is clicked
          $(".deactPro").click(function(){ 
            $.ajax({
              type: "POST",
              url: "deactivatePro.php",
              data: {id: $(this).attr('id')}, 
              success: function(response){
                alert(response); 
              },
              error: function(){
                alert("I couldn't do your operation!");
              }
            });
          });
          // when deactivated student button is clicked
          $(".deactStudent").click(function(){ 
            $.ajax({
              type: "POST",
              url: "deactivateStu.php",
              data: {stuId: $(this).attr('id')}, 
              success: function(response){
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
