/*
*   Este controlador es de uso general en las páginas web del sitio público.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para establecer la ruta y parámetros de comunicación con la API.
const API = SERVER + 'dashboard/usuario.php?action=';

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
                            <a onclick="logOut()" class="nav-link">Cerrar sesión</a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
                    `;
                } else {
                    header = `
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
                                    <a onclick="logOut()" class="nav-link">Cerrar sesión</a>
                                </li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                    `;
                }
                // Se asigna a la página web el contenido del encabezado.
                document.querySelector('header').innerHTML = header;
    
                // Se establece el pie del encabezado.
                const footer = `
                
                `;
                // Se asigna a la página web el contenido del pie.
                document.querySelector('footer').innerHTML = footer;

            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});