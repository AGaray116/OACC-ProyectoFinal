<?php
include_once '../PHP/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Consultorio</title>


    <link rel="stylesheet" href="../CSS/estilos1.css">
    <link rel="stylesheet" href="../CSS/estilosCardsAdministrar.css">
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
                <h3 class="txt">Administración Consultorios</h3>
            </div>
            <div class="vacio">
            </div>
        </div>
    </header>


    <section class="main">
        <?php
        $db = new DB();
        $base = $db->connect()->prepare('SELECT id_cos, consultorios_cos FROM consultorios');
        $base->execute();
        $num = $base->rowCount();
        $id;

        if ($num > 0) {
            while ($row = $base->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <section class="cards-admin">
                    <div class="contenido">
                        <div class="secretaria tamanoConsul">
                            <form action="" method="post" class="signin-form">

                                <div class="cont">

                                    <div class="info">
                                        <input type="hidden" name="id" value="<?php echo $row['id_cos'] ?>">
                                        <?php $id = $row['id_cos'] ?>
                                        <label for="NConsultorio">Consultorio:</label> <br>
                                        <input disabled type="text" id="NConsultorio" name="NSecretaria" value="<?php echo $row['consultorios_cos'] ?>">
                                    </div>


                                    <div class="info">
                                        <label for="">Doctores Asignados:</label>

                                        <?php
                                        $query = $db->connect()->prepare('SELECT nombre_dos, apellido_dos FROM doctores WHERE id_cos_dos = :id');
                                        $query->execute(['id' => $id]);
                                        $num1 = $query->rowCount();

                                        if ($num1 > 0) {
                                            while ($row1 = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <div class="info">
                                                    <input disabled type="text" value="<?php echo $row1['nombre_dos'] . " " . $row1['apellido_dos'] ?>">
                                                </div>
                                            <?php      }
                                        } else { ?>
                                            <div class="info">
                                                <input class="inputinfo" disabled type="text" value="Aún no hay doctores asignados">
                                            </div>
                                        <?php } ?>
                                    </div>



                                    <div class="info">
                                        <label for="">Secretarias Asignadas:</label>

                                        <?php
                                        $query2 = $db->connect()->prepare('SELECT nombre_ses, apellido_ses FROM secretarias WHERE id_cos_ses = :id');
                                        $query2->execute(['id' => $id]);
                                        $num2 = $query2->rowCount();

                                        if ($num2 > 0) {
                                            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <div class="info">
                                                    <input disabled type="text" value="<?php echo $row2['nombre_ses'] . " " . $row2['apellido_ses'] ?>">
                                                </div>
                                            <?php      }
                                        } else { ?>
                                            <div class="info">
                                                <input class="inputinfo" disabled type="text" value="Aún no hay secretarias asignadas">
                                            </div>
                                        <?php } ?>
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