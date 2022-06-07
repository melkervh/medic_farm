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
                            <img src="../../resources/img/Logo.png" alt=""  height="80" class="d-inline-block align-text-top logo">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="login.html">cerrar sesion</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">perfil</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            inicio
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="index.html">menu</a></li>
                                            <li><a class="dropdown-item" href="analgesicos.html">analgesicos</a></li>
                                            <li><a class="dropdown-item" href="antibioticos.html">antibioticos</a></li>
                                            <li><a class="dropdown-item" href="anticonceptivo.html">anticonceptivo</a></li>
                                            <li><a class="dropdown-item" href="antigripales.html">antigripales</a></li>
                                            <li><a class="dropdown-item" href="relajante_muscular.html">relajante musculares</a></li>
                                            <li><a class="dropdown-item" href="vitamina.html">vitaminas</a></li>
                                            <li>
            
                                        </ul>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">revicion de receta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="nosotros.html">sobre nosotros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="Contactanos.html">contactanos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="termino_condicion.html">terminos</a>
                                    </li>
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
                            <img src="../../resources/img/Logo.png" alt=""  height="80" class="d-inline-block align-text-top logo">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="login.html">Login</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="index.html" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            inicio
                                        </a>
                                    <li class="nav-item">
                                        <a class="nav-link" href="nosotros.html">sobre nosotros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="Contactanos.html">contactanos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="termino_condicion.html">terminos</a>
                                    </li>
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
                // Se define el componente Parallax.
                let parallax = `
                    <div class="parallax-container">
                        <div class="parallax">
                        </div>
                    </div>
                `;
                // Se asigna el componente Parallax antes de la etiqueta footer.
                document.querySelector('footer').insertAdjacentHTML('beforebegin', parallax);
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
                                <li class="mt-0">sobre nosotros</li>
                                <li>contactanos</li>
                            </ul>
                        </div>
                        <div class="col-sm-3  my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-0">Customers</li>
                                <li>Use Cases</li>
                            </ul>
                        </div>
                        <div class="col-sm-3  my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-0">Company</li>
                                <li>About</li>
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
                // Se declara e inicializa un arreglo con los nombres de las imagenes que se pueden utilizar en el efecto parallax.
                let images = ['img01.jpg', 'img02.jpg', 'img03.jpg', 'img04.jpg', 'img05.jpg'];
                // Se declara e inicializa una variable para obtener un elemento del arreglo de forma aleatoria.
                let element = Math.floor(Math.random() * images.length);
                // Se asigna la imagen a la etiqueta img por medio del atributo src.
                document.getElementById('parallax').setAttribute('src', '../../resources/img/parallax/' + images[element]);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});