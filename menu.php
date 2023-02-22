<?php 

@include 'config.php';
session_start();

$id_user = $_SESSION["userid"];

/*if(isset($_POST['btnsubmit'])){

  $meal_name = $_POST['meal_name'];
  $meal_price = $_POST['meal_price'];
  $meal_image = $_POST['meal_image'];
  $meal_quantity = 1;

  //check if we already added a meal in the table
  $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE nom_cart = '$meal_name' AND id = $id_user");
  if(mysqli_num_rows($select_cart) > 0)
  {
    //MSG : Meal already added to cart
    $message[] = 'Meal already added to cart';
  }else{
    $insert_meal = mysqli_query($conn, "INSERT INTO cart(nom_cart,price,imagee,quantity,id) VALUES('$meal_name','$meal_price','$meal_image',$meal_quantity,$id_user)");
    //MSG : Meal added to cart succesfully
    $message[] = 'Meal added to cart succesfully';
  }
}*/


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
  <script src="assets/js/jquery-1.11.1.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/stylee.css" rel="stylesheet">
  <style>
    .message{
      background-color: #8cff66;
      position: fixed;
      top: 8rem;left: 52rem;
      z-index: 10000;
      border-radius: .5rem;
      padding: 1.5rem 1.8rem;
      margin: 0 auto;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1.5rem;
    }
    .message span{
      font-size: 1.4rem;
      color: #000;
    }
    .message i{
      font-size: 2rem;
      color: #000;
      cursor: pointer;
    }
    .message i:hover{
      color: #cda45e;
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
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- navbar -->
      <?php 
      $select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE id = '$id_user'") or die('query failed');
      $row_cont = mysqli_num_rows($select_rows);
      ?>
      <a href="cart.php" id="Mycart" style="margin-left: 2rem;font-size: 1.1rem;">
        <!--<img src="assets/img/shopping_basket_white_24dp.svg" style="width: 35px;" alt="">-->
        <b>Cart </b>
        <span style="padding:.1rem .5rem;border-radius: .5rem;background-color: #cda45e;color:black;font-size: 1.1rem;"><b><?php echo $row_cont; ?></b></span>
      </a>
    </div>
  </header>
  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="container-xxl py-5 hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4" id="discover">
          <h2>Discover</h2>
          <h1 class="display-5 text-light mb-6 animated slideInDown">OUR TASTY MENU</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <!-- main -->
  <main id="main">
  <?php
  if(isset($message)){
    foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" id="closeM"></i></div>';
    };
  };
  ?>
   <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg" style="min-height: 1000px;">

      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li class="filter-active" id="all">All</li>
            </ul>
          </div>
        </div>

        <div class="row menu-container" id="repas" data-aos="fade-up" data-aos-delay="200">
          
        </div>
      </div>
    </section>
    <!-- End Menu Section -->
  </main>
  <!-- End main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <a href="home.php" class="nav-brand"><img src="assets/img/12COOL0-removebg-preview.png" height="60px" style="margin-left: -10%;" alt="" class="logo-img"></a>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  $( "#closeM" ).click(function() {
   $(".message").hide();
  });
