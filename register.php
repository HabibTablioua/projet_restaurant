<?php
  session_start(); 
  include_once 'cnx.php';
  include('phpqrcode/qrlib.php');

  if (isset($_POST['signe_up'])) {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; 
      }
     $username = test_input($_POST['nom']);
     $prenom =test_input($_POST['prenom']);
     $email = test_input($_POST['email']);
     $pass = test_input(($_POST['pass']));
     $com_pass= test_input(($_POST['Cpass']));
     //$adresse=test_input(($_POST['adresse']));
     //$telephone=test_input(($_POST['telephone']));
     $role='client';
     $user_data = 'username='.  $username;
     if (empty($username)) {
		header("Location:index.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location:index.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($com_pass)){
        header("Location:index.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($email)){
        header("Location:index.php?error=email is required&$user_data");
	    exit();
	}

	else if($pass !== $com_pass){
        header("Location:index.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}
  else if(empty($prenom)){
    header("Location:index.php?error=First name is required&$user_data");
    exit();
  }
    else{
        $sql = "SELECT * From user Where nom='$username' and  email='$email' ";
        $res= mysqli_query($conn ,$sql);
        if(mysqli_num_rows($res)==1){
            header("Location:index.php?error=The username is taken try another&$user_data");
	          exit();
        } 
          else{
            $path = 'qrcode/';
            $file = $path.uniqid().".png";
            $ecc = 'L';
            $pixel_Size = 20;
            $frame_Size = 10;
            //$getmid = mysqli_query($conn, "SELECT MAX(id) as maxid FROM `user`");
            //$maxid = mysqli_fetch_assoc($getmid);
            //$id = $maxid['maxid'] + 1;

          $query ="INSERT INTO user(nom,prenom,email,password,role,qrImage)VALUES ('$username','$prenom','$email','$pass','$role','$file')";
          $Resultat= mysqli_query($conn ,$query);
          if($Resultat){
            $qur = mysqli_query($conn, "SELECT id FROM user WHERE nom = '$username' And prenom = '$prenom'");
            $idu = mysqli_fetch_assoc($qur);
            $id = $idu['id'];
            $lfnameid = $id.$prenom.$username;
            QRcode::png($lfnameid,$file,$ecc,$pixel_Size,$frame_Size);
            header("Location:index.php?success=Your account has been created successfully");
            exit();
          }else{
            header("Location:index.php?error=unknown error occurred&$user_data");
            exit();
          }
        }
    }
}else{
	header("Location:index.php");
	exit();
}
  ?>