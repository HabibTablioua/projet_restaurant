<?php
    //session_start();  

    //$_SESSION['id_waiter'] = '<script>id_w</script>';
    //header('Location:profilewaiter.php');
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/img/12COOL.jpg" rel="icon">
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="assets/css/style_login.css" />
    <style>
      .lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #fff;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}
      .error{
        color: red;
      }
      .logo img {
        width: 230px; 
        margin-left: 15px;
      }
      .heading h2 {
          font-size: 2.1rem;
          font-weight: 600;
          margin-top: -30px;
          color: #151111;
      }
      main {
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
        /* background-color: #ff8c6b; */
        background-color: #0c0b09; 
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .error {
        background: #F2DEDE;
        color: #A94442;
        padding: 10px;
        width: 95%;
        border-radius: 5px;
        margin: 20px auto;
      }
      .success {
        background: #D4EDDA;
        color: #40754C;
        padding: 10px;
        width: 95%;
        border-radius: 5px;
        margin: 20px auto;
      }
      @media only screen and (max-width: 800px) {
        .logo img {
          margin-left: 55px;
        }
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  </head>
  <body>
    <main>

      <form action="waiterqr.php" method="POST" style="display: none;">
          <input type="text" name="username" id="username">
      </form>

      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <!-- -------------------- -->
            <!-- -------------------- -->
            <form id="frmlogin" autocomplete="off" class="sign-in-form">
              <a href="homep.html">
              <div class="logo">
                <img class="ha" href="homep.html" src="assets/img/logo.png" alt="easyclass" />
              </div>
              </a>
              <div class="heading">
                <p id="txter"></p>
              </div>
              <div class="actual-form" style="margin-top: -45%;">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="name"
                    required
                  />
                  <label>Username</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="password"
                    required
                  />
                  <label>Password</label>
                </div>
                <input type="submit"  value="Login" name="submit" class="sign-btn" />
                <input type="button"  value="Login With QRCode" id="btn_codeqr" class="sign-btn" />

                <div style="display: flex;justify-content: center;align-items: center;">
                <h6 style="margin-top: 2px;">Not registred yet ?</h6>&nbsp;
                <a href="#" class="toggle">Sign up</a>
                </div>
                <br>
               <!-- <p class="text">
                  Forgotten your password or you login datails?
                  <a href="#" class="toggle">Get help</a> signing in
                </p>-->
              </div>
            </form>
           <!--------------- -->
            <form id="frmsignup" autocomplete="off" class="sign-up-form">
              <div class="heading">
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>
              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="nom"
                    required
                  />
                  <label>First name</label>
                </div>
                <div class="input-wrap">
                  <input
                    type="text"
                    class="input-field"
                    autocomplete="off"
                    name="prenom"
                    required
                  />
                  <label>Last name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>
                <!-- ------------- -->
                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="pass"
                    required
                  />
                  <label>Password</label>
                </div>
                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="Cpass"
                    required
                  />
                  <label>Confirm password</label>
                </div>
                <input type="submit" id="btnreg" name="signe_up" value="Sign Up" class="sign-btn" />
                
                <!-- <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p> -->
              </div>
            </form>
          </div>
        
          
          <div class="carousel">
            <div class="images-wrapper">
              <img src="assets/img/kotobia.jpg" class="image img-1 show" alt="" />
            </div>
          </div>

        </div>
      </div>
    </main>

    <div id="my-modalt" class="modalTwo">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>QR Code Scanner</h2>
                </div>
                <div class="modal-body">
                    <video id="preview" width="100%"></video>
                </div>
            </div>
    </div>

    <!-- Javascript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--<script src="assets/js/instascan.min.js"></script>-->
    <script>
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
      Instascan.Camera.getCameras().then(function(cameras){
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan', function (content) {
        document.getElementById('username').value = content;
        document.forms[0].submit();
        //alert("Waiter : " + id_w);
      });

      $('.close').click(function(){
        $('#my-modalt').css("display", "none");
      });
      $('#btn_codeqr').click(function(){
        $(".modalTwo").css("display", "block");
      });


//login
      $(document).on('submit', '#frmlogin',function (e){
            e.preventDefault(); 
           //alert("here");
            var formData = new FormData(this);
            formData.append("frmlogin", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 8){
                      //alert(res.message);
                      location.href = "home.php";
                    }else if(res.status == 7){
                      //alert(res.message);
                      location.href = "dashadmin.php";
                    }else if(res.status == 9){
                      //alert(res.message);
                      location.href = "profilewaiter.php";
                    }else if(res.status == 10){
                      //var paragraph = document.getElementById("txter");
                      //paragraph.textContent += res.message;
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message,
                        confirmButtonColor: '#151111'
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                    }
                }
            });
        });


      //register
      $(document).on('submit', '#frmsignup',function (e){
            e.preventDefault(); 
           // var spinner = '<div class="lds-ripple"><div></div><div></div></div>';
            //$('#btnreg').html(spinner);
           //alert("here");
            var formData = new FormData(this);
            formData.append("frmsignup", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 11){
                     //msg
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })

                      Toast.fire({
                        icon: 'success',
                        title: res.message
                      })
                      setTimeout(goToProfile, 3000);
                      function goToProfile(){
                        window.location.href = "http://localhost/projetff/Restaurantly/confirmreg.php";
                      }

                      //end msg
                      //alert(res.message);
                    }else if(res.status == 12){

                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message,
                        confirmButtonColor: '#151111'
                        //footer: '<a href="">Why do I have this issue?</a>'
                      })
                     // alert(res.message);
                    }
                }
            });
        });
    </script>
 
  </body>
</html>
