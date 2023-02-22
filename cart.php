<?php 

@include 'config.php';
session_start();

$id_user = $_SESSION["userid"];
$name = $_SESSION['username']; 

if(isset($_POST['update_update_btn'])){
  $update_v = $_POST['update_quantity'];
  $update_id = $_POST['update_quantity_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$update_v' where id_cart = '$update_id'");
  if($update_quantity_query){
    header('location:cart.php');
  };
};
if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM cart WHERE id_cart = '$remove_id'");
  header('location:cart.php');
}
if(isset($_GET['delete_all'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM cart");
  header('location:cart.php');
}
if(isset($_GET['payment'])){
  header('location:checkout.php');
}

$select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'") or die('query failed');
$row_cont = mysqli_num_rows($select_rows);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Your Cart | 12COOL</title>
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
 <!-- <script type="text/javascript">
  new QRCode(document.getElementById("qrcode"), "http://jindo.dev.naver.com/collie");
  </script>-->
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
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

          <li class="dropdown"><a href="#"><span><?php  echo $name ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php"><div><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Profile</div></a></li>
              <li><a href="cart.php"><div><i class="bi bi-cart3"></i>&nbsp;&nbsp; Cart (<?php echo $row_cont; ?>)</div></a></li>
              <li><a href="historiqueclient.php"><div><i class="bi bi-cart-check-fill"></i>&nbsp;&nbsp; Orders</div></a></li> 
              <li><a href="logout.php"><div><i class="bi bi-door-closed"></i>&nbsp;&nbsp; Logout</div></a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" style="margin-right: -0.6rem;"></i>
      </nav><!-- navbar -->
      <?php 
      //$select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'") or die('query failed');
      //$row_cont = mysqli_num_rows($select_rows);
      ?>
      <!--<a href="#cart" id="Mycart" style="margin-left: 2rem;font-size: 1.1rem;">
        <img src="assets/img/shopping_basket_white_24dp.svg" style="width: 35px;" alt="">
        <b>Cart </b>
        <span style="padding:.1rem .5rem;border-radius: .5rem;background-color: #cda45e;color:black;font-size: 1.1rem;"><b><?php echo $row_cont; ?></b></span>
      </a>-->
      <ul>
      </ul>
    </div>
  </header>
  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="container-xxl py-5 hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4" id="discover">
          <h2>Discover</h2>
          <h1 class="display-5 text-light mb-6 animated slideInDown">Our Fast Delivery</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <section class="p-5">
    <h1 id="cart" style="text-align: center;margin-bottom: 3%;font-size: 48px;font-weight: 700;font-family: 'Beau Rivage', cursive;">Your Cart</h1>
    <div class="table-responsive">
      <table id="tblcart" class="table text-light" id="tableCart">
        <thead class="bg-white text-dark text-center">
          <tr>
            <th></th>
            <th scope="col">Meal name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php 
            $select_meal = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'");
            $total = 0;
            if(mysqli_num_rows($select_meal) > 0){
              while($fetch_meal = mysqli_fetch_assoc($select_meal)){
          ?>
          <tr>
            <td>
              <img src="assets/img/<?php echo $fetch_meal['imagee']; ?>" style="width: 100px;border-radius: 5px;" class="menu-img">
              &nbsp; 
            </td>
            <td><label style="margin-top: 36px;"><?php echo $fetch_meal['nom_cart']; ?></label></td>
            <td><label style="margin-top: 36px;"><?php echo $sub_total = number_format($fetch_meal['price'] * $fetch_meal['quantity']); ?> DH</label></td>
            <td>
              <form id="frmq">
              <input type="hidden" name="update_quantity_id" id="update_quantity_id" value="<?php echo $fetch_meal['id_cart']; ?>">
                    <input type="number" name="update_quantity" value="<?php echo $fetch_meal['quantity']; ?>" min="1" max="5" id="update_quantity" style="width: 45px;text-align: center;margin-top: 32px;">
                    <input type="submit" id="btnsq" value="update" style="height: 31px;padding-top:1%;display:none;" class="btn btn-light" name="update_update_btn">
                    <button id="updtqt" style="height: 31px;padding-top:1%;" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-right"></i></button>
              </form>
            </td>
            <td><button type="button" style="margin-top: 26px;" class="btn btn-warning" id="deletemeal" value="<?= $fetch_meal['id_cart']; ?>"><i class="fas fa-trash"></i> Remove</button></td>
          </tr>
          <?php 
              $total += $sub_total;
              };
            };
          ?>
          <tr style="background-color: #ffc107;color:black;">
            <td></td>
            <td></td>
            <td></td>
            <td><label style="margin-top: 8px;"><b>Total : <?php echo $total; ?> DH</b></label></td>
            <td><button type="button" class="btn btn-dark <?= ($total > 1) ? '' : 'disabled'; ?>" value="<?= $id_user; ?>" id="deleteAllCart"><i class="fas fa-trash"></i> Delete all</button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <br>
    <div class="btncheck" style="text-align:center;">
      <a href="cart.php?payment" style="align-items: center;width: 250px;;" class="btn btn-outline-light btn-fw btn-lg <?= ($total > 1)?'':'disabled'; ?>"><b><i class="fa-solid fa-cart-arrow-down"></i> &nbsp;&nbsp;&nbsp;Order now</b></a>
    </div>

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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).on('click','#deletemeal', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Meal ?'))
            {
                var meal_idc = $(this).val();
                //alert(meal_idc);
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_meal_cart': true,
                        'meal_idc': meal_idc
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 77){
                          $('#tblcart').load(location.href + " #tblcart");
                          //$('#bsubt').load(location.href + " #bsubt");
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
                        //end msg
                        }
                        else if(res.status == 78)
                        {
                            alert(res.message);
                            //$('#saveWaiter')[0].reset();
                        }
                    }
                });
            }   
        });
        //delete all from cart
        $(document).on('click','#deleteAllCart', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete all ?'))
            {
                var id_us = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_cart': true,
                        'id_us': id_us
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 101){
                          $('#tblcart').load(location.href + " #tblcart");
                          $('#bsubt').load(location.href + " #bsubt");
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
                        //end msg
                        }
                        else if(res.status == 102)
                        {
                          alert(res.message);
                        }
                    }
                });
            }   
        });
        $(document).on('click', '#updtqt',function(){
          $('#btnsq').click();
        });
        $(document).on('submit', '#frmq', function(e){  
          e.preventDefault(); 
          var formData = new FormData(this);
          formData.append("frmq", true);      
          $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 76){
                          $('#tblcart').load(location.href + " #tblcart");
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
                        //end msg
                        }
                        else if(res.status == 75)
                        {
                          alert(res.message);
                          //$('#saveWaiter')[0].reset();
                        }
                    }
                });   
        });
  </script>
</body>

</html>