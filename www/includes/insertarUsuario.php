<?php
    include('../conexion.php');
    include('mail.php');
    $con = conectar();

    $nombreUsuario = $_POST['nombreUsuario'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $pass = md5(strval(rand()));

    $sql = "INSERT INTO usuarios(nombreUsuario, correo, cargo, expiration_date, claveUsuario) VALUES('$nombreUsuario','$correo', '$cargo', CURRENT_DATE(), MD5('$pass'))";
    $query = mysqli_query($con,$sql);

    if($query){
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
