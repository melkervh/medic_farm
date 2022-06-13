// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PEDIDOS = SERVER + "public/pedidos.php?action=";

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener("DOMContentLoaded", function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    showDetailOrder();
});

function showDetailOrder() {
    // Petición para obtener los datos del registro solicitado.
    fetch(API_PEDIDOS + 'readEnca', {
        method: 'get',
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista y se muestra un mensaje de éxito.
                    fillDetailOrder(response.dataset);
                } else {
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillDetailOrder(dataset) {
    let main = "";
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        main += `
        <tr>
            <td class="text-center">${row.id_pedido}</td>
            <td class="text-center">${row.fecha_pedido}</td>
            <td class="text-center">${row.estado_pedido}</td>
            <td class="d-flex justify-content-center">
                <a onclick="openDetalle(${row.id_pedido})" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#detalle">
                        <i class="fa-solid fa-circle-info cart_nav1"></i>
                </a>
            </td>
        <tr>
      `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.querySelector("#tbody-rows").innerHTML = main;
}

function openDetalle(id) {

    const data = new FormData();
    data.append('id', id);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_PEDIDOS + 'readAlld', {
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
                        total += (row.cantidad_producto * row.precio_producto);
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                            <tr> 
                                <td class="text-center">${row.nombre_producto}</td>
                                <td class="text-center">${row.descripcion_producto}</td>
                                <td class="text-center">${row.precio_producto}</td>
                                <td class="text-center">${row.cantidad_producto}</td>
                                <td class="text-center">${(row.cantidad_producto * row.precio_producto).toFixed(2)}</td>
                                <td class="d-flex justify-content-center">
                                    <a onclick="openCreateValo(${row.id_detalle_pedido})" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#save-modal">
                                        <i class="fa-solid fa-circle-info cart_nav1"></i>
                                    </a>
                                </td>
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
