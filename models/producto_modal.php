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
    public function getidproducto()
    {
        return $this->idproducto;
    }
    public function getimg_produc()
    {
        return $this->img;
    }
    public function getnombre_producto()
    {
        return $this->nombre_producto;
    }
    public function getdescripcion()
    {
        return $this->descripcion;
    }
    public function getprecio_produc()
    {
        return $this->precio_produc;
    }
    public function getestado_produc()
    {
        return $this->estado_producto;
    }
    public function getCategoria()
    {
        return $this->Categoria;
    }
    public function getcantidad()
    {
        return $this->cantidad;
    }
    public function getRuta()
    {
        return $this->ruta;
    }
    
    public function createRow()
    {
        $sql = 'INSERT INTO producto(
             img_producto, nombre_producto, descripcion_producto, precio_produc, estado_producto, idusuario, idtip, cantidad_producto)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->img,$this->nombre_produc, $this->descripcion, $this->precio_produc, $this->estado , $_SESSION['idusuario'], $this->categoria, $this->cantidad);
        return Database::executeRow($sql, $params);
    }
    public function searchRows($value)
    {
        $sql = 'SELECT idproducto,img, nombre_produc, descripcion, precio_produc,tipo_nombre, estado,cantidad
        FROM producto INNER JOIN tipo_produc USING(idtip)
        WHERE nombre_produc ILIKE ? OR descripcion ILIKE ?
        ORDER BY nombre_produc';
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
    public function readProductosCategoria()
    {
        $sql = 'SELECT idproducto, img_producto, nombre_producto, descripcion_producto, precio_produc
        FROM producto INNER JOIN tipo_produc USING(idtip)
        WHERE idtip = ? AND estado_producto = true
        ORDER BY nombre_producto';
        $params = array($this->idproducto);
        return Database::getRows($sql, $params);
    }
 

}

?>