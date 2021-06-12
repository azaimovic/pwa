<?php
        define ('UPLPATH', 'img/');
        include 'connect.php';
        ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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


    <main>
        <div class="wrapper gornji" style="margin-top:15px;">
            <div>
                <form  enctype="multipart/form-data" name="forma" class="forma" action="skripta.php" method="POST">
                    <div>
                        <label for="naslov">Naslov vijesti</label><br>
                        <input id="naslov" type="text" name="naslov">
                        <br><span class="error" id="porukaNaslov"><br>
                    </div>
                    <div>
                        <label for="about">Kratki sadržaj vijesti</label><br>
                        <textarea id="about" name="about" cols="30" rows="10"></textarea>
                        <br><span class="error" id="porukaAbout"><br>
                    </div>
                    <div>
                        <label for="sadrzaj">Sadržaj vijesti</label><br>
                        <textarea id="sadrzaj" name="sadrzaj" cols="30" rows="10"></textarea>
                        <br><span class="error" id="porukaSadrzaj"><br>
                    </div>
                    <div>
                        <label for="slika">Slika:</label><br>
                        <input id="slika" type="file" accept="image/jpeg,image/gif" name="slika">
                        <br><span class="error" id="porukaSlika"><br>
                    </div>
                    <div>
                        <label for="kategorija">Kategorija vijesti</label><br>
                        <select id="kategorija" name="kategorija">
                            <option value="" disabled selected ></option>
                            <option  value="sport">Sport</option>
                            <option  value="kultura">Kultur</option>
                        </select>
                        <br><span class="error" id="porukaKategorija"><br>
                    </div>
                    <div>
                        <label>Spremiti u arhivu:
                            <input id="arhiva" type="checkbox" name="arhiva">
                            <br><span class="error" id="porukaArhiva"><br>
                        </label>
                    </div>
                    <div>
                        <button type="reset" value="ponisti">Poništi</button>
                        <button id="gumb" name="posalji" type="submit" value="prihvati">Prihvati</button>
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
        document.getElementById('gumb').onclick = function(){
            var slanje = true;

            var poljeNaslov = document.getElementById('naslov');
            var naslov = poljeNaslov.value;
            if(naslov.length > 30 || naslov.length < 5){
                slanje = false;
                poljeNaslov.style.border = "2px dashed brown";
                document.getElementById('porukaNaslov').innerHTML = 'Naslov mora imati između 5 i 30 znakova.';
            }

            var poljeAbout = document.getElementById('about');
            var about = poljeAbout.value;
            if(about.length > 100 || about.length < 10){
                slanje = false;
                poljeAbout.style.border = "2px dashed brown";
                document.getElementById('porukaAbout').innerHTML = 'Kratki sadržaj mora imati između 10 i 100 znakova.';
            }
            
            var poljeSadrzaj = document.getElementById('sadrzaj');
            var sadrzaj = poljeSadrzaj.value;
            if(sadrzaj.length == 0){
                slanje = false;
                poljeSadrzaj.style.border = "2px dashed brown";
                document.getElementById('porukaSadrzaj').innerHTML = 'Tekst ne smije biti prazan.';
            }


            var poljeSlika = document.getElementById('slika');
            var slika = poljeSlika.value;
            if(slika.length == 0){
                slanje = false;
                poljeSlika.style.border = "2px dashed brown";
                document.getElementById('porukaSlika').innerHTML = 'Odaberite sliku molim vas.';
            }


            var poljeKategorija = document.getElementById('kategorija');
            if(document.getElementById('kategorija').selectedIndex == 0){
                slanje = false;
                poljeKategorija.style.border = "2px dashed brown";
                document.getElementById('porukaKategorija').innerHTML = 'Odaberite kategoriju.';
            }


            if (slanje != true){
                event.preventDefault();
            }
        };
    </script>


</body>

</html>


