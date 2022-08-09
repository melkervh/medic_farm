<?php
class Clientes extends Validator
{
    private $idcliente = null;
    private $nombre = null;
    private $apellido = null;
    private $dui = null;
    private $correo = null;
    private $clave = null;
    private $estado = null;
    private $fecha = null;

    public function readAll(){
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, dui_cliente, correo_cliente
        FROM cliente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, dui_cliente, correo_cliente
                FROM cliente
                WHERE nombre_cliente ILIKE ? OR apellido_cliente ILIKE ?
                ORDER BY nombre_cliente';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

}
