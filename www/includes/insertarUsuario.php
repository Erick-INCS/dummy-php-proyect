<?php
    include('../conexion.php');
    include('mail.php');
    $con = conectar();

    $nombreUsuario = $_POST['nombreUsuario'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $pass = substr(md5(strval(rand())), 0, 5);
    if (isset($_POST['alertas'])) {
        $alertas = 1;
    } else {
        $alertas = 0;
    }

    echo var_dump(1);
    $sql = "SELECT 1 AS UNO FROM usuarios WHERE correo = '$correo'";
    $query = mysqli_fetch_array(mysqli_query($con, $sql));
    if (isset($query['UNO'])) {
        Header("Location: ../vistas/mostrarUsuarios.php?err=" . urldecode("El correo ya se encuentra registrado para otro usuario."));
        exit();
    }
    echo var_dump(2);
    $sql = "INSERT INTO usuarios(nombreUsuario, correo, cargo, expiration_date, claveUsuario, recibe_alertas) VALUES('$nombreUsuario','$correo', '$cargo', CURRENT_DATE(), MD5('$pass'), $alertas)";
    $query = mysqli_query($con,$sql);

    echo var_dump(3);
    echo $sql;
    if($query){
        echo var_dump(4);
		$subject = 'Su usuario se ha registrado';
		$body = "Hola usuario<br>
		Se ha generado un usuario en la plataforma con este correo asignado.<br>
		Para acceder favor de utilizar la siguiente contraseña temporal: $pass<br>
		Saludos.";

		send_mail(
			$correo,
			$subject,
			$body
		);
        Header("Location: ../vistas/mostrarUsuarios.php");
    }
?>
