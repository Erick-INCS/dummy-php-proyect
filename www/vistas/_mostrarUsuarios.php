<div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0">Sección de usuarios</h6>
    <!-- <a href="">Show All</a> -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Agregar usuario
    </button>
</div>

<?php
    //session_start();
    //$session = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $consultaUsuarios="SELECT idUsuario, nombreUsuario, cargo, correo, recibe_alertas FROM  usuarios";
    $queryUsuarios = mysqli_query($conn, $consultaUsuarios);
?>

<div class="contenido div-block-7 w-clearfix">
		<?php
			if (isset($_GET['err'])) {?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<?=$_GET['err']?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php } ?>

	<table id="tablaClinicas" class="table table-striped table-bordered">
		<thead>
			<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Cargo</th>
			<th>Correo</th>
			<th>Recibe alertas</th>
			<th></th>
			</tr>
		</thead>

		<tbody>
			<?php while($filasUsuarios = mysqli_fetch_array($queryUsuarios)) { ?>
				<tr>
					<td><?php echo $filasUsuarios['idUsuario']?></td>
					<td><?php echo $filasUsuarios['nombreUsuario']?></td>
					<td><?php echo $filasUsuarios['cargo']?></td>
					<td><?php echo $filasUsuarios['correo']?></td>
					<td><?php if ($filasUsuarios['recibe_alertas'] == 1) {echo 'Si';} else {echo 'No';}?></td>
					<?php
						if(0==0){
						?>
					<td><a href="editarUsuario.php?idUsuario=<?php echo $filasUsuarios['idUsuario'] ?>" class="btn btn-sm btn-primary">Editar</a></td>
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
			<?php } ?>
		</tbody>
	</table>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<form action="../includes/insertarUsuario.php" method="post" class="row">
					<div class="mb-3 col-7">
						<label for="nombreUsuario" class="form-label">Nombre</label>
						<input type="hidden" name="idUsuario" value="<?php echo $filaClinica['idUsuario'] ?>">
						<input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" value="<?=$filaClinica['nombreUsuario']?>" required>
					</div>

					<div class="mb-3 col-5">
						<label for="cargo" class="form-label">Cargo</label>
						<select id="cargo" class="form-select" name="cargo" aria-label="Selecciona el tipo de usuario." required>
							<option selected value="">-</option>
							<option >Administrador</option>
							<option >Pasante</option>
							<option >Médico</option>
						</select>
					</div>

					<div class="mb-3 col-7 text-center">
						<label for="correo" class="form-label">Correo</label>
						<input type="email" name="correo" class="form-control" value="<?=$filaClinica['correo']?>" id="correo" required>
					</div>
					
					<div class="mb-3 col">
						<div class="form-check mt-4">
							<input class="form-check-input" type="checkbox" value="1" id="alertas" name="alertas">
							<label class="form-check-label" for="alertas">
								Recibe alertas
							</label>
						</div>
					</div>

					<div class="col-12">
						<button type="submit" id="action_btn" class="btn btn-primary">Registrar</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
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
