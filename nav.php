<?php
    include_once 'PHP/database.php';
    $correo = "admin@admin.com";
    $db = new DB();
    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE correo_uss = :correo');
    $query->execute(['correo' => $correo]);

    $row = $query -> fetch(PDO::FETCH_NUM);
    
    $rol = $row[1];
	$correo = $row[2];
	$_SESSION['rol'] = $rol;
	$_SESSION['user'] = $correo;
?>
<nav class="menu">
    <div class="nose">
        <a href="#" id="btn-nosotros">Nosotros</a>
        <a href="#" id="btn-directorio">Directorio</a>
        <a href="#" id="btn-ubicacion">Ubicacion</a>
        <div class="dropdown nose2" id="nose2">
           
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo "Administración" ?><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <a class="dropdown-item" href="html/administracion_general.php">Panel de Administración</a>  
                    <a class="dropdown-item" href="html/perfil.php">Perfil</a>   
                </ul>
        </div>
    </div>


</nav>