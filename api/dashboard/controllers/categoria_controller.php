<?php
require_once('../../helpers/database.php');
require_once('../../../models/categoria_model.php');

class producto_controller 
{
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
        $sql = 'INSERT INTO tipo_produc(tipo_nombre,descripcion_tipo)
                VALUES(?, ?)';
        $params = array($this->tipo_nombre,$this->descripcion_tipo );
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = '  SELECT idtip ,tipo_nombre, descripcion_tipo
        FROM tipo_produc
        ORDER BY tipo_nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT  idtip ,tipo_nombre, descripcion_tipo
                FROM tipo_produc
                WHERE idtip = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE tipo_produc
                SET  tipo_nombre = ?, descripcion_tipo = ?
                WHERE idtip = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id);
        return Database::executeRow($sql, $params);
    }
    public function deleteRow()
    {
        $sql = 'DELETE FROM tipo_produc
                WHERE idtip = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}

?>