<?php
    $unique = true;
    $registriranKorisnik = "";
    if(isset($_POST['reg'])){
            if(!empty($_POST['korime']) && !empty($_POST['ime']) && !empty($_POST['prezime']) && !empty($_POST['lozinka1']) && !empty($_POST['lozinka2']) 
            && ($_POST['lozinka1'] == $_POST['lozinka1'])){
                
            include 'connect.php';

            $korime = $_POST['korime'];
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $lozinka = $_POST['lozinka1'];
            $hash_lozinka = password_hash($lozinka,CRYPT_BLOWFISH);
            $razina=0;
            

            $query = "SELECT username FROM user WHERE username = ?";
            $stmti = mysqli_stmt_init($dbc);
            if(mysqli_stmt_prepare($stmti, $query)){
                mysqli_stmt_bind_param($stmti,'s',$korime);
                mysqli_stmt_execute($stmti);
                mysqli_stmt_store_result($stmti);
            }

            if(mysqli_stmt_num_rows($stmti) > 0){
                $unique = false;
            }else{
                session_start();
                $_SESSION['username'] = $korime;
                $_SESSION['level'] = $razina;
                $query = "INSERT INTO user (name, surname, username, pass, razina) VALUES (?,?,?,?,?)";
                $stmt=mysqli_stmt_init($dbc);
                if(mysqli_stmt_prepare($stmt,$query)){
                    mysqli_stmt_bind_param($stmt,'ssssd',$ime,$prezime,$korime,$hash_lozinka,$razina);
                    mysqli_stmt_execute($stmt);
                    $registriranKorisnik = true;
                }
                
            };
            mysqli_close($dbc);
            header("Location: administracija.php");
        };
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
        <form enctype="multipart/form-data" method="POST" action="" class="prijava"><br>
                <div class="full-width">
                <label for="korime">Korisničko ime: </label><br>
                <input type="text" id="korime" name="korime" ><br>
                </div>
                <span id='PorukaUser' class='BojaPoruke'></span>
                <?php if(isset($_POST['reg'])){
                    if(!$unique){
                        echo"<br><span id='PorukaUser' class='BojaPoruke'>Korisničko ime se već koristi!</span>";
                    };
                };?><br>
                <div class="full-width">
                <label for="ime">Ime: </label><br>
                <input type="text" id="ime" name="ime" ><br>
                <span id="porukaIme" class="BojaPoruke"></span><br>
                </div>
                <div class="full-width">
                <label for="prezime">Prezime: </label><br>
                <input type="text" id="prezime" name="prezime" ><br>
                <span id="porukaPrezime" class="BojaPoruke"></span><br>
            </div>
                <div class="full-width">
                <label for="lozinka1">Lozinka: </label><br>
                <input type="password" id="lozinka1" name="lozinka1" ><br>
                <span id="Porukaloz" class="BojaPoruke"></span><br>
            </div>
                <div class="full-width">
                <label for="lozinka2">Ponovite lozinku: </label><br>
                <input type="password" id="lozinka2" name="lozinka2" ><br>
                <span id="Porukaloz2" class="BojaPoruke"></span><br>
            </div>
                <button type="submit" class="reg_form" id="reg" name="reg">Registriraj</button>
                <button id="registracija" onclick="location.href = 'administracija.php'" type="button"> Log in </button>
            </form>
            <?php if(isset($_POST['reg'])){
                if($registriranKorisnik == true){
                echo'<p>Korisnik je uspješno registriran!</p>';
            };
            };?>

            <script type="text/javascript">
            document.getElementById('reg').onclick = function(event){
                var slanjeForme= true;
                var ime= document.getElementById("ime").value;
                if(ime.length == 0) {
                    slanjeForme= false;
                    document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
                    document.getElementById("porukaIme").style.color = "red";
                } else{
                    document.getElementById("porukaIme").innerHTML="";
                }
                var prezime= document.getElementById("prezime").value;
                if(prezime.length== 0) {
                    slanjeForme= false;
                    document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
                    document.getElementById("porukaPrezime").style.color = "red";
                } else{
                    document.getElementById("porukaPrezime").innerHTML="";
                };
                var username= document.getElementById("korime").value;
                if(username.length== 0) {
                    slanjeForme= false;
                    document.getElementById("PorukaUser").innerHTML="<br>Unesite korisničko ime!<br>";
                    document.getElementById("PorukaUser").style.color = "red";
                } else{
                    document.getElementById("PorukaUser").innerHTML="";
                };
                var pass= document.getElementById("lozinka1").value;
                var passRep= document.getElementById("lozinka2").value;
                if(pass.length== 0|| passRep.length== 0|| pass!= passRep) {
                    slanjeForme= false;
                    document.getElementById("Porukaloz").innerHTML="<br>Lozinke nisu iste!<br>";
                    document.getElementById("Porukaloz").style.color = "red";
                    document.getElementById("Porukaloz2").innerHTML="<br>Lozinke nisu iste!<br>";
                    document.getElementById("Porukaloz2").style.color = "red";
                } else{
                    document.getElementById("Porukaloz").innerHTML="";
                    document.getElementById("Porukaloz2").innerHTML="";
                };
                if(slanjeForme!= true) {event.preventDefault();}
            };
        </script>
        
                
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


