<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Secretaria</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
    <link rel="stylesheet" href="../CSS/botonesAdministracion.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/body.css">
    <link rel="stylesheet" href="../CSS/nav.css">


</head>

<body>

    <header>
        <?php
        include_once 'navVistas.php';
        ?>
        <div class="contenedor1">
            <div class="img">
                <img src="../Img/logoIgeia.png" alt="" width="100" height="100">
            </div>
            <div class="textos">
                <h3 class="txt">Administración Secretarias</h3>
            </div>
            <div class="vacio">

            </div>
        </div>
    </header>


    <section class="main">
        <form action="" method="post" class="signin-form">
            <div class="busqueda">
                <input type="text" id="NomSecretaria" name="NomSecretaria" placeholder="Secre" class="nombreDoctor">
                <input type="submit" name="BNDoctor" placeholder="Ibarra" class="btns-admin-crud"> <br>
                <button class="btns-admin-crud" onclick="this.form.action='nuevaSecretaria.php'; this.form.submit();">Agregar nuevo</button>
            </div>
        </form>
        <?php
        if (isset($_POST['NomSecretaria'])) {
            $nombre = $_POST['NomSecretaria'];
            $base = $db->connect()->prepare('CALL buscarSecretarias(:nombre)');
            $base->execute(['nombre' => $nombre]);
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
        ?>

                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="secretaria tamanoSecre">
                                <form action="" method="post" class="signin-form">
                                    <div class="cont">
                                        <div class="imagen">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_ses"])) . '"/>'; ?>
                                        </div>
                                        <div class="btns">
                                            <button class="btns-admin-crud" onclick="this.form.action='modificarSecretaria.php';this.form.submit();">Editar información</button>
                                            <button class="btns-admin-crud" onclick="this.form.action='../PHP/eliminarSecretaria.php';this.form.submit();">Eliminar Registro</button>
                                        </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <input type="hidden" name="id" value="<?php echo $row['id_ses'] ?>">
                                            <label for="NSecretaria">Nombre Secretaria:</label>
                                            <input disabled type="text" id="NSecretaria" name="NSecretaria" value="<?php echo $row['nombre_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ASecretaria">Apellido Secretaria:</label>
                                            <input disabled type="text" id="ASecretaria" name="ASecretaria" value="<?php echo $row['apellido_ses'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="Correo">Correo:</label>
                                            <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>
                                    </div>

                                    <div class="cont">
                                        <div class="info">
                                            <label for="Fecha">Fecha de Nacimiento:</label>
                                            <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NTelefono">Numero de telefono:</label>
                                            <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_ses'] ?>">
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </section>


                <?php      }
            } else {
                echo '<script> alert("La secretaria buscada no existe"); window.location.href="../html/adminDoctores.php";  </script>';
            }
        } else {
            $base = $db->connect()->prepare('SELECT a.id_ses, a.nombre_ses, a.apellido_ses, a.foto_ses, a.id_cos_ses, b.consultorios_cos , a.correo_ses, a.fechaNacimiento_ses , a.telefono_ses FROM secretarias a INNER JOIN consultorios b ON id_cos_ses = id_cos');
            $base->execute();
            $num = $base->rowCount();

            if ($num > 0) {
                while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <section class="cards-admin">
                        <div class="contenido">
                            <div class="secretaria tamanoSecre">
                                <form action="" method="post" class="signin-form">
                                    <div class="cont">
                                        <div class="imagen">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_ses"])) . '"/>'; ?>
                                        </div>
                                        <div class="btns">
                                            <button class="btns-admin-crud" onclick="this.form.action='modificarSecretaria.php';this.form.submit();">Editar información</button>
                                            <button class="btns-admin-crud" onclick="this.form.action='../PHP/eliminarSecretaria.php';this.form.submit();">Eliminar Registro</button>
                                        </div>
                                    </div>


                                    <div class="cont">
                                        <div class="info">
                                            <input type="hidden" name="id" value="<?php echo $row['id_ses'] ?>">
                                            <label for="NSecretaria">Nombre Secretaria:</label>
                                            <input disabled type="text" id="NSecretaria" name="NSecretaria" value="<?php echo $row['nombre_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="ASecretaria">Apellido Secretaria:</label>
                                            <input disabled type="text" id="ASecretaria" name="ASecretaria" value="<?php echo $row['apellido_ses'] ?>">
                                        </div>

                                        <div class="info">
                                            <label for="Correo">Correo:</label>
                                            <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NConsultorio">Numero de Consultorio:</label>
                                            <input disabled type="text" id="NConsultorio" name="NConsultorio" value="<?php echo $row['consultorios_cos'] ?>">
                                        </div>
                                    </div>

                                    <div class="cont">
                                        <div class="info">
                                            <label for="Fecha">Fecha de Nacimiento:</label>
                                            <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_ses'] ?>">
                                        </div>
                                        <div class="info">
                                            <label for="NTelefono">Numero de telefono:</label>
                                            <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_ses'] ?>">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>

</html>