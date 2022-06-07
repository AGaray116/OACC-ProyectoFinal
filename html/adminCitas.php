<?php
include_once '../PHP/database.php';
$db = new DB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Citas</title>


    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
    <link rel="stylesheet" href="../CSS/botonesAdministracion.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/body.css">

</head>

<body>

    <header>
        
        <div class="contenedor1">
            <div class="img">
                <img src="../Img/logoIgeia.png" alt="" width="100" height="100">
            </div>
            <div class="textos">
                <h3 class="txt">Administración Citas</h3>
            </div>
            <div class="vacio">
            </div>
        </div>
    </header>


    <section class="main">
        <form action="" method="post" class="signin-form">
            <div class="busqueda">
                <input type="text" id="NomDoctor" name="NomDoctor" placeholder="Ibarra" class="nombreDoctor">
                <input type="submit" name="BNDoctor" placeholder="Ibarra" class="btns-admin-crud"> <br>
                <button class="btns-admin-crud" onclick="this.form.action='citasTotales.php'; this.form.submit();">Ver número de citas agendadas del mes</button>
            </div>
        </form>
        <?php
        if (isset($_POST['NomDoctor'])) {
            $nombre = $_POST['NomDoctor'];
            $base = $db->connect()->prepare('CALL buscarDoctorCitas(:nombre)');
            $base->execute(['nombre' => $nombre]);
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
        ?>

                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="secretaria">

                                <form action="" method="post" class="signin-form">
                                    <div class="cont">
                                        <div class="imagen">
                                            <img src="../Img/instagram-gc42c84e67_640.png" alt="" class="foto">
                                        </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <label for="NDoctor">Nombre Doctor:</label>
                                            <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ADoctor">Apellido Doctor:</label>
                                            <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Especialidad">Especialidad:</label>
                                            <input disabled type="text" id="especialida" name="especialidad" value="<?php echo $row['especialidad_ess'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>

                                    </div>

                                    <div class="cont">
                                        <div class="info">
                                            <label for="Fecha">Fecha de Cita:</label>
                                            <input disabled type="text" name="Fecha" value="<?php echo $row['fecha_cts'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Horario">Hora:</label>
                                            <input disabled type="text" id="hora" name="hora" value="<?php echo $row['horas_hcs'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NPaciente">Nombre del Paciente:</label>
                                            <input disabled type="text" id="NPaciente" name="NPaciente" value="<?php echo $row['nombre_pas'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="APaciente">Apellido del Paciente:</label>
                                            <input disabled type="text" id="APaciente" name="APaciente" value="<?php echo $row['apellido_pas'] ?>">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>


                <?php      }
            } else {
                echo '<script> alert("El doctor buscado no existe"); window.location.href="../html/adminCitas.php";  </script>';
            }
        } else {
            $base = $db->connect()->prepare('SELECT b.nombre_dos, b.apellido_dos, d.especialidad_ess, c.consultorios_cos, a.fecha_cts, e.horas_hcs, f.nombre_pas, f.apellido_pas FROM citas a INNER JOIN doctores b ON a.id_dos_cts = b.id_dos INNER JOIN consultorios c ON b.id_cos_dos = c.id_cos INNER JOIN especialidades d ON b.id_ess_dos = d.id_ess INNER JOIN horarios_citas e ON a.id_hcs_cts =e.id_hcs INNER JOIn pacientes f ON a.id_pas_cts = f.id_pas ');
            $base->execute();
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="secretaria">

                                <form action="" method="post" class="signin-form">
                                    <div class="cont">
                                        <div class="imagen">
                                            <img src="../Img/instagram-gc42c84e67_640.png" alt="" class="foto">
                                        </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <label for="NDoctor">Nombre Doctor:</label>
                                            <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ADoctor">Apellido Doctor:</label>
                                            <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_dos'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Especialidad">Especialidad:</label>
                                            <input disabled type="text" id="especialida" name="especialidad" value="<?php echo $row['especialidad_ess'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>

                                    </div>

                                    <div class="cont">
                                        <div class="info">
                                            <label for="Fecha">Fecha de Cita:</label>
                                            <input disabled type="text" name="Fecha" value="<?php echo $row['fecha_cts'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="Horario">Hora:</label>
                                            <input disabled type="text" id="hora" name="hora" value="<?php echo $row['horas_hcs'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NPaciente">Nombre del Paciente:</label>
                                            <input disabled type="text" id="NPaciente" name="NPaciente" value="<?php echo $row['nombre_pas'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="APaciente">Apellido del Paciente:</label>
                                            <input disabled type="text" id="APaciente" name="APaciente" value="<?php echo $row['apellido_pas'] ?>">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>
        <?php      }
            }
        } ?>

    </section>


    <?php
    include_once 'footer.php';
    ?>

   

</body>

</html>