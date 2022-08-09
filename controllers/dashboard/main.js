// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PRODUCTOS = SERVER + 'dashboard/actions/productos.php?action=';
const API_CLIENTE = SERVER + 'dashboard/actions/clientes.php?action=';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se define un objeto con la fecha y hora actual.
    graficoBarrasCategorias();
    graficoPastelCategorias();
    graficoclientes();
});

// Función para mostrar la cantidad de productos por categoría en un gráfico de barras.
function graficoBarrasCategorias() {
    // Petición para obtener los datos del gráfico.
    fetch(API_PRODUCTOS + 'cantidaProductosCategoria', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos a graficar.
                    let categoria = [];
                    let cantidades = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se agregan los datos a los arreglos.
                        categoria.push(row.tipo_nombre);
                        cantidades.push(row.cantidad_producto);
                    });
                    // Se llama a la función que genera y muestra un gráfico de barras. Se encuentra en el archivo components.js
                    barGraph('chart1', categoria, cantidades, 'Cantidad de productos', 'Cantidad de productos por categoría');
                } else {
                    document.getElementById('chart1').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

// Función para mostrar el porcentaje de productos por categoría en un gráfico de pastel.
function graficoPastelCategorias() {
    // Petición para obtener los datos del gráfico.
    fetch(API_PRODUCTOS + 'porcentajeProductosCategoria', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos a gráficar.
                    let categorias = [];
                    let porcentajes = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se agregan los datos a los arreglos.
                        categorias.push(row.tipo_nombre);
                        porcentajes.push(row.porcentaje);
                    });
                    // Se llama a la función que genera y muestra un gráfico de pastel. Se encuentra en el archivo components.js
                    pieGraph('chart2', categorias, porcentajes, 'Porcentaje de productos por categoría');
                } else {
                    document.getElementById('chart2').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}
// Función para mostrar la cantidad de productos por categoría en un gráfico de barras.

function graficoclientes() {

    // Petición para obtener los datos del gráfico.

    fetch(API_CLIENTE + 'clientesmes', {

        method: 'get'

    }).then(function (request) {

        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.

        if (request.ok) {

            request.json().then(function (response) {

                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas.

                if (response.status) {

                    // Se declaran los arreglos para guardar los datos a graficar.

                    let cantidad = [];

                    let mes = [];

                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.

                    response.dataset.map(function (row) {

                        // Se agregan los datos a los arreglos.

                        cantidad.push(row.cantidad);

                        mes.push(row.nombre_mes);

                    });

                    // Se llama a la función que genera y muestra un gráfico de barras. Se encuentra en el archivo components.js

                    lineGraph('chart3', mes, cantidad, 'Cantidad de clientes', 'Clientes registrados mensualmente en el año actual');

                } else {

                    document.getElementById('chart1').remove();

                    console.log(response.exception);

                }

            });

        } else {

            console.log(request.status + ' ' + request.statusText);

        }

    });

}