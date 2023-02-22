<?php
@include 'config.php';
session_start();


require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['frmtab'])){

    $id_user = $_SESSION["userid"];

    $purpose = mysqli_real_escape_string($conn, $_POST['purp']); 
    $Heure=mysqli_real_escape_string($conn, $_POST['Hour']);
    $Minute=mysqli_real_escape_string($conn, $_POST['minute']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone= mysqli_real_escape_string($conn,$_POST['phone']);
    $date= mysqli_real_escape_string($conn,$_POST['date']);
    $dateToday=date("Y-m-d");
    $nbp= mysqli_real_escape_string($conn,$_POST['people']);
    $id_location= $_SESSION['vradio'];
    $fidem = mysqli_query($conn, "SELECT code_locationT FROM locationt where nom_LocationT = '$id_location'");
    $emplt = mysqli_fetch_assoc($fidem);
    $emp = $emplt['code_locationT'];
    
    $cart_q = mysqli_query($conn, "SELECT * from `reservationt` where id_user = $id_user and date_res = '$date'");
    $loc_t = mysqli_query($conn, "SELECT count(*) as 'nbtb' from table_res where code_locationT = $emp");
    $contf = mysqli_fetch_array($loc_t);
    $conts = $contf['nbtb'];
    $der = mysqli_query($conn, "SELECT count(*) as 'nbss' from `reservationt` where code_locationT = $emp AND Heure = '$Heure' AND date_res = '$date'");
    $contz = mysqli_fetch_array($der);
    $conty = $contz['nbss'];
    if(mysqli_num_rows($cart_q) > 0){
        $res = [
            'status' => 22,
            'message' => 'Erreur deja reserver !!'
        ];
        echo json_encode($res);
        return false;
    }
    elseif($conts == $conty){
        $res = [
            'status' => 22,
            'message' => 'Changer l heure de reservation !!'
        ];
        echo json_encode($res);
        return false;
    }else
    {
        $idtab = mysqli_query($conn, "SELECT id_table from table_res where code_locationT = $emp AND purpose = '$purpose'");
        if(mysqli_num_rows($idtab) > 0){
            $idt = mysqli_fetch_assoc($idtab);
            $tab = $idt['id_table'];
            $addLiv = mysqli_query($conn, "INSERT INTO `reservationt`( `date_res`, `nb_personne`, `id_user`, `code_locationT`,`id_table`,`Heure`,`Minute`,`condition_res`) VALUES ('$date',$nbp,$id_user,$emp,$tab,'$Heure','$Minute','show')");
            if($addLiv){
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
                <p>Votre reservation a bien été prise en compte .</p><br>
                <p>Table : Tab".$tab."</p>
                <p>----------</p>
                <p>Merci d'avoir réservez a notre <b> Restaurant 12COOL</b>.</p>
            </div>";
            $mail->addAddress($email);
            $mail->send();
            $mail->smtpClose();
                $res = [
                    'status' => 11,
                    'message' => 'You will receive email to confirme reservation'
                ];
                echo json_encode($res);
                return false;
                //header('Location:historiqueclient.php');
            }
        }
        else
        {
            $res = [
                'status' => 22,
                'message' => 'There is no table availble for '.$purpose
            ];
            echo json_encode($res);
            return false;
        }
    }
}
?>