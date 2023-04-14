<?php

include 'connect.php';

extract($_POST);


if(isset($_POST['nameSend']) 
&& isset($_POST['emailSend']) 
&& isset($_POST['telSend']) 
&& isset($_POST['adresseSend'])){

    $sql= "insert into `crud` (nom, email, tel, adresse)
     values ('$nameSend', '$emailSend', '$telSend', '$adresseSend')";


     $result=mysqli_query($con, $sql);
}

?>