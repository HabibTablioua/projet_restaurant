<?php

@include 'config.php';
session_start();
if(isset($_SESSION['id_waiter'])){
$id_w = $_SESSION['id_waiter'];
$username = $_SESSION['name'];
$lastname = $_SESSION['lname'];
//echo $id_w;
$date_today = date("Y-m-d");

$total_day = mysqli_query($conn, "SELECT SUM(total) AS totald FROM teblecomm WHERE id_us = '$id_w' AND date_c = '$date_today' AND type_paim = 'Cash'");
$tot_d = mysqli_fetch_assoc($total_day);
$today_t = $tot_d['totald'];
if($today_t == null){
    $today_t = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Waiter | 12COOL</title>
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
            <a href="" class="nav-brand"><img src="assets/img/12COOL0.jpg" height="50px" alt="" class=""></a>

            <nav id="navbar" class="navbar order-last order-lg-0" style="font-family: 'Poppins', sans-serif;">
                <ul>
                    <li class="dropdown"><a href="#"><span><b><img src="assets/img/icons8-waiter-16.png" style="width: 21px;margin-top: -5px;"> <?php echo ucfirst($username); ?></b></span> <i class="bi bi-chevron-down"></i></a>
                        <ul style="left: -75px;">
                            <li><a href="historiquewaiter.php">
                                    <div><i class="bi bi-clipboard-check"></i>&nbsp;&nbsp; Historique</div>
                                </a></li>
                            <li><a href="profilewaiter.php"><div><i class="bi bi-cart3"></i>&nbsp;&nbsp; Order Now</div></a></li>
                            <li><a href="logout.php">
                                    <div><i class="bi bi-door-closed"></i>&nbsp;&nbsp; Logout</div>
                                </a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle" style="margin-right: -0.6rem;"></i>
            </nav><!-- navbar -->
        </div>
    </header>
    <!-- End Header -->

    <div class="message_div"></div>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="container-xxl py-5 hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4" id="discover">
                    <h2>Waiter</h2>
                    <h1 class="display-5 text-light mb-6 animated slideInDown"><?php echo ucfirst($username) . " " . ucfirst($lastname); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main" class="testimonials section-bg">
        <section class="p-5">
            <h1 id="cart" style="text-align: center;margin-bottom: 3%;font-size: 48px;font-weight: 700;font-family: 'Beau Rivage', cursive;">Historique</h1>
            <div class="table-responsive">
            <table id="tblcart" class="table text-light">
                <thead class="bg-white text-dark text-center">
                <tr>
                    <th scope="col">Table</th>
                    <th scope="col">Nb persone</th>
                    <th scope="col">Time</th>
                    <th scope="col">Meals</th>
                    <th scope="col">Total</th>
                    <th scope="col">Type paiment</th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php 
                    $select_meal = mysqli_query($conn, "SELECT * FROM teblecomm WHERE id_us = '$id_w' AND date_c = '$date_today' ORDER BY heure");
                    if(mysqli_num_rows($select_meal) > 0){
                    while($fetch_meal = mysqli_fetch_assoc($select_meal)){
                ?>
                <tr>
                    <td>Tab<?php echo $fetch_meal['id_table']; ?></td>
                    <td><?php echo $fetch_meal['nb_pers']; ?></td>
                    <td style="letter-spacing: 0.1rem;"><?php echo substr($fetch_meal['heure'],0,-3); ?></td>
                    <td><?php echo $fetch_meal['meal_q']; ?></td>
                    <td style="letter-spacing: 0.1rem;"><?php echo $fetch_meal['total']."DH"; ?></td>
                    <td><?php echo $fetch_meal['type_paim']; ?></td>
                    <?php 
                    };
                };
                ?>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b style="letter-spacing: 0.1rem;"><label style="color: #cda45e;">Total Cash :&nbsp; </label><?php echo $today_t." DH";?></b></td>
                </tr>
                </tbody>
            </table>
            </div>
        </section>
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
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


    </script>
</body>

</html>
<?php
    }else{
      header("Location:index.php");
    }
?>