<?php

@include 'config.php';
session_start();
if(isset($_SESSION['username'])&& isset($_SESSION['pass'])){

$name = $_SESSION['username']; 
$test = $_POST['vradio'];
$id_user = $_SESSION["userid"];
$_SESSION['vradio'] = $_POST['vradio'];
//echo 'Alert("' . $test . '")';
$select_info = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id_user'");
$fetch_info = mysqli_fetch_assoc($select_info);







?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Menu | 12COOL</title>
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
  <link href="assets/css/stylee.css" rel="stylesheet">
  <style>
    .table {
      text-align: center;
    }

    #local {
      align-items: center;
    }

    .checkout-form form {
      padding-left: 2rem;
      padding-right: 2rem;
      border-radius: .5rem;
    }

    .checkout-form form .col {
      flex: 1 1 40rem;
    }

    .checkout-form form .row .col span {
      font-size: 1.2rem;
      color: #cda45e;
      margin-left: 1rem;
    }

    .checkout-form form .row .col input {
      width: 100%;
      background-color: white;
      font-size: 1rem;
      color: black;
      border-radius: .3rem;
      margin: 0rem 0 1rem 0;
      padding: 0.5rem 1rem;
      text-transform: none;
    }
    .bon {
      background-color: #fff;
      color: #000;
      width: 600px;
      border-radius: .5rem;
      text-align: center;
      padding: 0.6rem 1.2rem;
      margin: 0 auto;
      justify-content: space-between;
      gap: 1.5rem;
    }
    .bon .time {
      display: flex;
      margin-left: 54px;
      border: 5px dashed black;
      width: 80%;
      height: 400px;
      margin-bottom: 40px;
      padding-left: 5%;
    }

    /*  .bon .time > h1
        margin-top: 3%;
        align-items: center;
     */
  </style>

</head>

<body>
  <?PHP

  ?>
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
          <li><a class="nav-link scrollto" href="home.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="menu.php">Menu</a></li>
          <li><a class="nav-link scrollto" href="home.php#contact">Contact</a></li>

          <li class="dropdown"><a href="#"><span><?php  echo $name ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php"><div><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Profile</div></a></li>
              <li><a href="cart.php"><div><i class="bi bi-cart3"></i>&nbsp;&nbsp; Cart</div></a></li>
              <li><a href="historiqueclient.php"><div><i class="bi bi-cart-check-fill"></i>&nbsp;&nbsp; Orders</div></a></li> 
              <li><a href="logout.php"><div><i class="bi bi-door-closed"></i>&nbsp;&nbsp; Logout</div></a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" style="margin-right: -0.6rem;"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="container-xxl py-5 hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4" id="discover">
          <h2>Discover</h2>
          <h1 class="display-5 text-light mb-6 animated slideInDown">THE BEST MEMORIES ARE MADE AROUND THE TABLE</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <!-- Time -->


  <!-- Time -->
  <!-- ======= table Section ======= -->
  <section class="checkout-form">
    <div class="section-title">
      <p class="table" style="font-family: 'Beau Rivage', cursive;">Book a Table</p>
    </div>
    <form id="frmtab">
      <div class="row">
        <div class="col">
          <span>Email</span>
          <input type="email" class="form-control" name="email" id="email" value="<?= $fetch_info['email'];?>" data-rule="email"  required>
          <div class="validate"></div>
        </div>
        <div class="col">
          <span>Phone number</span>
          <input type="text" class="form-control" name="phone" id="phone" value="<?= $fetch_info['telephone'];?>" placeholder="Your Phone" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required>
          <div class="validate"></div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <span>Date </span>
          <input type="date" name="date" class="form-control" required>
          <div class="validate"></div>
        </div>
        <div class="col">
        <!--  <span>Type Payement</span>
          <select class="form-control" id="exampleSelect" name="paiement" required>
            <option value="" selected disabled>type de paiement </option>
            <option value="Paypal">Paypal</option>
          </select>-->
          <span>Number Peopel </span>
          <input type="number" class="form-control" name="people" id="people" placeholder="# of people" data-rule="minlen:1" min="1" required>
          <div class="validate"></div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <span>Hour</span>
          <input type="number" class="form-control" name="Hour" placeholder="Hour" min=9 max=23 required>
          <div class="validate"></div>
        </div>
        <div class="col">
          <span>Minute</span>
          <!--<input type="number" class="form-control" name="minute"  placeholder="Minute"   min=0 max=59 required >-->
          <select name="minute" id="" class="form-control">
            <option value="" selected disabled>Minute</option>
            <option value="00">00</option>
            <option value="30">30</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <span>Location</span>
          <select class="form-control" id="exampleSelect" name="nom_location" disabled>
            <option [selected] value="<?php echo $test ?>"><?php echo $test ?></option>
          </select>

          <div class="validate"></div>
        </div>
        <div class="col">
          <span>Purpose</span>
          <!--<input type="number" class="form-control" name="minute"  placeholder="Minute"   min=0 max=59 required >-->
          <select name="purp" id="purp" class="form-control">
            <option value="" selected disabled>Chose...</option>
            <option value="Casual">Casual</option>
            <option value="Meeting">Meeting</option>
            <option value="Family">Family</option>
            <option value="Celebration">Celebration</option>
          </select>
        </div>
      </div>
      </div>
      <br>
      <div class="text-center">
        <input type="submit" name="Book_a_table_s" id="btnconf" style="display: none;">
        <a id="btnc" style="align-items: center;width: 250px;" class="btn btn-outline-light btn-fw btn-lg"><b><i class="fa-solid fa-utensils"></i> &nbsp;&nbsp;&nbsp;Book Table</b></a>
        <!--<button type="submit" name="payment" style="width: 200px;">Payment</button>-->
      </div>
    </form>
    </div>
  </section><!-- End Book A Table Section -->
  </main>



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
  <script src="assets/js/jquery-1.11.1.min.js">
  </script>
  <script>
    $(document).ready(function(){
      $('#btnc').click(function(){
        $('#btnconf').click();
      });
    });
    //add res table
    $(document).on('submit', '#frmtab',function (e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("frmtab", true); 
            $.ajax({
                type: "POST",
                url: "restable.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 11){
                        alert(res.message);                     
                    }else if(res.status == 22)
                    {
                      alert(res.message);
                    }
                }
            });
        });
  </script>
</body>

</html>
<?php
    }else{
      header("Location:index.php");
    }
?>