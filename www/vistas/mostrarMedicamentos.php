<div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0">Sección de medicamentos</h6>
    <!-- <a href="">Show All</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Agregar medicamento
    </button>
</div>

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
?>
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
                  $dt =strtotime($filasClinicas['fechadecaducidadMedicamento']);
                  $months_nm = (3600 * 24 * 30);
                  $months = abs(($dt / $months_nm) - (strtotime("now") / $months_nm));
                  $m_color = '';
                  if ($months <= 3.0) {
                    $m_color = 'text-danger';
                  }
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
                        <td class="<?=$m_color?>"><?php echo date("d/m/Y", $dt)?></td> <!-- Caducidad -->
                        <?php if(isset($_SESSION['usuario'])){ ?>

                        <td>
                            <a href="editarMedicamento.php?idClinica=<?php echo $filasClinicas['idClinica'] ?>&idMedicamento=<?php echo $filasClinicas['idMedicamento']?>" class="btn btn-sm btn-primary">Editar</a>
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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Medicamento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


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
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </form>


      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


    <script type="text/javascript">
      $(document).ready( function () {
        $.fn.dataTable.moment( 'DD/MM/YYYY' );
        $('#tablaClinicas').DataTable({
            scrollX: true,
            order: [[8, 'asc']],
          });
      });

      // const openModal = document.querySelector('.agregar');
      // const modal = document.querySelector('.modal');
      // const closeModal = document.querySelector('.modal__close');

      //     openModal.addEventListener('click', (e)=>{
      //       e.preventDefault();
      //       modal.classList.add('modal--show');
      //     });

      //     closeModal.addEventListener('click', (e)=>{
      //       e.preventDefault();
      //       modal.classList.remove('modal--show');
      //     });
    </script>
