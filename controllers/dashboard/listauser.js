// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIO = SERVER + 'dashboard/actions/listauser.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_USUARIO );
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.id_usuario}</td>
                <td>${row.nombre_usuario}</td>
                <td>${row.apellido_usuario}</td>
                <td>${row.correo_usuario}</td>
                <td>
                    <a onclick="openUpdate(${row.id_usuario})" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a onclick="openDelete(${row.id_usuario})">
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
    searchRows(API_USUARIO, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('archivo').required = true;
}



// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(idusuario) { 
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idusuario', idusuario);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_USUARIO  + 'readOne', {
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
                    document.getElementById('idusuario').value = response.dataset.idusuario;
                    document.getElementById('nombre').value = response.dataset.nombre;
                    document.getElementById('apellido').value = response.dataset.apellido;
                    document.getElementById('correo').value = response.dataset.correo;
                    document.getElementById('clave').value = response.dataset.calve;
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                
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
    (document.getElementById('idusuario').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_USUARIO , action, 'save-form', 'save-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(idusuario) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idusuario', idusuario);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_USUARIO , data);
}
