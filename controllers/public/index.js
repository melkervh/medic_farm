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
                        url = `carts.html?id=${row.idtip}&nombre=${row.tipo_nombre}`;
                        // Se crean y concatenan las tarjetas con los datos de cada categoría.
                        content += `
        
                            <div class="col-lg-4">
                                <div class="card h-100">
                                    <img src="${SERVER}images/categoria/${row.imagen_categoria}" class="card-img-top"
                                        alt="Anticonceptivos">
                                    <div class="card-body">
                                            <div class="col-10">
                                                <h5 class="card-title" ${row.tipo_nombre}</h5>
                                            </div>
                                          <p class="card-text">${row.descripcion_tipo}</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                         <a href="${url}" class="btn iniciar">Ver productos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              
                        `;
                    });
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar las categorías.
                    document.getElementById('categorias').innerHTML = content;
                    // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}