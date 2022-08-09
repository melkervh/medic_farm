<?php
class Historial extends Validator
{
    private $nombre = null;
    private $apellido = null;
    private $descripcion = null;
    private $cantidad_producto = null;
    private $precio_productod = null;
    private $idpedido = null;

    public function setidpedido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idpedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function searchRows($value)
    {
        $sql = "SELECT id_pedido, nombre_cliente, apellido_cliente, correo_cliente, to_char(fecha_pedido, 'DD-MM-yyyy') AS fecha_pedido
                FROM pedidos
                INNER JOIN cliente USING(id_cliente)
                where nombre_cliente ILIKE ? or apellido_cliente ILIKE ?
                order by nombre_cliente";
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = "SELECT id_pedido, nombre_cliente, apellido_cliente, correo_cliente, to_char(fecha_pedido, 'DD-MM-yyyy') AS fecha_pedido
                FROM pedidos
                INNER JOIN cliente USING(id_cliente)";
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readDetalle()
    {   
        $sql = 'SELECT nombre_producto, descripcion_producto, precio_produc, detalle_pedido.cantidad_producto, (precio_produc * detalle_pedido.cantidad_producto) AS subtotal
                FROM detalle_pedido
                INNER JOIN producto USING (idproducto)
                INNER JOIN pedidos USING (id_pedido)
                WHERE id_pedido = ?';
        $params = array($this->idpedido);
        return Database::getRows($sql, $params);
    }

}
?>