<?php
	include('../conexion.php');
	$con=conectar();

	$idClinica=$_GET['idClinica'];
	$idUsuario=$_GET['idUsuario'];
	$idMedicamento=$_GET['idMedicamento'];

	$sql_hist = "INSERT INTO historial VALUES(
			DEFAULT,
			$idMedicamento,
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			'0',
			NULL,
			NULL,
			'$idUsuario',
			CURRENT_TIMESTAMP(),
			(
				SELECT
					CONCAT(
						'Medicamento '
						, m.activoprincipalMedicamento
						, ' id(', m.idMedicamento, ') eliminado por '
						, u.nombreUsuario, ' (', u.correo, ').'
					) AS MSG
				FROM
					usuarios u
					LEFT JOIN medicamentos m
						ON m.idMedicamento = $idMedicamento
				WHERE u.idUsuario = '$idUsuario'
			)
		)";
	mysqli_query($con, $sql_hist);

	$sql="DELETE FROM clinicatienemedicamento  WHERE idClinica='$idClinica' AND idMedicamento ='$idMedicamento'";
	$query=mysqli_query($con,$sql);
	$sqldos="DELETE FROM medicamentos  WHERE idMedicamento='$idMedicamento'";
	$querydos=mysqli_query($con,$sqldos);

	if($query){
		Header("Location: ../vistas/inicio.php");
	}
?>
