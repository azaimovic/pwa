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

            

            <?php 
            $id = $_GET['id'];
            $query = "SELECT * FROM vijesti WHERE id = $id";
            $result = mysqli_query($dbc,$query);
            $slika = $_POST['slika'] ?? "";
            while($row = mysqli_fetch_array($result)){
            echo'

            <div class="row">
                <div class="text-center col-xl-12 padd">
                    <a class="naslovi" href="kategorija.php?id='.$row['kategorija'].'">
                    <h2>';
                    if ($row['kategorija'] == 'sport'){
                        echo 'BERLIN SPORT >';
                    }elseif ($row['kategorija'] == 'kultura'){
                        echo 'KULTUR UND SHOW >';
                    }
                    echo'</h2>
                    </a>
                </div>
            </div>
            
            <article>
                <div class="row">
                    <div class="text-left col-xl-12 padd">
                        <h3 style="padding-left:30px;">';
                            echo $row['naslov'];
                        echo '</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 padd">';
                echo    '<img src="' . UPLPATH . $row['slika'] . '" width=100%; height=550px; >';
                echo'       
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 padd">
                        <h4>';
                        echo $row['about']; 
                         echo'</h4>
                    </div>
                </div>

                <div class="row tekst">
                    <div class="col-xl-12 padd">
                        <p>'; 
                        echo $row['sadrzaj'];
                        echo '</p>
                    </div>
                </div>
            </article>';
            
            }
            ?>
        </div>
    </main>
    

    <footer class="text-center">
        <div class="podnozje">
            <p>Arijan Zaimović TVZ 2021 arijanzaimovic00@gmail.com</p>
        </div>
    </footer>


    
        


</body>

</html>