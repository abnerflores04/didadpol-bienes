     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0">Dashboard</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                             <li class="breadcrumb-item active"></li>
                         </ol>
                     </div><!-- /.col -->
                 </div><!-- /.row -->
             </div><!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->

         <!-- Main content -->
         <section class="content">
             <div class="container-fluid">
             <?php
                require_once "./controladores/usuarioControlador2.php";
                $ins_usuario = new usuarioControlador2();
                $total_usuarios = $ins_usuario->datos_usuario_controlador("Conteo", 0);
            ?>
                 <!-- Small boxes (Stat box) -->
                 <div class="row">
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-success">
                             <div class="inner">
                                 <h3><?php echo $total_usuarios->rowCount(); ?></h3>

                                 <p >Usuarios Registrados</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-person-add"></i>
                             </div>
                             <a href="<?php echo SERVERURL;?>lista-usuarios/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <?php
                            require_once "./controladores/rolControlador.php";
                             $ins_rol = new rolControlador();
                             $total_roles = $ins_rol->datos_rol_controlador("Conteo", 0);
                        ?>
                         <div class="small-box bg-warning">
                             <div class="inner">
                                 <h3><?php echo $total_roles->rowCount(); ?><sup style="font-size: 20px"></sup></h3>

                                 <p>Roles</p>
                             </div>
                             <div class="icon">
                             <i class="fas fa-user-tag"></i>
                             </div>
                             <a href="<?php echo SERVERURL;?>lista-roles/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                        
                         <div class="small-box bg-info">
                             <div class="inner">
                                 <h3>*<sup style="font-size: 20px"></h3>

                                 <p>Giras</p>
                             </div>
                             <div class="icon">
                             
                             <i class="fas fa-car-side"></i>
                             </div>
                             <a href="<?php echo SERVERURL;?>lista-giras/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                   

                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-danger">
                             <div class="inner">
                                 <h3>65</h3>

                                 <p>Unique Visitors</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-pie-graph"></i>
                             </div>
                             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                 </div>
                 <!-- /.row -->
                
                 <!-- /.row (main row) -->
             </div><!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
     <footer class="main-footer">
         <strong>Copyright &copy; 2021 <a href="https://didadpol.gob.hn">DIDADPOL</a>.</strong>
         All rights reserved.
         <div class="float-right d-none d-sm-inline-block">
             <b>Version</b> 3.1.0
         </div>
     </footer>