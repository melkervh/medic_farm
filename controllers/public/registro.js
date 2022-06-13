// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = SERVER + 'public/clientes.php?action=';


// Método manejador de eventos que se ejecuta cuando se envía el formulario de registrar cliente.
document.getElementById('regis-usu').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Petición para registrar un usuario como cliente.
    fetch(API_CLIENTES + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('regis-usu'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'login.html');
                } else {
                    // Se verifica si el token falló (ya sea por tiempo o por uso).
                    if (response.recaptcha) {
                        sweetAlert(2, response.exception, 'index.html');
                    } else {
                        sweetAlert(2, response.exception, null);
                        // Se genera un nuevo token.
                        reCAPTCHA();
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});