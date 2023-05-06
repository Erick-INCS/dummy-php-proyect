<?php
    session_start();
    $user_id = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $consultaClinicas="
    SELECT
      md.idMedicamento,
      md.nombrecomercialMedicamento,
      md.activoprincipalMedicamento,
      md.dosis,
      cm.loteMedicamento,
      cm.fechadecaducidadMedicamento,
      md.controlMedicamento,
      cm.cantidadMedicamento,
      cm.marca,
      d.nombreDosis,
      p.nombrePresentacion
  FROM
    clinicatienemedicamento cm
      INNER JOIN medicamentos md
        ON md.idMedicamento = cm.idMedicamento
      INNER JOIN dosis d
        ON md.idDosis = d.idDosis
      INNER JOIN presentacion p
        ON md.idPresentacion = p.idPresentacion
  WHERE cm.idUsuario = '$user_id'
  ORDER BY cm.fechadecaducidadMedicamento DESC
  ;
    ";
    $cantidadClinicas=mysqli_query($conn, $consultaClinicas);
    // echo var_dump($cantidadClinicas);

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal.css">
    <title></title>
  </head>
  <body>
    <section class="content">
      <div class="pagecontain container">
        <div class="div-block-6">
          <?php include( "../includes/menu.php"); ?>
          <div class="contenido div-block-7 w-clearfix">
                <?php if(isset($_SESSION['usuario'])){ ?>
            <div class="row">
              <div class="col mb-5">
                <a class="agregar btn btn-success" href="#">Agregar nuevo medicamento</a>
              </div>
            </div>
            <?php } ?>
            <table id="tablaClinicas" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Ingrediente activo</th>
                <th>Marca</th>
                <th>Lote</th>
                <th>Controlado</th>
                <th>Dosis</th>
                <th>Presentación</th>
                <th>Unidades</th>
                <th>Vía de administración</th>
                <th>Fecha de caducidad</th>
                <?php if(isset($_SESSION['usuario'])){ ?>
                <th></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              while($filasClinicas = mysqli_fetch_array($cantidadClinicas))
                {
                ?>
                    <tr>
                        <td><?=$filasClinicas['activoprincipalMedicamento']?></td> <!-- ingrediente activo -->
                        <td><?=$filasClinicas['marca']?></td> <!-- marca -->
                        <td><?php echo $filasClinicas['loteMedicamento']?></td> <!-- lote -->
                        <td><?php if($filasClinicas['controlMedicamento']==1){ echo 'Si'; } else if ($filasClinicas['controlMedicamento']==2){ echo 'No'; } ?></td><!-- controlado -->
                        <td><?php echo $filasClinicas['dosis']?></td> <!-- dosis -->
                        <td><?php echo $filasClinicas['nombrePresentacion']?></td> <!-- presentacion -->
                        <td><?php echo $filasClinicas['cantidadMedicamento']?></td> <!-- unidades -->
                        <td><?php echo $filasClinicas['nombreDosis']?></td> <!-- via de admin -->
                        <td><?php echo date("d/m/Y", strtotime($filasClinicas['fechadecaducidadMedicamento']))?></td> <!-- Caducidad -->
                        <?php if(isset($_SESSION['usuario'])){ ?>

                        <td>
                            <a href="editarMedicamento.php?idClinica=<?php echo $filasClinicas['idClinica'] ?>&idMedicamento=<?php echo $filasClinicas['idMedicamento']?>" class="agregar btn btn-info">Editar</a>
                        </td>
                        <?php
                      } ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </section>
    <div class="col-md-3">
        <section class="modal">
            <div class="modal__container">

                    <div class="container-sm">
                      <h3 class="card-title mt-0">Nuevo Medicamento</h3>
                      <form action="../includes/insertarMedicamento.php" method="post" class="row w-100">
                        <div class="mb-3 col-12">
                          <input type="hidden" name="idMedicamento" value="<?php echo $filaMedicamento['idMedicamento']?>">
                          <input type="hidden" name="idUsuario" value="<?=$user_id?>">

                          <label for="Ingrediente" class="form-label">Ingrediente activo</label>
                          <input type="text" name="Ingrediente" class="form-control" id="Ingrediente" value="<?=$filaMedicamento['activoprincipalMedicamento']?>" required>
                        </div>
                        <div class="mb-3 col-7">
                          <label for="marca" class="form-label">Marca</label>
                          <input type="text" name="marca" class="form-control" id="marca" value="<?=$filaMedicamento['marca']?>" required>
                        </div>
                        <div class="mb-3 col-5">
                          <label for="lote" class="form-label">Lote</label>
                          <input type="text" name="lote" class="form-control" id="lote" value="<?=$filaMedicamento['loteMedicamento']?>" required>
                        </div>
                        <div class="mb-3 col-7">
                          <label for="Controlado" class="form-label">Controlado</label>
                          <select id="Controlado" class="form-select" name="Controlado" aria-label="Selecciona si es un medicamento controlado." required>
                            <option <?php if (!isset($filaMedicamento['controlMedicamento'])) echo 'selected'?> value="">-</option>
                            <option value="1" <?php if ($filaMedicamento['controlMedicamento']==1) echo 'selected'?>>Si</option>
                            <option value="2" <?php if ($filaMedicamento['controlMedicamento']==2) echo 'selected'?> >No</option>
                          </select>
                        </div>
                        <div class="mb-3 col-5">
                          <label for="dosis" class="form-label">Dosis</label>
                          <input type="text" name="dosis" class="form-control" id="dosis" value="<?=$filaMedicamento['dosis']?>" required>
                        </div>
                        <div class="mb-3 col-6">
                          <label for="presentacion" class="form-label">Presentación</label>
                          <select id="presentacion" class="form-select" name="presentacion" aria-label="Selecciona la presentación." required>
                            <option <?php if (!isset($filaMedicamento['idPresentacion'])) echo 'selected'?> value="">-</option>
                            <option value="1" <?php if ($filaMedicamento['idPresentacion']==1) echo 'selected'?>>Tableta</option>
                            <option value="2" <?php if ($filaMedicamento['idPresentacion']==2) echo 'selected'?> >Capsula</option>
                            <option value="3" <?php if ($filaMedicamento['idPresentacion']==3) echo 'selected'?> >Supositorio</option>
                            <option value="4" <?php if ($filaMedicamento['idPresentacion']==4) echo 'selected'?> >Pomada</option>
                            <option value="5" <?php if ($filaMedicamento['idPresentacion']==5) echo 'selected'?> >Crema</option>
                            <option value="6" <?php if ($filaMedicamento['idPresentacion']==6) echo 'selected'?> >Jarabe</option>
                          </select>
                        </div>
                        <div class="mb-3 col-6">
                          <label for="unidades" class="form-label">Unidades</label>
                          <input type="number" name="unidades" class="form-control" id="unidades" value="<?=$filaMedicamento['cantidadMedicamento']?>" required>
                        </div>
                        <div class="mb-3 col">
                          <label for="via" class="form-label">Vía de administración</label>
                          <select id="via" class="form-select" name="via" aria-label="Selecciona la vía de administración." required>
                            <option <?php if (!isset($filaMedicamento['idDosis'])) echo 'selected'?> value="">-</option>
                            <option value="1" <?php if ($filaMedicamento['idDosis']==1) echo 'selected'?>>Oral</option>
                            <option value="2" <?php if ($filaMedicamento['idDosis']==2) echo 'selected'?> >Inyectada</option>
                            <option value="3" <?php if ($filaMedicamento['idDosis']==3) echo 'selected'?> >Intravenosa</option>
                          </select>
                        </div>
                        <div class="mb-3 col">
                          <label for="caducidad" class="form-label">Fecha de caducidad</label>
                          <input type="date" name="caducidad" class="form-control" id="caducidad" value="<?=$filaMedicamento['fechadecaducidadMedicamento']?>" required>
                        </div>
                        
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                          <input class="btn btn-danger modal__close" type="button" value="Cancelar">
                        </div>
                      </form>
                    </div>




        </section>
    </div>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#tablaClinicas').DataTable({
            scrollX: true,
          });
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
