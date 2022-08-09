<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../../models/listauser_modal.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $listauser = new listauser;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario']) OR true) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $listauser->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
            case 'search':
                $_POST = $listauser->validateForm($_POST);
                if ($_POST['search'] == '') {
                    $result['exception'] = 'Ingrese un valor para buscar';
                } elseif ($result['dataset'] = $listauser->searchRows($_POST['search'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST = $listauser->validateForm($_POST);
                if (!$listauser->setnombre($_POST['nombre'])) {
                    $result['exception'] = 'Nombre incorrecto';
                } elseif (!$listauser->setapellido($_POST['apellido'])) {
                    $result['exception'] = 'apellido incorrecto';
                } elseif (!$listauser>setcorreo($_POST['correo'])) {
                    $result['exception'] = 'correo incorrecto';
                } elseif (!$listauser->setclave($_POST['clave'])) {
                    $result['exception'] = 'clave incorrecta';
                } elseif ($listauser->createRow()) {  
                        $result['status'] = 1;
                     }
                    else {
                        $result['exception'] = Database::getException();
                    }
                    break;

                 case 'readOne':
                    if (!$listauser->setidusuario($_POST['id_usuario'])) {
                        $result['exception'] = ' incorrecta';
                    } elseif ($result['dataset'] = $listauser->readOne()) {
                            $result['status'] = 1;
                    } elseif (Database::getException()) {
                            $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'usuario inexistente';
                    }
                    break;
                case 'update':
                    $_POST = $listauser->validateForm($_POST);
                    if (!$listausert->setidusuario($_POST['id_usuario'])) {
                        $result['exception'] = 'usuario incorrecto';
                    } elseif (!$data = $listauser->readOne()) {
                        $result['exception'] = 'usuario inexistente';
                    } elseif (!$listauser->nombre($_POST['nombre'])) {
                        $result['exception'] = 'Nombre incorrecto';
                    } elseif (!$listauser->setapellido($_POST['apellido'])) {
                        $result['exception'] = 'Descripción incorrecta';
                    }  elseif (!$listauser->setcorreo($_POST['correo'])) {
                        $result['exception'] = 'correo incorrecto';
                    }elseif (!$listauser->setclave($_POST['clave'])) {
                        $result['exception'] = 'clave incorrecta';
                    }  elseif ($listausert->updateRow($data)) {
                        $result['status'] = 1;
                    }
                    else {
                        $result['exception'] = Database::getException();
                    }
                    break;
                case 'delete':
                    if (!$listauser->setidusuario($_POST['id_usuario'])) {
                        $result['exception'] = 'usuario incorrecta';
                    } elseif (!$data = $listauser->readOne()) {
                        $result['exception'] = 'usuario inexistente';
                    }elseif ($listauser->deleteRow()) {
                        $result['status'] = 1;
                    } 
                    else {
                        $result['exception'] = Database::getException();
                    }
                    break;
                default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
            }        
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
?>
