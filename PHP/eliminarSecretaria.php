<?php

include_once 'database.php';



if(isset($_POST['id'])){

    $id = $_POST['id'];

    $db = new DB();

    $query2 = $db->connect()->prepare('SELECT correo_ses FROM secretarias WHERE id_ses = :id');
    $query2 -> execute(['id' => $id]);
    $row = $query2 -> fetch(PDO::FETCH_NUM);
    $correo = $row['0'];

    $query3 = $db->connect()->prepare('SELECT id_uss FROM usuarios WHERE correo_uss = :correo');
    $query3 -> execute(['correo' => $correo]);
    $row2 = $query3 -> fetch(PDO::FETCH_NUM);
    $usuario = $row2['0'];

    
    $query3 = $db->connect()->prepare('DELETE FROM secretarias WHERE id_ses = :id');
    $query3->execute(['id' => $id]);

    $query4 = $db->connect()->prepare('DELETE FROM usuarios WHERE id_uss = :id');
    $query4->execute(['id' => $usuario]);
    echo '<script> alert("Se ha eliminado el registro."); window.location.href="../html/adminSecretaria.php";  </script>';
}
?>