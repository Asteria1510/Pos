<?php

require_once 'modelos/usuarios.modelo.php.php';
class ControladorUsuarios

{

//INGRESO USUARIOS
    
    static public function ctrIngresoUsuario()
    {

        if (isset($_POST["ingUsuario"])) {

            //echo '$_POST["ingUsuario"]';

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {

                //$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $encriptar = $_POST["ingPassword"];
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] ==  $encriptar) {

                    $_SESSION["iniciarSesion"] = "Ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["usuario"] = $respuesta ["usuario"];
                    $_SESSION["foto"] = $respuesta ["foto"];
                    $_SESSION["perfil"] = $respuesta ["perfil"];

 //REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN

                    //date_default_timezone_get('America/Bogota');
                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');

                    $fechaActual = $fecha.''.$hora;

                    $item1 = "ultimo_login";
                    $valor1 = $respuesta["ultimo_login"];

                    $item2 = "id";
                    $valor2 = $respuesta["id"];

                    $respuestaUltimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                    print_r($respuestaUltimoLogin);

                    //if($respuestaUltimoLogin == "OK"){
                        if(isset($respuestaUltimoLogin)){
                        

                        
                    echo '<script>
                    
                    window.location = "inicio";

                    </script>';

                    }

                }else{

                    echo '<br><div class="alert alert-danger">El usuario aún no esta activado</div>';
                }
            }else{

                echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

            }
        }
    }

//REGISTRO USUARIO

    static public function ctrCrearUsuario()
    {
        if(isset($_POST["nuevoUsuario"])){

            if(
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])  &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

                    
 //VALIDAR FOTO

                $ruta = "";

                if(isset($_FILES["nuevaFoto"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));

                    $nuevoAcho = 500;
                    $nuevoAlto = 500;

                    $directorio = "vistas/dist/img/usuarios/".$_POST["nuevoUsuario"];

                    mkdir($directorio, 0755);

                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

//GUARDAMOS IMAGEN EN EL DIRECTORIO

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/dist/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio."jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAcho, $nuevoAlto);

                        //imagecopyresized(dst_image, src_image, dst_x, dst_y, scr_x, src_y, dst_w, dst_h, src_w, src_h);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAcho , $nuevoAlto, $ancho , $alto);

                        imagejpeg($destino, $ruta);

                    }
                
                    if($_FILES["nuevaFoto"]["type"] == "image/png"){

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/dist/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio."png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAcho, $nuevoAlto);

                        //imagecopyresized(dst_image, src_image, dst_x, dst_y, scr_x, src_y, dst_w, dst_h, src_w, src_h);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAcho , $nuevoAlto, $ancho , $alto);

                        imagepng($destino, $ruta);

                    }
                }
            }

//VALIDAR IMAGEN

                    $ruta = $_POST["fotoActual"];

                    if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
    
                        list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
    
                        $nuevoAcho = 500;
                        $nuevoAlto = 500;
                   
                    $directorio = "vistas/dist/img/usuarios/".$_POST["editarUsuario"];               

//SE PREGUNTA SI HAY ALGUNA IMAGEN EN LA BASE DE DATOS
                    
                    if(!empty($_POST["fotoActual"])){

                        unlink($_POST["foto_Actual"]);

                    }else{
                        
                        mkdir($directorio, 0755);

                    }  

//DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP              

                    if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/dist/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio."jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAcho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAcho , $nuevoAlto, $ancho , $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["editarFoto"]["type"] == "image/png"){

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/dist/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio."png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAcho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAcho , $nuevoAlto, $ancho , $alto);

                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "usuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nuevoNombre"],
                              "usuario" => $_POST["nuevoUsuario"],
                              "password" => $_POST["nuevoPassword"],
                              "perfil" => $_POST["nuevoPerfil"],
                              "foto" => $ruta);

                  $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

              $tabla = "usuarios";

              $datos = array("nombre" => $_POST["nuevoNombre"],
                              "usuario" => $_POST["nuevoUsuario"],
                              "password" => $_POST["nuevoPassword"],
                              "perfil" => $_POST["nuevoPerfil"]);

              $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
              
              if($respuesta == "OK"){

                  echo '<script>

                  swal({

                      type: "success",
                      title: "¡El usuario ha sido guardado exitosamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false

                  }).then((result)=>{

                      if(result.value){

                          window.location ="usuarios";

                      }
                      
                  });
                  
              </script>'; 

              }
          } 
      


                $tabla = "usuarios";

                if($_POST["editarPassword"] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
                    
                            $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                }else{   
    
                      echo '<script>
    
                                swal({
                                     type: "error",
                                     title: "¡La contraseña no puede ir vacía llevar caracteres especiales!",
                                     showConfirmButton: true,
                                     confirmButtonText: "Cerrar",  
                                     closeOnConfirm: false
                                     }).then((result)=>{
    
                                        if(result.value){
    
                                        window.location ="usuarios";

                                        }

                                    })

                            </script>';

                        }

                    }else{

                        //$encriptar = $passwordActual;
                        $encriptar = $_POST["passwordActual"];

                    }       

                    $datos = array("nombre" => $_POST["editarNombre"],
                                "usuario" => $_POST["editarUsuario"],
                                "password" => $encriptar,
                                "perfil" => $_POST["editarPerfil"],
                                "foto" => $ruta);

                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                    if($respuesta == "OK"){

                      echo '<script>

                        swal({

                         type: "success",
                         title: "¡El usuario ha sido guardado correctamente!",
                         showConfirmButton: true,
                         confirmButtonText: "Cerrar",
                         closeOnConfirm: false

                    }).then((result)=>{

                          if(result.value){

                            window.location = "usuarios";

                        }

                    });

                    </script>';

                }else{    

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El usuario no puede ir vacío llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location ="usuarios";

                        }
                        
                    });
                    
                 </script>'; 

             }

            }
     
//BORRAR USUARIO

     public static function ctrBorrarUsuario(){

        if(isset($_GET["idUsuario"])){

            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            if($_GET["fotoUsuario"] != ""){

                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/dist/img/usuarios/'.$_GET["usuario"]);
            }

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if($respuesta == "OK"){

                echo '<script>

                  swal({

                   type: "success",
                   title: "¡El usuario ha sido borrado correctamente!",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConfirm: false

              }).then((result)=>{

                    if(result.value){

                      window.location = "usuarios";

                  }

              });

              </script>';

        }

     }

}
}



