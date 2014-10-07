<?php
$image=$_POST['image'];
$code=$_POST['code'];
require_once('fpdf.php');
require_once('fpdi.php');
//ob_start();
//
//        
//        $base64 = 'data:image/jpeg;base64,' .$image;
//       
//
//
//        ob_end_flush();

$pdf = new FPDI();

$pdf->AddPage(); 

$pdf->setSourceFile('contract.pdf'); 
// import page 1 
$tplIdx = $this->pdf->importPage(1); 
//use the imported page and place it at point 0,0; calculate width and height
//automaticallay and ajust the page size to the size of the imported page 
$this->pdf->useTemplate($tplIdx, 0, 0, 0, 0, true); 

// now write some text above the imported page 
$this->pdf->SetFont('Arial', '', '13'); 
$this->pdf->SetTextColor(0,0,0);
//set position in pdf document
$this->pdf->SetXY(20, 20);
//first parameter defines the line height
$this->pdf->Write(0, 'gift code');
//force the browser to download the output
$this->pdf->Output('gift_coupon_generated.pdf', 'D');;
//header("Content-Type: application/octet-stream");
//
//$file = "pdf/".$code .".pdf";
//header("Content-Disposition: attachment; filename=" . urlencode($file));   
//header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");
//header("Content-Description: File Transfer");            
//header("Content-Length: " . filesize($file));
//flush(); // this doesn't really matter.
//$fp = fopen($file, "r");
//while (!feof($fp))
//{
//    echo fread($fp, 65536);
//    flush(); // this is essential for large downloads
//} 
//fclose($fp); 
?>