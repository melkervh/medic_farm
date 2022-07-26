<?php
class usuario
{
    private $id_usuario= null;
    private $nombre = null;
    private $apellido = null;
    private $correo = null;
    private $clave = null;

    public function setIdUsuario($value)
    {
        $this->id_usuario = $value;
    }

    public function setNombre($value)
    {
        $this->nombre = $value;
    }

    public function setApellido($value)
    {
        $this->apellido = $value;
    }

    public function setCorreo($value)
    {
        $this->correo = $value;
    }

    public function setClave($value)
    {
        $this->clave = $value;
    }

    public function getIdUsuario()
    {
        return $this->idusuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getNombreUsuario()
    {
        return ($this->nombre.' '.$this->apellido);
    }
}

?>