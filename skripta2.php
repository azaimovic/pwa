<?php
   $ime = $_POST['ime'];
   $prezime = $_POST['prezime'];
   $korisnicko = $_POST['korisnicko'];
   $lozinka = $_POST['lozinka'];
   $lozinka1 = $_POST['lozinka1'];
   $razina = $_POST['razina'] ?? "";
   $registriranKorisnik = '';
   $lozinka_hash = password_hash($lozinka, CRYPT_BLOWFISH);
   if ($razina == 'nula'){
       $razina = 0;
   }elseif($razina == 'jedan'){
       $razina = 1;
   }
   include 'connect.php';

   if (isset($_POST['posalji2'])){
       $query = "SELECT * FROM korisnik";
       $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));

       
       $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ? ";
       $stmt = mysqli_stmt_init($dbc);
       if(mysqli_stmt_prepare($stmt,$sql)){
           mysqli_stmt_bind_param($stmt, 's', $korisnicko);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
       }
       if(mysqli_stmt_num_rows($stmt) > 0){
           $msg = "Korisničko ime već postoji!";
       }else{
            $query1 = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) 
            VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);

            if(mysqli_stmt_prepare($stmt, $query1)){
                mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko, $lozinka_hash, $razina);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
        }
       }

       mysqli_close($dbc);
   }
?>



