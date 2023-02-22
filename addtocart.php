<?php
@include 'config.php';
$id = $_POST["idu"];
$name = $_POST["nom"];
$prix = $_POST["prix"];
$image = $_POST["image"];


$query = "SELECT * FROM cart WHERE nom_cart = '$name' AND id = $id";
$fetchelem = mysqli_query($conn, $query);
if(mysqli_num_rows($fetchelem) > 0){
    exit();
}else
{
    $oldxm="INSERT INTO cart(nom_cart,price,imagee,quantity,id) VALUES('$name','$prix','$image',1,$id)";
    if (mysqli_query($conn,$oldxm)) 
    {
        echo "1";
    }
    else
    {   
        echo "0";
        echo "Error: ". mysqli_error($conn);
    }
    exit();
}
?>