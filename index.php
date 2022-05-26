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
                        <img class="imagen" src="IMG/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Doctores</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='HTML/adminDoctores.php'">Administrar</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="IMG/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Secretarias</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='HTML/adminSecretaria.php'">Administrar</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="IMG/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Citas</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='#'">Administrar</button>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="IMG/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Consultorios</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='#'">Administrar</button>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-general">
                    <div class="img">
                        <img class="imagen" src="IMG/instagram-gc42c84e67_640.png" alt="">
                    </div>
                    <div class="txt">
                        <p>Especialidades</p>
                    </div>
                    <div class="btns">
                        <button class="btns-admin-crud" onclick="window.location.href='#'">Administrar</button>
                    </div>
                </div>
            </div>
        </section>
    </section>







    <!-- footer terminado -->
    <?php
    include_once 'footer.php';
    ?>

</body>

</html>