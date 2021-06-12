<?php
    define ('UPLPATH', 'img/');
    include 'connect.php';

    $slika = $_FILES['slika']['name'] ?? "";
    $naslov = $_POST['naslov'] ?? "";
    $about = $_POST['about'] ?? "";
    $sadrzaj = $_POST['sadrzaj'] ?? "";
    $kategorija = $_POST['kategorija'] ?? "";

    if (isset($_POST['arhiva'])){
        $arhiva = 1;
    }else {
        $arhiva = 0;
    }

 
    if (isset($_POST['posalji'])){
    $target_dir = 'img/';
    

    $query = "INSERT INTO vijesti (naslov, about, sadrzaj, slika, kategorija, arhiva) 
        VALUES ('$naslov', '$about', '$sadrzaj', '$slika', '$kategorija', '$arhiva')";

    $result = mysqli_query($dbc, $query) or die('Error querying database');
    move_uploaded_file($_FILES["slika"]["tmp_name"] ?? "", $target_dir.$slika) ;
    }
    

    if (isset($_POST['izbrisi'])){
        $id = $_POST['id'] ?? "";
        $query2 = "DELETE FROM vijesti WHERE id=$id ";
        $result = mysqli_query($dbc,$query2) or die('Error querying databse');
    }


    if (isset($_POST['update'])){
            $id = $_POST['id'] ?? ""; 
            $slika = $_FILES['slika']['name'] ?? "";
            $naslov = $_POST['naslov'] ?? "";
            $about = $_POST['about'] ?? "";
            $sadrzaj = $_POST['sadrzaj'] ?? "";
            $kategorija = $_POST['kategorija'] ?? "";

            if (isset($_POST['arhiva'])){
                $arhiva = 1;
            }else {
                $arhiva = 0;
            }

            $target_dir = 'img/';
            

            $query3 = "UPDATE vijesti SET naslov = '$naslov', about = '$about', sadrzaj = '$sadrzaj',
            slika = '$slika', kategorija = '$kategorija', arhiva = '$arhiva' WHERE id = $id ";
            move_uploaded_file($_FILES["slika"]["tmp_name"] ?? "", $target_dir.$slika) ;
            $result = mysqli_query($dbc, $query3) or die('Error querying database');
           
    }

    mysqli_close($dbc);

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div style="margin-top:100px;" class="wrapper">
            <article>
                <div class="row">
                    <div class="text-left col-xl-12 padd">
                        <h3 style="padding-left:30px;"><?php echo $naslov; ?></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 padd">
                        <?php echo "<img src='img/$slika' width='100%;' height='550px;'>"; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 padd">
                        <h4><?php echo $about ?></h4>
                    </div>
                </div>

                <div class="row tekst">
                    <div class="col-xl-12 padd">
                        <p><?php echo $sadrzaj ?></p>
                    </div>
                </div>
            </article>
        </div>
    </main>
    

    <footer class="text-center">
        <div class="podnozje">
            <p>Arijan Zaimović TVZ 2021 arijanzaimovic00@gmail.com</p>
        </div>
    </footer>


    
        


</body>

</html>