<?php

    $con= new mysqli('localhost', 'root', 'root', 'crudphp');

    if(!$con){
        die(mysqli_error($con));
    }
?>