// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CATALOGO = SERVER + 'public/catalogo.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get('id');
    const NAME = params.get('nombre');
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProductosCategoria(ID, NAME);
});

// Función para obtener y mostrar los productos de acuerdo a la categoría seleccionada.
function readProductosCategoria(id, categoria) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idtip', id);
    // Petición para solicitar los productos de la categoría seleccionada.
    fetch(API_CATALOGO + 'readProductosCategoria', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las tarjetas con los datos de cada producto.
                        content += `
                            <div class="col s12 m6 l4">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="${SERVER}images/productos/${row.imagen_producto}" class="materialboxed">
                                        <a href="detail.html?id=${row.id_producto}" class="btn-floating halfway-fab waves-effect waves-light red tooltipped" data-tooltip="Ver detalle">
                                            <i class="material-icons">more_horiz</i>
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title">${row.nombre_producto}</span>
                                        <p>Precio(US$) ${row.precio_producto}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    // Se asigna como título la categoría de los productos.
                    document.getElementById('title').textContent = 'Categoría: ' + categoria;
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar los productos.
                    document.getElementById('productos').innerHTML = content;
                } 
                
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}