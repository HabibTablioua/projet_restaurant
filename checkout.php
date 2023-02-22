<?php 

@include 'config.php';
session_start();

$id_user = $_SESSION["userid"];
$name = $_SESSION['username'];
$shippingc = 15;


//Remplir les infos 
$select_info = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id_user'");
$fetch_info = mysqli_fetch_assoc($select_info);






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Checkout | 12COOL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/12COOL.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/checkout.css" rel="stylesheet">
  <style>
  .checkout-form form{
    padding: 2rem;
    border-radius: .5rem;
  }
  .checkout-form form .col{
    flex:1 1 40rem;
  }
  .checkout-form form .row .col span{
    font-size: 1.2rem;
    color: #cda45e;
    margin-left: 1rem;
  }
  .checkout-form form .row .col input{
    width: 100%;
    background-color: white;
    font-size: 1rem;
    color: black;
    border-radius: .3rem;
    margin: 0rem 0 1rem 0;
    padding: 0.5rem 1rem;
    text-transform: none;
  }
  .bon{
      background-color: #fff;
      color:#000;
      position: absolute;
      top: 9rem;left:25rem;
      z-index: 10000;
      border-radius: .5rem;
      text-align: center;
      padding: 0.6rem 1.2rem;
      margin: 0 auto;
      justify-content: space-between;
      gap: 1.5rem;
    }
    .bon h3{
      font-size: 1rem;
      /*margin-right: 45%;*/
      color: #000;
    }
    .bon h2{
      font-size: 1rem;
      margin-left: 30%;
      /*margin-top:-5.5%;*/
      color: #000;
    }
    #ligne{
      content: "";
      width: 500px;
      height: 4px;
      display: inline-block;
      background: #cda45e;
      margin: 4px 0px;
    }
    thead, tr{
      border: 2px solid;
      border-top: none;
      border-left: none;
      border-right: none;
      border-color:  #cda45e;
    }
    #lastch{
      border: 4px solid;
      border-top: 4px solid;
      border-left: none;
      border-right: none;
      border-color:  #cda45e;
    }
    @media print{
      body{
        visibility: hidden;
      }
      .bon, .bon *{
        visibility: visible;
      }
      .bon{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 5px dashed #cda45e;
      }
      .phonenb{
        padding-top: 35px;
      }
      .bon #printdoc{
        display:none;
      }
    }
  </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>+212696113957</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 10AM - 23PM</span></i>
      </div>

      <div class="languages d-none d-md-flex align-items-center">
        <ul>
          <!--<li>En</li>
          <li><a href="#">De</a></li>-->
        </ul>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="home.php" class="nav-brand"><img src="assets/img/12COOL0.jpg" height="50px" alt="" class=""></a>

      <nav id="navbar" class="navbar order-last order-lg-0" style="font-family: 'Poppins', sans-serif;">
        <ul>
          <li><a class="nav-link scrollto active" href="home.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="menu.php">Menu</a></li>
          <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
          <li><a class="nav-link scrollto" href="#events">Events</a></li>
          <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="dropdown"><a href="#"><span><?php  echo $name ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php"><div><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Profile</div></a></li>
              <li><a href="cart.php"><div><i class="bi bi-cart3"></i>&nbsp;&nbsp; Cart</div></a></li>
              <li><a href="logout.php"><div><i class="bi bi-door-closed"></i>&nbsp;&nbsp; Logout</div></a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" style="margin-right: -0.6rem;"></i>
      </nav><!-- navbar -->
      <?php 
      $select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'") or die('query failed');
      $row_cont = mysqli_num_rows($select_rows);
      ?>
      <a href="cart.php" id="Mycart" style="margin-left: 2rem;font-size: 1.1rem;color: #000;">
        <!--<img src="assets/img/shopping_basket_white_24dp.svg" style="width: 35px;" alt="">-->
        <b>Cart </b>
        <span style="padding:.1rem .5rem;border-radius: .5rem;background-color: #000;color:black;font-size: 1.1rem;"><b><?php echo $row_cont; ?></b></span>
      </a>
    </div>
  </header>
  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="filter: blur(5px);">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="container-xxl py-5 hero-header mb-5">
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <!-- main -->
 <div class="bon" data-aos="zoom-in" data-aos-delay="100">
    <img src="assets/img/logo_res.jpeg" style="margin-left: 5%;" height="80">
    <div style="display: flex;margin-top:3%;">
      <h3><b>N° Commande :</b> <label style="color: #cda45e;">CL<?php echo $numc = strval(rand(1,1000)); ?></label></h3>
      <h2><b>Date: <?php echo date("d-m-Y"); ?></b></h2>
    </div>    
    <h1 id="ligne"></h1>
    <table class="table">
      <thead>
        <tr>
          <th>Description</th>
          <th></th>
          <th></th>
          <th>QTY</th>
          <th>Price</th>
        </tr>
      </thead>
      <?php
        $select_comm = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'");
        $total = 0;
        if(mysqli_num_rows($select_comm) > 0){
          while($fetch_comm = mysqli_fetch_assoc($select_comm)){
      ?>
      <tbody>
        <tr>
          <td><?php echo $fetch_comm['nom_cart']; ?></td>
          <th></th>
          <th></th>
          <td>x<?php echo $fetch_comm['quantity']; ?></td>
          <td><?php echo $sub_total = number_format($fetch_comm['price'] * $fetch_comm['quantity']); ?>DH</td>
        </tr>
      <?php
        $total += $sub_total;
          };
        };
      ?>
        <tr id="shippingcost">
          <td>Shipping Cost</td>
          <th></th>
          <th></th>
          <td>-</td>
          <td><?php echo $shippingc ?> DH</td>
        </tr>
        <tr id="lastch">
          <td></td>
          <th></th>
          <th></th>
          <td colspan="2" id="totalapayer"><b>SUBTOTAL : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $total + $shippingc; ?> DH</b></td>
        </tr>
      </tbody>
    </table>
    <h4 style="font-size: 1rem;float: left;"><b>PAYMENT METHOD</b> : <i class="fa-brands fa-paypal"></i> PayPal</h4> 
    <h2 class="phonenb" style="font-size: 1rem;float: right;margin-top: -5.5%;"><i class="fa-solid fa-phone"></i>+212514523654</h2>
    <h2 class="phonenb" style="font-size: 1rem;float: right;margin-top: 1.5%;"><i class="fa-solid fa-phone"></i>+2125192001120</h2>
    <br>
    <br>
    <p style="font-size: 2rem;text-align: center;font-family: 'Beau Rivage', cursive;margin-top: 3%;margin-left:3%;">Thank you !</p>
    <button id="printdoc" class="btn btn-primary" onclick="window.print();">Save </button>
  </div>
