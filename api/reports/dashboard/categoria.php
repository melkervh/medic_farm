<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['idtipo'])) {
    require('../../helpers/dashboard_report.php');
    require('../../../models/categoria_modal.php');
    require('../../../models/producto_modal.php');

    // Se instancia el módelo Categorias para procesar los datos.
    $categoria = new TipoProducto;

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($categoria->setidtip($_GET['idtipo'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowCategoria = $categoria->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos de la categoría '.$rowCategoria['tipo_nombre']);
            // Se instancia el módelo Productos para procesar los datos.
            $producto = new producto;
            if ($producto->setCategoria($rowCategoria['idtip'])) {
                // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
                if ($dataProductos = $producto->productoCate()) {
                    // Se establece un color de relleno para los encabezados.
                    $pdf->setFillColor(225);
                    // Se establece la fuente para los encabezados.
                    $pdf->setFont('Times', 'B', 11);
                    // Se imprimen las celdas con los encabezados.
                    $pdf->cell(126, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                    $pdf->cell(30, 10, utf8_decode('Precio (US$)'), 1, 0, 'C', 1);
                    $pdf->cell(30, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
                    // Se establece la fuente para los datos de los productos.
                    $pdf->setFont('Times', '', 11);
                    // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                    foreach ($dataProductos as $rowProducto) {
                        ($rowProducto['estado_producto']) ? $estado = 'Activo' : $estado = 'Inactivo';
                        // Se imprimen las celdas con los datos de los productos.
                        $pdf->cell(126, 10, utf8_decode($rowProducto['nombre_producto']), 1, 0);
                        $pdf->cell(30, 10, $rowProducto['precio_produc'], 1, 0);
                        $pdf->cell(30, 10, $estado, 1, 1);
                    }
                } else {
                    $pdf->cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
                }
                // Se envía el documento al navegador y se llama al método footer()
                $pdf->output('I', 'categoria.pdf');
            } else {
                //header('location: ../../../views/dashboard/Categoria.html');
            }
        } else {
            //header('location: ../../../views/dashboard/Categoria.html');
        }
    } else {
        //header('location: ../../../views/dashboard/Categoria.html');
    }
} else {
    //header('location: ../../../views/dashboard/Categoria.html');
}
?>