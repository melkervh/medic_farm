<?php
// Clase general de reportes
require('../../helpers/dashboard_report.php');
//Se llama los modelos de los pedidos
require('../../../models/listauser_modal.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de usuarios registrados', 'Reporte de usuarios');

// Se instancia el módelo Categorías para obtener los datos.
$usuario = new listauser;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataUsuario = $usuario->readAll()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(72, 69, 48);
    // Se establece un color de texto del encabezdo
    $pdf->SetTextColor(255);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 12);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(40, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
    $pdf->cell(60, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
    $pdf->cell(90, 10, utf8_decode('Correo'), 1, 1, 'C', 1);
    

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(86, 134, 219);
    // Se establece un color de texto para el nombre de la categoría del resto de celdas
    $pdf->SetTextColor(0);
    // Se establece la fuente para los datos de los Usuarios.
    $pdf->setFont('Arial', '', 11);
    $i = 1;

    // Se recorren los registros ($dataUsuario) fila por fila ($rowusuario).
    foreach ($dataUsuario as $rowusuario) {
        // Se verifica si existen registros (Usuarios) para mostrar, de lo contrario se imprime un mensaje.
        if ($dataUsuario = $usuario->readAll()) {
            $pdf->cell(40, 10, utf8_decode($rowusuario['nombre_usuario']), 1, 0,'C');
            $pdf->cell(60, 10, utf8_decode($rowusuario['apellido_usuario']), 1, 0,'C');
            $pdf->cell(90, 10, utf8_decode($rowusuario['correo_usuario']), 1, 1, 'C');

        } else {
            $pdf->cell(0, 10, utf8_decode('No hay Usuarios para esta categoría'), 1, 1);
        }
    }
} else {
    $pdf->cell(0, 10, utf8_decode('No hay Usuario para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'usuarios.pdf');

