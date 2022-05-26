<?php
session_start();
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) {
        echo '<script> alert("No tiene permiso para usar esta pagina"); window.location.href="../index.php";  </script>';
    }
} else {
    echo '<script> alert("Debe Iniciar Sesion"); window.location.href="../index.php";  </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Doctor</title>


    <link rel="stylesheet" href="../CSS/estilos1.css">

</head>

<body>

    <header>
        <?php
        include_once 'navVistas.php';
        ?>
        <div class="contenedor1">
            <div class="img">
                <img src="../IMG/logoIgeia.png" alt="" width="100" height="100">
            </div>
            <div class="textos">
                <h3 class="txt">Administración Doctores</h3>
            </div>
            <div class="vacio">
            </div>
        </div>
    </header>

    <section class="main">

        <form action="" method="post" class="signin-form">
            <div class="contenido">
                <input type="text" id="NomDoctor" name="NomDoctor" placeholder="Ibarra" class="nombreDoctor">
                <input type="submit" name="BNDoctor" placeholder="Ibarra" class="button">

            </div>
        </form>
        <?php
        if (isset($_POST['NomDoctor'])) {
            $nombre = $_POST['NomDoctor'];
            $base = $db->connect()->prepare('SELECT a.id_dos, a.foto_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess WHERE a.nombre_dos = :nombre OR a.apellido_dos = :nombre1');
            $base->execute(['nombre' => $nombre, 'nombre1' => $nombre]);
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
        ?>

                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="doctor">

                                <form action="" method="post" class="signin-form">
                                    <div class="cont">

                                        <div class="imagen">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_dos"])) . '"/>'; ?>
                                        </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <input type="hidden" name="id" value="<?php echo $row['id_dos'] ?>">
                                            <label for="NDoctor">Nombre Doctor:</label>
                                            <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ADoctor">Apellido Doctor:</label>
                                            <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_dos'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="Correo">Correo:</label>
                                            <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Fecha">Fecha de Nacimiento:</label>
                                            <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_dos'] ?>">
                                        </div>
                                    </div>

                                    <div class="cont">

                                        <div class="info">
                                            <label for="NTelefono">Numero de telefono:</label>
                                            <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="info">Info:</label>
                                            <input disabled type="text" id="Info" name="Info" value="<?php echo $row['informacionRelevante_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Turno">Turno:</label>
                                            <input disabled type="textarea" id="Turno" name="Turno" value="<?php echo $row['turno_tur'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="info">Especialidad:</label>
                                            <input disabled type="text" id="Especialidad" name="Especialidad" value="<?php echo $row['especialidad_ess'] ?>">
                                        </div>
                                    </div>

                                    <div class="btns">
                                        <button class="btns-admin-crud" >Editar información</button>
                                        <button class="btns-admin-crud" >Eliminar Registro</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>


                <?php      }
            } else {
                echo '<script> alert("El doctor buscado no existe"); window.location.href="../html/adminDoctores.php";  </script>';
            }
        } else {
            $base = $db->connect()->prepare('SELECT a.id_dos, a.foto_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess');
            $base->execute();
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
                ?>

                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="doctor">

                                <form action="" method="post" class="signin-form">
                                    <div class="cont">

                                        <div class="imagen">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_dos"])) . '"/>'; ?>
                                        </div>
                                        <div class="btns">
                                        <button class="btns-admin-crud" >Editar información</button>
                                        <button class="btns-admin-crud" >Eliminar Registro</button>
                                    </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <input type="hidden" name="id" value="<?php echo $row['id_dos'] ?>">
                                            <label for="NDoctor">Nombre Doctor:</label>
                                            <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ADoctor">Apellido Doctor:</label>
                                            <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_dos'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="Correo">Correo:</label>
                                            <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Fecha">Fecha de Nacimiento:</label>
                                            <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_dos'] ?>">
                                        </div>
                                    </div>

                                    <div class="cont">

                                        <div class="info">
                                            <label for="NTelefono">Numero de telefono:</label>
                                            <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="info">Info:</label>
                                            <input disabled type="text" id="Info" name="Info" value="<?php echo $row['informacionRelevante_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Turno">Turno:</label>
                                            <input disabled type="textarea" id="Turno" name="Turno" value="<?php echo $row['turno_tur'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="info">Especialidad:</label>
                                            <input disabled type="text" id="Especialidad" name="Especialidad" value="<?php echo $row['especialidad_ess'] ?>">
                                        </div>
                                    </div>

                                   
                                </form>
                            </div>
                        </div>
                    </section>


        <?php      }
            }
        } ?>




        <form action="" method="post" class="signin-form">
            <div class="buttons">
                <button class="button nuevo" >Agregar nuevo</button>
            </div>
        </form>

    </section>

    <?php
    include_once 'footer.php';
    ?>


</body>

</html>