<?php
    include('../conexion.php');
    $con = conectar();

    $idMedicamento = $_POST['idMedicamento'];
	$Ingrediente = $_POST['Ingrediente'];
	$marca = $_POST['marca'];
	$lote = $_POST['lote'];
	$Controlado = $_POST['Controlado'];
	$dosis = $_POST['dosis'];
	$presentacion = $_POST['presentacion'];
	$unidades = $_POST['unidades'];
	$via = $_POST['via'];
	$caducidad = $_POST['caducidad'];
	$idUsuario = $_POST['idUsuario'];

    // $consultaMedicamento = "SELECT idMedicamento from medicamentos order by idMedicamento desc limit 1";
    // $querycuantoscuentoscuentas = mysqli_query($con,$consultaMedicamento);
    // $idMedicamento = mysqli_fetch_array($querycuantoscuentoscuentas);

    $sqlMedicamento = "INSERT INTO medicamentos(
        idMedicamento,
        activoprincipalMedicamento,
        controlMedicamento,
        dosis,
        idPresentacion,
        idDosis
    ) VALUES (
        DEFAULT,
        '$Ingrediente',
        '$Controlado',
        '$dosis',
        '$presentacion',
        '$via'
    )
    ";

	$queryMedicamento = mysqli_query($con, $sqlMedicamento);

	$sqlClinica = "INSERT INTO clinicatienemedicamento(
        idMedicamento,
        idUsuario,
        marca,
        loteMedicamento,
        cantidadMedicamento,
        fechadecaducidadMedicamento
    ) SELECT
        (SELECT MAX(idMedicamento) from medicamentos),
        '$idUsuario',
        '$marca',
        '$lote',
        '$unidades',
        '$caducidad'
    ";
    echo $sqlClinica;
	$queryClinica = mysqli_query($con, $sqlClinica);

    if($queryMedicamento && $queryClinica){
        header("Location: ../vistas/mostrarMedicamentos.php");
    } else {
        echo var_dump($queryMedicamento);
        echo '<br>';
        echo var_dump($queryClinica);
    }
?>
