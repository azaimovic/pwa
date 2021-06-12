<?php

    header('Content-Type: text/html; charset=utf-8');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $basename = "pwa";

    $dbc = mysqli_connect($servername, $username, $password, $basename) or 
    die ('Error connecting to MySQL server.' .mysqli_connect_error());

    if ($dbc){
        //echo "Connected successfully";
    }

?>