<?php
    //session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $consultaUsuarios="SELECT idUsuario, nombreUsuario, cargo, correo FROM  usuarios";
    $queryUsuarios = mysqli_query($conn, $consultaUsuarios);

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
            <div class="row">
              <div class="col mb-5">
                <a class="agregar btn btn-success" href="#">Agregar nuevo usuario</a>
              </div>
            </div>
            <table id="tablaClinicas" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Correo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($filasUsuarios = mysqli_fetch_array($queryUsuarios))
                {
                ?>
                    <tr>
                        <td><?php echo $filasUsuarios['idUsuario']?></td>
                        <td><?php echo $filasUsuarios['nombreUsuario']?></td>
                        <td><?php echo $filasUsuarios['cargo']?></td>
                        <td><?php echo $filasUsuarios['correo']?></td>
                        <?php
                          if(0==0){
                            ?>
                        <td><a href="editarUsuario.php?idUsuario=<?php echo $filasUsuarios['idUsuario'] ?>" class="btn btn-info">Editar</a></td>
                        <!-- <td><a href="../includes/eliminarUsuario.php?idUsuario=<?php echo $filasUsuarios['idUsuario'] ?>" class="btn btn-danger">Eliminar</a></td> -->
                        <?php
                      }
                      else {
                        ?>
                          <td></td>
                          <td></td>
                        <?php
                      }
                      ?>

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
                <!-- <h3 class="card-title">Agregar Usuario</h3>
                <form class="" action="../includes/insertarUsuario.php" method="post">
                  <div class="row">
                    <div class="col">
                      <label for="">Nombre:</label>
                      <input class="form-control" type="text" name="nombreUsuario" value="" required>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                      <div class="col">
                        <label for="">Clave:</label>
                        <input class="form-control" type="password" name="claveUsuario" value="" required>
                      </div>
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
                    </form> -->

                    <div class="container-sm">
                      <h3 class="card-title mt-0">Agregar Usuario</h3>
                      <form action="../includes/insertarUsuario.php" method="post">
                      <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="hidden" name="idUsuario" value="<?php echo $filaClinica['idUsuario'] ?>">
                        <input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" value="<?=$filaClinica['nombreUsuario']?>" required>
                      </div>
                      <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" name="cargo" class="form-control" id="cargo" value="<?=$filaClinica['cargo']?>" required>
                      </div>
                      <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" value="<?=$filaClinica['correo']?>" id="correo" required>
                      </div>
                    </div>

                    <div>
                      <button type="submit" id="action_btn" class="btn btn-primary">Registrar</button>
                      <input class="btn btn-danger modal__close" type="button" value="Cancelar">
                    </div>
                  </form>
                </div>
              </div>
            </section>
          </div>
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
