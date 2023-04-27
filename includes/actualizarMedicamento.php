<?php
  include('../conexion.php');
  $con=conectar();

  $idMedicamento = $_POST['idMedicamento'];
  $idClinica = $_POST['idClinica'];
  $idClinicaActual = $_POST['idClinicaActual'];
  $nombrecomercialMedicamento = $_POST['nombreComercial'];
  $activoprincipalMedicamento = $_POST['activoprincipalMedicamento'];
  $loteMedicamento = $_POST['loteMedicamento'];
  $fechadecaducidadMedicamento = $_POST['fechadecaducidadMedicamento'];
  $controlMedicamento = $_POST['controlMedicamento'];
  $cantidadMedicamento = $_POST['cantidadMedicamento'];
  $idDosis = $_POST['idDosis'];
  $idPresentacion = $_POST['idPresentacion'];

$sqlMedicamento = "UPDATE medicamentos SET nombrecomercialMedicamento='$nombrecomercialMedicamento', activoprincipalMedicamento='$activoprincipalMedicamento', idDosis='$idDosis', idPresentacion='$idPresentacion', controlMedicamento='$controlMedicamento' WHERE idMedicamento='$idMedicamento'";
$queryMedicamento = mysqli_query($con, $sqlMedicamento);

$sqlClinica = "UPDATE clinicatienemedicamento SET idClinica='$idClinicaActual',cantidadMedicamento='$cantidadMedicamento', loteMedicamento='$loteMedicamento', fechadecaducidadMedicamento='$fechadecaducidadMedicamento' WHERE idClinica = '$idClinica' AND idMedicamento = '$idMedicamento'";
$queryClinica = mysqli_query($con, $sqlClinica);

    if($queryClinica&&$queryMedicamento){
        Header("Location: ../vistas/mostrarMedicamentos.php");
    }
?>
