<?php
session_start();
include 'connect.php';
$uspjesnaPrijava = false;
$admin =false;
if(isset($_POST['login'])){
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql = "SELECT username, pass, razina FROM user WHERE username = ?";
    $stmt=mysqli_stmt_init($dbc);
    if(mysqli_stmt_prepare($stmt,$sql)){
        mysqli_stmt_bind_param($stmt,'s',$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }    
    mysqli_stmt_bind_result($stmt,$user,$hash,$lvl);
    mysqli_stmt_fetch($stmt);
    if(password_verify($password,$hash)){
        $_SESSION['username']=$user;
        $_SESSION['level']=$lvl;
        $uspjesnaPrijava=true;
        $admin=$lvl;
    }else{
        echo'Ne postoji navedeni korinik.<br> Registriraj te se!';
    }
};
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

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
            if(($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['username'])) && $_SESSION['level'] == 1){
                echo '<form action="logout.php">
                    <button class="logout" type="submit">Click here to log out</button>
                 </form>';
                ?>
                <section>
                <h2> Popis svih članaka </h2>
                <?php
                $target_dir = "upload/";
                $query = "SELECT * FROM articles
                            ORDER BY id DESC;";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)){
                    echo "<div class='popis'>";
                    echo "<img src='".$target_dir.$row['picture']."' />";
                    echo "<h4>" . $row['title']. "</h4>";
                    echo "<p>".$row['category']. "</p>";
                    echo "<p>".$row['dateWritten']."</p>";
                    echo '<a href="edit.php?id='.$row['id'].'"><i class="far fa-edit"></i></a>';
                    echo '<a href="delete.php?id='.$row['id'].'"><i class="fas fa-trash-alt"></i></a>';
                    echo "</div>";
                }
                ?>
                </section> 
            }




            <?php
            
//-----------------------------------------------prijavljen bez admin prava ----------------------------------------------------------------------
                
                }else if(isset($_SESSION['username']) && $_SESSION['level'] == 0){
                    echo '<section>
                            <p>Pozdrav '.$_SESSION['username'].'! Uspješno ste prijavljeni, ali niste administrator.</p>';
                    echo '<form action="logout.php">
                                <button class="logout" type="submit">Click here to log out</button>
                            </form>';
                            echo "</section> ";
                }else if($uspjesnaPrijava == false){
                    ?>
<!-- -----------------------------------------------prijava---------------------------------------------------------------------------------- --> 
                        <section>
                        <h2><i class="fas fa-square-full"></i> Log in</h2>
                        <form class="prijava"  method="POST" action="">
                            <div class="full-width">
                            <label for="username">Korisničko ime </label><br>
                            <input type="text" id="username" name="username"><br>
                            <span id="porukaKor"></span>
                            </div>
                            <div class="full-width">
                            <label for="password">Lozinka </label><br>
                            <input type="password" id="password" name="password"><br>
                            <span id="porukaPass"></span>
                            </div>
                            <button type="submit" id="login" name="login">Log in</button>
                            <button id="registracija" onclick="location.href = 'registracija.php'" type="button"> Registracija </button>
                        </form>
                        </section>
                    <script type="text/javascript">
                        document.getElementById('login').onclick = function (event){
                        var slanje_forme = true;
                        var username= document.getElementById("username").value;
                        if(username.length== 0) {
                            slanje_forme= false;
                            document.getElementById("porukaKor").innerHTML="<br>Unesite korisničko ime!<br><br>";
                            document.getElementById("porukaKor").style.color = "red";
                        } else{
                            document.getElementById("porukaKor").innerHTML="";
                        };
                        var pass= document.getElementById("password").value;
                        if(pass.length== 0) {
                            slanje_forme= false;
                            document.getElementById("porukaPass").innerHTML="<br>Unesite lozinku!<br><br>";
                            document.getElementById("porukaPass").style.color = "red";
                        } else{
                            document.getElementById("porukaPass").innerHTML="";
                        };
                        if(slanje_forme!= true) {event.preventDefault();};
                        };
                    </script> 
            <?php
                
            }

        ?>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------- --> 
        
                
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


