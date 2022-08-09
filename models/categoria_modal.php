<?php
class TipoProducto extends Validator
{
    private $idtip = null;
    private $tipo_nombre = null;
    private $descripcion_tipo = null;
    private $img= null;
    private $ruta = '../../images/categoria/';
   
    public function setidtip($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idtip = $value;
            return true;
        } else {
            return false;
        }
    }
    public function settipo_nombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tipo_nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setdescripcion_tipo($value)
    {
        if ($value) {
            if ($this->validateString($value, 1, 250)) {
                $this->descripcion_tipo = $value;
                return true;
            } else {
                return false;
            }
        } else {
            $this->descripcion_tipo = null;
            return true;
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
    public function getidtip()
    {
        return $this->ididtip;
    }
    public function gettipo_nombre()
    {
        return $this->tipo_nombre;
    }
    public function getdescripcion_tipo()
    {
        return $this->descripcion_tipo;
    }
    public function getRuta()
    {
        return $this->ruta;
    }
    public function getimg()
    {
        return $this->img;
    }
    public function searchRows($value)
    {
        $sql = 'SELECT idtip,tipo_nombre, descripcion_tipo
                FROM tipo_pruct
                WHERE tipo_nombre ILIKE ? OR descripcion_tipo ILIKE ?
                ORDER BY tipo_nombre';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO tipo_produc(tipo_nombre,descripcion_tipo,imagen_categoria )
                VALUES(?,?,?)';
        $params = array($this->tipo_nombre,$this->descripcion_tipo,$this->img);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT idtip ,tipo_nombre, descripcion_tipo,imagen_categoria
        FROM tipo_produc
        ORDER BY idtip';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT  idtip ,tipo_nombre, descripcion_tipo,imagen_categoria
                FROM tipo_produc
                WHERE idtip = ?';
        $params = array($this->idtip);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {

        $sql = 'UPDATE tipo_produc
                SET  tipo_nombre = ?, descripcion_tipo = ?,imagen_categoria= ?
                WHERE idtip = ?';
        $params = array( $this->tipo_nombre, $this->descripcion_tipo, $this->img,$this->idtip);
        return Database::executeRow($sql, $params);
    }
    public function deleteRow()
    {
        $sql = 'DELETE FROM tipo_produc
                WHERE idtip = ?';
        $params = array($this->idtip);
        return Database::executeRow($sql, $params);
    }
    //*Selecionamos la categoria para el reporte*//
    public function categoriaR()
    {

        $sql = 'SELECT tc. idtip, tipo_nombre, COUNT(idproducto) as cantidad
        FROM tipo_produc tc
        INNER JOIN producto tp ON tp.idtip = tc.idtip
        GROUP BY tc. idtip, tp. idtip
        ORDER BY tc. idtip';
        $params = null;
        return Database::executeRow($sql, $params);
    }
}
?>