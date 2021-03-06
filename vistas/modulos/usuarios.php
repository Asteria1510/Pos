<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Administrar usuarios

        </h1>

        <ol class="breadcrum">

            <li><a href="Inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

            <li class="active">Administrar usuarios</li>

        </ol>

    </section>

    <section class="content-header">

        <section class="content">

            <div class="box">

                <div class="box-header with-border">

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

                        Agregar Usuario

                    </button>

                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped  dt-table-responsive tablas">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Foto</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Último login</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php
                        
                        $item = null;
                        $valor = null;
                        
                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        foreach ($usuarios as $key => $value){

                           echo '<tr>

                           <td>1</td>
                           <td>'.$value["nombre"].'</td>
                           <td>'.$value["usuario"].'</td>';

                            if($value["foto"] != ""){

                                echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px" </td>';

                            }else{

                                echo '<td><img src="vistas/dist/img/default.jpg"  class="img-thumbnail" width="40px"></td>';

                            }
                         
                            echo '<td>'.$value["perfil"].'</td>';
 
                            if($value["estado"] != 0){

                                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'"estadoUsuario="0>Activado</button></td>';

                            }else{

                                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'"estadoUsuario="1">Desactivado</button></td>';

                           }

                           echo '<td>'.$value["ultimo_login"].'</td>
                           <td>

                               <div class="btn-group">

                                   <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                                   <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

                               </div>

                           </td>

                       </tr>';
                        
                        }   

                        ?>
                                                            
                        </tbody>

                    </table>

                </div>

            </div>

        </section>

</div>

<!-------------------MODAL AGREGAR USUARIO ------------------->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

                <!-- CABEZA DEL MODAL -->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Usuario</h4>
                </div>

<!-------------------- CUERPO DEL MODAL ----------------------->

                <div class="modal-body">
                    <div class="box-body">

<!-------------------- ENTRADA PARA EL NOMBRE ------------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" require>

                            </div>

                        </div>

<!----------------------- ENTRADA PARA EL USUARIO ----------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario" require>

                            </div>

                        </div>

<!------------------------- ENTRADA PARA CONTRASEÑA ----------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar Contraseña" require>

                            </div>

                        </div>

<!------------------------ ENTRADA PARA SELECCIONAR PERFIL ------------>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="nuevoPerfil">

                                    <option value="">Seleccionar perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Despacahador">Despachador</option>


                                </select>

                            </div>

                        </div>

<!------------------------ ENTRADA PARA SUBIR FOTO --------------------->

                        <div class="form-group">

                            <div class="panel">SUBIR FOTO</div>

                            <input type="file" class="nuevaFoto" name="nuevaFoto">

                            <p class="help-block">Peso máximo de la foto 2 MB</p>

                            <img src="vistas/dist/img/default.jpg"  class="img-thumbnail previsualizar" width="100px">

                        </div>

                    </div>
                </div>

<!----------------------- PIE DEL MODAL ------------------>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar Usuario</button>
                </div>

                    
<?php

    $crearUsuario = new ControladorUsuarios();
    $crearUsuario->ctrCrearUsuario();

?>

            </form>
        </div>
    </div>
</div>


<!------------------------- MODAL EDITAR USUARIO ------------->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="post">

<!------------------------- CABEZA DEL MODAL ----------------->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Usuario</h4>
                </div>

<!------------------------- CUERPO DEL MODAL ------------------>

                <div class="modal-body">
                    <div class="box-body">

<!------------------------- ENTRADA PARA EL NOMBRE -------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" require>

                            </div>

                        </div>

<!------------------------- ENTRADA PARA EL USUARIO ------------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" require>

                            </div>

                        </div>

<!--------------------------- ENTRADA PARA CONTRASEÑA -------------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Ingrese Nueva Contraseña">
                                <input type="hidden" id="passwordActual" name="passwordActual">
                            </div>

                        </div>

<!------------------------------ ENTRADA PARA SELECCIONAR PERFIL ---------------->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="editarPerfil">

                                    <option value="" id="editarPerfil"></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Despacahador">Despachador</option>


                                </select>

                            </div>

                        </div>

<!-------------------------------- ENTRADA PARA SUBIR FOTO ---------------------->

                        <div class="form-group">

                            <div class="panel">SUBIR FOTO</div>

                            <input type="file" class="nuevaFoto" name="nuevaFoto">

                            <p class="help-block">Peso máximo de la foto 2 MB</p>

                            <img src="vistas/dist/img/default.jpg"  class="img-thumbnail previsualizar" width="100px">

                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>

                    </div>
                </div>

<!---------------------------------- PIE DEL MODAL --------------------------------->

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>

                <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario -> ctrEditarUsuario();

                ?>

            </form>
        </div>
    </div>
</div>