<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/pedidos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $pedido = new Pedidos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['id_cliente'])) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            case 'createDetail':
                $_POST = $pedido->validateForm($_POST);
                if (!$pedido->startOrder()) {
                    $result['exception'] = 'Ocurrió un problema al obtener el pedido';
                } elseif (!$pedido->setProducto($_POST['idproducto'])) {
                    $result['exception'] = 'Producto  inexistente';
                } elseif (!$pedido->setCantidad($_POST['cantidad'])) {
                    $result['exception'] = 'Cantidad incorrecta';
                } elseif ($pedido->createDetail()) {
                    $result['status'] = 1;
                    $result['message'] = 'Producto agregado correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al agregar el producto';
                }
                break;
            case 'readOrderDetail':
                if (!$pedido->startOrder()) {
                    $result['exception'] = 'Debe agregar un producto al carrito';
                } elseif ($result['dataset'] = $pedido->readOrderDetail()) {
                    $result['status'] = 1;
                    $_SESSION['id_pedido'] = $pedido->getIdPedido();
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No tiene productos en el carrito';
                }
                break;
            case 'updateDetail':
                $_POST = $pedido->validateForm($_POST);
                if (!$pedido->setid_detalle($_POST['iddetalle'])) {
                    $result['exception'] = 'Detalle incorrecto';
                } elseif (!$pedido->setCantidad($_POST['cantidad'])) {
                    $result['exception'] = 'Cantidad incorrecta';
                } elseif ($pedido->updateDetail()) {
                    $result['status'] = 1;
                    $result['message'] = 'Cantidad modificada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                }
                break;
            case 'deleteDetail':
                if (!$pedido->setid_detalle($_POST['iddetalle'])) {
                    $result['exception'] = 'Detalle incorrecto';
                } elseif ($pedido->deleteDetail()) {
                    $result['status'] = 1;
                    $result['message'] = 'Producto removido correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al remover el producto';
                }
                break;
            case 'readEnca':
                if ($result['dataset'] = $pedido->readEnca()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Detalle inexistente';
                }
                break;
            case 'finishOrder':
                if ($pedido->finishOrder()) {
                    $result['status'] = 1;
                    $result['message'] = 'Pedido finalizado correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                }
                break;
            //caso readAlld para mostrar el detalle del registro
            case 'readAlld':
                if (!$pedido->setidPedido($_POST['id'])) {
                    $result['exception'] = 'Pedido incorrecto';
                } elseif ($result['dataset'] = $pedido->readAlld()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Pedido inexistente';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'createDetail':
                $result['exception'] = 'Debe iniciar sesión para agregar el producto al carrito';
                break;
            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
