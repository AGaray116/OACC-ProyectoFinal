<?php

include_once 'database.php';

if(isset($_POST['id']) && isset($_POST['Nombre']) && isset($_POST['Telefono']) && isset($_POST['Consultorio']) && isset($_POST['Apellidos']) && isset($_POST['Informacion'])){

    $id = $_POST['id'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellidos'];
    $telefono = $_POST['Telefono'];
    $consultorio = $_POST['Consultorio'];
    $informacion = $_POST['Informacion'];
    $turno = $_POST['Turno'];

    $db = new DB();

    

    $query = $db->connect()->prepare('SELECT * FROM doctores WHERE id_cos_dos = :cons AND id_tur_dos = :tur ');
    $query->execute(['cons' => $consultorio, 'tur' => $turno]);
    $n = $query -> rowCount();

    if ($n > 0){
        echo '<script> alert("Ya esta registrado un doctor en el mismo consultorio y el mismo"); window.location.href="../html/adminDoctores.php";  </script>';
    }else{
        $query3 = $db->connect()->prepare('UPDATE doctores SET nombre_dos = :nombre, apellido_dos = :apellido, telefono_dos = :telefono, id_cos_dos = :consultorio, informacionRelevante_dos =:info WHERE id_dos = :id');
        $query3->execute(['nombre' => $nombre, 'apellido' => $apellido, 'telefono' => $telefono, 'consultorio' => $consultorio,'info' => $informacion, 'id' => $id]);
        
        
        echo '<script> alert("Cambio Exitoso, Se ha modificado el registro."); window.location.href="../html/adminDoctores.php";  </script>';
    }
    
            
    
   }
?>