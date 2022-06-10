<?php
include_once '../PHP/database.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/body.css">

    <title>Modificar Secretaria</title>
</head>

<body>
    <header>

        <div class="contenedor1">
            <div class="img">
                <img src="../Img/logoIgeia.png" alt="" width="100" height="100">
            </div>
            <div class="textos">
                <h3 class="txt">Modificar Secretaria</h3>
            </div>
            <div class="vacio"></div>
        </div>
    </header>

    <section class="main">
        <section class="form-login">
            <div class="login">
                <form action="" method="post" class="signin-form">
                    <div class="datos">

                        <div class="">
                            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
                            <input class="input" type="text" placeholder="Nombre" name="Nombre">
                        </div>
                        <div class="">
                            <input class="input" type="text" placeholder="Apellidos" name="Apellidos">
                        </div>
                        <div class="">
                            <input class="input" type="tel" placeholder="Telefono" name="Telefono">
                        </div>
                        <div>
                            <label for="Consultorios">Consultorio</label>
                            <select name="Consultorio">

                                <option selected>Seleccione Consultorio</option>
                                <?php
                                $db = new DB();

                                $base = $db->connect()->prepare('SELECT id_cos, consultorios_cos FROM consultorios');

                                $base->execute();
                                $num = $base->rowCount();
                                if ($num > 0) {
                                    while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <option value="<?php echo $row['id_cos'] ?>"><?php echo $row['consultorios_cos'] ?></option>
                                <?php    }
                                }


                                ?>

                            </select>
                        </div>
                        <div>
                            <label for="Turnos">Turnos</label>
                            <select name="Turno">

                                <option selected>Seleccione Turno</option>
                                <?php
                                $db = new DB();

                                $base = $db->connect()->prepare('SELECT id_tur, turno_tur FROM turnos');

                                $base->execute();
                                $num = $base->rowCount();
                                if ($num > 0) {
                                    while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <option value="<?php echo $row['id_tur'] ?>"><?php echo $row['turno_tur'] ?></option>
                                <?php    }
                                }


                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="btns">
                        <button class="button" onclick="this.form.action='../PHP/modificarSecretaria.php'; this.form.submit();">Guardar</button>
                        <button class="button" onclick="this.form.action='adminSecretaria.php'; this.form.submit();">Cancelar</button>
                    </div>


                </form>
            </div>
        </section>
    </section>

  

</body>

</html>