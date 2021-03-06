     <!-- Content Wrapper. Contains page content -->
     <?php
        require_once './modelos/conectar.php';

        $sql = 'SELECT COUNT(e.exp_id) cantidad , CONCAT(u.nombre , " " , u.apellido) nombre FROM tbl_exp e
     INNER JOIN tbl_usuarios u on e.investigador_id=u.usuario_id GROUP BY investigador_id';

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

        $sql2 = 'SELECT COUNT(e.exp_id) AS cantidad, CONCAT(u.nombre , " " , u.apellido) AS nombre FROM tbl_exp e INNER JOIN tbl_usuarios u ON e.tecnico_legal_id = u.usuario_id GROUP BY e.tecnico_legal_id';

        $consulta2 = $conexion->prepare($sql2);
        $consulta2->execute();
        $res2 = $consulta2->fetchAll(PDO::FETCH_ASSOC);
        $data3 = '';
        $data4 = '';

        foreach ($res2 as $rows) {
            $data3 = $data3 . '"' . $rows['nombre'] . '",';
            $data4 = $data4 . '"' . $rows['cantidad'] . '",';
        }
        $data3 = trim($data3, ",");
        $data4 = trim($data4, ",");

        $sql3 = 'SELECT COUNT(e.exp_id) as cantidad, d.nombre as departamento FROM tbl_exp e  inner join tbl_municipios m on e.municipio_id=m.municipio_id INNER JOIN tbl_deptos d ON m.depto_id = d.depto_id GROUP BY d.depto_id';

        $consulta3 = $conexion->prepare($sql3);
        $consulta3->execute();
        $res3 = $consulta3->fetchAll(PDO::FETCH_ASSOC);
        $data5 = '';
        $data6 = '';

        foreach ($res3 as $rows) {
            $data5 = $data5 . '"' . $rows['departamento'] . '",';
            $data6 = $data6 . '"' . $rows['cantidad'] . '",';
        }
        $data5 = trim($data5, ",");
        $data6 = trim($data6, ",");

        $sql4 = 'SELECT COUNT(e.exp_id) as cantidad, m.nombre as municipio FROM tbl_exp e INNER JOIN tbl_municipios m ON e.municipio_id = m.municipio_id GROUP BY  e.municipio_id';

        $consulta4 = $conexion->prepare($sql4);
        $consulta4->execute();
        $res4 = $consulta4->fetchAll(PDO::FETCH_ASSOC);
        $data7 = '';
        $data8 = '';

        foreach ($res4 as $rows) {
            $data7 = $data7 . '"' . $rows['municipio'] . '",';
            $data8 = $data8 . '"' . $rows['cantidad'] . '",';
        }
        $data7 = trim($data7, ",");
        $data8 = trim($data8, ","); 
        

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
                             <a href="<?php echo SERVERURL; ?>lista-usuarios/" class="small-box-footer">Mas informaci??n <i class="fas fa-arrow-circle-right"></i></a>
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
                             <a href="<?php echo SERVERURL; ?>lista-roles/" class="small-box-footer">Mas informaci??n <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                        
                         <div class="small-box bg-info">
                             <div class="inner">
                                 <h3>*<sup style="font-size: 20px"></h3>

                                 <p>Expedientes</p>
                             </div>
                             <div class="icon">

                                 <i class="far fa-folder-open"></i>
                             </div>
                             <a href="<?php echo SERVERURL; ?>lista-giras/" class="small-box-footer">Mas informaci??n <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->


                     <div class="col-lg-3 col-6">
                     <?php
                            require_once "./controladores/feriadosControlador.php";
                            $ins_feriados = new feriadosControlador();
                            $total_feriados = $ins_feriados->datos_feriado_controlador("Conteo", 0);
                            ?>
                         <!-- small box -->
                         <div class="small-box bg-danger">
                             <div class="inner">
                                 <h3><?php echo $total_feriados->rowCount(); ?></h3>

                                 <p>Feriados</p>
                             </div>
                             <div class="icon">
                                 <i class="far fa-calendar-alt"></i>
                             </div>
                             <a href="#" class="small-box-footer">Mas informaci??n <i class="fas fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-12">
                         <div class="card card-info">
                             <div class="card-header">
                                 <h3 class="card-title">Expedientes por investigador</h3>
                             </div>
                             <div class="card-body">
                                 <canvas id="myChartInvest"></canvas>
                             </div>
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-12">
                         <div class="card card-info">
                             <div class="card-header">
                                 <h3 class="card-title">Expedientes por t??cnico legal</h3>
                             </div>
                             <div class="card-body">
                                 <canvas id="myChartLeg"></canvas>
                             </div>
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-6 col-12">
                         <div class="card card-info">
                             <div class="card-header">
                                 <h3 class="card-title">Expedientes por departamento</h3>
                             </div>
                             <div class="card-body">
                                 <canvas id="myChartDepto"></canvas>
                             </div>
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-6 col-12">
                         <div class="card card-info">
                             <div class="card-header">
                                 <h3 class="card-title">Expedientes por municipio</h3>
                             </div>
                             <div class="card-body">
                                 <canvas id="myChartMunci"></canvas>
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
         var ctx = document.getElementById('myChartInvest');

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

         var ctx = document.getElementById('myChartLeg');

         var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: [<?php echo $data3; ?>],
                 datasets: [{
                     label: 'Cantidad de expedientes por t??cnico legal',
                     data: [<?php echo $data4; ?>],
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

         var ctx = document.getElementById('myChartDepto');

         var myChart = new Chart(ctx, {
             type: 'pie',
             data: {
                 labels: [<?php echo $data5; ?>],
                 datasets: [{
                     label: 'Cantidad de expedientes por departamento',
                     data: [<?php echo $data6; ?>],
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

         var ctx = document.getElementById('myChartMunci');

         var myChart = new Chart(ctx, {
             type: 'pie',
             data: {
                 labels: [<?php echo $data7; ?>],
                 datasets: [{
                     label: 'Cantidad de expedientes por municipio',
                     data: [<?php echo $data8; ?>],
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