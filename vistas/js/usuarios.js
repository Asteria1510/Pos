//SUBIENDO FOTO USUARIO 

$(".nuevaFoto").change(function () {

    var imagen = this.files[0];

    //VALIDAR FORMATO DE LA FOTO- IMAGEN JPG-PNG

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

        $(".nuevaFoto").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagen["size"] > 2000000) {

        $(".nuevaFoto").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {

            var rutaImagen = event.taget.result;

            $(".previsualizar").attr("src", rutaImagen);

        })

    }
});

//EDITAR USUARIO

$(document).on("click", ".btnEditarUsuario", function () {

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);

            $("#passwordActual").val(respuesta["password"]);

            if (respuesta["foto"] != "") {

                $(".previsualizar").attr("src", respuesta["foto"]);

            }
        }

    });

})

//ACTIVAR USUARIO

$(document).on("click", ".btnActivar", function () {

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            if (window.matchMedia("(max-width:767px)").matches) {

                swal({
                    title: "El usuario ha sido actualizado",
                    type: "success",
                    confirmButtonText: "¡Cerrar!"
                }).then(function (result) {

                    if (result.value) {

                        window.location = "usuarios";

                    }

                });

            }

        })

    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario');

    } else {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);

    }

})

//ELIMINAR USUARIO

$(document).on("click", ".btnEliminarUsuario", function () {

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");

    swal({
        title: '¿Está seguro de borrar el usuario?',
        text: '¡Si no lo está puede cancelar la acción!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#515ecf',
        cancelButtonColor: '#d92e7f',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, borrar usuario!'
    }).then((result) => {

        if (result.value) {

            window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario + "&usuario=" + usuario + "&fotoUsuario=" + fotoUsuario;

        }

    })

})
