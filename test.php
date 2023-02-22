<?php
@include 'config.php';
session_start();
//$reqt = "SELECT count(*) from `order` where date_auj in(SELECT date_auj FROM `order` where YEAR(curdate()) = YEAR(date_auj) And WEEK(date_auj) = WEEK(current_date)) and dayname(date_auj)";
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


echo $res[0] . $res[1] . $res[2] . $res[3];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

</head>

<body>
  <canvas id="graph1"></canvas>
  <script>
    //statistiqe

    ctx = document.getElementById('graph1').getContext('2d');

    var data = {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      datasets: [{
        borderColor: 'rgb(255,99,132)',
        data: [<?php echo $res[0]; ?>, <?php echo $res[1]; ?>, <?php echo $res[2]; ?>, <?php echo $res[3]; ?>]
      }]
    }

    var options

    var config = {
      type: 'line',
      data: data,
      options: options
    }
    var graph1 = new Chart(ctx, config);
  </script>
</body>

</html>