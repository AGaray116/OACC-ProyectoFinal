<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/body.css">
</head>

<body>

    <header>
        <?php
        include_once 'navVistas.php';
        ?>
        <div class="contenedor1">
            <div class="img">
                <img class="logo" src="../Img/logoIgeia.png" alt="" width="100" height="100">
            </div>

            <div class="textos">
                <h3 class="txt">Perfil</h3>
            </div>
            <div>

            </div>
        </div>
    </header>
    <section class="main">
        <?php


        $comprobar = isset($_SESSION['rol']) && $_SESSION['user'];
        if (isset($_GET['cambiardir'])) {
            $cambiardir = 1;
        } else {
            $cambiardir = 0;
        }

        error_reporting(0);
        if ($comprobar == "True") {
            $correo = $_SESSION['user'];

            $db = new DB();

            if ($_SESSION['rol'] == 1) {
                $query = $db->connect()->prepare('SELECT a.id_dos, a.foto_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess WHERE a.correo_dos = :correo');
                $query->execute(['correo' => $correo]);
                $num = $query->rowCount();
                if ($num > 0) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>

                        <section class="cards-admin">
                            <div class="contenido">
                                <div class="secretaria">

                                    <form action="../PHP/cambiarContra.php" method="post" class="signin-form">
                                        <div class="cont">
                                            <input type="hidden" name="id" value="<?php echo $row['id_dos'] ?>">
                                            <div class="imagen">
                                                <?php
                                                echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_dos"])) . '"/>'; ?>
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

                                </div>
                            </div>
                        </section>
                        <div class="contrasena">
                            <div class="cambio">
                                

                                <input type="password" name="Contra" class="input" placeholder="Ingrese Contraseña">
                                <input type="password" name="VContra" class="input" placeholder="Confirme Contraseña">
                                <div class="btns">
                                    <button class="buttonCambio" this.form.action='../PHP/cambiarContra.php' ; this.form.submit();>Cambiar Contraseña</button>
                                </div>
                                </form>
                            </div>


                        <?php      }
                }
            }
            if ($_SESSION['rol'] == 2) {
                $query = $db->connect()->prepare('SELECT a.id_ads, a.nombre_ads, a.apellido_ads, a.correo_ads, a.fechaNacimiento_ads, a.telefono_ads FROM administradores a WHERE a.correo_ads = :correo');
                $query->execute(['correo' => $correo]);
                $num = $query->rowCount();
                if ($num > 0) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                            <section class="cards-admin">
                                <div class="contenido">
                                    <div class="secretaria">

                                        <form action="../PHP/cambiarContra.php" method="post" class="signin-form">
                                            <div class="cont">
                                                <div class="info">
                                                    <input type="hidden" name="id" value="<?php echo $row['id_ads'] ?>">
                                                    <label for="NDoctor">Nombre Administrador:</label>
                                                    <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_ads'] ?>">
                                                </div>
                                                <div class="info">
                                                    <label for="ADoctor">Apellido Administrador:</label>
                                                    <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_ads'] ?>">
                                                </div>

                                                <div class="info">
                                                    <label for="Correo">Correo:</label>
                                                    <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_ads'] ?>">
                                                </div>

                                            </div>

                                            <div class="cont">

                                                <div class="info">
                                                    <label for="NTelefono">Numero de telefono:</label>
                                                    <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_ads'] ?>">
                                                </div>
                                                <div class="info">
                                                    <label for="Fecha">Fecha de Nacimiento:</label>
                                                    <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_ads'] ?>">
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </section>
                            <div class="contrasena">
                                <div class="cambio">
                                    

                                    <input type="password" name="Contra" class="input" placeholder="Ingrese Contraseña">
                                    <input type="password" name="VContra" class="input" placeholder="Confirme Contraseña">
                                    <div class="btns">
                                        <button class="buttonCambio" this.form.action='../PHP/cambiarContra.php' ; this.form.submit();>Cambiar Contraseña</button>
                                    </div>
                                    </form>
                                </div>


                            <?php      }
                    }
                }
                if ($_SESSION['rol'] == 3) {
                    $query = $db->connect()->prepare('SELECT a.id_ses, a.foto_ses, a.nombre_ses, a.apellido_ses, a.correo_ses, b.consultorios_cos, a.fechaNacimiento_ses, a.telefono_ses FROM secretarias a INNER JOIN consultorios b ON a.id_cos_ses = b.id_cos WHERE a.correo_ses = :correo');
                    $query->execute(['correo' => $correo]);
                    $num = $query->rowCount();
                    if ($num > 0) {
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                                <section class="cards-admin">
                                    <div class="contenido">
                                        <div class="secretaria">

                                            <form action="../PHP/cambiarContra.php" method="post" class="signin-form">
                                                <div class="cont">
                                                    <input type="hidden" name="id" value="<?php echo $row['id_ses'] ?>">
                                                    <div class="imagen">
                                                        <?php
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_ses"])) . '"/>'; ?>
                                                    </div>
                                                </div>


                                                <div class="cont">
                                                    <div class="info">

                                                        <label for="NDoctor">Nombre Secretaria:</label>
                                                        <input disabled type="text" id="NDoctor" name="NDoctor" value="<?php echo $row['nombre_ses'] ?>">
                                                    </div>
                                                    <div class="info">
                                                        <label for="ADoctor">Apellido Secretaria:</label>
                                                        <input disabled type="text" id="ADoctor" name="ADoctor" value="<?php echo $row['apellido_ses'] ?>">
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

                                        </div>
                                    </div>
                                </section>
                                <div class="contrasena">
                                    <div class="cambio">
                                        

                                        <input type="password" name="Contra" class="input" placeholder="Ingrese Contraseña">
                                        <input type="password" name="VContra" class="input" placeholder="Confirme Contraseña">
                                        <div class="btns">
                                            <button class="buttonCambio" this.form.action='../PHP/cambiarContra.php' ; this.form.submit();>Cambiar Contraseña</button>
                                        </div>
                                        </form>
                                    </div>


                                    <?php      }
                            }
                        }
                        if ($_SESSION['rol'] == 4) {
                            $query = $db->connect()->prepare('SELECT a.id_pas, a.foto_pas, a.nombre_pas, a.apellido_pas, a.correo_pas, a.fechaNacimiento_pas, a.telefono_pas FROM pacientes a WHERE a.correo_pas = :correo');
                            $query->execute(['correo' => $correo]);
                            $num = $query->rowCount();
                            if ($num > 0) {
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    if ($cambiardir == 0) {
                                        $link = "perfil.php?cambiardir=1";
                                    ?>

                                        <section class="cards-admin">
                                            <div class="contenido">
                                                <div class="secretaria">

                                                    <form action="../PHP/cambiarContra.php" method="post" class="signin-form">
                                                        <div class="cont">
                                                            <input type="hidden" name="id" value="<?php echo $row['id_pas'] ?>">
                                                            <div class="imagen">
                                                                <?php
                                                                echo '<img src="data:image/jpeg;base64,' . base64_encode(stripslashes($row["foto_pas"])) . '"/>'; ?>
                                                            </div>
                                                        </div>


                                                        <div class="cont">
                                                            <div class="info">

                                                                <label for="NPaciente">Nombre Paciente:</label>
                                                                <input disabled type="text" id="NPaciente" name="NPaciente" value="<?php echo $row['nombre_pas'] ?>">
                                                            </div>
                                                            <div class="info">
                                                                <label for="APaciente">Apellido Paciente:</label>
                                                                <input disabled type="text" id="APaciente" name="APaciente" value="<?php echo $row['apellido_pas'] ?>">
                                                            </div>

                                                            <div class="info">
                                                                <label for="Correo">Correo:</label>
                                                                <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_pas'] ?>">
                                                            </div>

                                                        </div>

                                                        <div class="cont">
                                                            <div class="info">
                                                                <label for="Fecha">Fecha de Nacimiento:</label>
                                                                <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_pas'] ?>">
                                                            </div>
                                                            <div class="info">
                                                                <label for="NTelefono">Numero de telefono:</label>
                                                                <input disabled type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_pas'] ?>">
                                                            </div>

                                                        </div>
                                                        <div class="buttons">
                                                            <a href="<?php echo $link ?>" class="button" onlick=""> Editar Información</a>

                                                        </div>

                                                </div>
                                            </div>
                                        </section>
                                        <div class="contrasena">
                                            <div class="cambio">
                                                

                                                <input type="password" name="Contra" class="input" placeholder="Ingrese Contraseña">
                                                <input type="password" name="VContra" class="input" placeholder="Confirme Contraseña">
                                                <div class="btns">
                                                    <button class="buttonCambio" this.form.action='../PHP/cambiarContra.php' ; this.form.submit();>Cambiar Contraseña</button>
                                                </div>
                                                </form>
                                            </div>
                                        <?php   } else { ?>
                                            <section class="cards-admin">
                                                <div class="contenido">
                                                    <div class="secretaria">

                                                        <form action="" method="post" class="signin-form" enctype="multipart/form-data">
                                                            <div class="cont">
                                                                <input type="hidden" name="id" value="<?php echo $row['id_pas'] ?>">
                                                                <div class="button">
                                                                    <input class="input-file" name="Foto" type="file">
                                                                </div>
                                                            </div>


                                                            <div class="cont">
                                                                <div class="info">

                                                                    <label for="NPaciente">Nombre Paciente:</label>
                                                                    <input type="text" id="NPaciente" name="NPaciente" value="<?php echo $row['nombre_pas'] ?>">
                                                                </div>
                                                                <div class="info">
                                                                    <label for="APaciente">Apellido Paciente:</label>
                                                                    <input type="text" id="APaciente" name="APaciente" value="<?php echo $row['apellido_pas'] ?>">
                                                                </div>

                                                                <div class="info">
                                                                    <label for="Correo">Correo:</label>
                                                                    <input disabled type="text" id="Correo" name="Correo" value="<?php echo $row['correo_pas'] ?>">
                                                                </div>

                                                            </div>

                                                            <div class="cont">
                                                                <div class="info">
                                                                    <label for="Fecha">Fecha de Nacimiento:</label>
                                                                    <input disabled type="tel" name="FN" value="<?php echo $row['fechaNacimiento_pas'] ?>">
                                                                </div>
                                                                <div class="info">
                                                                    <label for="NTelefono">Numero de telefono:</label>
                                                                    <input type="number" id="NTelefono" name="NTelefono" value="<?php echo $row['telefono_pas'] ?>">
                                                                </div>

                                                            </div>
                                                            <div class="buttons">
                                                                <button class="button" type="submit" onclick="this.form.action='../PHP/modificarPaciente.php'; this.form.submit();">Guardar Cambios</button>

                                                            </div>

                                                    </div>
                                                </div>
                                            </section>
                                            <div class="contrasena">
                                                <div class="cambio">
                                                    

                                                    <input type="password" name="Contra" class="input" placeholder="Ingrese Contraseña">
                                                    <input type="password" name="VContra" class="input" placeholder="Confirme Contraseña">
                                                    <div class="btns">
                                                        <button class="buttonCambio" this.form.action='../PHP/cambiarContra.php' ; this.form.submit();>Cambiar Contraseña</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>




                        <?php    }
                                }
                            }
                        }
                    }

                        ?>
    </section>


    <?php
    include_once 'footer.php';
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>