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

<?php
        define ('UPLPATH', 'img/');
        include 'connect.php';
        ?>

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
        <?php
            $kategorija =$_GET['id'];
            if ($kategorija == 'sport'){
                $h2 = 'Berlin-sport >';
            }elseif ($kategorija == 'kultura'){
                $h2 = 'Kultur und show >';
            }
        ?>
        <div class="wrapper gornji" style="margin-top:15px;">
            <section style="margin-bottom:10px;">
                
                <div class="row">
                    <div class="text-center col-xl-12 padd">
                        <a class="naslovi" href="kategorija.php?id=<?php echo $kategorija?>">
                            <h2><?php echo $h2; ?></h2>
                        </a>
                    </div>
                </div>


                <div class="row">
                <?php
                $kategorija = $_GET['id'];
               

                
                $query = "SELECT * FROM vijesti WHERE kategorija = '$kategorija' ";
                $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
                
                while($row = mysqli_fetch_array($result)){

                    
                    echo '<article class="col-xl-4 col-md-4 col-sm-12 col-12  mali">';
                        echo '<div class="col-xl-12">';
                            echo '<div class="card">';
                                echo '<a href="clanak.php?id='.$row['id'].' "><img class="card-img-top" src="' . UPLPATH . $row['slika'] . '" alt="slika" style="height:300px;"></a>';
                                echo '<div class="card-body">';
                                    echo '<h5 class="card-title">'; 
                                    echo $row['naslov']; 
                                    echo '</h5>';
                                    echo '<p class="card-text">';
                                    echo $row['about'];
                                    echo '</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</article>';
                }
            

                

                ?>
                </div>

            </section>
        </div>

        
    </main>

    <footer class="text-center">
        <div class="podnozje">
            <p>Arijan Zaimović TVZ 2021
                arijanzaimovic00@gmail.com</p>
        </div>
    </footer>

</body>
</html>
