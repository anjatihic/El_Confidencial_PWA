<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>El Confidencial</title>
        <meta name="lang" content="es"/>
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

        <main class="kategorija-main">
            <?php
            include 'connect.php';
            $target_dir = 'upload/';
            $id = $_GET['id'];
            ?>
            <h2 style="text-transform: uppercase;"><i class="fas fa-square-full"></i> <?php echo $id;?></h2>
            <?php
            $query = "SELECT * FROM articles
                        WHERE category = '$id'
                        ORDER BY id DESC";
            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($result)){
                echo "<article>";
                echo'<div class="article">'; 
                echo '<div class="teknautas_img">'; 
                echo '<a href="clanak.php?id='.$row['id'].'">';
                echo '<img src="' . $target_dir . $row['picture'] . '"'; 
                echo '</div>'; 
                echo '<div class="media_body">'; 
                echo '<h4>';  
                echo $row['title']; 
                echo '</a></h4>';
                echo '<p class="date">'.$row['dateWritten'].'</p>'; 

                echo '</div></div>'; 
                echo '</article>';
            }
            ?>
            
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


