<?php

class Valoraciones extends Validator
{
    private $idproducto = null;
    private $idvaloraciones = null;
    private $iddetalle = null;
    private $calificacion = null;
    private $comentario = null;
    private $fecha_valoracion = null;
 
    public function setidproducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idproducto = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setidvaloraciones($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idvaloraciones = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdDetalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->iddetalle = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setcalificacion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->calificacion = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setcomentario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->comentario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setfecha_valoracion($value)
    {

        if ($this->validateDate($value)) {

            $this->fecha_valoracion = $value;

            return true;

        } else {

            return false;

        }

    }
    public function getIdproducto()
    {
        return $this->idproducto;
    }
    public function getIdvaloracion()
    {
        return $this->idvaloracion;
    }
    public function getiddetalle()
    {
        return $this->iddetalle;
    }
    public function getcalificacion()
    {
        return $this->calificacion;
    }
    public function getcomentario()
    {
        return $this->comentario;
    }
    public function getfecha_valoracion ()
    {
        return $this->fecha_valoracion ;
    }
 
    public function readValoraciones()
    {
        $sql = 'SELECT idvaloracion,producto.idproducto, nombre_cliente, calificacion, comentario, fecha_valoracion, estado_valoracion
        FROM public."valoracion"
         INNER JOIN detalle_pedido
         ON detalle_pedido.iddetalle = valoracion.iddetalle
         INNER JOIN producto
         ON detalle_pedido.idproducto = producto.idproducto
         INNER JOIN pedidos 
         ON detalle_pedido.id_pedido = pedidos.id_pedido
         INNER JOIN cliente
         ON pedidos.id_cliente = cliente.id_cliente
                WHERE idproducto = ? and estado_valoracion = true 
        ORDER BY calificacion_producto'
        ;
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }	
    public function readAll()
    {
        $sql = 'SELECT nombre_cliente, calificacion, comentario, fecha_valoracion
        FROM valoracion INNER JOIN cliente  USING (id_cliente) 
        ORDER BY nombre_cliente';
        $params = null;
        return Database::getRows($sql, $params);
    }					
}