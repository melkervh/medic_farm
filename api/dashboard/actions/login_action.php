<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../../models/usuario_model.php');
require_once('../controllers/usuario_controller.php');

$result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null, 'dataset' => null, 'username' => null);
//Obtenemos datos del formulario
$correo = $_POST['email'];
$clave = $_POST['pswd'];
//Inicializamos el objeto usuario_controller
$usuario_controller = new usuario_controller;
//se ejecuta la funcion CheckUsuario del objeto usuario_controller, y el resultado se almacena en la variable $dataUsuario
$dataUsuario = $usuario_controller->checkUsuario($correo,$clave);
//se verifica si la variable obtuvo informacion, o viene vacia
if(is_null($dataUsuario)){
    //echo('Datos Incorrectos');
    $result['status'] = 0;
    $result['exception'] = 'Datos Incorrectos';
}
else{
    session_start();
    $_SESSION["USER_SESSION"]=$dataUsuario;
    $result['status'] = 1;
    $result['message'] = 'Datos correctos';
}

print(json_encode($result));

?>