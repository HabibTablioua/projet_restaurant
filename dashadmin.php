<?php 
@include 'config.php';

session_start();
if(isset($_SESSION['username'])&& isset($_SESSION['pass'])){

//remplir combo location table
$emplreq = "SELECT * FROM locationt";
$emplc = mysqli_query($conn,$emplreq);

//remplir combo id table
$idtablee = "SELECT * FROM table_res where id_table not in(SELECT id_table FROM tablewaiter)";
$tablee = mysqli_query($conn,$idtablee);

//remplir combo waiter
$waiter = "SELECT * FROM user where role = 'waiter'";
$waiterinfo = mysqli_query($conn,$waiter);

//remplir combo categorie
$cat = "SELECT * FROM categorie";
$catsel = mysqli_query($conn,$cat);

//statistique
$tab = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$res = array();

$reqt = "SELECT count(*) as 'nbres' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Monday'";
$nbr = mysqli_query($conn, $reqt);
$nbres = mysqli_fetch_assoc($nbr);
$nbress = $nbres['nbres'];
array_push($res, $nbress);

$reqt1 = "SELECT count(*) as 'nbres1' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Tuesday'";
$nbr1 = mysqli_query($conn, $reqt1);
$nbres1 = mysqli_fetch_assoc($nbr1);
$nbress1 = $nbres1['nbres1'];
array_push($res, $nbress1);

$reqt2 = "SELECT count(*) as 'nbres2' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Wednesday'";
$nbr2 = mysqli_query($conn, $reqt2);
$nbres2 = mysqli_fetch_assoc($nbr2);
$nbress2 = $nbres2['nbres2'];
array_push($res, $nbress2);

$reqt3 = "SELECT count(*) as 'nbres3' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Thursday'";
$nbr3 = mysqli_query($conn, $reqt3);
$nbres3 = mysqli_fetch_assoc($nbr3);
$nbress3 = $nbres3['nbres3'];
array_push($res, $nbress3);

$reqt4 = "SELECT count(*) as 'nbres4' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Friday'";
$nbr4 = mysqli_query($conn, $reqt4);
$nbres4 = mysqli_fetch_assoc($nbr4);
$nbress4 = $nbres4['nbres4'];
array_push($res, $nbress4);

$reqt5 = "SELECT count(*) as 'nbres5' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Saturday'";
$nbr5 = mysqli_query($conn, $reqt5);
$nbres5 = mysqli_fetch_assoc($nbr5);
$nbress5 = $nbres5['nbres5'];
array_push($res, $nbress5);

$reqt6 = "SELECT count(*) as 'nbres6' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Sunday' - 1";
$nbr6 = mysqli_query($conn, $reqt6);
$nbres6 = mysqli_fetch_assoc($nbr6);
$nbress6 = $nbres6['nbres6'];
array_push($res, $nbress6);                 

//table reservation
$restab = array();

$reqtbl = "SELECT count(*) as 'nbrest' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Monday'";
$nbrse = mysqli_query($conn, $reqtbl);
$nbrestab = mysqli_fetch_assoc($nbrse);
$nbresst = $nbrestab['nbrest'];
array_push($restab, $nbresst);

$reqtbl1 = "SELECT count(*) as 'nbrest1' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Tuesday'";
$nbrse1 = mysqli_query($conn, $reqtbl1);
$nbrestab1 = mysqli_fetch_assoc($nbrse1);
$nbresst1 = $nbrestab1['nbrest1'];
array_push($restab, $nbresst1);

$reqtbl2 = "SELECT count(*) as 'nbrest2' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Wednesday'";
$nbrse2 = mysqli_query($conn, $reqtbl2);
$nbrestab2 = mysqli_fetch_assoc($nbrse2);
$nbresst2 = $nbrestab2['nbrest2'];
array_push($restab, $nbresst2);

$reqtbl3 = "SELECT count(*) as 'nbrest3' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Thursday'";
$nbrse3 = mysqli_query($conn, $reqtbl3);
$nbrestab3 = mysqli_fetch_assoc($nbrse3);
$nbresst3 = $nbrestab3['nbrest3'];
array_push($restab, $nbresst3);

$reqtbl4 = "SELECT count(*) as 'nbrest4' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Friday'";
$nbrse4 = mysqli_query($conn, $reqtbl4);
$nbrestab4 = mysqli_fetch_assoc($nbrse4);
$nbresst4 = $nbrestab4['nbrest4'];
array_push($restab, $nbresst4);


$reqtbl5 = "SELECT count(*) as 'nbrest5' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Saturday'";
$nbrse5 = mysqli_query($conn, $reqtbl5);
$nbrestab5 = mysqli_fetch_assoc($nbrse5);
$nbresst5 = $nbrestab5['nbrest5'];
array_push($restab, $nbresst5);

$reqtbl6 = "SELECT count(*) as 'nbrest6' from `reservationt` where date_res in(SELECT date_res FROM `reservationt` where YEAR(curdate()) = YEAR(date_res) And WEEK(date_res) = WEEK(current_date)) and dayname(date_res) = 'Sunday'";
$nbrse6 = mysqli_query($conn, $reqtbl6);
$nbrestab6 = mysqli_fetch_assoc($nbrse6);
$nbresst6 = $nbrestab6['nbrest6'];
array_push($restab, $nbresst6);



//income 
$income = array();

$revwsql = "SELECT SUM(total_price) as 'total' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Monday'";
$total = mysqli_query($conn, $revwsql);
$totres = mysqli_fetch_assoc($total);
$revt = $totres['total'];
array_push($income, $revt);

$revwsql1 = "SELECT SUM(total_price) as 'total1' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Tuesday'";
$total1 = mysqli_query($conn, $revwsql1);
$totres1 = mysqli_fetch_assoc($total1);
$revt1 = $totres1['total1'];
array_push($income, $revt1);

$revwsql2 = "SELECT SUM(total_price) as 'total2' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Wednesday'";
$total2 = mysqli_query($conn, $revwsql2);
$totres2 = mysqli_fetch_assoc($total2);
$revt2 = $totres2['total2'];
array_push($income, $revt2);

$revwsql3 = "SELECT SUM(total_price) as 'total3' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Thursday'";
$total3 = mysqli_query($conn, $revwsql3);
$totres3 = mysqli_fetch_assoc($total3);
$revt3 = $totres3['total3'];
array_push($income, $revt3);

$revwsql4 = "SELECT SUM(total_price) as 'total4' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Friday'";
$total4 = mysqli_query($conn, $revwsql4);
$totres4 = mysqli_fetch_assoc($total4);
$revt4 = $totres4['total4'];
array_push($income, $revt4);

$revwsql5 = "SELECT SUM(total_price) as 'total5' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Saturday'";
$total5 = mysqli_query($conn, $revwsql5);
$totres5 = mysqli_fetch_assoc($total5);
$revt5 = $totres5['total5'];
array_push($income, $revt5);

$revwsql6 = "SELECT SUM(total_price) as 'total6' from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj) = 'Sunday' - 1";
$total6 = mysqli_query($conn, $revwsql6);
$totres6 = mysqli_fetch_assoc($total6);
$revt6 = $totres6['total6'];
array_push($income, $revt6);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="js/owl.carousel.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/gest.css">
    <link rel="icon" href="assets/img/12COOL.jpg" type="image/gif"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <style>
        
    </style>
</head>
<body>
    <input type="checkbox" style="display: none;" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span><img src="assets/img/12COOL0-removebg-preview.png" alt="" height="60px"></span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="#" id="BT0" class="active"><span class="las la-igloo"></span><span> Dashboard</span></a>
                </li>
                <li>
                    <a href="#" id="BT1"><span class="las la-clipboard-list"></span><span>Booked Table </span></a>
                </li>
                <li>
                    <a href="#" id="BT2"><span class="las la-concierge-bell"></span><span> Meal Order</span></a>
                </li>
                <li>
                    <a href="#" id="BT3"><span class="las la-user-circle"></span><span>Customer's Account</span></a>
                </li>
                <li>
                    <a href="#" id="BT4"><span class="las la-utensils"></span><span>Restau-Management</span></a>
                    <ul id="sousmenu" style="color: #fff;margin-left: 10%;margin-top: 5%;">
                        <li>
                            <a href="#" id="btn1"><span class="las la-table"></span><span>Table</span></a>
                        </li>
                        <li>
                            <a href="#" id="btn2"><span class="las la-hamburger"></span><span>Menu</span></a>
                        </li>
                        <li>
                            <a href="#" id="btn3"><span class="las la-user"></span><span>Waiter</span></a>
                        </li>
                       
                    </ul>
                </li>
                <li class="deconnecter">
                    <a href="logout.php" id="BT6"><span class="las la-power-off"></span><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-title">
                <h2 style="margin-top: 0.5rem;">
                    <label for="nav-toggle">
                         <!--<i class="fa-solid fa-align-justify"></i>-->
                        <span class="fa-solid fa-align-justify"  style="cursor: pointer;"></span>
                    </label>
                    <label style="margin-left: -8px;">Dashboard</label>
                </h2>
               <!-- <div class="search-wrapper">
                    <span class="las la-search">
                    </span>
                    <input type="search" placeholder="Search here"/>
                </div>-->

                <div class="user-wrapper">
                    
                </div>
            </div>
        </header>
        <main>
            <div class="card">
                <?php
                $req = mysqli_query($conn, 'SELECT COUNT(*) as nbper FROM `user` WHERE date_aujaurd = CURRENT_DATE()  AND role="client"');
                $nbper = mysqli_fetch_assoc($req);
                $nbp = $nbper['nbper'];
                ?>
                    <div class="card-single" id="clientToday" style="cursor: pointer;">
                        <div>
                            <h1><?php echo $nbp; ?></h1>
                            <span>Customers</span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>
                    </div>
                    <?php
                    $exreq = mysqli_query($conn, 'SELECT COUNT(*) as nbres FROM `reservationt` WHERE date_res = CURRENT_DATE()');
                    $nbrest = mysqli_fetch_assoc($exreq); 
                    $nbt = $nbrest['nbres'];
                    ?>
                    <div class="card-single" id="tablerestoday" style="cursor: pointer;">
                        <div>
                            <h1><?php echo $nbt; ?></h1>
                            <span>Tables</span>
                        </div>
                        <div>
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <?php 
                    $execre = mysqli_query($conn, 'SELECT COUNT(*) as nb FROM `order` where date_auj = CURRENT_DATE()');
                    $nombre = mysqli_fetch_assoc($execre);
                    $nb = $nombre['nb'];
                    ?>
                    <div class="card-single" id="ordersToday" style="cursor: pointer;">
                        <div>
                            <h1><?php echo $nb; ?></h1>
                            <span>ordres</span>
                        </div>
                        <div>
                            <span class="las la-concierge-bell"></span>
                        </div>
                    </div>
                    <?php 
                    $execreq = mysqli_query($conn, 'SELECT SUM(total_price) as total FROM `order` WHERE date_auj = CURRENT_DATE()');
                    $rev = mysqli_fetch_assoc($execreq);
                    $sum = $rev['total'];
                    if($sum == null){
                        $sum = 0;
                    }
                    ?>
                    <div class="card-single" id="statistiqueToday" style="cursor: pointer;">
                        <div>
                            <h1><?php echo $sum; ?> DH</h1>
                            <span>Revenue</span>
                        </div>
                        <div>
                            <span class="lab la-google-wallet"></span>
                        </div>
                    </div>
            </div>

            <div class="recent-grid" id="customersToaday">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Customers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="tabcustomer"> 
                                <thead>
                                <tr>
                                    <td>First name</td>
                                    <td>Last name</td>
                                    <td>Email</td>
                                    <td>Password</td>
                                    <td>Adresse</td>
                                    <td>Phone</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT * FROM user where role = 'client' AND date_aujaurd = CURRENT_DATE()";
                                    $selectCust = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($selectCust) > 0){
                                        foreach($selectCust as $client)
                                        {
                                            ?>
                                    <tr>
                                        <td><img src="<?= $client['qrImage']; ?>" width="70" style="border-radius: 5px;height:100%;"></td>
                                        <td><?= $client['nom'] ?></td>
                                        <td><?= $client['prenom'] ?></td>
                                        <td><?= $client['email'] ?></td>
                                        <td><?= $client['password'] ?></td>
                                        <td><?= $client['adresse'] ?></td>
                                        <td><?= $client['telephone'] ?></td>
                                        <td>
                                            <div class="buttons"><button class="cta-02" id="sendQRCustomer" style="margin-top: 11%;" value="<?= $client['id'];?>"><span><i class="fa-solid fa-qrcode"></i> Send QRcode </span></button></div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="recent-grid" id="F4">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Tables have been reserved</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="restable"> 
                                <thead>
                                <tr>
                                    <td>Client</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Numbre of persons</td>
                                    <td>Purpose</td>
                                    <td>Location</td>
                                    <td>Table</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT * FROM reservationt WHERE date_res = CURRENT_DATE()";
                                    $select_tab = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($select_tab) > 0){
                                        foreach($select_tab as $table)
                                        {
                                            ?>
                                    <tr>
                                        <?php
                                        $iduser = $table['id_user'];
                                        $req = "SELECT nom,prenom FROM user where id = $iduser";
                                        $nomuser = mysqli_query($conn, $req);
                                        $nomprenom = mysqli_fetch_array($nomuser);
                                        ?>
                                        <td><?php echo $nomprenom['nom'].' '.$nomprenom['prenom'];?></td>
                                        <td><?= $table['date_res'] ?></td>
                                        <td><?= $table['temps'] ?></td>
                                        <td style="padding-left: 4%;"><?= $table['nb_personne'].' '.'People' ?></td>
                                        <?php
                                        $idtbl = $table['id_table'];
                                        $req = "SELECT purpose FROM table_res where id_table = $idtbl";
                                        $nompr = mysqli_query($conn, $req);
                                        $purpose = mysqli_fetch_array($nompr);
                                        ?>
                                        <td><?php echo $purpose['purpose']; ?></td>
                                        <?php
                                        $idloc = $table['code_locationT'];
                                        $req = "SELECT nom_LocationT FROM locationt where code_locationT = $idloc";
                                        $nomloc = mysqli_query($conn, $req);
                                        $locationtable = mysqli_fetch_array($nomloc);
                                        ?>
                                        <td><span class="status <?php echo $locationtable['nom_LocationT']; ?>"></span><?php echo $locationtable['nom_LocationT']; ?></td>
                                        <td><?= 'Tab'.$table['id_table'] ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>


            <div id="ordersTo">
            <div class="recent-grid">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Ordres</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="tabcustomer"> 
                                <thead>
                                <tr>
                                    <td>Full Name</td>
                                    <td>Meals</td>
                                    <td>Total</td>
                                    <td>Type Delivery</td>
                                    <td>Payement</td>
                                    <td>Address</td>
                                </tr>
                                </thead>
                                    <tbody>
                                    <?php 
                                        $selectorder = mysqli_query($conn,"SELECT * FROM `order` WHERE date_auj = CURRENT_DATE()");
                                        if(mysqli_num_rows($selectorder) > 0){
                                            foreach($selectorder as $order)
                                            {
                                                ?>
                                        <tr>
                                            <?php
                                            $iduser = $order['id'];
                                            $req = "SELECT nom,prenom FROM user where id = $iduser";
                                            $nomuser = mysqli_query($conn, $req);
                                            $nomprenom = mysqli_fetch_array($nomuser);
                                            ?>
                                            <td><?php echo $nomprenom['nom'].' '.$nomprenom['prenom'];?></td>
                                            <td><?= $order['meals_quan'] ?></td>
                                            <td><?= $order['total_price'].' DH'; ?></td>
                                            <td><?= $order['typedelivery'] ?></td>
                                            <td><?= $order['payementmethod'] ?></td>
                                            <td><?php echo $order['address1'].' '.$order['address2']; ?></td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>  
                                    </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="recent-grid">
                <div class="cardd">
                    <div class="Projects">
                        
                    </div>
                </div> 
            </div>

            </div>
            <div id="statistiqued">
                <div class="recent-grid">
                    <div class="cardd">
                        <div class="Projects">
                            <div class="card-header">
                                <h3>Statistique</h3>
                            </div>
                            <div class="card-body" style="width: 1000px;">
                                <canvas id="graph1"></canvas>
                                <canvas id="graph2" style="margin-top: 3%;"></canvas>
                            </div>
                        </div>
                    </div> 
                </div>       
            </div>

            <!-- Reservation table 'card' -->
            <div class="olcards">
                <h1 style="margin-top:1%;display: flex;justify-content: center;">Booked Table : <?php echo date('d-m-'.'20'.'y'); ?></h1>
             <div style="display: flex;flex-flow: row wrap;justify-content: center;">
                <?php
                    $req = "SELECT * FROM `reservationt` where date_res = CURRENT_DATE()";
                    $query = mysqli_query($conn, $req);
                    if(mysqli_num_rows($query) > 0){
                        while($fetch_tab = mysqli_fetch_assoc($query)){
                            $cdel = $fetch_tab['code_locationT'];
                            $secquer = mysqli_query($conn, "SELECT image_LocationT from locationt where code_locationT = $cdel");
                            $fetch_img = mysqli_fetch_assoc($secquer);
                            $img = $fetch_img['image_LocationT'];
                ?>
                <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                          <?php
                          $idtbl = $fetch_tab['id_table'];
                          $req = "SELECT purpose FROM table_res where id_table = $idtbl";
                          $nompr = mysqli_query($conn, $req);
                          $purpose = mysqli_fetch_array($nompr);
                          ?>
                         <img src="assets/img/<?php echo $img;?>" alt="repas" style="width:100%;height:100%;border-radius: 15px;">
                         <div class="txtimage"><h1><?php echo $purpose['purpose'];?></h1></div>
                        </div>
                        
                      <div class="flip-card-back">
                          <?php
                          $iduser = $fetch_tab['id_user'];
                          $req = "SELECT nom,prenom FROM user where id = $iduser";
                          $nomuser = mysqli_query($conn, $req);
                          $nomprenom = mysqli_fetch_array($nomuser);
                          
                          ?>
                            <h1 style="margin-top: 4%;font-size: 1.6rem;"><?php echo $nomprenom['nom'].' '.$nomprenom['prenom']; ?></h1>
                            <h3 style="margin-top: 20%;"><span class="las la-user"></span> <?php echo $fetch_tab['nb_personne'];?></h3>
                            <div style="display:flex;margin-top: 30%;">
                            <?php
                            if($fetch_tab["Minute"] == 0){
                                $minute = '00';
                            }else
                            {
                                $minute = '30';
                            }
                            ?>
                             <p style="margin-left: 6%;"><?php echo $fetch_tab["Heure"].':'.$minute; ?></p>
                             <?php 
                             $idloc = $fetch_tab['code_locationT'];
                             $req = "SELECT nom_LocationT FROM locationt where code_locationT = $idloc";
                             $nomloc = mysqli_query($conn, $req);
                             $locationtable = mysqli_fetch_array($nomloc);
                             ?>
                             <p style="margin-left: 45%;"><?php echo $locationtable['nom_LocationT'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        }
                    }   
                ?>
            </div>    
            </div>

            <br>

            <!-- End Reservation table 'card' -->

            <div class="recent-grid" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Table Reservation History</h3>
                            <div class="buttons"><button class="cta-01" id="supallres"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="restablee"> 
                                <thead>
                                <tr>
                                    <td>Client</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>number of persons</td>
                                    <td>Purpose</td>
                                    <td>Location</td>
                                    <td>Table</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT * FROM reservationt order by date_res desc";
                                    $select_tab = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($select_tab) > 0){
                                        foreach($select_tab as $table)
                                        {
                                            ?>
                                    <tr>
                                        <?php
                                        $iduser = $table['id_user'];
                                        $req = "SELECT nom,prenom FROM user where id = $iduser";
                                        $nomuser = mysqli_query($conn, $req);
                                        $nomprenom = mysqli_fetch_array($nomuser);
                                        ?>
                                        <td><?php echo $nomprenom['nom'].' '.$nomprenom['prenom'];?></td>
                                        <td><?= $table['date_res'] ?></td>
                                        <?php
                                        if($table["Minute"] == 0){
                                            $minute = '00';
                                        }else
                                        {
                                            $minute = '30';
                                        }
                                        ?>
                                        <td><?php echo $table['Heure'].':'.$minute; ?></td>
                                        <td style="padding-left: 4%;"><?= $table['nb_personne'].' '.'People' ?></td>
                                        <?php
                                        $idtbl = $table['id_table'];
                                        $req = "SELECT purpose FROM table_res where id_table = $idtbl";
                                        $nompr = mysqli_query($conn, $req);
                                        $purpose = mysqli_fetch_array($nompr);
                                        ?>
                                        <td><?php echo $purpose['purpose']; ?></td>
                                        <?php
                                        $idloc = $table['code_locationT'];
                                        $req = "SELECT nom_LocationT FROM locationt where code_locationT = $idloc";
                                        $nomloc = mysqli_query($conn, $req);
                                        $locationtable = mysqli_fetch_array($nomloc);
                                        ?>
                                        <td><span class="status <?php echo $locationtable['nom_LocationT']; ?>"></span><?php echo $locationtable['nom_LocationT']; ?></td>
                                        <td><?= 'Tab'.$table['id_table'] ?></td>
                                        <td>
                                            <div class="buttons"><button class="cta-02" id="supres" value="<?= $table['id_res']; ?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <!--Gest Orders-->
            <div id="gestorders">
            <h1 style="margin-top:1%;display: flex;justify-content: center;">Meal Orders </h1>
                <div class="recent-grid">
                    <div class="cardd">
                        <div class="Projects">
                            <div class="card-header">
                                <h3>Takeout and Delivery Orders</h3>
                                <div class="buttons"><button class="cta-01" id="supallordersD"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table width="100%" id="supallordersDtab"> 
                                    <thead>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>Meals</td>
                                        <td>Total</td>
                                        <td>Type Delivery</td>
                                        <td>Payement</td>
                                        <td>Address</td>
                                    </tr>
                                    </thead>
                                        <tbody>
                                        <?php 
                                            $selectorder = mysqli_query($conn,"SELECT * FROM `order` order by date_auj");
                                            if(mysqli_num_rows($selectorder) > 0){
                                                foreach($selectorder as $order)
                                                {
                                                    ?>
                                            <tr>
                                                <?php
                                                $iduser = $order['id'];
                                                $req = "SELECT nom,prenom FROM user where id = $iduser";
                                                $nomuser = mysqli_query($conn, $req);
                                                $nomprenom = mysqli_fetch_array($nomuser);
                                                ?>
                                                <td><?php echo $nomprenom['nom'].' '.$nomprenom['prenom'];?></td>
                                                <td><?= $order['meals_quan'] ?></td>
                                                <td><?= $order['total_price'].' DH'; ?></td>
                                                <td>
                                                    <?php
                                                    if($order['typedelivery'] == 'Get Your Order With  Delivery Man'){
                                                        echo 'With Delivery Man';
                                                    }else{
                                                        echo 'Takeout ';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $order['payementmethod'] ?></td>
                                                <td><?php
                                                 if($order['typedelivery'] == 'Get Your Order From Restaurant'){
                                                    echo '-'; 
                                                 }else
                                                 {
                                                    echo $order['address1'].' '.$order['address2']; 
                                                 }
                                                ?></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>  
                                        </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="recent-grid">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Waiter Ordres</h3>
                            <div class="buttons"><button class="cta-01" id="supallordersW"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="tabresw"> 
                                <thead>
                                <tr>
                                    <td>Hour</td>
                                    <td>Waiter</td>
                                    <td>Table</td>
                                    <td>Nb Person</td>
                                    <td>Meals</td>
                                    <td>Total</td>
                                    <td>Payement</td>
                                    <td></td>
                                </tr>
                                </thead>
                                    <tbody>
                                    <?php 
                                        $selectorder = mysqli_query($conn,"SELECT * FROM `teblecomm`");
                                        if(mysqli_num_rows($selectorder) > 0){
                                            foreach($selectorder as $order)
                                            {
                                                ?>
                                        <tr>
                                            <td><?= $order['heure'] ?></td>
                                            <?php
                                            $iduser = $order['id_us'];
                                            $req = "SELECT nom,prenom FROM user where id = $iduser";
                                            $nomuser = mysqli_query($conn, $req);
                                            $nomprenom = mysqli_fetch_array($nomuser);
                                            ?>
                                            <td><?php echo $nomprenom['nom'].' '.$nomprenom['prenom'];?></td>
                                            <td><?= 'Tab'.$order['id_table'] ?></td>
                                            <td><?= $order['nb_pers'] ?></td>
                                            <td><?= $order['meal_q'] ?></td>
                                            <td><?= $order['total'].' DH'; ?></td>
                                            <td><?= $order['type_paim'] ?></td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>  
                                    </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            </div>

            <!--Gest compte client-->

            <div id="compteClient">
            <h1 style="margin-top:1%;display: flex;justify-content: center;">Customers Account Management</h1>
            <div class="recent-grid" id="F2">
                <div class="cardd"> 
                    <div class="Projects">
                        <div class="card-header">
                            <h3>customers</h3>
                            <div class="buttons"><button class="cta-01" id="deleteallcustomers"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="tabcustomer"> 
                                <thead>
                                <tr>
                                    <td>First name</td>
                                    <td>Last name</td>
                                    <td>Email</td>
                                    <td>Password</td>
                                    <td>Adresse</td>
                                    <td>Phone</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT * FROM user where role = 'client' order by date_aujaurd  desc";
                                    $select_clt = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($select_clt) > 0){
                                        foreach($select_clt as $client)
                                        {
                                            ?>
                                    <tr>
                                        <td><?= $client['nom'] ?></td>
                                        <td><?= $client['prenom'] ?></td>
                                        <td><?= $client['email'] ?></td>
                                        <td><?= $client['password'] ?></td>
                                        <td><?= $client['adresse'] ?></td>
                                        <td><?= $client['telephone'] ?></td>
                                        <td>
                                            <div class="buttons"><button class="cta-02" id="deleteCustomer" style="margin-top: 13%;" value="<?= $client['id'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            </div>

            <!--Gestion Table-->
            <div id="gesttable">
                <!--Gestion Table restaurant-->
                <div style="display: flex;align-items: center;justify-content: center;">
                <div class="add-table">
                    <h2>Add New Table</h2>
                    <form id="addtable">
                        <table id="addtt">
                            <tr>
                                <td><label>Nombre de personnes</label></td>
                                <td>
                                    <!--<select name="typetable" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="For 1">For 1</option>
                                    <option value="For 2">For 2</option>
                                    <option value="For 3">For 3</option>
                                    <option value="For 4">For 4</option>
                                    <option value="For 5">For 5</option>
                                    <option value="For 6">For 6</option>
                                    </select>-->
                                    <input type="number" max="20" min="1" id="typetable" name="typetable" style="width: 200px;" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Purpose</label>
                                </td>
                                <td>
                                    <!--<select name="purpose" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Family">Family</option>
                                    <option value="Freinds">Freinds</option>
                                    <option value="Celebration">Celebration</option>
                                    </select>-->
                                    <input type="text" name="purpose" id="purpose" style="width: 200px;">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Emplacement</label></td>
                                <td>
                                <select name="emplacement" required>
                                <option selected disabled value="">Choose...</option>
                                <?php while($row = mysqli_fetch_array($emplc)):?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
                                <?php endwhile; ?>
                                </select>
                                &nbsp;&nbsp;<a id="addnewem"><i class="fa-solid fa-circle-plus" style="cursor: pointer;"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="btnsub" value="Add Table"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="addempl">
                    <br>
                    <h2>Add New Emplacement</h2>
                    <form id="addemplcment">
                        <table id="addem">
                            <tr>
                                <td><label>Image </label></td>
                                <td>
                                <input type="file" id="img_emplc" name="img_emplc" accept="image/png, image/jpeg" style="color: #000;" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Name </label>
                                </td>
                                <td>
                                    <input type="text" name="nameemplc" id="nameemplc" style="width: 200px;">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="addemlc" value="Add Emplacement"></td>
                            </tr>
                        </table>
                    </form>
                    </div>
                </div> 
                <div class="add-table">
                <h2>Table --> Waiter</h2>
                    <form id="afftabwait">
                        <table id="tabw">
                            <tr>
                                <td><label>Table</label></td>
                                <td>
                                    <select name="idtable" required>
                                    <option selected disabled value="">Choose...</option>
                                    <?php while($row = mysqli_fetch_array($tablee)):?>
                                    <option value="<?php echo $row[0]; ?>"> TB<?php echo $row[0]; ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Waiter</label>
                                </td>
                                <td>
                                    <select name="idwaiter" required>
                                    <option selected disabled value="">Choose...</option>
                                    <?php while($row = mysqli_fetch_array($waiterinfo)):?>
                                    <option value="<?php echo $row[0];?>"><?php echo $row[1].' '.$row[2];?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="savetablewaiter" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                </div>   
                </div>     
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Table Informations</h3>
                            <div class="buttons"><button class="cta-01" id="deletealltable"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="altable"> 
                                <thead>
                                <tr>
                                    <td>Id Table</td>
                                    <td>Nombre de personnes</td>
                                  <!--  <td>Disponible</td>-->
                                    <td>Purpose</td>
                                    <td>Emplacement</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_table = mysqli_query($conn, "SELECT * FROM table_res");
                                        if(mysqli_num_rows($select_table) > 0){
                                            while($fetch_table = mysqli_fetch_assoc($select_table)){
                                    ?>
                                    <tr>
                                        <td>Tb<?php echo $fetch_table['id_table']; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fetch_table['type_res']; ?></td>
                                      <!--  <td><label style="background: green;padding: 4px 8px 4px 8px;border-radius: 4px;color: #000;font-weight: 600;"><?php //echo $fetch_table['disponible']; ?></label></td>-->
                                        <td><?php echo $fetch_table['purpose']; ?></td>
                                        <?php 
                                        $codeLocat = $fetch_table['code_locationT'];
                                        $req = "SELECT nom_LocationT from locationt where code_locationT = $codeLocat";
                                        $nomlocation = mysqli_query($conn,$req);
                                        $rro = mysqli_fetch_array($nomlocation);
                                        ?>
                                        <td><?php echo $rro['nom_LocationT']; ?></td>
                                        <td>
                                            <div class="buttons"><button class="cta-02" id="modifytab" value="<?= $fetch_table['id_table'];?>"><span><i class="fas fa-pen"></i> Modify</span></button></div>
                                            <div class="buttons"><button class="cta-02" id="deletetab" value="<?= $fetch_table['id_table'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr> 
                                    <?php 
                                            };
                                        };
                                    ?>   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3> The Tables Of Each Waiter</h3>
                            <div class="buttons"><button class="cta-01" id="deletealltablew"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body" id="tabwai">
                            <div class="table-responsive">
                            <table width="100%"> 
                                <thead>
                                <tr>
                                    <td>Id Table</td>
                                    <td>Waiter</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_table = mysqli_query($conn, "SELECT * FROM tablewaiter");
                                        if(mysqli_num_rows($select_table) > 0){
                                        while($fetch_table = mysqli_fetch_assoc($select_table)){
                                    ?>
                                    <tr>
                                        <td>Tb<?php echo $fetch_table['id_table']; ?></td>
                                        <?php 
                                            $codewaiter = $fetch_table['id_waiter'];
                                            $req = "SELECT nom,prenom from user where id = $codewaiter";
                                            $nomwaiter = mysqli_query($conn,$req);
                                            $rro = mysqli_fetch_array($nomwaiter);
                                        ?>
                                        <td><?php echo $rro['nom'].' '.$rro['prenom']; ?></td>
                                        <td>
                                            <!--<div class="buttons"><button class="cta-02" id="btnmdfw" value=""><span><i class="fas fa-pen"></i> Modify</span></button></div>-->
                                            <div class="buttons"><button class="cta-02" id="btnspw" value="<?= $fetch_table['id_table']; ?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>    
                                    <?php 
                                            };
                                        };
                                    ?> 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Emplacement Table</h3>
                            <div class="buttons"><button class="cta-01" id="deleteallempl"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="tbempp" width="100%"> 
                                <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_emp = mysqli_query($conn, "SELECT * FROM locationt");
                                        if(mysqli_num_rows($select_emp) > 0){
                                        while($fetch_emp = mysqli_fetch_assoc($select_emp)){
                                    ?>
                                    <tr>
                                        <td><img src="assets/img/<?php echo $fetch_emp['image_LocationT']; ?>" width="70" style="border-radius: 5px;height:100%;"></td>
                                        <td><?php echo $fetch_emp['nom_LocationT']; ?></td>
                                        <td style="padding-top: 25px;">
                                            <div class="buttons"><button class="cta-02" id="modifyEmplc" value="<?= $fetch_emp['code_locationT'];?>"><span><i class="fas fa-pen"></i> Modify</span></button></div>
                                            <div class="buttons"><button class="cta-02" id="deleteEmplc" value="<?= $fetch_emp['code_locationT'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>   
                                    <?php 
                                            };
                                        };
                                    ?>   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <br>
            </div>  
            
            <!--Gestion Menu restaurant-->

            <div id="gestmenu">
                <div style="display: flex;align-items: center;justify-content: center;">
                <div class="add-table">
                    <h2>Add New Categorie</h2>
                    <form id="addcat">
                        <table>
                            <tr>
                                <td><label>Name</label></td>
                                <td>
                                    <input type="text" style="width: 200px;" name="name_cat" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="addcat" value="Add Categorie"></td>
                            </tr>
                        </table>
                    </form>
                </div> 
                <div class="add-table">
                    <h2>Add New Meal</h2>
                    <form id="addmealaj">
                        <table id="catmealrl">
                            <tr>
                                <td><label>Image</label></td>
                                <td>
                                <!--<div class="new_Btn"><button>Get File</button></div>-->
                                <input type="file" id="html_btn" name="photo" accept="image/png, image/jpeg" style="color: #000;" required/>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Name </label></td>
                                <td>
                                    <input type="text" name="meal_name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Prix</label>
                                </td>
                                <td>
                                   <input type="number" name="prix_meal" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Description</label></td>
                                <td>
                                <input type="text" name="desc" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Categorie</label></td>
                                <td>
                                <select name="categorie" required>
                                <option selected disabled value="">Choose...</option>
                                <?php while($row = mysqli_fetch_array($catsel)):?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                <?php endwhile; ?>
                                </select>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="addmeal" value="Add Meal"></td>
                            </tr>
                        </table>
                    </form>
                </div>  
                </div>   
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Meal Informations</h3>
                            <div class="buttons"><button class="cta-01" id="deleteallMeals"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="tbmeals" width="100%"> 
                                <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name</td>
                                    <td>Prix</td>
                                    <td>Description</td>
                                    <td>Categorie</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_meal = mysqli_query($conn, "SELECT * FROM plat order by code_plat");
                                        if(mysqli_num_rows($select_meal) > 0){
                                        while($fetch_meal = mysqli_fetch_assoc($select_meal)){
                                    ?>
                                    <tr>
                                        <td><img src="assets/img/<?php echo $fetch_meal['Image_plat']; ?>" width="70" style="border-radius: 5px;height:100%;"></td>
                                        <td><?php echo $fetch_meal['nom_plat']; ?></td>
                                        <td><?php echo $fetch_meal['prix_plat'].'DH'; ?></td>
                                        <td><?php echo $fetch_meal['description_plat']; ?></td>
                                        <?php 
                                            $idcat = $fetch_meal['id_cat'];
                                            $req = "SELECT nom_cat from categorie where id_cat = $idcat";
                                            $nomcat = mysqli_query($conn,$req);
                                            $rro = mysqli_fetch_array($nomcat);
                                        ?>
                                        <td><?php echo $rro['nom_cat']; ?></td>
                                        <td style="padding-top: 25px;">
                                            <div class="buttons"><button class="cta-02" id="modifyMeal" value="<?= $fetch_meal['code_plat'];?>"><span><i class="fas fa-pen"></i> Modify</span></button></div>
                                            <div class="buttons"><button class="cta-02" id="deleteMeal" value="<?= $fetch_meal['code_plat'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>   
                                    <?php 
                                            };
                                        };
                                    ?>   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Categorie Informations</h3>
                            <div class="buttons"><button class="cta-01" id="deleteAllCategorie"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="tbcat" width="100%"> 
                                <thead>
                                <tr>
                                    <td>Id categorie</td>
                                    <td>Name categorie</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_cat = mysqli_query($conn, "SELECT * FROM categorie");
                                        if(mysqli_num_rows($select_cat) > 0){
                                        while($fetch_cat = mysqli_fetch_assoc($select_cat)){
                                    ?>
                                    <tr>
                                        <td>Cat<?php echo $fetch_cat['id_cat']; ?></td>
                                        <td><?php echo $fetch_cat['nom_cat']; ?></td>
                                        <td>
                                            <div class="buttons"><button class="cta-02" id="modifyCat" value="<?= $fetch_cat['id_cat'];?>"><span><i class="fas fa-pen"></i> Modify</span></button></div>
                                            <div class="buttons"><button class="cta-02" id="deleteCat" value="<?= $fetch_cat['id_cat'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                        </td>
                                    </tr>  
                                    <?php 
                                            };
                                        };
                                    ?>   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
            </div>

            <!--Gest Waiter-->
            <div id="gestwaiter">
                <div style="display: flex;align-items: center;justify-content: center;">
                    <div class="add-table">
                        <h2>Add New Waiter</h2>
                        <form id="saveWaiter">
                        <div class="msgWaiter"><p id="errorMessage"></p></div>
                        <table>
                                    <tr>
                                        <td><label>First Name</label></td>
                                        <td>
                                            <input type="text" style="width: 200px;" name="fname_waiter" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Last Name</label></td>
                                        <td><input type="text" style="width: 200px;" name="lastn_waiter" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Email</label></td>
                                        <td><input type="text" style="width: 200px;" name="age_waiter" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Address</label></td>
                                        <td><input type="text" style="width: 200px;" name="address_waiter" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Phone Number</label></td>
                                        <td><input type="number" style="width: 200px;" name="tele_waiter" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Password</label></td>
                                        <td><input type="password" style="width: 200px;" name="password_waiter" required></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="addwaiter" value="Add Waiter"></td>                                        
                                    </tr>
                                </table>    
                        </form>
                    </div> 
                    <div class="add-table" id="ttoew" style="width: 500px;margin-top:3%;">
                        <h2>The Tables of each waiter</h2>
                        <?php 
                            $select_waiter = mysqli_query($conn, "SELECT distinct id_waiter FROM tablewaiter");
                            if(mysqli_num_rows($select_waiter) > 0){
                                while($fetch_w = mysqli_fetch_assoc($select_waiter)){
                        ?>
                        <div style="display: flex;justify-content: space-between;align-items: center;">
                        <?php 
                            $codewaiter = $fetch_w['id_waiter'];
                            $req = "SELECT nom,prenom from user where id in(select distinct id_waiter from tablewaiter where id_waiter = $codewaiter)";
                            $nomwaiter = mysqli_query($conn,$req);
                            $rro = mysqli_fetch_array($nomwaiter);    
                            
                            //total
                            $secreq = mysqli_query($conn, "SELECT SUM(total) AS total FROM teblecomm WHERE id_us = $codewaiter AND date_c = CURRENT_DATE() AND type_paim = 'Cash'");
                            $tot = mysqli_fetch_assoc($secreq);
                            $today_t = $tot['total'];
                            if($today_t == null){
                                $today_t = 0;
                            }
                        ?>
                        <h3 style="padding-top:5px;color:#cda45e;"><img src="assets/img/servant-outline.png"> <?php echo $rro['nom'].' '.$rro['prenom'];?></h3>
                        <div class="buttons" style="padding-left:150px;margin-top: 5px;"><i class="fa-solid fa-sack-dollar" style="margin-top: 3px;margin-right: 3px;"></i><span><b><?php echo $today_t; ?> DH</b></span></div>
                        </div> 
                        <div style="display: flex;flex-flow: row wrap;">
                        <?php 
                            $select_tab = mysqli_query($conn, "SELECT id_table FROM tablewaiter where id_waiter = $codewaiter");
                            if(mysqli_num_rows($select_tab) > 0){
                                while($fetch_d = mysqli_fetch_assoc($select_tab)){
                        ?>
                            <div class="tbwaiter"><b>Table<?php echo $fetch_d['id_table']; ?></b></div>
                            <?php 
                                };
                             };
                            ?>
                            <div style="border-top: 2px solid #000;width: 452px;margin-top: 3%;margin-bottom: 2%;"></div>
                        </div>
                        <?php 
                                };
                            };
                        ?> 
                    </div>
                </div>
                <div class="recent-grid" style="margin-left: 1%;" id="F1">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Waiter Informations</h3>
                            <div class="buttons"><button class="cta-01" id="deleteAllWaiterBtn"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table width="100%" id="tbwaiter"> 
                                <thead>
                                <tr>
                                    <td>FirstName</td>
                                    <td>LastName</td>
                                    <td>Email</td>
                                    <td>Address</td>
                                    <td>PhoneNumber</td>
                                    <td>Password</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = "SELECT * FROM user where role = 'waiter'";
                                    $select_wai = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($select_wai) > 0){
                                        foreach($select_wai as $waiter)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $waiter['nom'] ?></td>
                                                <td><?= $waiter['prenom'] ?></td>                                   
                                                <td><?= $waiter['email'] ?></td>                                    
                                                <td><?= $waiter['adresse'] ?></td>
                                                <td><?= $waiter['telephone'] ?></td>
                                                <td><?= $waiter['password'] ?></td>
                                                <td>
                                                    <div class="buttons"><button class="cta-02" id="qrCodeWaiterBtn" value="<?= $waiter['id'];?>"><span><i class="fa-solid fa-qrcode"></i> Send QR Code</span></button></div>
                                                   <!-- <div class="buttons"><button class="cta-02" id="sendWaiterQr" value=""><span>send QRCode via email</span></button></div>          -->                                       
                                                    <div class="buttons"><button class="cta-02" id="editWaiterBtn" value="<?= $waiter['id'];?>"><span><i class="fas fa-pen"></i> Modify</span></button></div>
                                                    <div class="buttons"><button class="cta-02" id="deleteWaiterBtn" value="<?= $waiter['id'];?>"><span><i class="fas fa-trash"></i> Delete</span></button></div>
                                                </td>
                                            </tr>  
                                            <?php
                                        }
                                    }
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
            </div>

                <div class="recent-grid" style="margin-left: 1%;" id="F10">
                <div class="cardd">
                    <div class="Projects">
                        <div class="card-header">
                            <h3>Contact </h3>
                            <div class="buttons"><button class="cta-01" id="deleteAllcontact"><span><i class="fas fa-trash"></i> Delete All</span></button></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <br>
            </div>
        </main>


        <!--Modal modifier categorie-->
        <div id="my-modal-cat" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>Modify Catégorie</h2>
                </div>
                <div class="modal-body">
                <form id="updateCat">
                <div class="msgWaiter"><p id="errorMessageCat"></p></div>
                <table>
                    <input type="hidden" name="cat_id" id="cat_id">
                        <tr>
                            <td><label>Categorie :</label></td>
                            <td>
                                <input type="text" id="fname_cat" style="width: 200px;" name="fname_cat" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" id="updateC" class="btnmodal" value="Save"></td>                                        
                        </tr>
                </table>
                </form>
                </div>
            </div>
        </div>


        <!--Modal modifier Meal-->
        <div id="my-modal-meal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>Modify Meal</h2>
                </div>
                <div class="modal-body">
                <form id="updateMeal">
                        <div class="msgWaiter"><p id="errorMessageMeal"></p></div>
                        <table>
                            <input type="hidden" name="meal_id" id="meal_id">
                            <tr>
                                <td><label>Image</label></td>
                                <td>
                                <!--<div class="new_Btn"><button>Get File</button></div>-->
                                <input type="file" id="html_btn_m" name="photoo" accept="image/png, image/jpeg" style="color: #000;" required/>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Name </label></td>
                                <td>
                                    <input type="text" id="upmname" style="width: 200px;" name="upmname" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Prix</label>
                                </td>
                                <td>
                                   <input type="number" id="upmpr" style="width: 200px;" name="upmpr" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Description</label></td>
                                <td>
                                <input type="text" id="upmdesc" style="width: 200px;" name="upmdesc" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Categorie</label></td>
                                <td>
                                <select name="categoriee" style="width: 200px;" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                $cat = "SELECT * FROM categorie";
                                $catsel = mysqli_query($conn,$cat);
                                ?>
                                <?php while($row = mysqli_fetch_array($catsel)):?>
                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                <?php endwhile; ?>
                                </select>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" id="updateM" class="btnmodal" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal QR code-->
        <div id="my-modalt" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>QR Code Waiter</h2>
                </div>
                <div class="modal-body">
                    <div id="qrcode" style="display: flex;align-items: center;justify-content: center;">
                       <?php echo $imgqr = "<img src='' id='imgqrcode' width='160'>"; ?>
                    </div>
                    <form id="sendm" style="align-items: center;justify-content: center;display: flex;">
                        <input type="hidden" name="emailwaiter" id="emailwaiter">
                        <input type="hidden" name="qrmessage" id="qrmessage">
                        <input type="submit" id="btnsendemail" name="Sendma" value="Send QR via Email">
                    </form>
                    <div class="btnqrcodee"><button id="btnqr" onclick="window.print();">Save QRCode</button></div>
                </div>
            </div>
        </div>

        <!--modal modifier waiter-->
        <div id="my-modal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>Edit waiter information</h2>
                </div>
                <div class="modal-body">
                    <form id="updateWaiter">
                                <div class="msgWaiter"><p id="errorMessage2"></p></div>
                                <table>
                                    <input type="hidden" name="waiter_id" id="waiter_id">
                                    <tr>
                                                <td><label>First Name</label></td>
                                                <td>
                                                    <input type="text" id="fname_waiter" style="width: 200px;" name="fname_waiter" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Last Name</label></td>
                                                <td><input type="text" id="lname_waiter" style="width: 200px;" name="lastn_waiter" required></td>
                                            </tr>
                                            <tr>
                                                <td><label>Email</label></td>
                                                <td><input type="text" id="age_waiter" style="width: 200px;" name="age_waiter" required></td>
                                            </tr>
                                            <tr>
                                                <td><label>Address</label></td>
                                                <td><input type="text" id="adres_waiter" style="width: 200px;" name="address_waiter" required></td>
                                            </tr>
                                            <tr>
                                                <td><label>Phone Number</label></td>
                                                <td><input type="number" id="tele_waiter" style="width: 200px;" name="tele_waiter" required></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" id="updateW" class="btnmodal" value="Save"></td>                                        
                                            </tr>
                                </table>    
                    </form>
                </div>
            </div>
        </div>

        <!--modal modifier table-->
        <div id="my-modal-table" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close">&times;</div>
                    <h2>Edit Table Information</h2>
                </div>
                <div class="modal-body">
                    <form id="updatetable">
                                <!--<div class="msgt"><p id="errorMessage3"></p></div>-->
                                <table>
                                    <input type="hidden" name="tab_idm" id="tab_idm">
                                            <tr>
                                                <td><label>Nombre de personnes</label></td>
                                                <td>
                                                    <select name="ttable" style="width: 200px;" required>
                                                        <option selected disabled value="">Choose...</option>
                                                        <option value="For 1">For 1</option>
                                                        <option value="For 2">For 2</option>
                                                        <option value="For 3">For 3</option>
                                                        <option value="For 4">For 4</option>
                                                        <option value="For 5">For 5</option>
                                                        <option value="For 6">For 6</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Purpose</label></td>
                                                <td>
                                                    <select name="ppose" style="width: 200px;" required>
                                                        <option selected disabled value="">Choose...</option>
                                                        <option value="Casual">Casual</option>
                                                        <option value="Meeting">Meeting</option>
                                                        <option value="Family">Family</option>
                                                        <option value="Freinds">Freinds</option>
                                                        <option value="Celebration">Celebration</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Emplacement</label></td>
                                                <td>
                                                    <select name="emplacem" style="width: 200px;" required>
                                                        <option selected disabled value="">Choose...</option>
                                                        <?php 
                                                        $emplreq = "SELECT * FROM locationt";
                                                        $emplc = mysqli_query($conn,$emplreq);
                                                        while($row = mysqli_fetch_array($emplc)):?>
                                                        <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" id="updatetab" class="btnmodal" value="Save"></td>                                        
                                            </tr>
                                </table>    
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="assets/js/qrcode.min.js"></script>

    <!--<script src="assets/js/jquery-3.4.1.js"></script>-->
    <script>
        
        //add waiter
        $(document).on('submit', '#saveWaiter',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("saveWaiter", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 200){
                        $('#errorMessage').text(res.message);
                        $('#tbwaiter').load(location.href + " #tbwaiter");
                        $('#saveWaiter')[0].reset();
                        
                    }else if(res.status == 400)
                    {
                        $('#errorMessage').text(res.message);
                        $('#saveWaiter')[0].reset();
                    }
                }
            });
        });

        //add categorie
        $(document).on('submit', '#addcat',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("addcat", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 910){
                        alert(res.message);
                        $('#tbcat').load(location.href + " #tbcat");
                        $('#catmealrl').load(location.href + " #catmealrl");
                        $('#updateMeal').load(location.href + " #updateMeal");

                        
                        $('#addcat')[0].reset();
                        
                    }else if(res.status == 920)
                    {
                        alert(res.message);
                        $('#addcat')[0].reset();
                    }
                }
            });
        });

        //add meal
        $(document).on('submit', '#addmealaj',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("addmealaj", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 901){
                        alert(res.message);
                        $('#tbmeal').load(location.href + " #tbmeal");
                        $('#addmealaj')[0].reset();
                        
                    }else if(res.status == 902)
                    {
                        alert(res.message);
                        $('#addmealaj')[0].reset();
                    }
                }
            });
        });

        //add table
        $(document).on('submit', '#addtable',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("addtable", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 904){
                        alert(res.message);
                        $('#altable').load(location.href + " #altable");
                        $('#tabw').load(location.href + " #tabw");
                        $('#addtt')[0].reset();
                        
                    }else if(res.status == 905)
                    {
                        alert(res.message);
                        $('#addtt')[0].reset();
                    }
                }
            });
        });

         //add emplacement
         $(document).on('submit', '#addemplcment',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("addemplcment", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 909){
                        alert(res.message);
                        $('#addtt').load(location.href + " #addtt");
                        $('#tbempp').load(location.href + " #tbempp");
                        $('#addemplcment')[0].reset();
                        
                    }else if(res.status == 908)
                    {
                        alert(res.message);
                        $('#addemplcment')[0].reset();
                    }
                }
            });
        });

        //add table to waiter
        $(document).on('submit', '#afftabwait',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("afftabwait", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 906){
                        alert(res.message);
                        $('#tabwai').load(location.href + " #tabwai");
                        $('#tabw').load(location.href + " #tabw");
                        
                    }else if(res.status == 907)
                    {
                        alert(res.message);
                        $('#tabw')[0].reset();
                    }
                }
            });
        });
        
        //get info categorie 
        $(document).on('click','#modifyCat', function(){
            var idCat = $(this).val();
            $.ajax({
                type: "GET",
                url: "crud.php?idCat=" + idCat,
                success: function (response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 330){
                        $("#my-modal-cat").css("display", "block");
                        $('#errorMessageCat').text(res.message);
                        $('#cat_id').val(res.data.id_cat);
                        $('#fname_cat').val(res.data.nom_cat);
                    }else if(res.status == 333){
                        $('#errorMessageCat').text(res.message);
                    }
                }
            });
        });


        //get waiter info
        $(document).on('click','#editWaiterBtn', function(){
            var idWaiter = $(this).val();
            //alert(idWaiter);
            $.ajax({
                type: "GET",
                url: "crud.php?idWaiter=" + idWaiter,
                success: function (response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 300){
                        $("#my-modal").css("display", "block");
                        $('#errorMessage2').text(res.message);

                        $('#waiter_id').val(res.data.id);
                        $('#fname_waiter').val(res.data.nom);
                        $('#lname_waiter').val(res.data.prenom);
                        $('#age_waiter').val(res.data.email);
                        $('#adres_waiter').val(res.data.adresse);
                        $('#tele_waiter').val(res.data.telephone);
                    }
                }
            });
        });

        //get Meal info
        $(document).on('click','#modifyMeal', function(){
            var idMeal = $(this).val();
            //alert(idWaiter);
            $.ajax({
                type: "GET",
                url: "crud.php?idMeal=" + idMeal,
                success: function (response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 366){
                        $("#my-modal-meal").css("display", "block");
                        $('#errorMessageMeal').text(res.message);

                        $('#meal_id').val(res.data.code_plat);
                        $('#upmname').val(res.data.nom_plat);
                        $('#upmpr').val(res.data.prix_plat);
                        //$('#html_btn_m').val(res.data.Image_plat);
                        $('#upmdesc').val(res.data.description_plat);
                        //$('#upmcat').val(res.data.id_cat);
                    }else if(res.status == 367){
                        $("#my-modal-meal").css("display", "block");
                        $('#errorMessageMeal').text(res.message);
                    }
                }
            });
        });

         //get table info
         $(document).on('click','#modifytab', function(){
            var idtab = $(this).val();
            $.ajax({
                type: "GET",
                url: "crud.php?idtab=" + idtab,
                success: function (response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 33){
                        $("#my-modal-table").css("display", "block");
                        $('#errorMessage3').text(res.message);

                        $('#tab_idm').val(res.data.id_table);
                    }else if(res.status == 44){
                        $("#my-modal-table").css("display", "block");
                        $('#errorMessage3').text(res.message);
                    }
                }
            });
        });

        $(document).on('click','#qrCodeWaiterBtn', function(){
            $("#my-modalt").css("display", "block");
        });

        //get waiter info (QRcode)
        $(document).on('click','#qrCodeWaiterBtn', function(){
            var idwaiter = $(this).val();
            //alert(idWaiter);
            $.ajax({
                type: "GET",
                url: "crud.php?idw=" + idwaiter,
                success: function (response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 80){
                        var mail = res.data.email;
                        var imageqr = res.data.qrImage;
                        $("#imgqrcode").attr("src", imageqr);
                        document.getElementById('emailwaiter').value = mail;
                        document.getElementById('qrmessage').value = imageqr;
                        //alert(mail);
                        $("#my-modalt").css("display", "block");
                    }
                    else if(res.status == 90){
                        alert(res.message);
                    }
                }
            });
        });

        //delete waiter 
        $(document).on('click','#deleteWaiterBtn', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Waiter ?'))
            {
                var waiter_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_waiter': true,
                        'waiter_id': waiter_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 800){
                            $('#tbwaiter').load(location.href + " #tbwaiter");
                            alert(res.message);
                        }
                        else if(res.status == 900)
                        {
                            alert(res.message);
                            //$('#saveWaiter')[0].reset();
                        }
                    }
                });
            }   
        });

    
        $(document).on('submit', '#sendm',function (e){
            e.preventDefault(); 
           // alert("here");
            var formData = new FormData(this);
            formData.append("sendm", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 888){
                        alert(res.message);
                    }
                    else if(res.status == 777)
                    {
                        alert(res.message);
                    }
                }
            });
        });

        //send email to Customer
        $(document).on('click','#sendQRCustomer', function(e){
            e.preventDefault(); 
                var cust_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'send_mailcus': true,
                        'cust_id': cust_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 2000){
                            alert(res.message);
                        }
                        else if(res.status == 1000)
                        {
                            alert(res.message);
                        }
                    }
                });
        });
         

        //delete reservation table
        $(document).on('click','#supres', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this reservation ?'))
            {
                var res_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_res': true,
                        'res_id': res_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 820){
                            $('#restable').load(location.href + " #restable");
                            $('.olcards').load(location.href + " .olcards");
                            alert(res.message);
                        }
                        else if(res.status == 920)
                        {
                            alert(res.message);
                            //$('#saveWaiter')[0].reset();
                        }
                    }
                });
            }   
        });

        //delete customer 
        $(document).on('click','#deleteCustomer', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Customer ?'))
            {
                var customer_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_customer': true,
                        'customer_id': customer_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 860){
                            $('#tabcustomer').load(location.href + " #tabcustomer");
                            $('#restable').load(location.href + " #restable");
                            $('.olcards').load(location.href + " .olcards");
                            alert(res.message);
                        }
                        else if(res.status == 960)
                        {
                            alert(res.message);
                            //$('#saveWaiter')[0].reset();
                        }
                    }
                });
            }   
        });

        //delete meal
        $(document).on('click','#deleteMeal', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Meal ?'))
            {
                var meal_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_meal': true,
                        'meal_id': meal_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 861){
                            $('#tbmeals').load(location.href + " #tbmeals");
                            alert(res.message);
                        }
                        else if(res.status == 962)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete table
        $(document).on('click','#deletetab', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Table ?'))
            {
                var tab_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_table': true,
                        'tab_id': tab_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 862){
                            $('#altable').load(location.href + " #altable");
                            $('#afftabwait').load(location.href + " #afftabwait");
                            $('#tabwai').load(location.href + " #tabwai");
                            alert(res.message);
                        }
                        else if(res.status == 963)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete table&waiter
        $(document).on('click','#btnspw', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this (Table & Waiter) ?'))
            {
                var tab_idw = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_tableW': true,
                        'tab_idw': tab_idw
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 864){
                            $('#tabwai').load(location.href + " #tabwai");
                            $('#tabw').load(location.href + " #tabw");
                            //$('#ttoew').load(location.href + " #ttoew"); 
                            alert(res.message);
                        }
                        else if(res.status == 965)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete categorie
        $(document).on('click','#deleteCat', function(e){
            e.preventDefault(); 
            if(confirm('Are you sure you want to delete this Catégorie ?'))
            {
                var cat_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_cat': true,
                        'cat_id': cat_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 863){
                            $('#tbcat').load(location.href + " #tbcat");
                            $('#catmealrl').load(location.href + " #catmealrl");
                            $('#tbmeal').load(location.href + " #tbmeal");
                            alert(res.message);
                        }
                        else if(res.status == 964)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all reservation table
        $(document).on('click','#supallres', function(){
            if(confirm('Are you sure you want to delete all Reservation ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_res': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 830){
                            $('#restablee').load(location.href + " #restablee");
                            $('.olcards').load(location.href + " .olcards");
                            alert(res.message);
                        }
                        else if(res.status == 930)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all orders
        $(document).on('click','#supallordersD', function(){
            if(confirm('Are you sure you want to delete all Orders ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_ord': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 830){
                            $('#supallordersDtab').load(location.href + " #supallordersDtab");
                            alert(res.message);
                        }
                        else if(res.status == 930)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });


        //delete all orders waiter
        $(document).on('click','#supallordersW', function(){
            if(confirm('Are you sure you want to delete all Orders waiter ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_ordw': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 830){
                            $('#tabresw').load(location.href + " #tabresw");
                            alert(res.message);
                        }
                        else if(res.status == 930)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all customers
        $(document).on('click','#deleteallcustomers', function(){
            if(confirm('Are you sure you want to delete all Customer ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_cus': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 870){
                            $('#tabcustomer').load(location.href + " #tabcustomer");
                            $('#restable').load(location.href + " #restable");
                            $('.olcards').load(location.href + " .olcards");
                            alert(res.message);
                        }
                        else if(res.status == 970)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        
        //delete all meals
        $(document).on('click','#deleteallMeals', function(){
            if(confirm('Are you sure you want to delete all Meals ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_meals': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 878){
                            $('#tbmeal').load(location.href + " #tbmeal");
                            alert(res.message);
                        }
                        else if(res.status == 977)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all meals
        $(document).on('click','#deleteAllCategorie', function(){
            if(confirm('Are you sure you want to delete all categories ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_cat': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 876){
                            $('#tbcat').load(location.href + " #tbcat");
                            alert(res.message);
                        }
                        else if(res.status == 975)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all emplacement table 
        $(document).on('click','#deleteallempl', function(){
            if(confirm('Are you sure you want to delete all emplacement ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_emp': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 876){
                            $('#tbemp').load(location.href + " #tbemp");
                            $('#altable').load(location.href + " #altable");
                            $('#tabwai').load(location.href + " #tabwai");

                            alert(res.message);
                        }
                        else if(res.status == 975)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });


        //delete all tables
        $(document).on('click','#deletealltable', function(){
            if(confirm('Are you sure you want to delete all tables ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_tab': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 877){
                            $('#altable').load(location.href + " #altable");
                            alert(res.message);
                        }
                        else if(res.status == 978)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //delete all tables&waiter
        $(document).on('click','#deletealltablew', function(){
            if(confirm('Are you sure you want to delete all (table & waiter) ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_tabw': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 879){
                            $('#tabwai').load(location.href + " #tabwai");
                            alert(res.message);
                        }
                        else if(res.status == 971)
                        {
                            alert(res.message);
                        }
                    }
                });
            }   
        });

        //qrCode
        /*$(document).on('click','#qrCodeWaiterBtn', function(){ 
            $('#qrcode').empty();
            var id_Waiter = $(this).val();
            //var username_waiter = 0;
            //alert(id_Waiter);
            var qrcode = new QRCode(document.getElementById('qrcode'));
            qrcode.makeCode(id_Waiter);
            $("#my-modalt").css("display", "block");
            /*$("#qrcode").qrcode({
                mode: 1,
                label:'12COOL',
                fontname:'sans',
                fontcolor:'#000'
            }); 
        });*/

        //delete all waiter's
        $(document).on('click','#deleteAllWaiterBtn', function(){
            if(confirm('Are you sure you want to delete all Waiters ?'))
            {
                $.ajax({
                    type: "POST",
                    url: "crud.php",
                    data: {
                        'delete_all_waiter': true
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if(res.status == 810){
                            $('#tbwaiter').load(location.href + " #tbwaiter");
                            alert(res.message);
                        }
                        else if(res.status == 910)
                        {
                            alert(res.message);
                            //$('#saveWaiter')[0].reset();
                        }
                    }
                });
            }   
        });

        //update waiter
        $(document).on('submit', '#updateWaiter',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("updateWaiter", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 600){
                        $('#errorMessage2').text(res.message);
                        $('#tbwaiter').load(location.href + " #tbwaiter");
                        //$('#saveWaiter')[0].reset();
                        
                    }else if(res.status == 700)
                    {
                        $('#errorMessage2').text(res.message);
                        //$('#saveWaiter')[0].reset();
                    }
                }
            });
        });

        //update Categorie
        $(document).on('submit', '#updateCat',function (e){
            e.preventDefault(); 
            //alert("hello younes");
             
            var formData = new FormData(this);
            formData.append("updateCat", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 660){
                        $('#errorMessageCat').text(res.message);
                        $('#tbcat').load(location.href + " #tbcat");
                        
                    }else if(res.status == 770)
                    {
                        $('#errorMessageCat').text(res.message);
                        //$('#saveWaiter')[0].reset();
                    }
                }
            });
        });

        //update Meal
        $(document).on('submit', '#updateMeal',function (e){
            e.preventDefault(); 
             //alert("erger");
            var formData = new FormData(this);
            formData.append("updateMeal", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 662){
                        $('#errorMessageMeal').text(res.message);
                        $('#tbmeals').load(location.href + " #tbmeals");
                        
                    }else if(res.status == 772)
                    {
                        $('#errorMessageMeal').text(res.message);
                    }
                }
            });
        });


        //update table
        $(document).on('submit', '#updatetable',function (e){
            e.preventDefault(); 
             
            var formData = new FormData(this);
            formData.append("updatetable", true); 
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 662){
                        console.log(res.message);
                        $('#altable').load(location.href + " #altable");
                        
                    }else if(res.status == 772)
                    {
                        console.log(res.message);
                        //$('#saveWaiter')[0].reset();
                    }
                }
            });
        });
        $('#statistiqued').show();
        //closeModal
        $('.close').click(function(){
            $('.modal').css("display", "none");
        });
        $('#addempl').hide();
        $('#addnewem').click(function(){
            $('#addempl').slideToggle();
        });

        $('#customersToaday').hide();
        $('#F4').hide();
        $('#ordersTo').hide();
        $('#clientToday').click(function(){
            $('#customersToaday').show();
            $('#F4').hide();
            $('#ordersTo').hide();
            $('#statistiqued').hide();
        });
        $('#tablerestoday').click(function(){
            $('#customersToaday').hide();
            $('#F4').show();
            $('#ordersTo').hide();
            $('#statistiqued').hide();
        });
        $('#ordersToday').click(function(){
            $('#customersToaday').hide();
            $('#F4').hide();
            $('#ordersTo').show();
            $('#statistiqued').hide();
        });
        $('#statistiqueToday').click(function(){
            //alert('efgeg');
            $('#statistiqued').show();
            $('#customersToaday').hide();
            $('#F4').hide();
            $('#ordersTo').hide();
        });

        //statistiqe
        ctx = document.getElementById('graph1').getContext('2d');
        ctxt = document.getElementById('graph2').getContext('2d');

        var data = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
            label: 'Takeout and Delivery Orders',
            borderColor: 'rgb(255,99,132)',
            data: [<?php echo $res[0]; ?>, <?php echo $res[1]; ?>, <?php echo $res[2]; ?>, <?php echo $res[3]; ?>, <?php echo $res[4]; ?>, <?php echo $res[5]; ?>, <?php echo $res[6]; ?>]
        },
        {
            label: 'Table Reservation',
            borderColor: '#000000',
            data: [<?php echo $restab[0]; ?>,<?php echo $restab[1]; ?>,<?php echo $restab[2]; ?>,<?php echo $restab[3]; ?>,<?php echo $restab[4]; ?>,<?php echo $restab[5]; ?>,<?php echo $restab[6]; ?>]
        }
        ]
        }

        var options

        var config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
            title: {
                display: true,
                text: 'Orders & Reserved tables'
            },
        },
        }
        }

        var data2 = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
            label: 'Income of the week in DH',
            backgroundColor	: '#000000',
            data: [<?php echo $income[0]; ?>,<?php echo $income[1]; ?>,<?php echo $income[2]; ?>,<?php echo $income[3]; ?>,<?php echo $income[4]; ?>,<?php echo $income[5]; ?>,<?php echo $income[6]; ?>]
        }
        ]
        }


        //line chart
        var config2 = {
        type: 'bar',
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Income of the week'
                },
            },
        }
        }

        var graph1 = new Chart(ctx, config);
        var lignch = new Chart(ctxt,config2);

    </script>
    <script src="assets/js/gest.js"></script>
</body>
</html>

<?php
    }else{
      header("Location:index.php");
    }
?>