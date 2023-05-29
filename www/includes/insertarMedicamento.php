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


	$sql_hist = "INSERT INTO historial VALUES(
		DEFAULT,
		(SELECT MAX(idMedicamento) from medicamentos),
		'$Ingrediente',
		'$marca',
		'$lote',
		'$Controlado',
		'$dosis',
		'$presentacion',
		'$unidades',
		'$caducidad',
		'$via',
		'$idUsuario',
		CURRENT_TIMESTAMP(),
		(
				SELECT
					CONCAT(
						'Medicamento '
						, m.activoprincipalMedicamento
						, ' id(', m.idMedicamento, ') dado de alta por '
						, u.nombreUsuario, ' (', u.correo, ').'
					) AS MSG
				FROM
					usuarios u
					LEFT JOIN medicamentos m
						ON m.idMedicamento = (SELECT MAX(idMedicamento) from medicamentos)
				WHERE u.idUsuario = '$idUsuario'
			)
	)";
	mysqli_query($con, $sql_hist);
    // echo $sql_hist;


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
        header("Location: ../vistas/inicio.php");
    } else {
        echo var_dump($queryMedicamento);
        echo '<br>';
        echo var_dump($queryClinica);
    }
?>
