/*
*   Este controlador es de uso general en las páginas web del sitio público.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para establecer la ruta y parámetros de comunicación con la API.
const API = SERVER + 'public/clientes.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Petición para determinar si se ha iniciado sesión.
    fetch(API + 'getUser', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se define una variable para asignar el encabezado del documento.
                let header = '';
                // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
                if (response.session) {
                    header = `
                    <div class="colores">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <a href="index.html"><img src="../../resources/img/Logo.png"  height="80" class="d-inline-block align-text-top logo"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Perfil</a>
                                    </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="index.html">Menu</a>
                                         </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="carrito.html">Carrito</a>
                                         </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="historial_pedidos.html">Historial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a onclick="logOut()" class="nav-link">Cerrar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                    `;
                } else {
                    header = `
                    <div class="colores">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                        <a href="index.html"><img src="../../resources/img/Logo.png"  height="80" class="d-inline-block align-text-top logo"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item dropdown">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.html">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.html">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="registro_usuario.html">Nueva Cuenta</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="nosotros.html">Sobre Nosotros</a>
                                </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="termino_condicion.html">Terminos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                    `;
                }
                // Se asigna a la página web el contenido del encabezado.
                document.querySelector('header').innerHTML = header;
    
                // Se establece el pie del encabezado.
                const footer = `
                <div class="row justify-content-center mb-0 pt-5 pb-0 row-2 px-3">
                <div class="col-12">
                    <div class="row row-2">
                        <div class="col-sm-3 text-md-center">
                            <h5><span> <i class="fa fa-firefox text-light" aria-hidden="true"></i></span><b> MedicFarm</b></h5>
                        </div>
                        <div class="col-sm-3  my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-0">Mas Sobre Nosotros</li>
                                <li>Contactanos</li>
                            </ul>
                        </div>
                        <div class="col-sm-3  my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-0">Terminos y Condiciones</li>
                                <li>HTML</li>
                            </ul>
                        </div>
                        <div class="col-sm-3  my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-0">JavaScript</li>
                                <li>Bootstrap</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-0 pt-0 row-1 mb-0  px-sm-3 px-2">
                <div class="col-12">
                    <div class="row my-4 row-1 no-gutters">
                        <div class="col-sm-3 col-auto text-center"><small>&#9400; MedicFarm</small></div>
                        <div class="col-md-3 col-auto "></div>
                        <div class="col-md-3 col-auto"></div>
                        <div class="col  my-auto text-md-left  text-right "> <small> medicfarm@gmail.com<span><img
                                        src="https://i.imgur.com/TtB6MDc.png" class="img-fluid " width="25"></span>
                                <span><img src="https://i.imgur.com/N90KDYM.png" class="img-fluid "
                                        width="25"></span></small> </div>
                    </div>
                </div>
            </div>
                `;
                // Se asigna a la página web el contenido del pie.
                document.querySelector('footer').innerHTML = footer;

            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});