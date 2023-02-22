<?php
@include 'config.php';
session_start(); 

if(isset($_POST['username'])){
    $text = $_POST['username'];
    echo $text;
    $req = "SELECT * from user where CONCAT(id,prenom,nom) = '$text'";
    $query = mysqli_query($conn, $req);
    $fetch_info = mysqli_fetch_assoc($query);
    $numr = mysqli_num_rows($query);
    if($numr == 1 && $fetch_info['role'] == 'waiter'){
        $_SESSION['id_waiter'] = $fetch_info['id'];
        $_SESSION['name'] = $fetch_info['nom'];
        $_SESSION['lname'] = $fetch_info['prenom'];
        header('Location:profilewaiter.php');
    }else if($numr == 1 && $fetch_info['role'] == 'client'){
        $_SESSION['username'] = $fetch_info['nom'];
        $_SESSION["userid"] = $fetch_info['id'];
        $_SESSION['pass'] = $fetch_info['password'];
        header('Location:home.php');
    }
    else{
        echo 'Erreur Login With QR code !!';
    }
}
?>