<?php
  session_start();
  $is_admin = $_SESSION['admin'];
  if(isset($_SESSION['usuario'])){ ?>
<?php } ?>

<div class="flextleft menuleft">
  <div class="row w-row">
    <div class="w-col w-col-10">
      <div class="leftnametext nametext">Bienvenido</div>
      <div class="detailtext leftnametext nametext">Menu interactivo</div>
    </div>
  </div>
  <div class="leftmenucontain">
    <a href="inicio.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">G</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Inicio</div></div>
      </div>
    </a>
    <a href="mostrarMedicamentos.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">B</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Medicamentos</div></div>
      </div>
    </a>
    <?php if($is_admin){ ?>
    <!-- Para administrador -->
    <a href="mostrarUsuarios.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">A</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Usuarios</div></div>
      </div>
    </a>
    
    <a href="mostrarDosis.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">C</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Dosis</div></div>
      </div>
    </a>
    <a href="mostrarPresentacion.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">D</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Presentacion</div></div></div>
    </a>
    <!-- <a href="mostrarPresentacion.php" class="leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">D</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Presentacion</div></div></div>
    </a> -->
    <a href="../includes/cerrarsesion.php" class="leftlogout leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">F</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Salir</div></div>
      </div>
    </a>
<?php } elseif(!isset($_SESSION['usuario'])){ ?>
    <a href="iniciarsesion.php" class="leftlogout leftmenulink w-inline-block">
      <div class="w-row">
        <div class="w-col w-col-2"><div class="icontectleft">F</div></div>
        <div class="w-col w-col-8"><div class="leftlinktext">Iniciar sesion</div></div>
      </div>
    </a>
<?php } ?>
  </div>
</div>
