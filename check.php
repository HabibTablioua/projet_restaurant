<?php
@include 'config.php';
session_start();

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$id_user = $_SESSION["userid"];

    $name = mysqli_real_escape_string($conn,$_POST["Firstname"]." ".$_POST["Lastname"]);
    $prixtotal = $_POST['total'];
    $ncommande = $_POST['ncom'];
    $adress1 = $_POST['addres1'];
    $adress2 = $_POST['addres2'];
    $typedelivery = $_POST['tdelivery'];
    $typepayment = $_POST['payementt'];
    $user = $id_user;

    //get all meals from cart
    $cart_q = mysqli_query($conn, "SELECT * from `cart` where id = $user");
    if(mysqli_num_rows($cart_q) > 0){
        while($meal = mysqli_fetch_assoc($cart_q)){
            $meal_name[] = $meal['nom_cart'].' ('.$meal['quantity'].')';
        }
    }
    $totalmeals = implode(' , ',$meal_name);

    $addLiv = mysqli_query($conn, "INSERT INTO `order`( `address1`, `address2`, `total_price`, `typedelivery`, `payementmethod`,`meals_quan`, `id`,`condord`) VALUES ('$adress1','$adress2',$prixtotal,'$typedelivery','$typepayment','$totalmeals',$user,'show')");
    if($addLiv){
        $supp = mysqli_query($conn, "DELETE from cart where id = $user");
        //email
            $mail_user = $_POST['email'];

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "resto12cool@gmail.com";
            $mail->Password = "rfteblflzrxnhllo";
            $mail->Subject="Confirmation Order";
            $mail->setFrom("resto12cool@gmail.com");
            $mail->isHTML(true);
            $mail->Body="<div>
                <h3>Bonjour ".$name.",</h3>
                <p>Votre commande a bien été prise en compte sous le numéro ".$ncommande." .</p><br>
                <p>Meals :</p>
                <p>----------</p>
                <p>".$totalmeals."</p>
                <p>----------</p>
                <p>Total : <b>".$prixtotal." DH </b></p>
                <p>Réglement : ".$typepayment."</p>
                <p>Merci d'avoir commandé sur <b>12COOL Restaurant </b>.</p>
            </div>";
            $mail->addAddress($mail_user);
            if($mail->send()){
                header("Location:historiqueclient.php");
            }else{
                echo('Erreur send mail !!');
            }
            $mail->smtpClose();
    }
    else
    {
        header("Location:checkout.php");
    }
?>