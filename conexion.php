<?php
function conectar(){
    $host="localhost";
    $user="root";
    $pass="root";
    $bd="clinicaComunitarias";

    $con = mysqli_connect($host, $user, $pass, $bd) or die("Unable to Connect to '$host'");
    return $con;
}
?>