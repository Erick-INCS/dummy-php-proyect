<?php
    session_start();
    $user_id = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idMedicamento=$_GET['idMedicamento'];

    
    $consultaMedicamentos="
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
    d.idDosis,
    d.nombreDosis,
    p.nombrePresentacion,
    p.idPresentacion
    FROM
    clinicatienemedicamento cm
    INNER JOIN medicamentos md
    ON md.idMedicamento = cm.idMedicamento
    INNER JOIN dosis d
    ON md.idDosis = d.idDosis
    INNER JOIN presentacion p
    ON md.idPresentacion = p.idPresentacion 
    WHERE cm.idMedicamento = '$idMedicamento'
    AND cm.idUsuario = '$user_id'
    ";
    
    $cantidadMedicamentos = mysqli_query($conn, $consultaMedicamentos);
    $filaMedicamento = mysqli_fetch_array($cantidadMedicamentos);
    // echo var_dump($filaMedicamento);
?>
                      <h3 class="card-title">Editar Medicamento</h3>
                      <form action="../includes/actualizarMedicamento.php" method="post" class="row w-100 mt-3">
                        <div class="mb-3 col-md-4 col-lg-3">
                          <input type="hidden" name="idMedicamento" value="<?php echo $filaMedicamento['idMedicamento']?>">
                          <input type="hidden" name="idUsuario" value="<?=$user_id?>">

                          <label for="Ingrediente" class="form-label">Ingrediente activo</label>
                          <input type="text" name="Ingrediente" class="form-control" id="Ingrediente" value="<?=$filaMedicamento['activoprincipalMedicamento']?>" required>
                        </div>
                        <div class="mb-3 col-3">
                          <label for="marca" class="form-label">Marca</label>
                          <input type="text" name="marca" class="form-control" id="marca" value="<?=$filaMedicamento['marca']?>" required>
                        </div>
                        <div class="mb-3 col-2">
                          <label for="lote" class="form-label">Lote</label>
                          <input type="text" name="lote" class="form-control" id="lote" value="<?=$filaMedicamento['loteMedicamento']?>" required>
                        </div>
                        <div class="mb-3 col-2">
                          <label for="Controlado" class="form-label">Controlado</label>
                          <select id="Controlado" class="form-select" name="Controlado" aria-label="Selecciona si es un medicamento controlado." required>
                            <option <?php if (!isset($filaMedicamento['controlMedicamento'])) echo 'selected'?> value="">-</option>
                            <option value="1" <?php if ($filaMedicamento['controlMedicamento']==1) echo 'selected'?>>Si</option>
                            <option value="2" <?php if ($filaMedicamento['controlMedicamento']==2) echo 'selected'?> >No</option>
                          </select>
                        </div>
                        <div class="mb-3 col-2">
                          <label for="dosis" class="form-label">Dosis</label>
                          <input type="text" name="dosis" class="form-control" id="dosis" value="<?=$filaMedicamento['dosis']?>" required>
                        </div>
                        <div class="mb-3 col-3">
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
                        <div class="mb-3 col-2">
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
                          <a href="inicio.php" class="btn btn-secondary">Cancelar</a>
                          <a href="../includes/eliminarMedicamento.php?idMedicamento=<?=$filaMedicamento['idMedicamento']?>" class="btn btn-danger">Eliminar</a>
                        </div>
                      </form>