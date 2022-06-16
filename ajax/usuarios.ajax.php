<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

//EDITAR USUARIOS

    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

//ACTIVAR USUARIO

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    }    
        
}

//EDITAR USUARIO

if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();

}