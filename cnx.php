<?php
    $server= 'localhost';
    $user = 'root';
    $pass ='';
    $db = 'cool_db';
    $conn = mysqli_connect($server, $user,$pass,$db);
    if (!$conn) {
        die("<script>alert('La connection echoué.')</script>");
      }
?> 