<?php
    // session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idUsuario=$_GET['idUsuario'];
    $consultaClinicas="SELECT * FROM  usuarios WHERE idUsuario='$idUsuario'";
    $cantidadClinicas=mysqli_query($conn, $consultaClinicas);
    $filaClinica = mysqli_fetch_array($cantidadClinicas);
    // echo var_dump($idUsuario);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" charset="utf-8"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
  </head>
  <body>
    <section class="content">
      <div class="pagecontain">
        <div class="div-block-6">
          <?php include( "../includes/menu.php"); ?>
          <div class="contenido div-block-7 w-clearfix">

                    <div class="container-sm">
                      <h3 class="card-title">Agregar Usuario</h3>
                      <form action="../includes/actualizarUsuario.php" method="post">
                        <div class="mb-3">
                          <label for="nombreUsuario" class="form-label">Nombre</label>
                          <input type="hidden" name="idUsuario" value="<?php echo $filaClinica['idUsuario'] ?>">
                          <input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" value="<?=$filaClinica['nombreUsuario']?>" required>
                        </div>
                        <div class="mb-3">
                          <label for="cargo" class="form-label">Cargo</label>
                          <select id="cargo" class="form-select" name="cargo" aria-label="Selecciona el tipo de usuario." required>
                            <option <?php if (!isset($filaClinica['cargo'])) echo 'selected'?> value="">-</option>
                            <option <?php if ($filaClinica['cargo']=='Administrador') echo 'selected'?>>Administrador</option>
                            <option <?php if ($filaClinica['cargo']=='Pasante') echo 'selected'?> >Pasante</option>
                            <option <?php if ($filaClinica['cargo']=='Médico') echo 'selected'?> >Médico</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="correo" class="form-label">Correo</label>
                          <input type="email" name="correo" class="form-control" value="<?=$filaClinica['correo']?>" id="correo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="mostrarUsuarios.php" class="btn btn-secondary">Cancelar</a>
                        <a href="../includes/eliminarUsuario.php?idUsuario=<?=$filaClinica['idUsuario']?>" class="btn btn-danger">Eliminar</a>
                      </form>
                    </div>

          </div>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $(document).ready( function () {
        $('#tablaClinicas').DataTable();
      });

      const openModal = document.querySelector('.agregar');
      const modal = document.querySelector('.modal');
      const closeModal = document.querySelector('.modal__close');

          openModal.addEventListener('click', (e)=>{
            e.preventDefault();
            modal.classList.add('modal--show');
          });

          closeModal.addEventListener('click', (e)=>{
            e.preventDefault();
            modal.classList.remove('modal--show');
          });
    </script>
  </body>
</html>
