<?php
    //session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idClinica=$_GET['idClinica'];
    $consultaClinicas="SELECT * FROM  clinicas inner join ciudades on clinicas.idCiudad = ciudades.idCiudad WHERE idClinica='$idClinica'";
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
                        <h3 class="card-title">Agregar Clinica</h3>
                        <form class="" action="../includes/actualizarClinica.php" method="post">
                          <input type="hidden" name="idClinica" value="<?php echo $filaClinica['idClinica'] ?>"></input>
                          <div class="row">
                            <div class="col">
                              <label for="">Nombre:</label>
                              <input class="form-control" type="text" name="nombreClinica" value="<?php echo $filaClinica['nombreClinica'] ?>" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="col">
                                <label for="">Ciudad:</label>
                                <select class="form-select" name="ciudadClinica">
                                  <?php
                                          $mysqli = new mysqli('localhost', 'root', '', 'clinicasComunitarias');
                                          $queryCiudades = $mysqli -> query("select *from ciudades");
                                          while ($valores = mysqli_fetch_array($queryCiudades)){
                                              echo '<option value="' . $valores['idCiudad'] . '">'.$valores['nombreCiudad'] . '</option>';
                                          }
                                      ?>
                                </select>
                              </div>
                            </div>
                            <div class="col">
                              <label for="">Donación:</label>
                              <select class="form-select" name="donacionClinica">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <label for="">Ubicación Actual:</label>
                              <?php echo $filaClinica['direccionClinica'] ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label for="">Direccion:</label>
                                <textarea class="form-control" name="direccionClinica" rows="3" required>
                                  <?php echo $filaClinica['direccionClinica'] ?>
                                </textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <input class="btn btn-info" type="submit" name="" value="Actualizar">
                              </div>
                              <div class="col">
                                  <a href="mostrarClinicas.php" class="btn btn-danger modal__close" type="button">Cancelar</a>
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
