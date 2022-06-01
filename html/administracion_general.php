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

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
    <link rel="stylesheet" href="../CSS/body.css">
    <link rel="stylesheet" href="../CSS/nav.css">

    <title>Administración</title>
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
                <h3 class="txt">Administración</h3>
            </div>
            <div class="vacio">
            </div>
        </div>

    </header>

    <section class="main">
        <section class="cards-admin">
            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="../Img/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Doctores</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='adminDoctores.php'">Administrar</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="../Img/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Secretarias</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='adminSecretaria.php'">Administrar</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="../Img/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Citas</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='adminCitas.php'">Administrar</button>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="../Img/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Consultorios</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='adminConsultorio.php'">Administrar</button>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="../Img/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Especialidades</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='adminEspecialidades.php'">Administrar</button>
                    </div>
                </div>
            </div>
        </section>
    </section>







    <!-- footer terminado -->
    <?php
    include_once 'footer.php';
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>