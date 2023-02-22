<?php
@include 'config.php';
$case = $_POST["id"];
$data = array();
if($case == 0)
{
    $result = mysqli_query($conn, "SELECT * FROM plat");
    while($row = mysqli_fetch_object($result)){
        array_push($data,$row);
    }
}else{
    $result = mysqli_query($conn, "SELECT * FROM plat where id_cat = $case");
    while($row = mysqli_fetch_object($result)){
        array_push($data,$row);
    }
}
echo json_encode($data);
exit();
?>