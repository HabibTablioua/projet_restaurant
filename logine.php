<?php 
 @include 'config.php';
 session_start();
if (isset($_POST['submit'])) {
      $username = $conn->real_escape_string($_POST['name']);
      $pass = $conn->real_escape_string($_POST['password']);
      $sql =" SELECT * From user WHERE nom='$username' AND password='$pass'";
      $res= mysqli_query($conn ,$sql);
      $row = mysqli_fetch_array($res);  
     if(is_array($row)){
       if($row['role']=='admin'){
          $_SESSION['username'] =$username;
          $_SESSION['pass'] = $pass;
          $_SESSION['logi'] =true;
          header('Location:dashadmin.php');
        }
        else if($row['role']=='client')
        {
          $sqltwo = "SELECT id FROM user WHERE nom='$username' AND password='$pass'";
          $_SESSION['username'] =$username;
          $_SESSION["userid"] = trim($row["id"]);
          $_SESSION['pass'] = $pass;
          $_SESSION['logi'] =true;
          header('Location:home.php');
        }  
        else if($row['role']=='waiter'){
          $sqltwo = "SELECT id FROM user WHERE nom='$username' AND password='$pass'";
          $_SESSION['name'] =$username;
          $_SESSION['id_waiter'] = trim($row["id"]);
          $_SESSION['lname'] = $row['prenom'];
          $_SESSION['pass'] = $pass;
          $_SESSION['logi'] =true;
          header('Location:profilewaiter.php');
        }
      }
      else{
        header('Location:index.php');
        $_POST['name']="";
        $pass ="";
      }
    }
   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  