<?php

include_once 'database.php';

if(isset($_POST['Nombre']) && isset($_FILES['Foto']) && isset($_POST['Telefono']) && isset($_POST['Consultorio']) && isset($_POST['Turno']) && isset($_POST['Correo']) && isset($_POST['Apellidos'])
   && isset($_POST['Fecha']) && isset($_POST['Informacion']) && isset($_POST['Especialidad'])){
    $foto;
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellidos'];
    $telefono = $_POST['Telefono'];
    $consultorio = $_POST['Consultorio'];
    $turno = $_POST['Turno'];
    $correo = $_POST['Correo'];
    $fecha = $_POST['Fecha'];
    $especialidad = $_POST['Especialidad'];
    $info = $_POST['Informacion'];

    echo $nombre;

    $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $combLen = strlen($comb) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }
    $Apass= implode($pass);
    $checarSiImagen = getimagesize($_FILES['Foto']['tmp_name']);
    if($checarSiImagen == false){
        $foto = NULL;
    }else{
        $image = $_FILES['Foto']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $foto = $imgContent;
    }
    
    $db = new DB();

    $query = $db->connect()->prepare('SELECT * FROM doctores WHERE correo_dos = :correo');
    $query->execute(['correo' => $correo]);
    $n = $query->rowCount();
    
    $query1 = $db->connect()->prepare('SELECT * FROM doctores WHERE telefono_dos = :telefono');
    $query1->execute(['telefono' => $telefono]);
    $n2 = $query1->rowCount();

    $query2 = $db->connect()->prepare('SELECT * FROM doctores WHERE id_cos_dos = :cons AND id_tur_dos = :tur ');
    $query2->execute(['cons' => $consultorio, 'tur' => $turno]);
    $n3 = $query2 -> rowCount();
    
    if ($n3 > 0){
        echo '<script> alert("Ya esta registrado un doctor en el mismo consultorio y el mismo turno"); window.location.href="../html/adminDoctores.php";  </script>';
    }else{
        if($n > 0 OR $n2 > 0){
            echo '<script> alert("Este usuario ya esta registrado"); window.location.href="../html/adminDoctores.php"; </script>';
        }else{
                
                $query3 = $db->connect()->prepare('INSERT INTO usuarios(id_tus_uss, correo_uss, contrasena_uss) VALUES(:id_tus, :correo, :contrasena)');
                $query3->execute(['id_tus' => 1, 'correo' => $correo, 'contrasena' => $Apass]);
                
                $query4 = $db->connect()->prepare('INSERT INTO doctores(id_uss_dos, id_tur_dos, id_cos_dos, nombre_dos, apellido_dos,foto_dos, fechaNacimiento_dos, telefono_dos, id_ess_dos, informacionRelevante_dos, correo_dos) VALUES(:id_uss, :id_tur, :id_cos, :nombre, :apellido, :foto, :fecha, :telefono, :especialidad, :info, :correo)');
                $query4->execute(['id_uss' => 1, 'id_tur' => $turno,'id_cos' => $consultorio, 'nombre' => $nombre, 'apellido' => $apellido,'foto' => $foto, 'fecha' => $fecha, 'telefono' => $telefono, 'especialidad' => $especialidad, 'info' => $info, 'correo' => $correo]);
                
                mail("$correo","Torre Igeia Consultorios","Ha registrado correctamente en Igeia Tower Medic. \n Con el correo: " . $correo . " con la contraseña temporal: " . $Apass);
                
                echo '<script> alert("Registro Exitoso, Se ha enviado un correo electronico."); window.location.href="../index.php"; </script>';

        }
    }
   }
?>