<?php
require_once('../../helpers/database.php');
require_once('../../../models/producto_model.php');

class producto_controller 
{
    public function createRow()
    {
        $sql = 'INSERT INTO producto(img_producto,nombre_producto, descripcion_producto, precio_producto , estado_producto, idusuario,idtip )
                VALUES(?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->img_producto,$this->nombre_producto, $this->descripcion_producto, $this->precio_producto, $this->estado_producto, $_SESSION['idusuario'],  $this->idtip);
        return Database::executeRow($sql, $params);
    }
    public function searchRows($value)
    {
        $sql = 'SELECT idproducto,img_producto, nombre_producto, descripcion_producto, precio_produc,tipo_nombre, estado_producto
        FROM producto INNER JOIN tipo_produc USING(idtip)
        WHERE nombre_producto ILIKE ? OR descripcion_producto ILIKE ?
        ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, nombre_categoria, estado_producto
        FROM productos INNER JOIN categorias USING(id_categoria)
        ORDER BY nombre_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT idproducto, nombre_producto, descripcion_producto, precio_produc, img_producto, idtip, estado_producto
        FROM producto
        WHERE idproducto =?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_img_producto)
    {
        ($this->img_producto) ? $this->deleteFile($this->getRuta(), $current_img_producto) : $this->img_producto = $current_img_producto;

        $sql = 'UPDATE producto
                SET img_producto = ?, nombre_producto = ?, descripcion_producto = ?, precio_produc= ?, estado_producto = ?, idtip = ?
                WHERE idproducto = ?';
        $params = array($this->img_producto, $this->nombre_producto, $this->descripcion_producto, $this->precio_producto, $this->estado_producto, $this->idtip , $this->idproducto);
        return Database::executeRow($sql, $params);
    }
    public function deleteRow()
    {
        $sql = 'DELETE FROM producto
                WHERE idproducto = ?';
        $params = array($this->idproducto);
        return Database::executeRow($sql, $params);
    }

    public function readProductosCategoria()
    {
        $sql = 'SELECT idproducto, img_producto, nombre_producto, descripcion_producto, precio_producto
        FROM productos INNER JOIN tipo_produc USING(idtip)
        WHERE idtip = ? AND estado_producto = true
        ORDER BY nombre_producto';
        $params = array($this->idproducto);
        return Database::getRows($sql, $params);
    }

}

?>