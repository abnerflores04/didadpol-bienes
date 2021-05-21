<!-- jQuery -->
<script src="<?php echo SERVERURL;?>vistas/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo SERVERURL;?>vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="<?php echo SERVERURL;?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo SERVERURL;?>vistas/plugins/moment/moment.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo SERVERURL;?>vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo SERVERURL;?>vistas/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo SERVERURL;?>vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SERVERURL;?>vistas/dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/dist/js/funciones.js"></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/jquery/jquery.mask.min.js"></script>
<script src="<?php echo SERVERURL;?>vistas/dist/js/alertas.js" ></script>
<script src="<?php echo SERVERURL;?>vistas/plugins/select2/js/select2.full.js" ></script>
<script>
    $(function () {
     $('.colaboradores_sal_reg').select2();
  $('.colaboradores_sal_reg').select2({
                    theme: 'bootstrap4'
                })
    $("#usu_celular_reg").mask("0000-0000");
    $("#usu_celular_up").mask("0000-0000");
    
    $('#example1').DataTable({
               language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar: _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                         "first": "Primero",
                         "last": "Último",
                         "next": "Siguiente",
                         "previous": "Anterior"
                    },
                    "aria": {
                         "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                         "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                    
               }
               
          });
    
});
</script>