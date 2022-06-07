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
                        <div class="navbar-fixed">
                            <nav class="green">
                                <div class="nav-wrapper">
                                    <a href="index.html" class="brand-logo"><img src="${SERVER}/images/logo.png" height="60"></a>
                                    <a data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.html"><i class="material-icons left">view_module</i>Catálogo</a></li>
                                        <li><a href="cart.html"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                                        <li><a onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.html"><i class="material-icons left">view_module</i>Catálogo</a></li>
                            <li><a href="cart.html"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                            <li><a onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                        </ul>
                    `;
                } else {
                    header = `
                        <div class="navbar-fixed">
                            <nav class="green">
                                <div class="nav-wrapper">
                                    <a href="index.html" class="brand-logo"><img src="${SERVER}images/logo.png" height="60"></a>
                                    <a data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.html"><i class="material-icons left">view_module</i>Catálogo</a></li>
                                        <li><a href="signup.html"><i class="material-icons left">person</i>Crear cuenta</a></li>
                                        <li><a href="login.html"><i class="material-icons left">login</i>Iniciar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.html"><i class="material-icons left">view_module</i>Catálogo</a></li>
                            <li><a href="signup.html"><i class="material-icons left">person</i>Crear cuenta</a></li>
                            <li><a href="login.html"><i class="material-icons left">login</i>Iniciar sesión</a></li>
                        </ul>
                    `;
                }
                // Se asigna a la página web el contenido del encabezado.
                document.querySelector('header').innerHTML = header;
                // Se define el componente Parallax.
                let parallax = `
                    <div class="parallax-container">
                        <div class="parallax">
                            <img id="parallax">
                        </div>
                    </div>
                `;
                // Se asigna el componente Parallax antes de la etiqueta footer.
                document.querySelector('footer').insertAdjacentHTML('beforebegin', parallax);
                // Se establece el pie del encabezado.
                const footer = `
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="white-text">Nosotros</h5>
                                <p>
                                    <blockquote>
                                        <a href="#" class="white-text"><b>Misión</b></a>
                                        <span>|</span>
                                        <a href="#" class="white-text"><b>Visión</b></a>
                                        <span>|</span>
                                        <a href="#" class="white-text"><b>Valores</b></a>
                                    </blockquote>
                                    <blockquote>
                                        <a href="#" class="white-text"><b>Términos y condiciones</b></a>
                                    </blockquote>
                                </p>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="white-text">Contáctanos</h5>
                                <p>
                                    <blockquote>
                                        <a href="https://www.facebook.com/" class="white-text" target="_blank"><b>facebook</b></a>
                                        <span>|</span>
                                        <a href="https://www.instagram.com/" class="white-text" target="_blank"><b>instagram</b></a>
                                        <span>|</span>
                                        <a href="https://www.youtube.com/" class="white-text" target="_blank"><b>youtube</b></a>
                                    </blockquote>
                                    <blockquote>
                                        <a href="mailto:dacasoft@outlook.com" class="white-text"><b>Correo electrónico</b></a>
                                        <span>|</span>
                                        <a href="https://api.whatsapp.com/" class="white-text" target="_blank"><b>WhatsApp</b></a>
                                    </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            <span>© 2018-2022 Copyright CoffeeShop. Todos los derechos reservados.</span>
                            <span class="right">Diseñado con
                                <a href="http://materializecss.com/" target="_blank">
                                    <img src="../../resources/img/materialize.png" height="20" style="vertical-align:middle" alt="Materialize">
                                </a>
                            </span>
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