<?php
    include_once 'database.php';

    if(isset($_POST['Contra']) && isset($_POST['VContra'])){
        $contra = $_POST['Contra'];
        $verificar = $_POST['VContra'];
        $id = $_POST['id'];
        if($contra == $verificar){
            $db = new DB();
            session_start();
            $correo = $_SESSION['user'];
            $query = $db->connect()->prepare('SELECT id_uss FROM usuarios WHERE  correo_uss = :correo');
            $query->execute(['correo' => $correo]);
            $n = $query -> rowCount();
            if($n > 0){
                $row = $query -> fetch(PDO::FETCH_NUM);
                $usuario = $row[0];
                $query1 = $db->connect()->prepare('UPDATE usuarios SET contrasena_uss = :contra WHERE id_uss = :id');
                $query1->execute(['contra' => $contra, 'id' => $usuario]);
            }

            
            
            echo '<script> alert("Cambio existoso."); window.location.href="../html/perfil.php";  </script>';
        }else{
            echo '<script> alert("Contraseñas no coinciden"); window.location.href="../html/perfil.php";  </script>';
        }
    }

?>