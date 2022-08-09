// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PRODUCTOS = SERVER + 'dashboard/actions/productos.php?action=';
const ENDPOINT_CATEGORIAS = 'http://localhost/medic_farm/api/dashboard/actions/categoria_action.php?action=readAll';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_PRODUCTOS);
    // Se define una variable para establecer las opciones del componente Modal.
    let options = {
        dismissible: false,
        onOpenStart: function () {
            // Se restauran los elementos del formulario.
            document.getElementById('save-form').reset();
            // Se establece el valor mínimo para el precio del producto.
            document.getElementById('precio_produc').setAttribute('min', 0.01);
            // Se establece el valor máximo para el precio del producto.
            document.getElementById('precio_produc').setAttribute('max', 999.99);
        }
    }
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        var estado;
                        if (row.estado_producto == '1') {
                            estado = "Disponible";
                        }
                        if (row.estado_producto == '0') {
                            estado = "No disponible";
                        }

        // Se establece un icono para el estado del producto.
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
            <td>${row.idproducto}</td>
                <td><img src="${SERVER}images/productos/${row.img_producto}" class="materialboxed" height="100"></td>
                <td>${row.nombre_producto}</td>
                <td>${row.descripcion_producto}</td>
                <td>${row.precio_produc}</td>
                <td>${row.cantidad_producto}</td>
                <td>${row.tipo_nombre}</td>
                <td>${estado}</td>
                <td>
                <a onclick="openUpdate(${row.idproducto})"data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                id="save-modal" onclick="openCreate()"">
                <i class="fa-solid fa-pen"></i>
            </a>
            <a onclick="openDelete(${row.idproducto})">
                <i class="fa-solid fa-trash-can"></i>
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
    searchRows(API_PRODUCTOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
    // Se abre la caja de diálogo (modal) que contiene el formulario.
    // Se asigna el título para la caja de diálogo (modal).
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('save-form').reset();
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_CATEGORIAS, 'categoria', null);
}

// Función para abrir el reporte de productos.
function openReport() {
    // Se establece la ruta del reporte en el servidor.
    let url = SERVER + 'reports/dashboard/productos.php';
    // Se abre el reporte en una nueva pestaña del navegador web.
    window.open(url);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(idproducto) {
    // Se asigna el título para la caja de diálogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar producto';
    // Se establece el campo de archivo como opcional.
    document.getElementById('archivo').required = false;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idproducto', idproducto);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_PRODUCTOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idproducto').value = response.dataset.idproducto;
                    document.getElementById('nombre').value = response.dataset.nombre_producto;
                    document.getElementById('precio').value = response.dataset.precio_produc;
                    document.getElementById('descripcion').value = response.dataset.descripcion;
                    document.getElementById('cantidad').value = response.dataset.cantidad;
                    fillSelect(ENDPOINT_CATEGORIAS, 'categoria', response.dataset.idtip);
                    if (response.dataset.estado_producto) {
                        document.getElementById('estado').checked = true;
                    } else {
                        document.getElementById('estado').checked = false;
                    }
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    (document.getElementById('idproducto').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_PRODUCTOS, action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(idproducto) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idproducto', idproducto);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_PRODUCTOS, data);
}