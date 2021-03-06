      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo SERVERURL;?>home/" class="brand-link">
                <img src="<?php echo SERVERURL;?>vistas/dist/img/DIDAPOL-LOGO.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">DIDADPOL</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo SERVERURL;?>home/" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Inicio
                                    
                                </p>
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-usuarios/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p> Listas de Usuarios</p>
                                    </a>
                                </li>
                        </li>
                        
                        
                    </ul>
                    <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-user-tag"></i>
                                <p>
                                      Roles
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-roles/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p> Listas de Roles</p>
                                    </a>
                                </li>
                                 </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-folder-open"></i>
                                <p>
                                      Expedientes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-exp-investigacion/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Lista Expedientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-monitoreo-exp/" class="nav-link">
                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                        <p> Monitoreo expediente</p>
                                    </a>
                                </li>
                                <?php if($_SESSION['rol_id'] == 2) {?>
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-reportes-exp/" class="nav-link">
                                        <i class="nav-icon fas fa-print"></i>
                                        <p> Reportes de expediente</p>
                                    </a>
                                </li>
                                <?php } else if($_SESSION['rol_id'] == 3) {?>
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-reportes-exp-leg/" class="nav-link">
                                        <i class="nav-icon fas fa-print"></i>
                                        <p> Reportes de expediente</p>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-bitacora-fechas/" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i>
                                        <p> Bit??cora Expedientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-balance-scale"></i>
                                <p>
                                    Unidad Seguimiento
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-proc-penales/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Procesos Penales</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-proc-disciplinarios/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Procesos Disciplinarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-calendar-alt"></i>
                                <p>
                                    Feriados
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-feriados/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p> Listas de feriados</p>
                                    </a>
                                   
                                </li>
                                </ul>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>