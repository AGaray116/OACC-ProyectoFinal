<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igeia</title>

    <link rel="stylesheet" href="CSS/estilosIndex.css">
    <link rel="stylesheet" href="CSS/estilos1.css">
    <link rel="stylesheet" href="CSS/mapa.css">

</head>

<body>
    <!--Header-->
    <header>
        <div class="contenedor">
        
            <div class="textos">
                <div class="img">
                    <img class="logo" src="Img/logoIgeia.png" alt="" width="100" height="100">
                </div>
                <h1 class="nombre">Igeia <span>Torre Medica</span> </h1>
                <h3>Tu salud Es Importante Para Nosotros</h3>
            </div>
        </div>
    </header>

    <!--Nosotros-->
    <section class="main">
        <section class="nosotros" id="nosotros">
            <div class="contenedor">
                <div class="foto">
                    <img src="Img/stethoscope-g8ffe8adc4_640.jpg" alt="">
                </div>
                <article>
                    <h3>Descripción</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptatibus dignissimos enim minus, consectetur reiciendis fuga magnam quidem expedita laborum veniam dicta!</p>
                </article>
                <article>
                    <h3>Misión</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut nihil ullam ipsam, quidem consectetur quasi! Quia consequatur exercitationem quaerat ab, dolor error.</p>
                </article>
                <article>
                    <h3>Visión</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam nihil pariatur cumque unde consequatur officia neque similique id magnam, illum sint ex.</p>
                </article>
            </div>
        </section>

        <!--Directorio-->
        <section class="directorio" id="directorio">
            <div class="contenedor-directorio">
                <h3 class="titulo-directorio" id="titulo-directorio">Directorio</h3>
                <form action="#" method="post" class="signin-form">
                    <div class="busqueda">
                        <input type="text" id="nombreDoctor" name="NDoctor" class="nombreDoctor" placeholder="Nombre Doctor">
                        <button class="button" type="submit" name="BDoctor" id="btn-buscar">Buscar</button>
                    </div>

                    <br>
                    <div class="btns">
                        <div class="btn3">
                            <button class="button" type="submit" id="button-especialidad" name="Nefrologia">Nefrología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Cardiologia">Cardiología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Pediatria">Pediatría</button>
                        </div>
                        <div class="btn3">
                            <button class="button" type="submit" id="button-especialidad" name="Oftalmologia">Urología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Urologia">Oftalmología</button>
                        </div>
                        <div class="btn3">
                            <button class="button" type="submit" id="button-especialidad" name="Psicologia">Psicología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Dermatologia">Dermatología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Neumologia">Neumología</button>
                        </div>
                        <div class="btn3">
                            <button class="button" type="submit" id="button-especialidad" name="Oncologia">Oncología</button>
                            <button class="button" type="submit" id="button-especialidad" name="Ginecologia">Ginecología</button>
                        </div>
                    </div>
                </form>
            </div>


        </section>

        <section id="masInfo" class="masInfo">
            <div class="contenedo-info">
                <div class="contenido1">
                    <article>
                        <h3>Especialidades</h3>
                        <p>Contamos con multiples especialidades para que nuestros pacientes puedan tener un servicio completo y de calidad.</p>
                    </article>
                    <article>
                        <h3>Citas</h3>
                        <p>Contamos con horarios accesibles, puedes elegir el dia y la hora de forma rapida y agendar tus citas.</p>
                    </article>
                    <article>
                        <h3>Costos</h3>
                        <p>Los costos son accesibles, contamos con planes de pagos y un servicio de calidad. </p>
                    </article>
                    <article>
                        <h3>Seguridad</h3>
                        <p>Proporcionamos un servicio de calidad. Brindamos la mejor seguridad y confidencialidad para nuestros pacientes.</p>
                    </article>
                </div>

            </div>
        </section>

    </section>

    <section class="Ubicacion" id="Ubicacion">
        <div class="contenedor">
            <h3 class="titulo">Ubicacion</h3>
            <div class="direccion">
                <p class="calle">Toriello Guerra, Tlalpan <br> 14050 Ciudad de México, CDMX</p>
                <p class="telefono">55 5555 5555</p>
                <p class="correo">igeiatowermedic@gmail.com</p>
            </div>
            <div class="horarios">
                <h4>Horarios</h4>
                <p class="entre-semana">Lunes a Viernes <br> 7:00 - 21:00</p>
                <p class="fin-semana">Sabados y Domingos <br> 7:00 - 21:00</p>
            </div>
        </div>
    </section>

    <section class="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.750808391627!2d-99.16232858326438!3d19.293199914550918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce005849c4bf33%3A0xbd6c52abd4499c5!2sToriello%20Guerra%2C%20Tlalpan%2C%2014050%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1653237965789!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    </section>

    <?php
    include_once 'html/footer.php';
    ?>

</body>
</body>

</html>