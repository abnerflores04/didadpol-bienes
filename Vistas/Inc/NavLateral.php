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
                            <i class="fas fa-car"></i>
                                <p>
                                    Salidas
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo SERVERURL;?>lista-giras/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p> Listas de giras</p>
                                    </a>
                                    <a href="<?php echo SERVERURL;?>lista-diligencias/" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p> Listas de diligencias</p>
                                    </a>
                                </li>
                                </ul>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>