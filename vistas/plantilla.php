      <?php

      session_start();

      ?>

      <!DOCTYPE html>
      <html lang="en">

      <head>

        <meta charset="utf-8">
        <meta name=http-equiv="X-UA-Compatible" content=" IE= edge">

        <title>Proyecto Final</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="icon" href="vistas/dist/img/icons.png">


        <!----------- PLUGINS DE CSS------------->


        <!--Bootstrap 3.3.7-->
        <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

        <!-- AdminLTE Skins. -->
        <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!-- DataTables -->

        <link rel="stylesheets" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


        <!----------- PLUGINS DE JAVASCRIPT------------->

        <!-- JQuery 3 -->
        <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap 3.3.7 -->
        <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- SlimScroll -->
        <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

        <!-- FastClick-->
        <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

        <!-- AdminLTE App -->
        <script src="vistas/dist/js/adminlte.min.js"></script>

        <!-- DataTables -->
        <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

        <script src="vistas/bower_components/datatables.net/js/dataTables.min.js"></script>


      </head>


      <!-----------CUERPO DEL DOCUMENTO------------------>


      <body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

        <!-- Site wrapper -->

        <?php

        if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "OK") {

          echo '<div class="wrapper">';

          include "modulos/cabezote.php";

          include "modulos/menu.php";

          if (isset($_GET["ruta"])) {

            if (
              $_GET["ruta"] == "inicio" ||
              $_GET["ruta"] == "usuarios" ||
              $_GET["ruta"] == "categorias" ||
              $_GET["ruta"] == "productos" ||
              $_GET["ruta"] == "clientes" ||
              $_GET["ruta"] == "ventas" ||
              $_GET["ruta"] == "crear-venta" ||
              $_GET["ruta"] == "reportes" ||
              $_GET["ruta"] == "salir"
            ) {

              include "modulos/" . $_GET["ruta"] . ".php";
            } else {

              include "modulos/404.php";
            }
          } else {

            include "modulos/inicio.php";
          }

          include "modulos/footer.php";

          echo '</div>';
        } else {

          include "modulos/login.php";
        }

        ?>

        <script src="vistas/js/plantilla.js"></script>

        <script src="vistas/js/usuarios.js"></script>


      </body>

      </html>