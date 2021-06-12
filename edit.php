<?php
    include "connect.php";
    $target_dir = 'upload/';
    $id = $_GET['id'];
    $query = "SELECT * from articles
                WHERE id = $id";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['update'])){
        $naslov = $_POST['title'];
        $sadrzaj = $_POST['content'];
        $sazetak = $_POST['about'];
        $kategorija = $_POST['category'];
        if(isset($_POST['archive'])){
            $arhiva=1;
        }
        else{
            $arhiva=0;
        }
        $query = "UPDATE articles SET title='$naslov',about='$sazetak',
                        content='$sadrzaj',category='$kategorija',archive='$arhiva' WHERE id=$id;";
        
        $rezultat = mysqli_query($dbc, $query);
        echo "Članak je promijenjen";}

    
?>

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

        <main>
            <?php
            echo '<form method="POST" enctype="multipart/form-data" action="" name="unos">
                    <div class="full-width">
                        <label for="title" class="label">Naslov vijesti</label><br>
                        <input type="text" name="title" placeholder="Naslov" value = "'.$row['title'].'">
                    </div>
                    <div class="half-width">
                        <label for="about" class="label">Kratki sadržaj</label><br>
                        <textarea name="about" placeholder="Kratki sadržaj">'.$row['about'].'</textarea>
                    </div>
                    <div class="full-width">
                        <label for="content" class="label">Sadržaj vijesti</label><br>
                        <textarea name="content" placeholder="Sadržaj">'.$row['content'].'</textarea>
                    </div>
                    <div class="full-width">
                        <label for="category" class="label">Kategorija vijesti</label><br>
                        <select name="category" value="'.$row['category'].'">
                            <option value="'.$row['category'].'" >'.$row['category'].'</option>
                            <option value="Europa">Europa</option>
                            <option value="Teknautas">Teknautas</option>
                        </select>
                    </div>
                    <div class="full-width">
                        <label for="archive" class="label">Spremiti u arhivu?</label>';
                        if($row['archive'] == 0){
                            echo '<input type="checkbox" name="archive"/>';
                        }
                        else{
                            echo '<input type="checkbox" name="archive" checked/>';
                        }
                        echo '</div>
                                <div class="full-width">
                                    <button type="reset" value="reset">Poništi</button>
                                    <button type="submit" name="update" value="submit">Promijeni</button>
                                </div>            
                            
                            </form>';

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


