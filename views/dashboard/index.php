<?php
   require_once('../../models/usuario_model.php');
   session_start();
    IF(!isset($_SESSION["USER_SESSION"])){
        header('Location: login.html');
    }
    $userData = $_SESSION['USER_SESSION'];
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../resources/css/privado.css" media="screen,projection" />
    <title>Bienbenidos</title>
</head>

<body class="loginbody">

    <!-- Nav de la página web -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light navbar-dark">
            <div class="container-fluid">
                <img src="../../resources/img/Logo.png" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="lista_usuario.html">Lista de
                                usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="agregar_producto.html">Ingresar
                                producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="historial_ventas.html">Historial</a>
                        </li>
                        <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="Categoria.html">Categorias</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="login.html"><?php echo($userData->getNombreUsuario()) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../api/dashboard/actions/logout_action.php">Cerrar Session</a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>

    </main>

    <script src="../../resources/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</body>

</html>