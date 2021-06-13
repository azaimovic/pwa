<?php
session_start();
define('UPLPATH', 'img/');
include 'connect.php';


$ime = $_POST['ime'] ?? "";
$prezime = $_POST['prezime'] ?? "";
$korisnicko = $_POST['korisnicko'] ?? "";
$lozinka = $_POST['lozinka'] ?? "";
$lozinka1 = $_POST['lozinka1'] ?? "";
$razina = $_POST['razina'] ?? "";
$registriranKorisnik = '';
$lozinka_hash = password_hash($lozinka, CRYPT_BLOWFISH);
$msg = "";
if ($razina == 'nula') {
    $razina = 0;
} elseif ($razina == 'jedan') {
    $razina = 1;
}
include 'connect.php';

if (isset($_POST['posalji2'])) {
    $query = "SELECT * FROM korisnik";
    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));


    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ? ";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $korisnicko);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = "Korisničko ime već postoji!" ?? "";
    } else {
        $query1 = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query1)) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko, $lozinka_hash, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
        }
    }

    mysqli_close($dbc);
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

    if ($registriranKorisnik == true) {
        echo 'Korisnik je uspješno registriran';
    } else {
        


    ?>

        <main>
            <div class="wrapper gornji" style="margin-top:15px; margin-bottom:130px;">
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
                            <?php echo '<span>' .$msg. '</span>'; ?>
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
                                <option value="jedan">Administrator</option>
                                <option value="nula">Korisnik</option>
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
        </main>

        <footer class="text-center">
            <div class="podnozje">
                <p>Arijan Zaimović TVZ 2021
                    arijanzaimovic00@gmail.com</p>
            </div>
        </footer>

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


</body>

</html>