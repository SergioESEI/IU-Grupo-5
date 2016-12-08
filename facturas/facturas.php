<?php
if((isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0) || (isset($_SESSION['permisos']) && in_array('Factura',$_SESSION['permisos']))){ 

//Recibir detalles de factura
$id_factura = $arrayF["Id_Factura"];
$fecha_factura = $arrayF["Fecha"];

//Recibir los datos de la empresa
$nombre_tienda = "MOOVETT";
$direccion_tienda = "Rúa Avilés de Taramancos, 2";
$poblacion_tienda = "Ourense";
$provincia_tienda = "Ourense";
$codigo_postal_tienda = "32003";
$telefono_tienda = "988 61 62 99";

//Recibir los datos del cliente
$nombre_cliente = iconv("UTF-8", "WINDOWS-1252", strval($arrayF['Nombre']));
$email_cliente = iconv("UTF-8", "WINDOWS-1252", strval($arrayF['Email']));
$direccion_cliente = iconv("UTF-8", "WINDOWS-1252", strval($arrayF['Direccion']));
$telefono = iconv("UTF-8", "WINDOWS-1252", strval($arrayF['Tlf']));

//variable que guarda el nombre del archivo PDF
$archivo="../facturas/factura-$id_factura.pdf";

//Llamada al script fpdf
require('fpdf.php');


$archivo_de_salida=$archivo;

$pdf=new FPDF();  //crea el objeto
$pdf->AddPage();  //añadimos una página. Origen coordenadas, esquina superior izquierda, posición por defeto a 1 cm de los bordes.


//logo de la empresa
$pdf->Image('../facturas/logo.jpg' , 0 ,0, 40 , 40,'JPG', 'http://php-estudios.blogspot.com');

// Encabezado de la factura
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190, 10, "FACTURA", 0, 2, "C");
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(190,5, "Número de factura: $id_factura"."\n"."Fecha: $fecha_factura", 0, "C", false);
$pdf->Ln(2);

// Datos de la empresa
$pdf->SetFont('Arial','B',12);
$top_datos=45;
$pdf->SetXY(40, $top_datos);
$pdf->Cell(190, 10, "Datos de la empresa:", 0, 2, "J");
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(190, //posición X
5, //posición Y
$nombre_tienda."\n".
"Dirección: ".$direccion_tienda."\n".
"Población: ".$poblacion_tienda."\n".
"Provincia: ".$provincia_tienda."\n".
"Código Postal: ".$codigo_postal_tienda."\n".
"Teléfono: ".$telefono_tienda."\n",
 0, // bordes 0 = no | 1 = si
 "J", // texto justificado 
 false);


// Datos del cliente
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(125, $top_datos);
$pdf->Cell(190, 10, "Datos del cliente:", 0, 2, "J");
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(
190, //posición X
5, //posicion Y
"Nombre: ".$nombre_cliente."\n".
"Dirección: ".$direccion_cliente."\n".
"Email: ".$email_cliente."\n".
"Teléfono: ".$telefono."\n",
0, // bordes 0 = no | 1 = si
"J", // texto justificado
false);

//Salto de línea
$pdf->Ln(2);

//Creación de la tabla de los detalles de las actividades
$top_actividades = 110;
    $pdf->SetXY(45, $top_actividades);
    $pdf->Cell(40, 5, 'ACTIVIDAD', 0, 1, 'C');
    $pdf->SetXY(115, $top_actividades);
    $pdf->Cell(40, 5, 'IMPORTE', 0, 1, 'C');  
	$pdf->SetXY(80, $top_actividades);
    $pdf->Cell(40, 5, 'DESCRIPCIÓN', 0, 1, 'C');
 
$y = 115; // variable para la posición top desde la cual se empezarán a agregar los datos
$x=0;
while($x <= count($arrayL) - 1){
$pdf->SetFont('Arial','',8);
       
   $pdf->SetXY(45, $y);
    $pdf->Cell(40, 5, iconv("UTF-8", "WINDOWS-1252", strval($arrayL[$x]['Nombre'])), 0, 1, 'C');
	$pdf->SetXY(115, $y);
    $pdf->Cell(40, 5, iconv("UTF-8", "WINDOWS-1252", strval($arrayL[$x]['Importe']))." €", 0, 1, 'C');
    $pdf->SetXY(80, $y);
    $pdf->Cell(40, 5, iconv("UTF-8", "WINDOWS-1252", strval($arrayL[$x]['Descripcion'])), 0, 1, 'C');

	$x++;
	// aumento del top 5 cm
	$y = $y + 5;	
}
//Cálculo del precio total
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190, 5, "TOTAL: ".$arrayF['Total']." €", 0, 1, "C");


$pdf->Output($archivo_de_salida);//cierra el objeto pdf

//Creacion de las cabeceras que generarán el archivo pdf
header ("Content-Type: application/download");
header ("Content-Disposition: attachment; filename=$archivo");
header("Content-Length: " . filesize("$archivo"));
$fp = fopen($archivo, "r");
fpassthru($fp);
fclose($fp);

//Eliminación del archivo en el servidor
unlink($archivo);
}else echo "Permiso denegado.";