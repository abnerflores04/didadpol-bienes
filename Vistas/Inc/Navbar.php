<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Inicio</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <?php
                        echo $_SESSION['usuario_spm'];?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SERVERURL.'actualizar-usuario/'?>" >
                    <i class="fas fa-user-cog"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn-exit-system" href="#" >
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

  