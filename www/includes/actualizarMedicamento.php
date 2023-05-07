<?php
	include('../conexion.php');
	$con=conectar();

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
	$idUsuario=$_POST['idUsuario'];

	/*
	medicamentos (
		idMedicamento -> idMedicamento
		activoprincipalMedicamento -> Ingrediente
		controlMedicamento -> Controlado
		dosis -> dosis
		idPresentacion -> presentacion
		idDosis -> via
	)

	clinicatienemedicamento (
		marca -> marca
		loteMedicamento -> lote
		cantidadMedicamento -> unidades
		fechadecaducidadMedicamento -> caducidad
		idClinica,
		idMedicamento,
	)
	*/

	$sqlMedicamento = "UPDATE medicamentos SET
	idMedicamento = '$idMedicamento',
	activoprincipalMedicamento = '$Ingrediente',
	controlMedicamento = '$Controlado',
	dosis = '$dosis',
	idPresentacion = '$presentacion',
	idDosis = '$via'
	WHERE idMedicamento='$idMedicamento'"; 

$queryMedicamento = mysqli_query($con, $sqlMedicamento);

$sqlClinica = "UPDATE clinicatienemedicamento SET
	marca = '$marca',
	loteMedicamento = '$lote',
	cantidadMedicamento = '$unidades',
	fechadecaducidadMedicamento = '$caducidad'
	WHERE idMedicamento = '$idMedicamento'
	AND idUsuario='$idUsuario'";

	$queryClinica = mysqli_query($con, $sqlClinica);

	if($queryClinica&&$queryMedicamento){
		Header("Location: ../vistas/inicio.php");
	}
?>
