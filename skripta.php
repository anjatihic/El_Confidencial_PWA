<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>El Confidencial - Unos vijesti</title>
        <meta name="lang" content="hr"/>
        <meta name="description" content="Todas las noticias y columnas de Opinión sobre España, 
        Mundo, Deportes, Bienestar, Tecnología, Cultura y Famosos"/>
        <meta name="keywords" content="Todas las noticias y columnas de Opinión sobre España, Mundo, Deportes, Bienestar, Tecnología, Cultura y Famosos">
        <meta name="author" content="Anja Tihić"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="icon" href="img/favicon.ico"/>
        <script src="https://kit.fontawesome.com/58e2d96e1f.js" crossorigin="anonymous"></script>


    </head>
    <body>
        <header>
            <a href="indeks.php" title="Ir a El Confidencial, noticias y actualidad."><img src="img/logo.svg" alt="El Confidencial logo" /></a>
            
            <nav>
                <ul>

                <li><a href="indeks.php">HOME</a></li>
                <li><a href="kategorija.php?id=europa">EUROPA</a></li>
                <li><a href="kategorija.php?id=teknautas">TEKNAUTAS</a></li>
                <li><a href="unos.html">UNOS</a></li>
                <li><a href="administracija.php">ADMINISTRACIÓN</a></li>

                </ul>
            </nav>
        </header>

        <main>
            <section>
                <h2><i class="fas fa-square-full"></i> UNESI VIJEST</h2>
                
                <?php
                include 'connect.php';

                
                    $title = $_POST['title'];
                    $about = $_POST['about'];
                    $photo = $_FILES['picture']['name'];
                    $target_dir = 'upload/'.$photo;
                    move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir);

                    $content = $_POST['content'];
                    $category = $_POST['category'];
                    if(isset($_POST['archive'])){
                        $archive = 1;
                    }
                    else{
                        $archive = 0;
                    }
                    $date = date('d.m.Y.');

                    $query = "INSERT INTO articles (dateWritten, title, about, content, picture, category, archive)
                                VALUES ('$date', '$title', '$about', '$content', '$photo', '$category', '$archive')";
                    if (mysqli_query($dbc, $query)) {
                        echo "<br/>New record created successfully";
                      } else {
                        echo "<br/>Error: " . mysqli_error($dbc);
                      }
                    
                    mysqli_close($dbc);

                

                
                ?>


            </section>
        </main>
        
        <footer>
            <p>&copy; Anja Tihić <a href="mailto:atihic@tvz.hr">atihic@tvz.hr</a> 2021</p>
            <a href="https://www.elconfidencial.com/politicas-de-privacidad/descripcion-general/" title="Condiciones">Condiciones</a>
            <a href="https://www.elconfidencial.com/politicas-de-privacidad/privacidad/" title="Política de Privacidad">Política de Privacidad</a>
            <a href="https://www.elconfidencial.com/politicas-de-privacidad/cookies/" title="Política de Cookies">Política de Cookies</a>
            <a href="https://www.elconfidencial.com/politicas-de-privacidad/transparencia/" title="Transparencia">Transparencia</a>
            <p>Auditado por Comscore</p>
        </footer>
    </body>
</html>







