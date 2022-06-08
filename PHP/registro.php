
<?php

include_once 'database.php';

if(isset($_POST['Nombre']) && isset($_POST['Telefono']) && isset($_POST['Correo']) && isset($_POST['Contrasena']) && isset($_POST['Apellidos'])
   && isset($_POST['Fecha']) && isset($_POST['Confirmar'])){
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellidos'];
    $telefono = $_POST['Telefono'];
    $correo = $_POST['Correo'];
    $fecha = $_POST['Fecha'];
    $contrasena = $_POST['Contrasena'];
    $confirmar = $_POST['Confirmar'];
    $foto;
   

    $checarSiImagen = getimagesize($_FILES['Foto']['tmp_name']);
    if($checarSiImagen == false){
        $foto = NULL;
    }else{
        $image = $_FILES['Foto']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $foto = $imgContent;
         
    }
    
    $db = new DB();

    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE correo_uss = :correo');
    $query->execute(['correo' => $correo]);
    $n = $query->rowCount();
   
    
    

    if($n > 0 ){
        echo '<script> alert("Este usuario ya esta registrado"); window.location.href="../html/registro.html"; </script>';
    }else{
        if($contrasena == $confirmar){
            
       
            $query3 = $db->connect()->prepare('INSERT INTO usuarios(id_tus_uss, correo_uss, contrasena_uss) VALUES(:id_tus, :correo, :contrasena)');
            
            $query3->execute(['id_tus' => 4, 'correo' => $correo, 'contrasena' => $contrasena]);
            
            $query4 = $db->connect()->prepare('INSERT INTO pacientes(id_uss_pas, foto_pas, nombre_pas, apellido_pas, fechaNacimiento_pas, telefono_pas, correo_pas) VALUES(:id_uss, :foto, :nombre, :apellido, :fechaNacimiento, :telefono, :correo)');
            $query4->execute(['id_uss' => 0, 'foto' => $foto, 'nombre' => $nombre, 'apellido' => $apellido, 'fechaNacimiento' => $fecha, 'telefono' => $telefono, 'correo' => $correo]);
            echo '<script> alert("Registro Exitoso, Se ha enviado un correo electronico."); window.location.href="../index.php"; </script>';
            mail("$correo","Torre Igeia Consultorios","Usted se ha registrado correctamente con el correo " . $correo);
        }else{
            echo '<script> alert("Verifica Tus contraseñas"); window.location.href="../html/registro.html"; </script>';
        }
    }
   }
?>