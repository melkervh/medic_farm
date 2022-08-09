<?php
// Clase general de reportes
require('../../helpers/dashboard_report.php');
//Se llama los modelos de los pedidos
require('../../../models/producto_modal.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de estado de productos', 'Reporte de productos');

// Se instancia el módelo Categorías para obtener los datos.
$producto = new producto;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataproducto = $producto->reporteProducto()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(72, 69, 48);
    // Se establece un color de texto del encabezdo
    $pdf->SetTextColor(255);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 12);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(95, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
    $pdf->cell(95, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
    

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(86, 134, 219);
    // Se establece un color de texto para el nombre de la categoría del resto de celdas
    $pdf->SetTextColor(0);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Arial', '', 11);
    $i = 1;

    // Se recorren los registros ($dataproducto) fila por fila ($rowproducto).
    foreach ($dataproducto as $rowproducto) {
        // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
        if ($dataproducto = $producto->readAll()) {
            $pdf->cell(95, 10, utf8_decode($rowproducto['nombre_producto']), 1, 0,'C');
            $pdf->cell(95, 10, utf8_decode($rowproducto['estado_producto']), 1, 1, 'C');

        } else {
            $pdf->cell(0, 10, utf8_decode('No hay productos'), 1, 1);
        }
    }
} else {
    $pdf->cell(0, 10, utf8_decode('No hay productos para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'productos.pdf');

