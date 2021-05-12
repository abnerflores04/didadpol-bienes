<?php
if ($peticionAjax) {
    require_once "../modelos/usuarioModelo2.php";
} else {
    require_once "./modelos/usuarioModelo2.php";
}
class usuarioControlador2 extends usuarioModelo2
{
    
    
    public function listar_usuarios_controlador()
    {
        $contador = 1;
        $tabla = '';
        $consulta = "SELECT * FROM tbl_usuario u INNER JOIN tbl_rol r on u.rol_id=r.rol_id WHERE usu_id!=1 order by usu_id desc";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

       

        $tabla .= '<div class="table-responsive">

        <a href="'. SERVERURL . 'registro-usuarios/" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Nuevo usuario
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered table-hover">

            <thead class="text-center">
                <tr>
                    <th>N°</th>
                    <th>ROL</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>USUARIO</th>
                    <th>CORREO </th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td>' . $contador . '</td>
                <td>' . $rows['rol_nombre'] . '</td>
                <td>' . $rows['usu_nombre'] . '</td>
                <td>' . $rows['usu_apellido'] . '</td>
                <td>' . $rows['usu_usuario'] . '</td>
                <td>' . $rows['usu_correo_i'] . '</td>
                <td>' . $rows['usu_estado'] . '</td>
                <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-informacion-usuario/' . mainModel2::encryption($rows['usu_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>

                    <a href="' . SERVERURL . 'actualizar-usuario/' . mainModel2::encryption($rows['usu_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="usuario_id_del" value="' . mainModel2::encryption($rows['usu_id']) . '">

                        <button type="submit" title="Eliminar"class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </form>
                </div>
            </td> 
            </tr>';
            $contador++;
        }
        $tabla.=' </tbody>
        </table>
        </div>';
        return $tabla;
    }
}/* fin clase */
