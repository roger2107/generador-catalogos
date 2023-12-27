<?php
    // mostrar errores de php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    require('../../librerias/fpdf186/fpdf.php');
    require('../../librerias/fpdf186/makefont/makefont.php');
    //Importar la conexion a la BD
    require '../../includes/config/database.php';
    $db  = conectarDB();

    //$query = "SELECT * FROM productos WHERE idcategoria = 3;";
    $query = "SELECT * FROM productos ORDER BY idcategoria;";
    $resultadoConsulta = mysqli_query($db, $query);
    
    //$queryContarResultados = "SELECT COUNT( id) AS totalResultados FROM productos WHERE idcategoria = 4 ;";

    //VARIABLES DE LA URL

    
    $columnas = 2;
    
    


    //VARIABLES DEL DOCUMENTO
    // echo '<pre>';
    // var_dump($resultadoConsulta);
    // echo '</pre>';
    // exit;

    //MakeFont('../../Poppins-Regular.ttf','cp1252');
    class pdf extends FPDF{
        public function header(){
            $this->SetFillColor(0, 95, 157);
            $this->Rect(0,0, 175, 25,'F');
            $this->SetY(10);
            $this->SetFont('arial', 'b', 18);
            $this->SetTextColor(255,255,255);
            $this->Write(5, 'COMERCIALIZADORA DEL PACIFICO');
            $this->Image('../../imagenes/logo.jpg',180, 0, 25, 25, 'jpg');
        }
    
        public function footer(){
            $this->SetFillColor(0, 95, 157);
            $this->Rect(0,260, 220, 40,'F');
            $this->SetY(-20);
            
            $this->setX(15);
            $this->SetY(265);
            $this->SetTextColor(255,255,255);
            $this->SetFont('arial', '', 16);
            $this->Write(5, '951 343 6530');
    
           
            $this->SetX(80);
            $this->Write(5, 'contacto@cubiit.io');
    
            
            $this->SetX(150);
            $this->Write(5, 'www.cubiit.io');
        }
    
    }
    
    if($columnas === 2){
        $totalResultados = $resultadoConsulta->num_rows;
        $productosPorHoja = 4;

        $fpdf =new pdf('p', 'mm', 'letter', true);
        $fpdf->AddFont('Poppins','','Poppins-Regular.php');
        $fpdf->AddPage('portrait', 'letter');
        
        $yInicial = 30;
        $xInicial = 15;


        $columnaActual =1;
        $productosColocados =0;
        //CODIGO PARA CREAR UNA FILA
        while($producto = mysqli_fetch_assoc($resultadoConsulta)){
            //CODIGO PARA CREAR EL TITULO DEL PRODUCTO------------ PRIMERA FICHA
            $fpdf->SetFillColor(0, 95, 157);
            $fpdf->SetTextColor(255,255,255);
            $fpdf->SetDrawColor(0, 95, 157);
            $fpdf->SetFont('Poppins', '', 15);
            $fpdf->SetXY($xInicial, $yInicial);
            $fpdf->Cell(93, 15,mb_convert_encoding( $producto['nombre'],'ISO-8859-1','UTF-8'),1,0,'C', 1);
            //mb_convert_encoding('Esta linea está en COURIER BOLD tamaño 12', 'ISO-8859-1','UTF-8')

            //CODIGO PARA CREAR EL RECUADRO DE LA IMAGEN
            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->SetDrawColor(180,180,180);
            $fpdf->SetXY($xInicial, $yInicial+15);
            $fpdf->Cell(93, 90, '',1,0,'C', 1);

            //CODIGO PARA COLOCAR LA IMAGEN DE PRODUCTO
            $fpdf->Image('../../imagenes/' . $producto['imagen'],$xInicial+10, $yInicial+16, 75, 75, 'jpg');

            //CODIGO PARA LA DESCRIPCION DEL PRODUCTO
            $fpdf->SetXY($xInicial, $yInicial+85);
            $fpdf->SetTextColor(0, 95, 157);
            $fpdf->SetFont('Poppins', '', 15);
            $fpdf->Cell(93, 15, mb_convert_encoding( $producto['descripcion'],'ISO-8859-1','UTF-8'),0,0,'C', 0);

            //CODIGO PARA PONER EL PRECIO
            $fpdf->SetXY($xInicial, $yInicial+95);
            $fpdf->SetFont('Poppins', '', 15);
            $fpdf->Cell(93, 10, '$' . $producto['precio'],0,0,'C', 0);

            $xInicial +=103;
            
            
            
            if($columnaActual === $columnas){
                $xInicial = 15;
                
                $yInicial +=115;

                $columnaActual=0;
            }
            $columnaActual++;
            $productosColocados++;

            if($productosColocados==$productosPorHoja){
                $fpdf->AddPage('portrait', 'letter');
                $xInicial = 15;
                $yInicial = 30;
                $productosColocados =0;
            }
        }

        
        
    
    
        $fpdf->Output('','catalogo.pdf','');
    }

    

?>