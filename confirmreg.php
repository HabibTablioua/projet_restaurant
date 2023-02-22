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
      .error{
        color: red;
      }
      .logo img {
        width: 230px; 
        margin-left: auto
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
            <form id="frmconf" autocomplete="off" class="sign-in-form">
              <a href="homep.html">
              <div class="logo">
                <img class="ha" href="homep.html" src="assets/img/logo.png" alt="easyclass" />
              </div>
              </a>
              <div class="actual-form" style="margin-top: -40%;">
               <!-- <input type="hidden" value="">-->
               <h4>Check your mail, </h4><br><!--You will receive a confirmation email -->
                <div class="input-wrap">
                <input
                    type="number"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="keyverf"
                    required
                  />
                  <label>Key </label>
                </div>

                <input type="submit"  value="Confirm" name="submit" class="sign-btn" />
                <div style="display: flex;justify-content: center;align-items: center;">
                </div>
                <br>
              </div>
            </form>
           
           <!--------------- -->
            <form autocomplete="off" class="sign-up-form">
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
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="adresse"
                    required
                  />
                  <label>Adresse</label>
                </div>
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="telephone"
                    required
                  />
                  <label>Phone number</label>
                </div>
                <input type="submit" name="signe_up" value="Sign Up" class="sign-btn" />
                
                <!-- <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p> -->
              </div>
            </form>
          </div>
        <!--  <form id="frmconfc" class="sign-up-form" style="display: none;">
            <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="number"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    name="keyverf"
                    required
                  />
                  <label>Key </label>
                </div>
            <input type="submit" name="subkey" value="Confirm" class="sign-btn">
          </form>-->

          <div class="carousel">
            <div class="images-wrapper">
              <img src="assets/img/kotobia.jpg" class="image img-1 show" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>



    <!-- Javascript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--<script src="assets/js/instascan.min.js"></script>-->
    <script>
      $(document).on('submit', '#frmconf',function (e){
            e.preventDefault(); 
           //alert("here");
            var formData = new FormData(this);
            formData.append("frmconf", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 30){
                      //alert(res.message);
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
                       // window.location.href = "http://localhost/projetff/Restaurantly/profilewaiter.php";
                        window.location.href = "http://localhost/projetff/Restaurantly/home.php";
                      }
                      
                    }else if(res.status == 40){
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
    </script>
 
  </body>
</html>
