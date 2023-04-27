<?php
    //session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idClinica=$_GET['idClinica'];
    $idMedicamento=$_GET['idMedicamento'];

    $consultaMedicamentos="
    SELECT clinicas.idClinica, medicamentos.idMedicamento, donacionClinica, medicamentos.nombrecomercialMedicamento, activoprincipalMedicamento, loteMedicamento, fechadecaducidadMedicamento, controlMedicamento, cantidadMedicamento, nombreDosis, nombrePresentacion, nombreClinica FROM clinicatienemedicamento
    INNER JOIN clinicas ON clinicas.idClinica = clinicatienemedicamento.idClinica
    INNER JOIN medicamentos ON medicamentos.idMedicamento = clinicatienemedicamento.idMedicamento
    INNER JOIN dosis ON medicamentos.idDosis = dosis.idDosis
    INNER JOIN presentacion ON medicamentos.idPresentacion = presentacion.idPresentacion
    WHERE clinicatienemedicamento.idClinica = '$idClinica' AND clinicatienemedicamento.idMedicamento = '$idMedicamento'
    ";

    $cantidadMedicamentos = mysqli_query($conn, $consultaMedicamentos);
    $filaMedicamento = mysqli_fetch_array($cantidadMedicamentos);
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
              <form class="" action="../includes/actualizarMedicamento.php" method="post">
                <h3 class="card-title">Agregar Medicamento</h3>
                <div class="row">
                  <input type="hidden" name="idMedicamento" value="<?php echo $filaMedicamento['idMedicamento']?>">
                  <input type="hidden" name="idClinica" value="<?php echo $filaMedicamento['idClinica']?>">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Nombre Comercial:
                            <input class="form-control" type="text" name="nombreComercial" value="<?php echo $filaMedicamento['nombrecomercialMedicamento']?>">
                        </label>
                    </div>
                    <div class="col">
                        <label for="">Activo Principal:
                            <input class="form-control" type="text" name="activoprincipalMedicamento" value="<?php echo $filaMedicamento['activoprincipalMedicamento']?>">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Lote:
                            <input class="form-control" type="text" name="loteMedicamento" value="<?php echo $filaMedicamento['loteMedicamento']?>">
                        </label>
                    </div>
                    <div class="col">
                        <label for="">Controlado:
                          <select class="form-select" name="controlMedicamento">
                            <option value="1">Si</option>
                            <option value="2">No</option>
                          </select>
                        </label>
                    </div>
                    <div class="col">
                        <label for="">Cantidad:
                            <input min="1" class="form-control" type="number" name="cantidadMedicamento" value="<?php echo $filaMedicamento['cantidadMedicamento']?>">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Dosis:
                            <select class="form-select" name="idDosis">
                              <?php
                                      $mysqli = new mysqli('localhost', 'root', '', 'clinicasComunitarias');
                                      $queryDosis = $mysqli -> query("select *from dosis");
                                      while ($valores = mysqli_fetch_array($queryDosis)){
                                          echo '<option value="' . $valores['idDosis'] . '">'.$valores['nombreDosis'] . '</option>';
                                      }
                                  ?>
                            </select>
                        </label>
                    </div>
                    <div class="col">
                        <label for="">Fecha de Cad.:
                            <input class="form-control" type="datetime-local" name="fechadecaducidadMedicamento" value="">
                        </label>
                    </div>
                </div>
                <div class="row form-outline">
                    <div class="col">
                        <label for="">Presentación:
                            <select class="form-select" name="idPresentacion">
                              <?php
                                      $mysqli = new mysqli('localhost', 'root', '', 'clinicasComunitarias');
                                      $queryPresentacion = $mysqli -> query("select *from presentacion");
                                      while ($valores = mysqli_fetch_array($queryPresentacion)){
                                          echo '<option value="' . $valores['idPresentacion'] . '">'.$valores['nombrePresentacion'] . '</option>';
                                      }
                                  ?>
                            </select>
                        </label>
                    </div>
                    <div class="col">
                        <label for="">Clinica:
                            <select class="form-select" name="idClinicaActual">
                              <?php
                                      $mysqli = new mysqli('localhost', 'root', '', 'clinicasComunitarias');
                                      $queryClinicas = $mysqli -> query("select *from clinicas");
                                      while ($valores = mysqli_fetch_array($queryClinicas)){
                                          echo '<option value="' . $valores['idClinica'] . '">'.$valores['nombreClinica'] . '</option>';
                                      }
                                  ?>
                            </select>
                        </label>
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
