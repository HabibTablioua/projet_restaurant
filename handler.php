<?php 

/*require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->SMTPDebug = 0;
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'resto12cool@gmail.com';
$mail->Password = '12COO@Lresto';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('resto12cool@gmail.com','Admin 12COOL Restaurant');
$mail->addAddress($_POST['emailwaiter']);
$mail->addReplyTo('resto12cool@gmail.com','Admin 12COOL Restaurant');
$mail->isHTML(true);
$mail->Subject='Your Qr Code';
$image = $_POST['qrmessage'];
$mail->Body= 'This is your QR code.';

$mail->addEmbeddedImage($image, "my-attach", "some_picture.png");

//$mail->addEmbeddedImage($_POST['qrmessage'], 'qrmessage');
if(!$mail->send()){
    echo $res = "Erreur !!";
}
else{
    echo $res = "Qr send succesfully .";
}*/

?>