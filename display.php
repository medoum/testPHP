<?php

include 'connect.php';

if(isset($_POST['displaySend'])){
    $table= '<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N˚</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Tel</th>
            <th scope="col">Adresse</th>
            <th scope="col">Operations</th>

        </tr>
    </thead>';

    $sql= "Select * from `crud`";
    $result = mysqli_query($con, $sql);
    $number=1;

    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $nom=$row['nom'];
        $email=$row['email'];
        $tel=$row['tel'];
        $adresse=$row['adresse'];
        $table .= '<tr>
        <td scope="row">' .$number. '</td>
        <td>' .$nom. '</td>
        <td>' .$email. '</td>
        <td>' .$tel. '</td>
        <td>' .$adresse. '</td>
        <td>
            <button class="btn btn-dark" onclick="UpdateUser('.$id.')">Modifier</button>
            <button class="btn btn-danger" onclick="DeleteUser('.$id.')">Supprimer</button>
        </td>
      </tr>';
      $number++;
    }
    $table.= '</table>';
    echo $table;
}

?>

