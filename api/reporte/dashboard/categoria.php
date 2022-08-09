<?php
require('../../helpers/dashboard_report.php');
require('../../../models/producto_modal.php');
require('../../../models/categorias_modal.php');

//Se instancia la clase para crear el reporte.
$pdf = new Report;
//Se verifica si hay una sesion activa, para poder utilizar las variables de session.
session_start();
// Se inicia el reporte con el encabezado del documento en ello incluimos el encabezado + el nombre y apellido de la persona que 
//*a iniciado la seccion*//
$pdf->startReport('Productos y categorias', $_SESSION['nombre_usuario'], $_SESSION['apellido_usuario']);

// Se instancia el módelo Tipo empleado para obtener los datos.
$categoria = new TipoProducto;
// Se verifica si existen registros (marcas) para mostrar, de lo contrario se imprime un mensaje.
if ($dataTipoProducto = $categoria -> categoriaR()){
    // Se establece la fuente para los encabezados.
    $pdf -> setFont('Times', 'B', 11);
    // Se establece un color de relleno para los encabezados de las tablas.
    $pdf ->setFillColor(0,230,118);
    // Se imprimen las celdas con los encabezados.
    $pdf -> cell(93, 10, utf8_decode('Nombre'),1,1,'C', 1);
    //Se evalua si existen productos en las categorias para mostrar, de lo contrario no se muestra
    foreach($dataTipoProducto as $rowcategoriaR){
        //Se evalua si existen empleados en el tipo empleado para mostrar, de lo contrario no se muestra
        if ($rowcategoriaR['cantidad'] > 0){
        // Se establece la fuente para los encabezados.
        $pdf -> setFont('Times', 'B', 11);
        // Se establece un color de relleno para los encabezados de las tablas.
        $pdf ->setFillColor(0,230,118);
        // Se imprimen las celdas con los encabezados.
        $pdf -> cell(0,10,utf8_decode('Categoria: '.$rowcategoriaR['tipo_nombre']),1, 1, 'C',1);
                   
        // Se instancia el módelo Producto para procesar los datos.
        $productos = new producto;
        // Se establece la categoria para obtener el producto, de lo contrario se imprime un mensaje de error.
        if ($productos -> setCategoria($rowcategoriaR['idtip'])) {
        // Se establece la fuente para los datos de los productos.
        $pdf -> setFont('Arial','',11);
        // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
        if($dataTipoProducto = $productos -> productoCate()){
        // Se recorren los registros ($dataTipoProducto) fila por fila ($rowcategoriaR).
        foreach ($dataTipoProducto as $rowcategoriaR) {
        // Se imprimen las celdas con los datos de los empleados.
        $pdf -> cell(93, 10, utf8_decode($rowcategoriaR['nombre_producto']),1,1);

       }
        }
    }else{
        $pdf -> cell(0, 10, utf8_decode('Categoria inexistente'), 1, 1);
    }
    }
}
}else{
    $pdf->cell(0, 10, utf8_decode('no existe ninguna categoria'), 1, 1);
}
// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'categorias.pdf');