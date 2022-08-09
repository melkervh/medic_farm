<?php
class producto extends Validator
{
    private $idproducto = null;
    private $img= null;
    private $nombre_produc = null;
    private $descripcion = null;
    private $precio_produc = null;
    private $estado= null;
    private $categoria = null ;
    private $cantidad = null ;
    private $ruta = '../../images/productos/';

    public function setidproducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idproducto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setnombre_produc($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre_produc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setdescripcion($value)
    {
        if ($this->validateString($value, 1, 250)) {
            $this->descripcion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setprecio_produc($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio_produc = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setimg($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->img= $this->getFileName();
            return true;
        } else {
            return false;
        }
    }

    public function setcantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCategoria($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->categoria = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setestado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado= $value;
            return true;
        } else {
            return false;
        }
    }
    public function getRuta()
    {
        return $this->ruta;
    }
    public function getimg()
    {
        return $this->img;
    }
    
    public function createRow()
    {
        $sql = 'INSERT INTO public.producto(
            img_producto, nombre_producto, descripcion_producto, precio_produc, estado_producto, idusuario, idtip, cantidad_producto)
           VALUES ( ?, ?, ?, ?, ?, 1, ?, ?)';
        $params = array($this->img,$this->nombre_produc, $this->descripcion, $this->precio_produc, $this->estado , $this->categoria, $this->cantidad);
        return Database::executeRow($sql, $params);
    }
    //consulta para el buscador de productos
    public function searchRows($value)
    {
        $sql = 'SELECT idproducto,img_producto , nombre_producto , descripcion_producto , precio_produc,tipo_nombre, estado_producto ,cantidad_producto 
        FROM producto INNER JOIN tipo_produc USING(idtip)
        WHERE nombre_producto ILIKE ? OR descripcion_producto ILIKE ?
        ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT idproducto, img_producto, nombre_producto, descripcion_producto, precio_produc,tipo_nombre,estado_producto,cantidad_producto
        FROM producto INNER JOIN tipo_produc USING(idtip)
        ORDER BY nombre_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT idproducto, nombre_producto, descripcion_producto, precio_produc, img_producto, tipo_nombre, 
        estado_producto,cantidad_producto
              FROM producto
              inner join tipo_produc on producto.idtip = tipo_produc.idtip
        WHERE idproducto =?';
        $params = array($this->idproducto);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_img)
    {
        ($this->img) ? $this->deleteFile($this->getRuta(), $current_img) : $this->img = $current_img;

        $sql = 'UPDATE producto
                SET img = ?, nombre_produc = ?, descripcion= ?, precio_produc= ?, estado = ?, idtip = ?, cantidad= ?
                WHERE idproducto = ?';
        $params = array($this->img, $this->nombre_produc, $this->descripcion, $this->precio_produc, $this->estado, $this->idtip , $this ->cantidad ,$this->idproducto);
        return Database::executeRow($sql, $params);
    }
    public function deleteRow()
    {
        $sql = 'DELETE FROM producto
                WHERE idproducto = ?';
        $params = array($this->idproducto);
        return Database::executeRow($sql, $params);
    }
       // se crea el metodo con la cual se crearan las carts
    public function readProductosCategoria()
    {
        $sql = 'SELECT idproducto, img_producto, nombre_producto, descripcion_producto, precio_produc
        FROM producto INNER JOIN tipo_produc USING(idtip)
        WHERE idtip = ? AND estado_producto = true
        ORDER BY nombre_producto';
        $params = array($this->idproducto);
        return Database::getRows($sql, $params);
    }
    public function cantidaProductosCategoria()
    {
        $sql = 'SELECT tipo_nombre, COUNT(idproducto) cantidad_producto
                FROM producto INNER JOIN tipo_produc USING(idtip)
                GROUP BY tipo_nombre ORDER BY cantidad_producto DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function porcentajeProductosCategoria()
    {
        $sql = 'SELECT tipo_nombre, ROUND((COUNT(idproducto) * 100.0 / (SELECT COUNT(idproducto) FROM producto)), 2) porcentaje
                FROM producto INNER JOIN tipo_produc USING(idtip)
                GROUP BY tipo_nombre ORDER BY porcentaje DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }
 
    public function graficoEstadovaloracion()
{
    $sql = 'SELECT idvaloracion, calificacion
                FROM valoracion 
                GROUP BY idvaloracion ORDER BY calificacion DESC';
    $params = null;
    return Database::getRows($sql, $params);
}
public function graficoEstadoClientes()
{
    $sql = 'SELECT id_cliente, estado_cliente
                 FROM cliente 
                GROUP BY id_cliente ORDER BY estado_cliente DESC';
    $params = null;
    return Database::getRows($sql, $params);
}
public function graficoestadoPedidos()
{
    $sql = 'SELECT id_pedido, estado_pedido , nombre_cliente
    FROM pedidos INNER JOIN cliente USING(id_cliente)
     ORDER BY nombre_cliente';
    $params = null;
    return Database::getRows($sql, $params);
}

     //*Generamos el reporte*//
     public function productoCate()
     {
         $sql = 'SELECT nombre_producto, estado_producto, precio_produc
         FROM producto tp
         INNER JOIN tipo_produc te ON  te.idtip = tp."idtip"
         WHERE tp."idtip" = ?
         ORDER BY nombre_producto';
         $params = array($this->categoria);
         return Database::getRows($sql, $params);
     }
}
?>