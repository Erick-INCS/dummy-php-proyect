        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="inicio.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><?=$APP_NAME?></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0"><?=$_SESSION['nombre_usuario']?></h6>
                        <span><?=$_SESSION['cargo']?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="inicio.php" class="nav-item nav-link <?php if ($c=='Medicamentos'){echo 'active';}?>"><i class="fa fa-prescription-bottle me-2"></i>Medicamentos</a>
                    <?php if($is_admin){ ?>
                    <!-- Para administrador -->
                        <a href="mostrarUsuarios.php" class="nav-item nav-link <?php if ($c=='Usuarios'){echo 'active';}?>"><i class="fa fa-users me-2"></i>Usuarios</a>
                        <a href="m_historial.php" class="nav-item nav-link <?php if ($c=='Historial'){echo 'active';}?>"><i class="fa fa-history me-2"></i>Historial</a>
                    <?php } ?>

                    <!-- <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->