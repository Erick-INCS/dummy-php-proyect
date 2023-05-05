<?php
  include "../includes/utils.php";
  $env = LoginRedirection();
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
  </head>
  <body>
    <section class="content">
      <div class="pagecontain">
        <div class="div-block-6">
          <?php include( "../includes/menu.php"); ?>
          <div class="div-block-7 w-clearfix">
            <div class="topdashbar">
              <div class="stathold">
                <h4>Nuestros servicios</h4>
                <p>Proyecto con gran impacto en la sociedad</p>
              </div>
            </div>
            <div class="row mt-4">
              <!-- <div class="col">
                <a href="mostrarClinicas.php" class="botonMenu clinicas"></a>
              </div> -->
              <div class="col">
                <a href="mostrarMedicamentos.php" class="botonMenu medicamentos"></a>
              </div>
              <div class="col">
                <a href="requisitos.php" class="botonMenu requisitos"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
