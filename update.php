<?php

include 'connect.php';

if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];

    $sql = "Select * from `crud` where id=$user_id";
    $result= mysqli_query($con, $sql);
    $response = array();
    while($row=mysqli_fetch_assoc($result)){
        $response= $row;
    }
    echo json_encode($response);
}else{
    $response['status'] = 200;
    $response['message'] = "Invalide ou données non trouvée";
}



// Update query

if(isset($_POST['hiddendata'])){
    $uniqueid = $_POST['hiddendata'];
    $nom= $_POST['updatename'];
    $email= $_POST['updateemail'];
    $tel= $_POST['updatetel'];
    $adresse= $_POST['updateadresse'];

    $sql = "update `crud` set nom='$nom', email='$email', tel='$tel', adresse='$adresse' where id=$uniqueid";

    $result=mysqli_query($con, $sql);
}
?>