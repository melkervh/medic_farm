<?php
// Clase general de reportes
require('../../helpers/dashboard_report.php');
//Se llama los modelos de los pedidos
require('../../../models/historial_model.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de pedidos registrados', 'Reporte de pedidos');

// Se instancia el módelo Categorías para obtener los datos.
$historial = new Historial;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataHistorial = $historial->readAll()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(72, 69, 48);
    // Se establece un color de texto del encabezdo
    $pdf->SetTextColor(255);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 12);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
    $pdf->cell(35, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
    $pdf->cell(35, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
    $pdf->cell(40, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Correo'), 1, 1, 'C', 1);
    

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(86, 134, 219);
    // Se establece un color de texto para el nombre de la categoría del resto de celdas
    $pdf->SetTextColor(0);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Arial', '', 11);
    $i = 1;

    // Se recorren los registros ($datahistorials) fila por fila ($rowhistorial).
    foreach ($dataHistorial as $rowhistorial) {
        // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
        if ($dataHistorial = $historial->readAll()) {
            $pdf->cell(10, 10, $i++, 1, 0, 'C');
            $pdf->cell(35, 10, utf8_decode($rowhistorial['nombre_cliente']), 1, 0,'C');
            $pdf->cell(35, 10, utf8_decode($rowhistorial['apellido_cliente']), 1, 0,'C');
            $pdf->cell(40, 10, utf8_decode($rowhistorial['fecha_pedido']), 1, 0, 'C');
            $pdf->cell(70, 10, utf8_decode($rowhistorial['correo_cliente']), 1, 1, 'C');

        } else {
            $pdf->cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
        }
    }
} else {
    $pdf->cell(0, 10, utf8_decode('No hay categorías para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'historials.pdf');

