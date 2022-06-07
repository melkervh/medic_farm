// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = SERVER + 'public/catalogo.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que muestra las categorías disponibles.
    readAllCategorias();
    // Se define una variable para establecer las opciones del componente Slider.
    let options = {
        height: 300
    }
    // Se inicializa el componente Slider para que funcione el carrusel de imágenes.
    M.Slider.init(document.querySelectorAll('.slider'), options);
});

// Función para obtener y mostrar las categorías disponibles.
function readAllCategorias() {
    // Petición para solicitar los datos de las categorías.
    fetch(API_CATALOGO + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es satisfactoria, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se comprueba si la respuesta es correcta, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    let url = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se define una dirección con los datos de cada categoría para mostrar sus productos en otra página web.
                        url = `articles.html?id=${row.id_categoria}&nombre=${row.nombre_categoria}`;
                        // Se crean y concatenan las tarjetas con los datos de cada categoría.
                        content += `
                            <div class="col s12 m6 l4">
                                <div class="card hoverable">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img src="${SERVER}images/categorias/${row.imagen_categoria}" class="activator">
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4">
                                            <b>${row.nombre_categoria}</b>
                                            <i class="material-icons right tooltipped" data-tooltip="Descripción">more_vert</i>
                                        </span>
                                        <p class="center">
                                            <a href="${url}" class="tooltipped" data-tooltip="Ver productos">
                                                <i class="material-icons">local_cafe</i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4">
                                            <b>${row.nombre_categoria}</b>
                                            <i class="material-icons right tooltipped" data-tooltip="Cerrar">close</i>
                                        </span>
                                        <p>${row.descripcion_categoria}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tarjetas">
                            <div class="row row-cols-1 row-cols-md-2 g-2">
                                <div class="col-lg-4">
                                    <div class="card h-100">
                                        <img src="${SERVER}../../resources/img/card/${row.imagen_categoria}" class="card-img-top" alt="Anticonceptivos">
                                        <div class="card-body">
                                            <h5 class="card-title">${row.nombre_categoria}</h5>
                                            <!--Agregamos un collapso como boton para que contenga la informacion-->
                                            <p>
                                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseExample1" aria-expanded="false"
                                                    aria-controls="collapseExample1">
                                                    MedicFarm
                                                </button>
                                                <!--iniciamos un boton con la etiqueta "a" y con clase button-->
                                                <a class="btn btn-primary" href="anticonceptivo.html" role="button">Ver mas</a>
                                                <!--Fin de boton-->
                                            </p>
                                            <div class="collapse" id="collapseExample1">
                                                <div class="card card-body">
                                                    Variedad de anticonceptivos, diferetes tipos y marcas, no te lo pudes perder
                                                    solo en
                                                    MedicFarm
                                                </div>
                                            </div>
                                            <!--Fin de collapso-->
                                        </div>
                                    </div>
                                </div>
                        `;
                    });
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar las categorías.
                    document.getElementById('categorias').innerHTML = content;
                    // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                } else {
                    // Se asigna al título del contenido un mensaje de error cuando no existen datos para mostrar.
                    let title = `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>`;
                    document.getElementById('title').innerHTML = title;
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}