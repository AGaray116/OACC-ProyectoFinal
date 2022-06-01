<?php

include_once 'database.php';

if(isset($_POST['Nombre']) && isset($_FILES['Foto']) && isset($_POST['Telefono']) && isset($_POST['Consultorio'])  && isset($_POST['Correo']) && isset($_POST['Apellidos'])
   && isset($_POST['Fecha']) && isset($_POST['Turno'])){
    $foto;
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellidos'];
    $telefono = $_POST['Telefono'];
    $consultorio = $_POST['Consultorio'];
    $correo = $_POST['Correo'];
    $fecha = $_POST['Fecha'];
    $turno = $_POST['Turno'];

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

    $query = $db->connect()->prepare('SELECT * FROM secretarias WHERE correo_ses = :correo');
    $query->execute(['correo' => $correo]);
    $n = $query->rowCount();
    
    $query1 = $db->connect()->prepare('SELECT * FROM secretarias WHERE telefono_ses = :telefono');
    $query1->execute(['telefono' => $telefono]);
    $n2 = $query1->rowCount();

    $query2 = $db->connect()->prepare('SELECT * FROM secretarias WHERE id_cos_ses = :cons AND id_tur_ses = :tur ');
    $query2->execute(['cons' => $consultorio, 'tur' => $turno]);
    $n3 = $query2 -> rowCount();
    
    if ($n3 > 0 ){
        echo '<script> alert("Ya esta registrado una secretaria en el mismo consultorio y el mismo turno"); window.location.href="../html/adminSecretaria.php";  </script>';
    }else{
        if($n > 0 OR $n2 > 0){
            echo '<script> alert("Este usuario ya esta registrado"); window.location.href="../html/adminSecretaria.php"; </script>';
        }else{
                
                $query3 = $db->connect()->prepare('INSERT INTO usuarios(id_tus_uss, correo_uss, contrasena_uss) VALUES(:id_tus, :correo, :contrasena)');
                $query3->execute(['id_tus' => 3, 'correo' => $correo, 'contrasena' => $Apass]);
                
                $query4 = $db->connect()->prepare('INSERT INTO secretarias(id_uss_ses, id_cos_ses, id_tur_ses, nombre_ses, apellido_ses, foto_ses, fechaNacimiento_ses, telefono_ses, correo_ses) 
                                                                    VALUES(:id_uss, :id_cos, :id_tur, :nombre, :apellido, :foto, :fecha, :telefono, :correo)');
                $query4->execute(['id_uss' => 3,'id_cos' => $consultorio, 'id_tur' => $turno, 'nombre' => $nombre, 'apellido' => $apellido,'foto' => $foto, 'fecha' => $fecha, 'telefono' => $telefono, 'correo' => $correo]);
                
                  mail("$correo","Torre Igeia Consultorios","Ha registrado correctamente en Igeia Tower Medic. \n Con el correo: " . $correo . " con la contraseña temporal: " . $Apass);
                echo '<script> alert("Registro Exitoso, Se ha enviado un correo electronico."); window.location.href="../html/adminSecretaria.php";  </script>';
        }
    }
        
   }
?>