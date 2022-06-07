<?php
class Historial extends Validator
{
    private $nombre = null;
    private $apellido = null;
    private $descripcion = null;
    private $cantidad_producto = null;
    private $precio_productod = null;

    public function searchRows($value)
    {
        $sql = 'SELECT iddetalle, nombre, apellido, nombre_produc, cantidad_producto, precio_produc
                FROM public.detalle_pedido 
                inner join cliente on detalle_pedido.idcliente = cliente.idcliente
                inner join producto on detalle_pedido.idproducto = producto.idproducto
                where nombre ILIKE ? or apellido ILIKE ? or descripcion ILIKE ?
                order by nombre';
        $params = array("%$value%", "%$value%",  "%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT iddetalle, nombre, apellido, nombre_produc, cantidad_producto, precio_produc
                FROM public.detalle_pedido 
                inner join cliente on detalle_pedido.idcliente = cliente.idcliente
                inner join producto on detalle_pedido.idproducto = producto.idproducto
                order by apellido';
        $params = null;
        return Database::getRows($sql, $params);
    }
    /*public function readOne()
    {
        $sql = 'SELECT  idtip ,tipo_nombre, descripcion_tipo
                FROM tipo_produc
                WHERE idtip = ?';
        $params = array($this->idtip);
        return Database::getRow($sql, $params);
    }*/
}
?>