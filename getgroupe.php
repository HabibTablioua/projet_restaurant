<?php
@include 'config.php';
$data = array();
$result = mysqli_query($conn, "SELECT * FROM categorie");
while($row = mysqli_fetch_object($result)){
    array_push($data,$row);
}
echo json_encode($data);
exit();
?>