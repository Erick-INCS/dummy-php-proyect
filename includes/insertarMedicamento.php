<?php
    include('../conexion.php');
    $con = conectar();

    $nombrecomercialMedicamento = $_POST['nombreComercial'];
    $activoprincipalMedicamento = $_POST['activoprincipalMedicamento'];
    $loteMedicamento = $_POST['loteMedicamento'];
    $fechadecaducidadMedicamento = $_POST['fechadecaducidadMedicamento'];
    $controlMedicamento = $_POST['controlMedicamento'];
    $cantidadMedicamento = $_POST['cantidadMedicamento'];
    $idDosis = $_POST['idDosis'];
    $idPresentacion = $_POST['idPresentacion'];
    $idClinica = $_POST['idClinica'];

    $sqlMedicamento = "INSERT medicamentos VALUES(DEFAULT,'$nombrecomercialMedicamento','$activoprincipalMedicamento','$idDosis','$idPresentacion','$controlMedicamento')";
    $queryMedicamento = mysqli_query($con,$sqlMedicamento);

    $consultaMedicamento = "SELECT idMedicamento from medicamentos order by idMedicamento desc limit 1";
    $querycuantoscuentoscuentas = mysqli_query($con,$consultaMedicamento);
    $idMedicamento = mysqli_fetch_array($querycuantoscuentoscuentas);

    $sqlclinicatienemedicamento = "INSERT clinicatienemedicamento VALUES('$idClinica','$idMedicamento[0]','$cantidadMedicamento','$loteMedicamento','$fechadecaducidadMedicamento')";
    $queryClinicatienemedicamento = mysqli_query($con,$sqlclinicatienemedicamento);

    if($queryMedicamento && $queryClinicatienemedicamento){
       header("Location: ../vistas/mostrarMedicamentos.php");
    }
?>
