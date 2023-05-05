<?php
    //session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idClinica=$_GET['idDosis'];
    $consultaClinicas="SELECT * FROM  dosis WHERE idDosis='$idClinica'";
    $cantidadClinicas=mysqli_query($conn, $consultaClinicas);
    $filaClinica = mysqli_fetch_array($cantidadClinicas);
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
            <div class="col-md-3">
              <h3 class="card-title">Editar Dosis</h3>
              <form class="" action="../includes/actualizarDosis.php" method="post">
                <div class="row mb-4">
                  <div class="col">
                    <label for="">Nombre:</label>
                    <input type="hidden" name="idDosis" value="<?php echo $filaClinica['idDosis'] ?>">
                    <input class="form-control" type="text" name="nombreDosis" value="<?php echo $filaClinica['nombreDosis'] ?>" required>
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="btn btn-info" type="submit" name="" value="Registrar">
                    </div>
                    <div class="col">
                        <input class="btn btn-danger modal__close" type="button" value="Cancelar">
                    </div>
                </div>
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
