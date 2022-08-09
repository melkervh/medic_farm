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

    public function clientesmes()
    {
        $sql = "SELECT COUNT(id_cliente) AS cantidad, to_char(fecha_cliente, 'TMMonth') 
        AS nombre_mes, to_char(fecha_cliente, 'mm') AS numero_mes
        FROM cliente
        WHERE to_char(fecha_cliente,'yy') = to_char(CURRENT_DATE,'yy')
        GROUP BY nombre_mes, numero_mes
        ORDER BY numero_mes";
        $params = null;
        return Database::getRows($sql, $params);
    }
}
