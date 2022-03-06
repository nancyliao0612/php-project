<?php
session_start();
session_destroy();
header("Location: index.php"); //navigate the user to index.php when the user log out.

?>