<!-----------LOGOTIPO---------------->

<header class="main-header">

    <a href="inicio" class="logo">


        <span class="logo-mini">

            <img src="vistas/dist/img/credit/paypal.png" class="img-responsive" style="padding:10px">

        </span>

        <span class="logo-lg">

            <img src="vistas/dist/img/credit/cirrus.png" class="img-responsive" style="padding:10px 0px">

        </span>

    </a>


    <!-----------BARRA DE NAVEGACIÓN---------------->


    <nav class="navbar navbar-static-top" role="navigation">


        <!--BARRA DE NAVEGACIÓN-->

        <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">Toggle navigation</span>

        </a>

        <!-- PERFIL USUARIO -->

        <div class="nav navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                    <?php

                    if($_SESSION["foto"] != ""){

                        echo  '<img src="'.$_SESSION["foto"].'" class="user-image">';

                    }else

                        echo '<img src="vistas/dist/img/icons.png" class="user-image">'

                    ?>
                        
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"];  ?></span>

                    </a>

                    <!-- DROPDOWN-TOGGLE -->

                    <ul class="dropdown-menu">

                        <li class="user-body">

                            <div class="pull-right">

                                <a href="salir" class="btn btn-default btn-flat">Salir</a>

                            </div>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>


    </nav>


</header>