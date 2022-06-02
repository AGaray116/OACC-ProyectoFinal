<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Especialidad</title>


    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
    <link rel="stylesheet" href="../CSS/buttons.css">
    <link rel="stylesheet" href="../CSS/body.css">
    <link rel="stylesheet" href="../CSS/nav.css">

</head>

<body>

    <header>
    
        <div class="contenedor1">
            <div class="img">
                <img src="../Img/logoIgeia.png" alt="" width="100" height="100">
            </div>
            <div class="textos">
                <h3 class="txt">Administración Especialidades</h3>
            </div>
            <div class="vacio">
            </div>
        </div>
    </header>


    <section class="main">
        <?php
        $db = new DB();
        $base = $db->connect()->prepare('SELECT id_ess, especialidad_ess FROM especialidades');
        $base->execute();
        $num = $base->rowCount();
        $id;

        if ($num > 0) {
            while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <section class="cards-admin">
                    <div class="contenido">
                        <div class="secretaria">
                            <form action="" method="post" class="signin-form">
                                <div class="cont">

                                    <div class="info">
                                        <input type="hidden" name="id" value="<?php echo $row['id_ess'] ?>">
                                        <?php $id = $row['id_ess'] ?>
                                        <label for="NEspecialidad">Especialidad:</label>
                                        <input disabled type="text" id="Especialidad" name="Especialidad" value="<?php echo $row['especialidad_ess'] ?>">
                                    </div>
                                    <div class="info">
                                        <label for="">Doctores Asignados:</label>

                                        <?php
                                        $query = $db->connect()->prepare('SELECT nombre_dos, apellido_dos FROM doctores WHERE id_ess_dos = :id');
                                        $query->execute(['id' => $id]);
                                        $num1 = $query->rowCount();

                                        if ($num1 > 0) {
                                            while ($row1 = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                    
                                                    <input disabled type="text" value="<?php echo $row1['nombre_dos'] . " " . $row1['apellido_dos'] ?>">
                                                
                                            <?php      }
                                        } else { ?>
                                                <input class="inputinfo" disabled type="text" value="Aún no hay doctores asignados">
                                        <?php } ?>
                                    </div>

                                </div>
                        </div>
                        </form>

                    </div>
                    </div>
                </section>


        <?php      }
        } ?>
    </section>


    <?php
    include_once 'footer.php';
    ?>


</body>

</html>