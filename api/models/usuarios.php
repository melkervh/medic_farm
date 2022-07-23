<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos.
*   Es clase hija de Validator.
*/
class Usuarios extends Validator
{
    // Declaración de atributos (propiedades).
    private $idusuario= null;
    private $nombres = null;
    private $apellidos = null;
    private $clave = null;
    private $correo = null;

      /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setIdUsuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idusuario = $value;
            return true;
        } else {
            return false;
        }
    }
      public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = password_hash($value, PASSWORD_DEFAULT);
            return true;
        } else {
            return false;
        }
    }
    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }
     /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getIdUsuario()
    {
        return $this->idusuario;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getClave()
    {
        return $this->clave;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete (buscar, crear, leer, actualizar, eliminar)).
    */

    /*Funcion para realizar una busqueda de usuarios*/
    public function searchRows($value)
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario
                FROM usuario
                WHERE apellido_usuario ILIKE ? OR nombre_usuario ILIKE ?
                ORDER BY apellido_usuario';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    /*Funcion para la creacion de un usuarios*/
    public function createRow()
    {
        $sql = 'INSERT INTO usuario(nombre_usuario, apellido_usuario, clave_usuario, correo_usuario)
                VALUES(?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->clave, $this->correo);
        return Database::executeRow($sql, $params);
    }

    /*Funcion para la lectura de todos los usuarios*/
    public function readAll()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario
                FROM usuario
                ORDER BY apellido_usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    /*Funcion para la lectura de un usuario*/
    public function readOne()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario
                FROM usuario
                WHERE id_usuario = ?';
        $params = array($this->idusuario);
        return Database::getRow($sql, $params);
    }

    /*Funcion para la actualizacion de un usuario*/
    public function updateRow()
    {
        $sql = 'UPDATE usuario 
                SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->idusuario);
        return Database::executeRow($sql, $params);
    }

      /*Funcion para eliminar un usuario*/
    public function deleteRow()
    {
        $sql = 'DELETE FROM usuario
                WHERE id_usuario = ?';
        $params = array($this->idusuario);
        return Database::executeRow($sql, $params);
    }
}