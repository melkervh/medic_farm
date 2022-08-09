// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PEDIDOS = SERVER + 'dashboard/actions/historial_action.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_PEDIDOS);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.id_pedido}</td>
                <td>${row.nombre_cliente}</td>
                <td>${row.apellido_cliente}</td>
                <td>${row.correo_cliente}</td>
                <td>${row.fecha_pedido}</td>
                <td>
                    <a onclick="openDetalle(${row.id_pedido})" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-file-signature"></i>
                    </a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_PEDIDOS, 'search-form');
});

function openDetalle(id) {
    const data = new FormData();
    data.append('id', id);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_PEDIDOS + 'readDetalle', {
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
                    let total = 0;
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        total += (row.cantidad_producto * row.precio_produc);
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                            <tr> 
                                <td>${row.nombre_producto}</td>
                                <td>${row.descripcion_producto}</td>
                                <td>${row.precio_produc}</td>
                                <td>${row.cantidad_producto}</td>
                                <td>${(row.subtotal)}</td>
                            </tr>
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tbody-rows-detalle').innerHTML = content;
                    document.getElementById('total').textContent = total.toFixed(2);
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}


// Función para abrir el reporte de productos venddidos y cuanto ha recaudado.
function openReporteHistorial() {
    // Se establece la ruta del reporte en el servidor.
    let url = SERVER + 'reports/dashboard/reporte_historial.php';
    // Se abre el reporte en una nueva pestaña del navegador web.
    window.open(url);
}