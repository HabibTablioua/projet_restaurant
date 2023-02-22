<?php
@include 'config.php';
session_start();
/* echo $test; */
if(isset($_POST['Book_a_table'])){
    $test=array_id_table();
    $Heure=($_POST['Hour']);
    $Minute=($_POST['minute']);
    $email = test_input($_POST['email']);
    $phone=test_input(($_POST['phone']));
    $date=(($_POST['date']));
    $dateToday=date("Y-m-d");
    $nbp=($_POST['people']);
    $type_paiement=($_POST['paiement']);
    /* $num_table=($_POST['id_table']); */
    $id_location=cherche_id_location($_SESSION['vradio']);
    $id_nom=id_user($_SESSION['username']);
    echo $id_nom;
    if($id_nom!=-1){
        $id_utilisateure=$id_nom;
    }
    if($id_location!=-1){
      $id_loc=$id_location;
    } 
   
	 if(empty($date)){
        header("Location:table.php?error=Date is required&$user_data");
	    exit();
	}
  if(empty($nbp)){
    header("Location:table.php?error=Number of people is required&$user_data");
  exit();
 }
 if(($nbp)<1){
  header("Location:table.php?error=Error Number of people you shoud enter positive number  &$user_data");
exit();
}
	else if(empty($email)){
        header("Location:table.php?error=email is required&$user_data");
	    exit();
	}
  else if(empty($phone)){
      header("Location:table.php?error=Telephone is required&$user_data");
      exit();
  }
  else if($test==-1){
    header("Location:table.php?error=There is no table available in ".$_SESSION['vradio']." &$user_data");
    exit();
}
  else if(empty($nbp)){
    header("Location:table.php?error=number of people is required&$user_data");
    exit();
  }
  else if(empty($Heure)){
    header("Location:table.php?error=Hour is required&$user_data");
    exit();
  }
  else if(empty($Minute)){
    header("Location:table.php?error=Minute is required&$user_data");
    exit();

  }
  else if($date<$dateToday){
    header("Location:table.php?error=Erreur Date");
    exit();
    
  }
  else{
    $sql = "SELECT * From reservationt Where  date_res='$date' and Heure=".$Heure." and Minute=".$Minute." and  id_user=".$id_utilisateure." ";
    $res= mysqli_query($conn ,$sql);
    if(mysqli_num_rows($res)==1){
        header("Location:table.php?error=You already reserved in same date and time try another time&$user_data");
        exit();
    } 
    else{
      $Resultat = mysqli_query($conn, "INSERT INTO reservationt(date_res,nb_personne,id_user,code_locationT,id_table,Heure,Minute) VALUES('$date',".$nbp.",".$id_utilisateure.",".$id_loc.",".$test.",".$Heure.",".$Minute.")");
      if($Resultat){  
          update($test);   
          header('Location:table.php?success1=reserved&table=' . $test);
          exit();
      }
      else{
          header("Location:table.php?error=Erreur");
          exit();
      }
    }   
    }
}
 
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; 
  }
  function id_user($name){
    $conn = mysqli_connect('localhost','root','','cool_db') or die('connection failed');
    $sql = "SELECT * From user Where nom='$name'";
    $res= mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);  
    $id=-1;
    if(is_array($row)){ 
        $id=$row['id'];
    } 
    return $id;
  }
 
  function cherche_id_location($nom_location){
    $conn = mysqli_connect('localhost','root','','cool_db') or die('connection failed');
    $sql = "SELECT code_locationT  From locationt Where nom_LocationT='$nom_location'";
    $res= mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);  
    $ch=-1;
    if(is_array($row)){ 
        $ch=$row['code_locationT'];
    } 
    return $ch;
  }
  function update($nb_t){
    $conn = mysqli_connect('localhost','root','','cool_db') or die('connection failed');
    mysqli_query($conn, "UPDATE table_res SET disponible = 'non' where id_table = ".$nb_t."");
  }  
  function array_id_table(){
    $les_id_table=array();
    $test=$_SESSION['vradio'];
    $conn = mysqli_connect('localhost','root','','cool_db') or die('connection failed');
    $sql ="SELECT id_table from table_res,locationt where table_res.code_locationt=locationt.code_locationt and locationt.nom_LocationT='$test' and table_res.disponible='oui';";
    $res= mysqli_query($conn ,$sql);
    if(mysqli_num_rows($res) > 0){
      while($fetch_id_table = mysqli_fetch_assoc($res)){
        array_push($les_id_table,$fetch_id_table['id_table']);   
      }
      return $les_id_table[0];
    }
    else{
      return -1;
    }
    
  }

















 /* function time($id){
    $conn = mysqli_connect('localhost','root','','cool_db') or die('connection failed');
    $sql = "SELECT 	Heure  From reservationt Where 	id_res='".$id."'";
    $res= mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);  
    $ch=0;
    if(is_array($row)){ 
        $ch=intval($row['Heure']);
    }
    $ch=$ch+2;
    $ret=false;
    if(intval(date("h")) >= $ch){
      $ret=true;
    } 
    return $ret;
  }*/






?>