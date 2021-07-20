     <!-- Content Wrapper. Contains page content -->
     <?php
        require_once './modelos/conectar.php';

        $sql = 'SELECT COUNT(e.exp_id) cantidad , CONCAT(u.usu_nombre , " " , u.usu_apellido) nombre FROM tbl_exp e
     INNER JOIN tbl_usuario u on e.investigador_id=u.usu_id GROUP BY investigador_id';

        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $res = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $data1 = '';
        $data2 = '';

        foreach ($res as $rows) {
            $data1 = $data1 . '"' . $rows['nombre'] . '",';
            $data2 = $data2 . '"' . $rows['cantidad'] . '",';
        }
        $data1 = trim($data1, ",");
        $data2 = trim($data2, ",");


        ?>
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

                                 <p>Usuarios Registrados</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-person-add"></i>
                             </div>
                             <a href="<?php echo SERVERURL; ?>lista-usuarios/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
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
                             <a href="<?php echo SERVERURL; ?>lista-roles/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">

                         <div class="small-box bg-info">
                             <div class="inner">
                                 <h3>*<sup style="font-size: 20px"></h3>

                                 <p>Expedientes</p>
                             </div>
                             <div class="icon">

                             <i class="far fa-folder-open"></i>
                             </div>
                             <a href="<?php echo SERVERURL; ?>lista-giras/" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->


                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-danger">
                             <div class="inner">
                                 <h3>*</h3>

                                 <p>Feriados</p>
                             </div>
                             <div class="icon">
                             <i class="far fa-calendar-alt"></i>
                             </div>
                             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-6 col-12">
                         <div class="card card-info">
                             <div class="card-header">
                                 <h3 class="card-title">Expedientes por Investigador</h3>
                             </div>
                             <div class="card-body">
                                 <canvas id="myChart"></canvas>
                             </div>
                         </div>
                     </div>
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

     <script>
         var ctx = document.getElementById('myChart');

         var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: [<?php echo $data1; ?>],
                 datasets: [{
                     label: 'Cantidad de expedientes por investigador',
                     data: [<?php echo $data2; ?>],
                     backgroundColor: [
                         'rgba(255, 99, 132, 0.2)',
                         'rgba(54, 162, 235, 0.2)',
                         'rgba(255, 206, 86, 0.2)',
                         'rgba(75, 192, 192, 0.2)',
                         'rgba(153, 102, 255, 0.2)',
                         'rgba(255, 159, 64, 0.2)'

                     ],
                     borderColor: [
                         'rgba(255, 99, 132, 1)',
                         'rgba(54, 162, 235, 1)',
                         'rgba(255, 206, 86, 1)',
                         'rgba(75, 192, 192, 1)',
                         'rgba(153, 102, 255, 1)',
                         'rgba(255, 159, 64, 1)'

                     ],
                     borderWidth: 1
                 }]
             },
             options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }
         });
     </script>