$(document).ready(()=>{
  $(`#all`).click(() => {
        $("#repas").empty();

        getmyrepqs(0).then((data) => {
          //console.log(data);
          // alert("hna");
          let jnsa = JSON.parse(data);
          console.log(jnsa);
          for (let j = 0; j < jnsa.length; j++) {
            $("#repas").append(`
          <div class="col-lg-6 menu-item">
              <div>
                  <img src="assets/img/${jnsa[j].Image_plat}" class="menu-img" alt="">
                  <div class="menu-content">
                    <a href="#">${jnsa[j].nom_plat}</a><span>${jnsa[j].prix_plat} DH</span>
                  </div>
                  <div class="menu-ingredients">
                    ${jnsa[j].description_plat}
                  </div>
                  <input type="hidden" name="meal_name" value="${jnsa[j].Image_plat}">
                  <input type="hidden" name="meal_image" value="${jnsa[j].nom_plat}">
                  <input type="hidden" name="meal_price" value="${jnsa[j].prix_plat}">
                  <button  onclick="addtocart('${jnsa[j].nom_plat}','${jnsa[j].prix_plat}','${jnsa[j].Image_plat}',<?php echo $id_user; ?>)" class="btn btn-light" style="float:right;margin-top:6%;"><i class="fa fa-cart-shopping"></i></button>
                  <!-- <input type="submit" class="btn btn-light" name="btnsubmit" value="Add to cart" style="float:right;margin-top: 8%;">
                  <button type="submit" name="btn-submit" class="btn btn-light" style="float:right;">Add to cart</button>-->
              </div>
            </div> 
      `);
          }
        })
      })
      $("#all").trigger("click");
      getmygroup().then((data) => {
        //console.log(data);
        let jsn = JSON.parse(data);
        //console.log(jsn);
        for (let i = 0; i < jsn.length; i++) {
          $("#menu-flters").append(`
      <li class="" id="grp${jsn[i].id_cat}">${jsn[i].nom_cat}</li>
      `);
          $(`#grp${jsn[i].id_cat}`).click(() => {
            $("#repas").empty();
            getmyrepqs(jsn[i].id_cat).then((data) => {
              //console.log(data);
              let jnsa = JSON.parse(data);
              console.log(jnsa);
              for (let j = 0; j < jnsa.length; j++) {
                $("#repas").append(`
          <div class="col-lg-6 menu-item">
              <div>
                  <img src="assets/img/${jnsa[j].Image_plat}" class="menu-img" alt="">
                  <div class="menu-content">
                    <a href="#">${jnsa[j].nom_plat}</a><span>${jnsa[j].prix_plat} DH</span>
                  </div>
                  <div class="menu-ingredients">
                    ${jnsa[j].description_plat}
                  </div>
                  <input type="hidden" name="meal_name" value="${jnsa[j].nom_plat}">
                  <input type="hidden" name="meal_image" value="${jnsa[j].Image_plat}">
                  <input type="hidden" name="meal_price" value="${jnsa[j].prix_plat}">
                  <button  onclick="addtocart('${jnsa[j].nom_plat}','${jnsa[j].prix_plat}','${jnsa[j].Image_plat}',<?php echo $id_user; ?>)" class="btn btn-light" style="float:right;margin-top:6%;"><i class="fa fa-cart-shopping"></i></button>
                  <!-- <input type="submit" class="btn btn-light" name="btnsubmit" value="Add to cart" style="float:right;margin-top: 8%;">
                  <button type="submit" name="btn-submit" class="btn btn-light" style="float:right;">Add to cart</button>-->
              </div>
            </div> 
      `);
              }
            })
          })
        }
      })
    })

    function getmygroup() {
      return new Promise(function(resolve, reject) {
        $.ajax({
          method: "POST",
          url: "getgroupe.php",
          data: {},
          success: function(data) {
            resolve(data) // Resolve promise and go to then()
          },
          error: function(err) {
            // console.log(err)
            reject(err) // Reject the promise and go to catch()
          }
        });
      });
    }

    function getmyrepqs(id) {
      return new Promise(function(resolve, reject) {
        $.ajax({
          method: "POST",
          url: "getplates.php",
          data: {
            "id": id
          },
          success: function(data) {
            resolve(data) // Resolve promise and go to then()
          },
          error: function(err) {
            // console.log(err)
            reject(err) // Reject the promise and go to catch()
          }
        });
      });
    }

    function addtocart(nom, prix, image, idu) {
      return new Promise(function(resolve, reject) {
        $.ajax({
          method: "POST",
          url: "addtocart.php",
          data: {
            "idu": idu,
            "nom": nom,
            "prix": prix,
            "image": image,
          },
          success: function(data) {
            console.log(data);
            $('#Mycart').load(location.href + " #Mycart");
            //$('#bsubt').load(location.href + " #bsubt");
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
                            title: 'Meal added to Cart'
                          })
                        //end msg
            resolve(data) // Resolve promise and go to then()
          },
          error: function(err) {
            // console.log(err)
            reject(err) // Reject the promise and go to catch()
          }
        });
      });
    }

  </script>
</body>
</html>