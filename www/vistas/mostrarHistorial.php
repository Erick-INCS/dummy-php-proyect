<div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0">Historial de modificaciones</h6>
</div>

<?php
    session_start();
    $user_id = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $consultaClinicas="
    SELECT
      *
    FROM
      historial h
        LEFT JOIN medicamentos md
          ON md.idMedicamento = h.idMedicamento
        LEFT JOIN presentacion p
          ON h.presentacion = p.idPresentacion
    ;
    ";
    $cantidadClinicas=mysqli_query($conn, $consultaClinicas);
?>
            <table id="tablaClinicas" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Registro</th>
                <th>Ingrediente activo</th>
                <th>Marca</th>
                <th>Lote</th>
                <th>Controlado</th>
                <th>Dosis</th>
                <th>Presentación</th>
                <th>Unidades</th>
                <th>Vía de administración</th>
                <th>Fecha de caducidad</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($filasClinicas = mysqli_fetch_array($cantidadClinicas))
                {
                  if (isset($filasClinicas['fecha_caducidad'])) {
                    $dt=strtotime($filasClinicas['fecha_caducidad']);
                  }
                  // elseif (isset($filasClinicas['fechadecaducidadMedicamento'])) {
                  //   $dt =strtotime($filasClinicas['fechadecaducidadMedicamento']);
                  // }
                ?>
                    <tr>
                        <td><?=$filasClinicas['txid']?></td> <!-- # -->
                        <td><?=$filasClinicas['comentario']?></td> <!-- comentario -->
                        <td><?=$filasClinicas['ingrediente_activo']?></td> <!-- ingrediente activo -->
                        <td><?=$filasClinicas['marca']?></td> <!-- marca -->
                        <td><?php echo $filasClinicas['lote']?></td> <!-- lote -->
                        <td><?php if($filasClinicas['controlado']==1){ echo 'Si'; } else if ($filasClinicas['controlMedicamento']==2){ echo 'No'; } ?></td><!-- controlado -->
                        <td><?php echo $filasClinicas['dosis']?></td> <!-- dosis -->
                        <td><?php echo $filasClinicas['nombrePresentacion']?></td> <!-- presentacion -->
                        <td><?php echo $filasClinicas['unidades']?></td> <!-- unidades -->
                        <td><?php echo $filasClinicas['dosis']?></td> <!-- via de admin -->
                        <td ><?php
                          if (isset($dt)) {
                            echo date("d/m/Y", $dt);
                          }
                        ?></td> <!-- Caducidad -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
          </table>
          </div>
        </div>




      </div>
    </div>
  </div>
</div>


    <script type="text/javascript">
      $(document).ready( function () {
        $.fn.dataTable.moment( 'DD/MM/YYYY' );
        $('#tablaClinicas').DataTable({
            scrollX: true,
            order: [[0, 'desc']],
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
