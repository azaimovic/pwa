<?php
session_start();
define('UPLPATH', 'img/');
include 'connect.php';

if (isset($_POST['posalji2'])) {
    $prijavaImeKorisnika = $_POST['korisnicko'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;
    }

    if ($levelKorisnika == 1) {
        $admin = true;
    } else {
        $admin = false;
    }

    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
} else {
    $uspjesnaPrijava = false;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <header>
        <div class="row">
            <div class="text-center col-xl-12">
                <h1>B.Z.</h1>
            </div>
        </div>

        <div class="row">
            <nav>
                <ul class="nav nav-fill">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="kategorija.php?id=sport">Berlin-sport</a></li>
                    <li class="nav-item"><a class="nav-link" href="kategorija.php?id=kultura">Kultur und show</a></li>
                    <li class="nav-item"><a class="nav-link" href="administracija.php">Administracija</a></li>
                    <li class="nav-item"><a class="nav-link" href="registracija.php">Registracija</a></li>
                    <li class="nav-item"><a class="nav-link" href="unos.php">Unos</a></li>
                </ul>
            </nav>
        </div>


    </header>

    <?php
    
    if (($uspjesnaPrijava == true && $admin == true) ||
        (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1
    ) {
        
        $query = "SELECT * FROM vijesti";
        $result = mysqli_query($dbc, $query);
        echo '<main>';
        echo '<div class="wrapper gornji" style="margin-top:15px;">';
        echo '<div>';

        while ($row = mysqli_fetch_array($result)) {
            echo '<form  enctype="multipart/form-data" name="forma" class="forma" action="skripta.php" method="POST">
                    <div>
                        <label for="naslov">Naslov vijesti</label><br>
                        <input value="' . $row['naslov'] . '" type="text" name="naslov">
                    </div>
                    <div>
                        <label for="about">Kratki sadržaj vijesti</label><br>
                        <textarea name="about" cols="30" rows="10">
                        ' . $row['about'] . '
                        </textarea>
                    </div>
                    <div>
                        <label for="sadrzaj">Sadržaj vijesti</label><br>
                        <textarea name="sadrzaj" cols="30" rows="10">
                        ' . $row['sadrzaj'] . '
                        </textarea>
                    </div>
                    <div>
                        <label for="slika">Slika:</label><br>
                        <input value="' . $row['slika'] . '" type="file" accept="image/jpeg,image/gif" name="slika"><br>
                        <img src="' . UPLPATH . $row['slika'] . '" width=100px>
                    </div>
                    <div>
                        <label for="kategorija">Kategorija vijesti</label><br>
                        <select value="' . $row['kategorija'] . '" name="kategorija">
                            <option value="sport">Sport</option>
                            <option value="kultura">Kultur</option>
                        </select>
                    </div>
                    <div>
                        <label>Spremiti u arhivu:';

            if ($row['arhiva'] == 0) {
                echo '<input type="checkbox" name="arhiva"> Arhiviraj?';
            } else {
                echo '<input type="checkbox" name="arhiva" checked> Arhiviraj?';
            }
            echo '
                        </label>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="' . $row['id'] . '">
                        <button type="reset" value="ponisti">Poništi</button>
                        <button type="submit" name="izbrisi" value="izbrisi">Izbriši</button>
                        <button name="posalji" type="submit" value="prihvati">Prihvati</button>
                        <button name="update" type="submit" value="update">Update</button>

                    </div>
                </form>';
        }
    } else if ($uspjesnaPrijava == true && $admin == false) {
        echo 'Bok' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.';
    } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
        echo 'Bok' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste admin';
    } else if ($uspjesnaPrijava == false) {
        $msg = '';
        echo '<div class="wrapper gornji" style="margin-top:15px; margin-bottom:130px;">
                <div>
                    <form name="forma" class="forma" action="" method="POST">
                        <div>
                            <label for="ime">Vaše ime:</label><br>
                            <input id="ime" type="text" name="ime">
                            <br><span class="error" id="porukaIme"><br>
                        </div>
                        <div>
                            <label for="prezime">Vaše prezime:</label><br>
                            <input type="text" name="prezime" id="prezime">
                            <br><span class="error" id="porukaPrezime"><br>
                        </div>
                        <div>
                            <label for="korisnicko">Vaše korisničko ime:</label><br>
                            <input type="text" name="korisnicko" id="korisnicko">
                            <br><span class="error" id="porukaKorisnicko"><br>
                        </div>
                        <div>
                            <label for="lozinka">Vaše lozinka:</label><br>
                            '; ?> <?php echo "<span class='bojaPoruke'> $msg </span>"; ?>
                        <?php 
                        echo'
                            <input type="password" name="lozinka" id="lozinka">
                            <br><span class="error" id="porukaLozinka"><br>
                        </div>
                        <div>
                            <label for="lozinka1">Ponovite lozinku:</label><br>
                            <input type="password" name="lozinka1" id="lozinka1">
                            <br><span class="error" id="porukaLozinka1"><br>
                        </div>
                        <div>
                            <label for="razina">Razina:</label><br>
                            <select id="razina" name="razina">
                                <option value="" disabled selected></option>
                                <option value="nula">Administrator</option>
                                <option value="jedan">Korisnik</option>
                            </select>
                            <br><span class="error" id="porukaRazina"><br>
                        </div>




                        <div>
                            <button type="reset" value="ponisti">Poništi</button>
                            <button id="gumb2" name="posalji2" type="submit" value="prihvati2">Prihvati</button>
                        </div>
                    </form>
                </div>
            </div>
            
                
            </div>
        </div>
    </main>';
    ?>
        <script type="text/javascript">
            document.getElementById('gumb2').onclick = function() {
                var slanje = true;

                var poljeIme = document.getElementById('ime');
                var ime = poljeIme.value;
                if (ime.length == 0) {
                    slanje = false;
                    poljeIme.style.border = "2px dashed brown";
                    document.getElementById('porukaIme').innerHTML = 'Ime mora biti uneseno';
                }

                var poljePrezime = document.getElementById('prezime');
                var prezime = poljePrezime.value;
                if (prezime.length == 0) {
                    slanje = false;
                    poljePrezime.style.border = "2px dashed brown";
                    document.getElementById('porukaPrezime').innerHTML = 'Prezime mora biti uneseno.';
                }

                var poljeKorisnicko = document.getElementById('korisnicko');
                var korisnicko = poljeKorisnicko.value;
                if (korisnicko.length == 0) {
                    slanje = false;
                    poljeKorisnicko.style.border = "2px dashed brown";
                    document.getElementById('porukaKorisnicko').innerHTML = 'Korisnicko ime mora biti uneseno';
                }


                var poljeLozinka = document.getElementById('lozinka');
                var lozinka = poljeLozinka.value;
                var poljeLozinka1 = document.getElementById('lozinka1');
                var lozinka1 = poljeLozinka1.value;
                if (lozinka.length == 0) {
                    slanje = false;
                    poljeLozinka.style.border = "2px dashed brown";
                    document.getElementById('porukaLozinka').innerHTML = 'Lozinka mora biti unesena';
                } else if (lozinka != lozinka1) {
                    slanje = false;
                    poljeLozinka.style.border = "2px dashed brown";
                    document.getElementById('porukaLozinka').innerHTML = 'Lozinke se ne podudaraju';
                }


                var poljeRazina = document.getElementById('razina');
                if (document.getElementById('razina').selectedIndex == 0) {
                    slanje = false;
                    poljeRazina.style.border = "2px dashed brown";
                    document.getElementById('porukaRazina').innerHTML = 'Odaberite razinu.';
                }


                if (slanje != true) {
                    event.preventDefault();
                }
            };
        </script>
    <?php




    }


    ?>



    <!--
    <main>
        <div class="wrapper gornji" style="margin-top:15px;">
            <div>
                php /*
                while($row = mysqli_fetch_array($result)){
                echo '<form  enctype="multipart/form-data" name="forma" class="forma" action="skripta.php" method="POST">
                    <div>
                        <label for="naslov">Naslov vijesti</label><br>
                        <input value="'.$row['naslov'].'" type="text" name="naslov">
                    </div>
                    <div>
                        <label for="about">Kratki sadržaj vijesti</label><br>
                        <textarea name="about" cols="30" rows="10">
                        '.$row['about'].'
                        </textarea>
                    </div>
                    <div>
                        <label for="sadrzaj">Sadržaj vijesti</label><br>
                        <textarea name="sadrzaj" cols="30" rows="10">
                        '.$row['sadrzaj'].'
                        </textarea>
                    </div>
                    <div>
                        <label for="slika">Slika:</label><br>
                        <input value="'.$row['slika'].'" type="file" accept="image/jpeg,image/gif" name="slika"><br>
                        <img src="' . UPLPATH . $row['slika'] . '" width=100px>
                    </div>
                    <div>
                        <label for="kategorija">Kategorija vijesti</label><br>
                        <select value="'.$row['kategorija'].'" name="kategorija">
                            <option value="sport">Sport</option>
                            <option value="kultura">Kultur</option>
                        </select>
                    </div>
                    <div>
                        <label>Spremiti u arhivu:';
                       
                        if ($row['arhiva'] == 0){
                                echo '<input type="checkbox" name="arhiva"> Arhiviraj?';
                            }else{
                                echo '<input type="checkbox" name="arhiva" checked> Arhiviraj?'; 
                            }
                            echo'
                        </label>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <button type="reset" value="ponisti">Poništi</button>
                        <button type="submit" name="izbrisi" value="izbrisi">Izbriši</button>
                        <button name="posalji" type="submit" value="prihvati">Prihvati</button>
                        <button name="update" type="submit" value="update">Update</button>

                    </div>
                </form>';
                };

              */  ?>
            </div>
        </div>
    </main> -->

    <footer class="text-center">
        <div class="podnozje">
            <p>Arijan Zaimović TVZ 2021
                arijanzaimovic00@gmail.com</p>
        </div>
    </footer>


</body>

</html>