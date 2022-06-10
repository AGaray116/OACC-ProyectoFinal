<nav class="menu">
    <div class="nose">
        <a href="../index.php" id="btn-nosotros" class="txtNav">Inicio</a>
        <div class="dropdown nose2" id="nose2">
            <?php require '../PHP/database.php';
           
            $comprobar = isset($_SESSION['rol']) && $_SESSION['user'];
            error_reporting(0);
            if ($comprobar == "True") {
                $correo = $_SESSION['user'];
                $db = new DB();
                if ($_SESSION['rol'] == 1) {
                    $query = $db->connect()->prepare('SELECT nombre_dos, apellido_dos FROM doctores WHERE correo_dos = :correo');
                    $query->execute(['correo' => $correo]);

                    if ($query->rowCount() > 0) {
                        $row = $query->fetch(PDO::FETCH_NUM);
                        $nombre = $row[0] . " " . $row[1];
                    }
                }
                if ($_SESSION['rol'] == 2) {
                    $query = $db->connect()->prepare('SELECT nombre_ads, apellido_ads FROM administradores WHERE correo_ads = :correo');
                    $query->execute(['correo' => $correo]);
                    if ($query->rowCount() > 0) {
                        $row = $query->fetch(PDO::FETCH_NUM);
                        $nombre = $row[0] . " " . $row[1];
                    }
                }
                if ($_SESSION['rol'] == 3) {
                    $query = $db->connect()->prepare('SELECT nombre_ses, apellido_ses FROM secretarias WHERE correo_ses = :correo');
                    $query->execute(['correo' => $correo]);
                    if ($query->rowCount() > 0) {
                        $row = $query->fetch(PDO::FETCH_NUM);
                        $nombre = $row[0] . " " . $row[1];
                    }
                }
                if ($_SESSION['rol'] == 4) {
                    $query = $db->connect()->prepare('SELECT nombre_pas, apellido_pas FROM pacientes WHERE correo_pas = :correo');
                    $query->execute(['correo' => $correo]);
                    if ($query->rowCount() > 0) {
                        $row = $query->fetch(PDO::FETCH_NUM);
                        $nombre = $row[0] . " " . $row[1];
                    }
                }


            ?>
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $nombre ?><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php
                    if ($_SESSION['rol'] == 1) {
                    ?>
                        <div>
                            <a class="dropdown-item" href="perfil.php">Perfil</a>
                        </div>
                        <div>
                            <a class="dropdown-item" href="../PHP/cerrar_sesion.php">Cerrar Sesión</a>
                        </div>
                    <?php
                    }
                    if ($_SESSION['rol'] == 2) {
                    ?>  
                        <div>
                        <a class="dropdown-item" href="perfil.php">Perfil</a>
                        </div>
                        <div>
                        <a class="dropdown-item" href="administracion_general.php">Panel de Administración</a>
                        </div>
                        <div>
                        <a class="dropdown-item" href="../PHP/cerrar_sesion.php">Cerrar Sesión</a>
                        </div>
                    <?php
                    }
                    if ($_SESSION['rol'] == 3) {
                    ?>
                        <div>
                        <a class="dropdown-item" href="perfil.php">Perfil</a>
                        </div>
                        <div><a class="dropdown-item" href="../PHP/cerrar_sesion.php">Cerrar Sesión</a></div>
                    <?php
                    }
                    if ($_SESSION['rol'] == 4) {
                    ?>
                        <div><a class="dropdown-item" href="perfil.php">Perfil</a></div>
                        <div><a class="dropdown-item" href="../PHP/cerrar_sesion.php">Cerrar Sesión</a></div>
                    <?php
                    }
                } else {
                    ?>
                    <button class="btn btn-primary" type="button" onclick="window.location.href='html/iniciarSesion.html'">Iniciar Sesión</button>
                <?php
                }
                ?>
        </div>
    </div>


</nav>