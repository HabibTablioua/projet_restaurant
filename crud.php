<?php

@include 'config.php';
session_start();
include('phpqrcode/qrlib.php');


require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;





//Add Waiter
if(isset($_POST['saveWaiter'])){
    $firstname = mysqli_real_escape_string($conn, $_POST['fname_waiter']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastn_waiter']);
    $age = mysqli_real_escape_string($conn, $_POST['age_waiter']);
    $address = mysqli_real_escape_string($conn, $_POST['address_waiter']);
    $tele = mysqli_real_escape_string($conn, $_POST['tele_waiter']); 
    $passww = mysqli_real_escape_string($conn, $_POST['password_waiter']); 

    $checkWaiter = mysqli_query($conn, "SELECT * FROM user WHERE nom = '$firstname' and prenom = '$lastname'");
    if(mysqli_num_rows($checkWaiter) > 0)
    {
        $res = [
            'status' => 400,
            'message' => 'Waiter exists already !!'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        //generate QR code
        $path = 'qrcode/';
        $file = $path.uniqid().".png";
        $ecc = 'L';
        $pixel_Size = 20;
        $frame_Size = 10;
        $getmid = mysqli_query($conn, 'SELECT MAX(id) as maxid FROM `user`');
        $maxid = mysqli_fetch_assoc($getmid);
        $id = $maxid['maxid'] + 1;
        $lfnameid = $id.$lastname.$firstname;


        $query = "INSERT INTO user(nom,prenom,email,password,role,adresse,telephone,qrImage) VALUES('$firstname','$lastname','$age','$passww','waiter','$address','$tele','$file')";
        $addwaiter = mysqli_query($conn, $query); 
        if($addwaiter)
        {
            QRcode::png($lfnameid,$file,$ecc,$pixel_Size,$frame_Size);
            $res = [
                'status' => 200,
                'message' => 'Waiter Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Waiter not Created'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

//Add order waiter
if(isset($_POST['frmwait'])){
    $typep = mysqli_real_escape_string($conn, $_POST['typepai']);
    date_default_timezone_set("Africa/Casablanca");
    $date = date('Y-m-d');
    $time = date('H:i');
    $nbpersone = mysqli_real_escape_string($conn, $_POST['nbpersone']);
    $idtab = mysqli_real_escape_string($conn, $_POST['idtab']);
    $id_user = $_SESSION["id_waiter"];

    $cart_q = mysqli_query($conn, "SELECT * from `cart` where id = $id_user");
    if (mysqli_num_rows($cart_q) > 0) {
     while ($meal = mysqli_fetch_assoc($cart_q)) {
        $meal_name[] = $meal['nom_cart'] . ' (' . $meal['quantity'] . ' )';
     }
    }
    $totalmeals = implode(', ', $meal_name);
    $total = $_SESSION['totalm'];
        $query = "INSERT into teblecomm(id_table,date_c,heure,nb_pers,type_paim,meal_q,total,id_us) VALUES($idtab,'$date','$time',$nbpersone,'$typep','$totalmeals',$total,$id_user)";
        $addwaiter = mysqli_query($conn, $query); 
        if($addwaiter)
        {
            $supp = mysqli_query($conn, "DELETE from cart where id = $id_user");
            $disp = mysqli_query($conn, "UPDATE table_res set disponible = 'non' where id_table = $idtab");
            $res = [
                'status' => 206,
                'message' => 'Order Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 406,
                'message' => 'Order not Created'
            ];
            echo json_encode($res);
            return false;
        }
    
}


//update res table
if(isset($_POST['frmrestb'])){
    $typep = mysqli_real_escape_string($conn, $_POST['typepai']);
    $idres = mysqli_real_escape_string($conn, $_POST['idres']);
    $id_user = $_SESSION["userid"];

    $cart_q = mysqli_query($conn, "SELECT * from `cart` where id = $id_user");
    if (mysqli_num_rows($cart_q) > 0) {
     while ($meal = mysqli_fetch_assoc($cart_q)) {
        $meal_name[] = $meal['nom_cart'] . ' (' . $meal['quantity'] . ' )';
     }
    }
    $totalmeals = implode(', ', $meal_name);
    $total = $_SESSION['totalm'];
        $query = "UPDATE reservationt SET meals_q = '$totalmeals' , total = $total, typepai = '$typep' where id_res = $idres";
        $addwaiter = mysqli_query($conn, $query); 
        if($addwaiter)
        {
            $supp = mysqli_query($conn, "DELETE from cart where id = $id_user");
            $res = [
                'status' => 206,
                'message' => 'Meals added Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 406,
                'message' => 'Meals not Created'
            ];
            echo json_encode($res);
            return false;
        }
    
}

//add meal
if(isset($_POST['addmealaj'])){

    //$img_meal = mysqli_real_escape_string($conn, $_POST['name_cat']);
    $image = mysqli_real_escape_string($conn,$_FILES["photo"]["name"]);
    $tmp_image = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($tmp_image,"assets/img/$image");
    $name= mysqli_real_escape_string($conn,$_POST['meal_name']);
    $prix = mysqli_real_escape_string($conn,$_POST['prix_meal']);
    $desc = mysqli_real_escape_string($conn,$_POST['desc']);
    $categorie = mysqli_real_escape_string($conn,$_POST['categorie']);



    $checkcat = mysqli_query($conn, "SELECT * FROM plat WHERE nom_plat = '$name'");
    if(mysqli_num_rows($checkcat) > 0)
    {
        $res = [
            'status' => 902,
            'message' => 'Meal exists already !!'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $query = "INSERT INTO plat(nom_plat,prix_plat,Image_plat,description_plat,id_cat) values('$name','$prix','$image','$desc',$categorie)";
        $addcategorie = mysqli_query($conn, $query); 
        if($addcategorie)
        {
            $res = [
                'status' => 901,
                'message' => 'Meal Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 902,
                'message' => 'Meal not Created'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

//add table
if(isset($_POST['addtable'])){

    $type_table = 'For '.mysqli_real_escape_string($conn,$_POST['typetable']);
    $purpose =  mysqli_real_escape_string($conn,$_POST['purpose']);
    $emplacement = mysqli_real_escape_string($conn,$_POST['emplacement']);
    $disponible = 'oui';

        $query = "INSERT INTO table_res(code_locationT,type_res,purpose,disponible) VALUES($emplacement,'$type_table','$purpose','$disponible')";
        $addtab = mysqli_query($conn, $query); 
        if($addtab)
        {
            $res = [
                'status' => 904,
                'message' => 'Table Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 905,
                'message' => 'Table not Created'
            ];
            echo json_encode($res);
            return false;
        }
}

//add emplacement
if(isset($_POST['addemplcment'])){
    $image = mysqli_real_escape_string($conn,$_FILES["img_emplc"]["name"]);
    $tmp_image = $_FILES["img_emplc"]["tmp_name"];
    move_uploaded_file($tmp_image,"assets/img/$image");
    $name_emplc =  mysqli_real_escape_string($conn,$_POST['nameemplc']);

    $checkcat = mysqli_query($conn, "SELECT * FROM locationt WHERE nom_LocationT = '$name_emplc'");
    if(mysqli_num_rows($checkcat) > 0)
    {
        $res = [
            'status' => 908,
            'message' => 'Emplacement exists already !!'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $query = "INSERT INTO locationt(image_LocationT,nom_LocationT) VALUES('$image','$name_emplc')";
        $addtab = mysqli_query($conn, $query); 
        if($addtab)
        {
            $res = [
                'status' => 909,
                'message' => 'Emplacement Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 908,
                'message' => 'Emplacement not Created'
            ];
            echo json_encode($res);
            return false;
        }
    }
}


//add table to waiter
if(isset($_POST['afftabwait'])){

    $idwaiter = mysqli_real_escape_string($conn,$_POST['idwaiter']);
    $idtable =  mysqli_real_escape_string($conn,$_POST['idtable']);

        $query = "INSERT INTO tablewaiter(id_waiter,id_table) VALUES($idwaiter,$idtable)";
        $addtabw = mysqli_query($conn, $query); 
        if($addtabw)
        {
            $res = [
                'status' => 906,
                'message' => 'Table assigned Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 907,
                'message' => 'Table not assigned'
            ];
            echo json_encode($res);
            return false;
        }
}

//change table avalibility
if(isset($_POST['changeav'])){

    $av = mysqli_real_escape_string($conn,$_POST['availl']);
    $idtable =  mysqli_real_escape_string($conn,$_POST['idtt']);

        $query = "UPDATE table_res SET disponible = '$av' WHERE id_table = $idtable";
        $addtabw = mysqli_query($conn, $query); 
        if($addtabw)
        {
            $res = [
                'status' => 7,
                'message' => 'Table availaible'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 8,
                'message' => 'Table not availaible'
            ];
            echo json_encode($res);
            return false;
        }
}

//add categorie
if(isset($_POST['addcat'])){

    $nom_cat = mysqli_real_escape_string($conn, $_POST['name_cat']);

    $checkcat = mysqli_query($conn, "SELECT * FROM categorie WHERE nom_cat = '$nom_cat'");
    if(mysqli_num_rows($checkcat) > 0)
    {
        $res = [
            'status' => 920,
            'message' => 'Categorie exists already !!'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $query = "INSERT INTO categorie(nom_cat) values('$nom_cat')";
        $addcategorie = mysqli_query($conn, $query); 
        if($addcategorie)
        {
            $res = [
                'status' => 910,
                'message' => 'Categorie Created Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 920,
                'message' => 'Categorie not Created'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

//Find Waiter
if(isset($_GET['idWaiter']))
{
    $idWaiter = mysqli_real_escape_string($conn, $_GET['idWaiter']);
    $query = "SELECT * FROM user where id = '$idWaiter'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $waiter = mysqli_fetch_array($query_run);
        $res = [
            'status' => 300,
            'message' => 'Waiter Fetch Successfully',
            'data' => $waiter
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 100,
            'message' => 'Waiter Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}

//Find Categorie
if(isset($_GET['idCat']))
{
    $idCat = mysqli_real_escape_string($conn, $_GET['idCat']);
    $query = "SELECT * FROM categorie where id_cat = '$idCat'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $waiter = mysqli_fetch_array($query_run);
        $res = [
            'status' => 330,
            'message' => 'Waiter Fetch Successfully',
            'data' => $waiter
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 333,
            'message' => 'Waiter Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}

//Find table
if(isset($_GET['idtab']))
{
    $idtab = mysqli_real_escape_string($conn, $_GET['idtab']);
    $query = "SELECT * FROM table_res where id_table = '$idtab'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $table = mysqli_fetch_array($query_run);
        $res = [
            'status' => 33,
            'message' => 'table Fetch Successfully',
            'data' => $table
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 44,
            'message' => 'table Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}
//Find Meal
if(isset($_GET['idMeal']))
{
    $idMeal = mysqli_real_escape_string($conn, $_GET['idMeal']);
    $query = "SELECT * FROM plat where code_plat = '$idMeal'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $waiter = mysqli_fetch_array($query_run);
        $res = [
            'status' => 366,
            'message' => 'Meal Fetch Successfully',
            'data' => $waiter
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 367,
            'message' => 'Meal Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}

//Find waiter
if(isset($_GET['idw']))
{
    $idMeal = mysqli_real_escape_string($conn, $_GET['idw']);
    $query = "SELECT * FROM user where id = '$idMeal'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $waiter = mysqli_fetch_array($query_run);
        $res = [
            'status' => 80,
            'message' => 'waiter Fetch Successfully',
            'data' => $waiter
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 90,
            'message' => 'waiter Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}

/*Find user
if(isset($_GET['iduser']))
{
    $iduser = mysqli_real_escape_string($conn, $_GET['iduser']);
    $query = "SELECT * FROM user where id = '$iduser'";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) == 1)
    {
        $user = mysqli_fetch_array($query_run);
        $res = [
            'status' => 10,
            'message' => 'user Fetch Successfully',
            'data' => $user
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 20,
            'message' => 'user Id Not Found',
        ];
        echo json_encode($res);
        return false;
    }
}*/

//Update Waiter
if(isset($_POST['updateWaiter'])){
    $idWaiter = mysqli_real_escape_string($conn, $_POST['waiter_id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['fname_waiter']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastn_waiter']);
    $age = mysqli_real_escape_string($conn, $_POST['age_waiter']);
    $address = mysqli_real_escape_string($conn, $_POST['address_waiter']);
    $tele = mysqli_real_escape_string($conn, $_POST['tele_waiter']); 


        $query = "UPDATE user SET nom ='$firstname', prenom = '$lastname', email = '$age',adresse = '$address',telephone = '$tele' WHERE id = '$idWaiter'";
        $updatewaiter = mysqli_query($conn, $query); 
        if($updatewaiter)
        {
            $res = [
                'status' => 600,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 700,
                'message' => 'Update Failed'
            ];
            echo json_encode($res);
            return false;
        }
}

//Update Meal
if(isset($_POST['updateMeal'])){
    $idmeal = mysqli_real_escape_string($conn, $_POST['meal_id']);
    $nommeal = mysqli_real_escape_string($conn, $_POST['upmname']);
    $prixmeal = mysqli_real_escape_string($conn, $_POST['upmpr']);
    $descriptionmeal = mysqli_real_escape_string($conn, $_POST['upmdesc']);
    $imagemeal = mysqli_real_escape_string($conn,$_FILES["photoo"]["name"]);
    $tmp_image = $_FILES["photoo"]["tmp_name"];  
    $id_cat = mysqli_real_escape_string($conn, $_POST['categoriee']); 


        $query = "UPDATE plat SET nom_plat ='$nommeal', prix_plat = '$prixmeal', Image_plat = '$imagemeal',description_plat = '$descriptionmeal',id_cat = '$id_cat' WHERE code_plat = '$idmeal'";
        $updateM = mysqli_query($conn, $query); 
        if($updateM)
        {
            $res = [
                'status' => 662,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 772,
                'message' => 'Update Failed'
            ];
            echo json_encode($res);
            return false;
        }
}

//Update user

if(isset($_POST['modifyUser'])){
    $iduser = mysqli_real_escape_string($conn, $_POST['user_id']);
    $firstn = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastn = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['number']);
    $addres = mysqli_real_escape_string($conn, $_POST['addres']);
    //$password = mysqli_real_escape_string($conn, $_POST['password']); 

        $query = "UPDATE user SET nom ='$firstn', prenom = '$lastn', email = '$email',adresse = '$addres',telephone = '$phone' WHERE id = '$iduser'";
        $updateM = mysqli_query($conn, $query); 
        if($updateM)
        {
            $_SESSION['username'] = $firstn;
            $res = [
                'status' => 30,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 40,
                'message' => 'Update Failed'
            ];
            echo json_encode($res);
            return false;
        }
}

//Update user password

if(isset($_POST['modifyUserpass'])){
    $iduser = mysqli_real_escape_string($conn, $_POST['user_id']);
    $currentpass = mysqli_real_escape_string($conn, $_POST['oldpassw']);
    $newpass = mysqli_real_escape_string($conn, $_POST['passw']);
    $newpasst = mysqli_real_escape_string($conn, $_POST['passtwo']);
    $oldp = mysqli_query($conn, "SELECT password FROM user WHERE id = $iduser");
    $gtpss = mysqli_fetch_assoc($oldp);
    $passol = $gtpss['password'];

    if($newpass == $newpasst && $currentpass == $passol)
    {

        $query = "UPDATE user SET password = '$newpass' WHERE id = '$iduser'";
        $updateM = mysqli_query($conn, $query); 
        if($updateM)
        {
            //$_SESSION['username'] = $firstn;
            $res = [
                'status' => 30,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 40,
                'message' => 'Update Failed '
            ];
            echo json_encode($res);
            return false;
        }
    }else
    {
        $res = [
            'status' => 40,
            'message' => 'update Failed !! '
        ];
        echo json_encode($res);
        return false;
    }
}

//Update Categorie
if(isset($_POST['updateCat'])){

    $id_cat = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $nom_cat = mysqli_real_escape_string($conn, $_POST['fname_cat']);
        $query = "UPDATE categorie SET nom_cat = '$nom_cat' WHERE id_cat = '$id_cat'";
        $updateCat = mysqli_query($conn, $query); 
        if($updateCat)
        {
            $res = [
                'status' => 660,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 770,
                'message' => 'Update Failed'
            ];
            echo json_encode($res);
            return false;
        }
}

//Delete Waiter
if(isset($_POST['delete_waiter'])){
    $waiter_id = mysqli_real_escape_string($conn, $_POST['waiter_id']);
    $query = "DELETE FROM user WHERE id = '$waiter_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 800,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 900,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Update table
if(isset($_POST['updatetable'])){

    $id_tab = mysqli_real_escape_string($conn, $_POST['tab_idm']);

    $type = mysqli_real_escape_string($conn, $_POST['ttable']);
    $purpose = mysqli_real_escape_string($conn, $_POST['ppose']);
    $emplacement = mysqli_real_escape_string($conn, $_POST['emplacem']);

        $query = "UPDATE table_res SET 	code_locationT = $emplacement , type_res = '$type' , purpose = '$purpose' WHERE id_table = '$id_tab'";
        $updatetable = mysqli_query($conn, $query); 
        if($updatetable)
        {
            $res = [
                'status' => 662,
                'message' => 'Update passed Successfully'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 772,
                'message' => 'Update Failed'
            ];
            echo json_encode($res);
            return false;
        }
}

//Update quantity cart
if(isset($_POST['frmq'])){

    $id_cart = mysqli_real_escape_string($conn, $_POST['update_quantity_id']);
    $quant = mysqli_real_escape_string($conn, $_POST['update_quantity']);
    $query = "UPDATE cart SET quantity = $quant where id_cart = $id_cart";
    $updatetable = mysqli_query($conn, $query); 
    if($updatetable)
    {
        $res = [
            'status' => 76,
            'message' => 'update passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 75,
            'message' => 'update Failed'
        ];
        echo json_encode($res);
        return false;
    }
        
}

//delete reservation table
if(isset($_POST['delete_res'])){
    $res_id = mysqli_real_escape_string($conn, $_POST['res_id']);
    $query = "DELETE FROM reservationt WHERE id_res = '$res_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 820,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 920,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete customer
if(isset($_POST['delete_customer'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $query = "DELETE FROM user WHERE role = 'client' AND id = '$cus_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 860,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 960,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete meal
if(isset($_POST['delete_meal'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['meal_id']);
    $query = "DELETE FROM plat WHERE code_plat = '$cus_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 861,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 962,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete meal from cart(user)
if(isset($_POST['delete_meal_cart'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['meal_idc']);
    $query = "DELETE FROM cart WHERE id_cart = $cus_id";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 77,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 78,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete table
if(isset($_POST['delete_table'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['tab_id']);
    $query = "DELETE FROM table_res WHERE id_table = '$cus_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 862,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 963,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete table&waiter
if(isset($_POST['delete_tableW'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['tab_idw']);
    $query = "DELETE FROM tablewaiter WHERE id_table = '$cus_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 864,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 965,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//delete categorie
if(isset($_POST['delete_cat'])){
    $cus_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $query = "DELETE FROM categorie WHERE id_cat = '$cus_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 863,
            'message' => 'Delete passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 964,
            'message' => 'Delete Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All reservation table
if(isset($_POST['delete_all_res'])){
    $query = "DELETE FROM reservationt";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 830,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 930,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All orders
if(isset($_POST['delete_all_ord'])){
    $query = "DELETE FROM `order`";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 830,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 930,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All orders waiter
if(isset($_POST['delete_all_ordw'])){
    $query = "DELETE FROM `teblecomm`";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 830,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 930,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}



//Button Delete All custumer's
if(isset($_POST['delete_all_cus'])){
    $query = "DELETE FROM user where role = 'client'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 870,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 970,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All meals
if(isset($_POST['delete_all_meals'])){
    $query = "DELETE FROM plat";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 878,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 977,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All categories
if(isset($_POST['delete_all_cat'])){
    $query = "DELETE FROM categorie";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 876,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 975,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All waiter
if(isset($_POST['delete_all_waiter'])){
    $query = "DELETE FROM user WHERE role = 'waiter'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 810,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 910,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All tables
if(isset($_POST['delete_all_tab'])){
    $query = "DELETE FROM table_res";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 877,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 978,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}


//Button Delete All emplacement table
if(isset($_POST['delete_all_emp'])){
    $query = "DELETE FROM locationt";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 876,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 975,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All tables&waiter
if(isset($_POST['delete_all_tabw'])){
    $query = "DELETE FROM tablewaiter";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 879,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 971,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button hide reservation user
if(isset($_POST['delete_all_restabu'])){
    $id_user = $_SESSION["userid"];
    $query = "UPDATE reservationt SET condition_res = 'hide' WHERE id_user = $id_user";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 11,
            'message' => ' All reservation are deleted '
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 12,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}
//Button hide orders user
if(isset($_POST['delete_all_orders'])){
    $id_user = $_SESSION["userid"];
    $query = "UPDATE `order` SET condord = 'hide' WHERE id = $id_user";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 13,
            'message' => ' All orders are deleted '
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 14,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button Delete All from cart
if(isset($_POST['delete_all_cart'])){
    $us_id = mysqli_real_escape_string($conn, $_POST['id_us']);
    $query = "DELETE FROM cart where id = $us_id";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 101,
            'message' => 'Delete all passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 102,
            'message' => 'Delete all Failed'
        ];
        echo json_encode($res);
        return false;
    }
}

//Button update quantity
/*if(isset($_POST['update_quant_cart'])){
    $id_c = mysqli_real_escape_string($conn, $_POST['id_cart']);
    $query = "UPDATE cart SET quantity = $val_q where id_cart = $id_c";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $res = [
            'status' => 76,
            'message' => 'update passed Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 75,
            'message' => 'update Failed'
        ];
        echo json_encode($res);
        return false;
    }
}*/

//send QRcode via mail 'waiter'

if(isset($_POST['sendm'])){
    $wai_mail =  mysqli_real_escape_string($conn, $_POST['emailwaiter']);
    $qrmessage = $_POST['qrmessage'];
    $imgcode = '/'.$qrmessage;
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->CharSet="UTF-8";
    $mail->Port = "587";
    $mail->Username = "resto12cool@gmail.com";//old pass :12COO@Lresto
    $mail->Password = "rfteblflzrxnhllo"; 
    $mail->Subject="Your Qr Code";
    $mail->setFrom('resto12cool@gmail.com','Admin 12COOL Restaurant');
    $mail->addAddress($wai_mail);
    $mail->isHTML(true);
    $mail->Body='<img src="cid:heret">';//Use Qr Code for fast and safe login 
    $mail->AddEmbeddedImage(dirname(__FILE__) . $imgcode, 'heret');

    //$mail->addAttachment($qrmessage, 'Demo_Files/Images');
    if($mail->send()){
        $res = [
            'status' => 777,
            'message' => 'qr send via email'
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 888,
            'message' => 'qr not send via email'
        ];
        echo json_encode($res);
        return false;
    }
    $mail->smtpClose();
}

//send QRcode via mail 'customer'

if(isset($_POST['send_mailcus'])){
    $id_cus =  mysqli_real_escape_string($conn, $_POST['cust_id']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id_cus'");
    $fetch_us = mysqli_fetch_array($query);
    $email = $fetch_us['email'];
    $qrimg = $fetch_us['qrImage'];
    $imgcode = '/'.$qrimg;

   
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "resto12cool@gmail.com";
    $mail->Password = "rfteblflzrxnhllo";
    $mail->Subject="Your Qr Code";
    $mail->setFrom("resto12cool@gmail.com");
    $mail->isHTML(true);
    $mail->Body='<img src="cid:here">';
    $mail->AddEmbeddedImage(dirname(__FILE__) . $imgcode, 'here');
    $mail->addAddress($email);
    if($mail->send()){
        $res = [
            'status' => 2000,
            'message' => 'qr send via email'
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 1000,
            'message' => 'qr not send via email'
        ];
        echo json_encode($res);
        return false;
    }
    $mail->smtpClose();
    
}

//login
if (isset($_POST['frmlogin'])) {
    $username =  mysqli_real_escape_string($conn, $_POST['name']);
    $pass =  mysqli_real_escape_string($conn, $_POST['password']);

    $sql ="SELECT * From user WHERE nom='$username' AND password='$pass'  AND confk = 1";
    $res= mysqli_query($conn ,$sql);
    $row = mysqli_fetch_array($res);  
   if(is_array($row)){
     if($row['role']=='admin'){
        $_SESSION['username'] =$username;
        $_SESSION['pass'] = $pass;
        $_SESSION['logi'] =true;
        //header('Location:dashadmin.php');
        $res = [
            'status' => 7,
            'message' => 'Admin'
            ];
            echo json_encode($res);
            return false;
      }
      else if($row['role']=='client')
      {
        $sqltwo = "SELECT id FROM user WHERE nom='$username' AND password='$pass'";
        $_SESSION['username'] =$username;
        $_SESSION["userid"] = trim($row["id"]);
        $_SESSION['pass'] = $pass;
        $_SESSION['logi'] =true;
        //header('Location:home.php');
        $res = [
            'status' => 8,
            'message' => 'customer'
            ];
            echo json_encode($res);
            return false;
      }  
      else if($row['role']=='waiter'){
        $sqltwo = "SELECT id FROM user WHERE nom='$username' AND password='$pass'";
        $_SESSION['name'] =$username;
        $_SESSION['id_waiter'] = trim($row["id"]);
        $_SESSION['lname'] = $row['prenom'];
        $_SESSION['pass'] = $pass;
        $_SESSION['logi'] =true;
        //header('Location:profilewaiter.php');
        $res = [
            'status' => 9,
            'message' => 'waiter'
            ];
            echo json_encode($res);
            return false;
        }
    }
    else{
      //header('Location:index.php');
      $_POST['name']="";
      $pass ="";
      $res = [
        'status' => 10,
        'message' => 'You have entered an invalid username or password !!'
        ];
        echo json_encode($res);
        return false;
    }
}

//register
if (isset($_POST['frmsignup'])) {

     $username = mysqli_real_escape_string($conn, $_POST['nom']);
     $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $pass = mysqli_real_escape_string($conn, $_POST['pass']);
     $com_pass= mysqli_real_escape_string($conn, $_POST['Cpass']);
     //$adresse= mysqli_real_escape_string($conn, $_POST['adresse']);
     //$telephone= mysqli_real_escape_string($conn, $_POST['telephone']);
     $role='client';

     $sqlm = "SELECT * From user Where email='$email'";
     $ressm = mysqli_query($conn ,$sqlm);

     //$sqlt = "SELECT * From user Where telephone= $telephone";
     //$resst = mysqli_query($conn ,$sqlt);
     
	if($pass != $com_pass){
        $res = [
            'status' => 12,
            'message' => 'The confirmation password does not match'
            ];
            echo json_encode($res);
            return false;
	}else if(mysqli_num_rows($ressm)>=1){
        $res = [
            'status' => 12,
            'message' => 'The e-mail is taken try another one !'
            ];
            echo json_encode($res);
            return false;
    }
    /*else if(mysqli_num_rows($resst)>=1){
        $res = [
            'status' => 12,
            'message' => 'The phone number is taken try another one !'
            ];
            echo json_encode($res);
            return false;
    }*/
    else{
        $sql = "SELECT * From user Where nom='$username' and  prenom='$prenom' ";
        $ress= mysqli_query($conn ,$sql);
        if(mysqli_num_rows($ress)==1){
            //header("Location:index.php?error=The username is taken try another&$user_data");
            $res = [
                'status' => 12,
                'message' => 'The username is taken try another one !'
                ];
                echo json_encode($res);
                return false;
        } 
        /*else if(strlen($telephone) < 10){
            $res = [
                'status' => 12,
                'message' => 'The phone number is less than 10 !'
                ];
                echo json_encode($res);
                return false;
        }*/
        else if(strlen($pass) < 8){
            $res = [
                'status' => 12,
                'message' => 'The password is less than 8 !'
                ];
                echo json_encode($res);
                return false;
        }
        else
        {
            $path = 'qrcode/';
            $file = $path.uniqid().".png";
            $ecc = 'L';
            $pixel_Size = 20;
            $frame_Size = 10;
            $getmid = mysqli_query($conn, "SELECT MAX(id) as maxid FROM `user`");
            $maxid = mysqli_fetch_assoc($getmid);
            $id = $maxid['maxid'] + 1;

            $long_key = 15;
            $key = "";
            for($i = 1;$i < $long_key;$i++){
                $key .= mt_rand(0,9);
            }

          $query ="INSERT INTO user(nom,prenom,email,password,role,qrImage,confirmkey)VALUES ('$username','$prenom','$email','$pass','$role','$file','$key')";
          $Resultat= mysqli_query($conn ,$query);
          if($Resultat){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->CharSet="UTF-8";
            $mail->Port = "587";
            $mail->Username = "resto12cool@gmail.com";
            $mail->Password = "rfteblflzrxnhllo";
            $mail->Subject="Confirm Account";
            $mail->setFrom("resto12cool@gmail.com");
            $mail->isHTML(true);
            $mail->Body="<div>
                <p>Your vérification code : <b>. $key .</b></p>
            </div>";
            $mail->addAddress($email);
            $mail->send();
            $mail->smtpClose();

            $res = [
                'status' => 11,
                'message' => 'Your account has been created successfully'//Your account has been created successfully
                ];
                echo json_encode($res);
                return false;
            /*$qur = mysqli_query($conn, "SELECT id FROM user WHERE nom = '$username' And prenom = '$prenom'");
            $idu = mysqli_fetch_assoc($qur);
            $id = $idu['id'];
            $lfnameid = $id.$prenom.$username;
            QRcode::png($lfnameid,$file,$ecc,$pixel_Size,$frame_Size);*/

            
            
            //Your account has been created successfully
            $res = [
                'status' => 11,
                'message' => 'You will receive a confirmation email ('.$email.')'
                ];
                echo json_encode($res);
                return false; 
      
          }else{
           // header("Location:index.php?error=unknown error occurred&$user_data");
           $res = [
            'status' => 12,
            'message' => 'Unknown error occurred !!'
            ];
            echo json_encode($res);
            return false;
          }
        
        }

    }
}
if (isset($_POST['frmconf'])) {
    $key =  mysqli_real_escape_string($conn, $_POST['keyverf']);

    $sql = mysqli_query($conn, "SELECT max(id) as 'idclt' from user");
    $idyus = mysqli_fetch_assoc($sql);
    $idclt = $idyus['idclt'];
    $sqlt = mysqli_query($conn, "SELECT confirmkey from user where id = $idclt");
    $keyu = mysqli_fetch_assoc($sqlt);
    $keyuser = $keyu['confirmkey'];

    if($keyuser == $key){
        $updateus = mysqli_query($conn, "UPDATE user SET confk = 1 where id = $idclt");
        $res = [
            'status' => 30,
            'message' => 'Account verified '
            ];
            echo json_encode($res);
            return false;
    }else{
        $res = [
            'status' => 40,
            'message' => 'Key not correct !! '
            ];
            echo json_encode($res);
            return false;
    }
}

if (isset($_POST['frmsendcont'])) {
    $iduser =  mysqli_real_escape_string($conn, $_POST['iduser']);
    $subject =  mysqli_real_escape_string($conn, $_POST['subject']);
    $message =  mysqli_real_escape_string($conn, $_POST['message']);

        $query = "INSERT INTO contactus(subject,message,idus) values('$subject','$message',$iduser)";
        $addcategorie = mysqli_query($conn, $query); 
        if($addcategorie)
        {
            $res = [
                'status' => 10,
                'message' => 'Contact passed succesfuly'
            ];
            echo json_encode($res);
            return false;
        }
        else
        {
            $res = [
                'status' => 20,
                'message' => 'Erreur Contact'
            ];
            echo json_encode($res);
            return false;
        }
            

}
?>