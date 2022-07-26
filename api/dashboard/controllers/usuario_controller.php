<?php
require_once('../../helpers/database.php');
require_once('../../../models/usuario_model.php');

class usuario_controller
{
    //inicializamos funcion para verificar usuario, si funciona devolvera informacion de usuario, sino NULL
    public function checkUsuario($correo, $clave)//recibe 2 parametros, correo y clae
    {
        //consulta sql para buscar un usuario filtrado por correo y clave
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario FROM usuario WHERE correo_usuario = ? and clave_usuario = ?';
        //se envian los parametros en orden de {?}, el primero es correo, y el segundo clave, se envian en ese orden
        $params = array($correo,$clave);
        //se ejecuta el script SQL, si retorna datos entrara al IF; sino al ELSE
        if ($data = Database::getRow($sql, $params)) {
            //Si obtuvo datos, se almacenan enla variable $data
            //Se inicializa un variable de clase usuario, y se le pasan los datos de $data
            $usuario = new usuario;
            $usuario->setIdUsuario($data['id_usuario']);
            $usuario->setNombre($data['nombre_usuario']);
            $usuario->setApellido($data['apellido_usuario']);
            $usuario->setCorreo($data['correo_usuario']);
            //se retorna el objeto de clase usuario con datos llenos
            return $usuario;
        } else {
            //se retorna un resultado NULL
            return null;
        }
    }
}

?>