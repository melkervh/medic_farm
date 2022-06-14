<?php

class Clientes extends Validator
{
    //Declaracion de las propiedades 
    private $id_cliente = null;
    private $nombre_cliente = null;
    private $apellido_cliente = null;
    private $dui_cliente = null;
    private $correo_cliente = null;
    private $clave_cliente = null;
    private $estado_cliente = null; // Valor por defecto en la base de datos: true

    //-- Métodos para validar y asignar valores de los atributos.--

    public function setIdCliente($value)
    {
     if ($this->validateNaturalNumber($value)) {
        $this->id_cliente= $value;
        return true;
     } else {
        return false;
     }
    }

    public function setNombreCliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidoCliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDUICliente($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreoCliente($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClaveCliente($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave_cliente = password_hash($value, PASSWORD_DEFAULT);
            return true;
        } else {
            return false;
        }
    }

    public function setEstadoCliente($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    //--Métodos para obtener valores de los atributos.--
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function getNombreCliente()
    {
        return $this->nombre_cliente;
    }
    
    public function getApellidoCliente()
    {
        return $this->apellido_cliente;
    }

    public function getDUICliente()
    {
        return $this->dui_cliente;
    }

    public function getCorreoCliente()
    {
        return $this->correo_cliente;
    }

    public function getClaveCliente()
    {
        return $this->clave_cliente;
    }

    public function getEstadoCliente()
    {
        return $this->estado_cliente;
    }

     /*
    *   Métodos para gestionar la cuenta del cliente.
    */
    public function checkUser($correo_cliente)
    {
        $sql = 'SELECT id_cliente, estado_cliente FROM cliente WHERE correo_cliente = ?';
        $params = array($correo_cliente);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_cliente = $data['id_cliente'];
            $this->estado_cliente = $data['estado_cliente'];
            $this->correo_cliente = $correo_cliente;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($clave_cliente)
    {
        $sql = 'SELECT clave_cliente FROM cliente WHERE id_cliente = ?';
        $params = array($this->id_cliente);
        $data = Database::getRow($sql, $params);
        if (password_verify($clave_cliente, $data['clave_cliente'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $sql = 'UPDATE clientes SET clave_cliente = ? WHERE id_cliente = ?';
        $params = array($this->clave_cliente, $this->id_cliente);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE cliente
                SET nombre_cliente = ?, apellido_cliente = ?, correo_cliente = ?, dui_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->nombre_cliente, $this->apellido_cliente, $this->correo_cliente, $this->dui_cliente,  $this->id_cliente);
        return Database::executeRow($sql, $params);
    }

    public function changeStatus()
    {
        $sql = 'UPDATE cliente
                SET estado_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->estado_cliente, $this->id_cliente);
        return Database::executeRow($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO cliente(nombre_cliente, apellido_cliente, dui_cliente, correo_cliente, clave_cliente, estado_cliente)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_cliente, $this->apellido_cliente, $this->dui_cliente, $this->correo_cliente, $this->clave_cliente, $this->estado_cliente);
        return Database::executeRow($sql, $params);
    }
}