<br>

  <section class="checkout-form">
    <h1 id="cart" style="text-align: center;margin-bottom: 1%;font-size: 48px;font-weight: 700;font-family: 'Beau Rivage', cursive;">Complete Your Order</h1>
    <form id="fr" action="check.php" method="post">
      <div class="row">
        <div class="col">
          <span>First Name</span>
          <input type="text" value="<?php echo $fetch_info['nom']; ?>" class="form-control" name="Firstname" placeholder="Enter your first name " required>
        </div>
        <div class="col">
          <span>Last Name</span>
          <input type="text" value="<?php echo $fetch_info['prenom']; ?>" class="form-control" name="Lastname" placeholder="Enter your last name " required>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <span>Phone Number</span>
          <input type="number" value="<?php echo $fetch_info['telephone']; ?>" class="form-control" name="number" placeholder="Enter your phone number " required>
        </div>
        <div class="col">
          <span> Email address</span>
          <input type="email" value="<?php echo $fetch_info['email']; ?>" class="form-control" name="email" placeholder="Enter your Email " required>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <span>Address line 1</span>
          <input type="text" value="<?php echo $fetch_info['adresse']; ?>" class="form-control" name="addres1" placeholder="44, Boulevard Nakhil." required>
        </div>
        <div class="col">
          <span>Address line 2</span>
          <input type="text" class="form-control" name="addres2" placeholder="RESIDENCE EL KHEIR. Marrakech" required>
        </div>
      </div>  
      <div class="row">
        <div class="col">
          <span>Delivery</span>
          <select name="tdelivery" class="form-select" onchange="gettdel(this)" required>
          <option value="" selected disabled>Select Type of delivery</option>
          <option  value="Get Your Order From Restaurant">Get Your Order From Restaurant</option>
          <option  value="Get Your Order With  Delivery Man">Get Your Order With  Delivery Man</option>
          </select>
          <!--<input type="text" class="form-control" name="city" value="Marrakech" style="font-weight:bold;" disabled>-->
        </div>
        <div class="col">
          <span>Payement Method</span>
          <select name="payementt" id="tpayement" class="form-select" onchange="getCombop(this)" required>
          <option value="" selected disabled>Select Payement Method</option>
          <option  value="Paypal">Paypal (free shipping)</option>
          <option  value="Cash">Cash on Delivery</option>
          </select>
          <!--<input type="text" class="form-control" name="payment" value="Paypal " style="font-weight:bold;" disabled>-->
        </div>
      </div>  
      <br>
      <input type="hidden" name="total" value="<?php echo $total + 15; ?>">
      <input type="hidden" value="<?php echo $numc; ?>" name="ncom">
      <input type="hidden" value="">
      <div style="text-align:center;">
      <input type="submit" id="btnsub" style="display: none;" name="btncheck">
      <a id="btna" style="align-items: center;width: 250px;" class="btn btn-outline-light btn-fw btn-lg"><b><i class="fa-solid fa-circle-check"></i> &nbsp;&nbsp;&nbsp;Confirm Order</b></a>
      </div>

      <div id="paypalbtn" style="text-align: center;display: none;">
                                <div id="paypal-button-container"></div>
                                </div>
                                </div>
                                <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script><script>

                                function initPayPalButton() {
                                    
                                paypal.Buttons({
                                    style: {
                                    shape: 'rect',
                                    color: 'gold',
                                    layout: 'vertical',
                                    label: 'paypal',
                                    
                                    },

                                    createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
                                    });
                                    },

                                    onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(orderData) {
                                        
                                        // Full available details
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                                        // Show a success message within this page, e.g.
                                       alert('Paiement effectué avec succès');
                                       document.getElementById('fr').submit();

                                        // Or go to another URL:  actions.redirect('thank_you.html');
                                        
                                    });
                                    },

                                    onError: function(err) {
                                        }
                                }).render('#paypal-button-container');
                                }
                                initPayPalButton();
                                </script>
    </form>
  </section>
  
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <a href="index.html" class="nav-brand"><img src="assets/img/12COOL0-removebg-preview.png" height="60px" style="margin-left: -10%;" alt="" class="logo-img"></a>
              <p>
                Quartier Moulay Abdullah<br>
                Ben Hezzian, Medina.<br><br>
                <strong>Phone :</strong> +212696113957<br>
                <strong>Email :</strong> resto@12cool.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>12COOL</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery-1.11.1.min.js"></script>
  <script>
    $(document).ready(function(){

      /*var delivryName = $("#tpayement option:selected").val();
      $("#tpayement").onChange(function() {
        if(delivryName === "cash"){
          alert("edfe");
          $("#paypalbtn").hide();
      }
      });*/
    
      $("#btna").click(function(){
        $("#btnsub").click();
      });
      /*$("#btna").click(function(){
        var delivryName = $("#tpayement").find(":selected").val();
        if(delivryName == 0)
        {
          //alert("Yessss");
          $("#btna").hide();
          $("#paypalbtn").css('display','block');
        }else if(delivryName == 1){
          alert("cash");
          
        }
      });*/

    });
    
      function getCombop(selectObject){
        var value = selectObject.value;
        if(value == "Paypal"){
          $("#btna").hide();
          $("#paypalbtn").css('display','block');
        }
        else{
          $("#btna").show();
          $("#paypalbtn").css('display','none');
        }
      }

      function gettdel(selectObj){
        var val = selectObj.value;
        if(val == "Get Your Order From Restaurant"){
          $("#shippingcost").hide();
          $('#tbmeal').load(location.href + " #tbmeal");
        }else
        {
          $("#shippingcost").show();
        }
      }

      /*$('#btnsub').submit(function(){
        $.ajax({
         type: 'POST',
         url: 'check.php',
         data: { content: $('.bon').html()}
     });
      });*/
  </script>
</body>

</html>