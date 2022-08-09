<?php
class listauser extends Validator
{
    private $idusuario= null;
    private $nombre = null;
    private $apellido = null;
    private $correo = null;
    private $clave = null;

    public function setidusuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idusuario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setnombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tipo_nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setapellido($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setcorreo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setclave($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getidusuario()
    {
        return $this->idusuario;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function getapellido()
    {
        return $this->apellido;
    }
    public function getcorreo()
    {
        return $this->correo;
    }
    public function getclave()
    {
        return $this->clave;
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idusuario, nombre,apellido, correo, clave
                FROM usuarios
                WHERE nombre ILIKE ? OR clave ILIKE ?
                ORDER BY nombre';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql ='INSERT INTO public.usuario(
            nombre, apellido, correo, clave)
            VALUES ( ?, ?, ?, ?);';
        $params = array($this->nombre, $this->apellido, $this->correo, $this->clave);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario
        FROM usuario
        ORDER BY nombre_usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario
                FROM usuario
                WHERE id_usuario = ?';
        $params = array($this->idusuario);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    { 
        $sql = 'UPDATE usuario
                SET  nombre_usuario = ?, apellido_usuario= ?, correo_usuario = ?
                WHERE id_usuario = ?';
        $params = array( $this->nombre, $this->apellido,$this->correo, $this->clave,  $this->idusuario);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM usuario
                WHERE id_usuario = ?';
        $params = array($this->idusuario);
        return Database::executeRow($sql, $params);
    }

}
?>