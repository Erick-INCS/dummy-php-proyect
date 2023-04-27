<?php
  include('../conexion.php');

  function LoginRedirection()
  {
    session_start();
    $session = $_SESSION['usuario'];
    $conn = conectar();

    if (!isset($session)) {
      header("Location: iniciarsesion.php");
      exit();
    }

    return array(
      "user" => $session,
      "conn" => $conn,
    );
  }
?>
