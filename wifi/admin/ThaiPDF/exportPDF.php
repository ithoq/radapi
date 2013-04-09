<? 

require('thaipdfclass.php');
include("../include/class.mysqldb.php");
include("../include/config.inc.php");

function utf8_to_tis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    if (ord($str[$i]) == 224) {
      $unicode = ord($str[$i+2]) & 0x3F;
      $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
      $unicode |= (ord($str[$i]) & 0x0F) << 12;
      $res .= chr($unicode-0x0E00+0xA0);
      $i += 2;
    } else {
      $res .= $str[$i];
    }
  } 
  return $res;
}
function thaidate($str) {
	if($str == "0000-00-00") {
		return "����˹�";
	}
	$y = substr($str, 0, 4) + 543;
	$m = substr($str, 6, 2) + 0;
	$d = substr($str, 8, 2);
			
				
	$month = array("�.�.", "�.�.", "��.�", "��.�.", "�.�.", "��.�.", "�.�.", "�.�.", "�.�.", "�.�.", "�.�.", "�.�.");
	return $d . " " . $month[$m-1] . " " . $y;
}


$footer =  '';
$header = '���ҧ�ʴ���ª��͡����';

$pdf=new ThaiPDF();
$pdf->SetThaiFont();
$pdf->SetHeader( '', 1, 'R', 1);
$pdf->SetFooter($footer, 0, 'L', 1);
$pdf->AddPage();
$pdf->SetFont('FreesiaUPC','B',16); 
$pdf->SetTextColor(0,0,0);

foreach($_REQUEST as $key => $value) {
	$$key = $value;
	// $pdf->Ln(10);
	// $pdf->MultiCell(0,7,$key .' => ' . $value,0,'J');
}
$end = $numadd;
$sql = "select * from groups where gname = '$group'";
$result = mysql_query($sql);
$data = mysql_fetch_object($result);
$gdesc = utf8_to_tis620($data->gdesc);



for($i = 0; $i < $numadd; $i++) {
	if($i % 34 == 0) {
		if($i != 0) { $pdf->AddPage(); }
		$pdf->Cell(0,0,'���ҧ�ʴ���ª��͡����' . $gdesc . ' (�ӹǹ������ ' . $end . ' ��)'   ,0,1,'L');
		$pdf->Ln(7);
		$pdf->SetFont('FreesiaUPC','B',14); 
		$pdf->Cell(15,7,'�ӴѺ���',1,0,'C');
		$pdf->Cell(30,7,'���ͼ����',1,0,'C');
		$pdf->Cell(30,7,'���ʼ�ҹ',1,0,'C');
		$pdf->Cell(30,7,'�ѹ�������',1,0,'C');
		$pdf->Cell(30,7,'��������',1,0,'C');
		$pdf->Cell(0,7,'�����˵�',1,0,'C');
		$pdf->Ln(7);	
	}
	$pdf->SetFont('FreesiaUPC','',14); 
	$pdf->Cell(15,7,$i+1 . '.',1,0,'C');
	$pdf->Cell(30,7,$username[$i]  ,1,0,'C');
	$pdf->Cell(30,7,$passC ,1,0,'C');
	$pdf->Cell(30,7,$data->gexpire ,1,0,'C');
	$pdf->Cell(30,7,$data->gdownload . '/' . $data->gupload . ' KB' ,1,0,'C');
	$pdf->Cell(0,7,'',1,0,'L');
	$pdf->Ln(7);
}

$pdf->Ln(4);
$pdf->Cell(18,7,'�����˵�:',0,0,'L');
$pdf->Cell(0,7,'���ͼ����������ʼ�ҹ��ҧ������ö��ҹ��֧�ѹ���ҷ���˹�㹵��ҧ ',0,0,'J');
$pdf->Ln(7);


if($numadd % 2 != 0) { 
	$numodd = $numadd - 1;
} else { 
	$numodd = $numadd; 
}
$row = 0;
for($i = 0; $i < $numodd; $i+=2) {
	if($row % 4 == 0) {
		$pdf->AddPage(); 
		$newrow = 0;
	}
	$pdf->Image('001.png',10,20 + $newrow * 60, 92, 50);
	$pdf->SetFont('FreesiaUPC','B',16); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('LilyUPC','B',40); 
	$pdf->Text(20,35 + $newrow * 60,'�����Թ������'); 
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('FreesiaUPC','B',70); 
	$pdf->SetXY(20,50 + $newrow * 60);
	$pdf->Cell(75,7,$username[$i] ,0,0,'R');
	$pdf->SetFont('FreesiaUPC','',12); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(20,61 + $newrow * 60);
	$pdf->Cell(75,7,'�ѵ��������: ' . thaidate($data->gexpire) ,0,0,'R');
 
	$pdf->SetXY(18,61 + $newrow * 60);
	$pdf->Cell(75,7,'���ʼ�ҹ: ' .$passC,0,0,'L');


	$pdf->Image('001.png',108,20 + $newrow * 60, 92, 50); 
	$pdf->SetFont('FreesiaUPC','B',16); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('LilyUPC','B',40); 
	$pdf->Text(118,35 + $newrow * 60,'�����Թ������'); 
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('FreesiaUPC','B',70); 
	$pdf->SetXY(118,50 + $newrow * 60);
	$pdf->Cell(75,7,$username[$i+1] ,0,0,'R');
	$pdf->SetFont('FreesiaUPC','',12); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(118,61 + $newrow * 60);
	$pdf->Cell(75,7,'�ѵ��������: ' . thaidate($data->gexpire) ,0,0,'R');
 
	$pdf->SetXY(116,61 + $newrow * 60);
	$pdf->Cell(75,7,'���ʼ�ҹ: ' .$passC,0,0,'L');


	$row++;
	$newrow++;

}
if($numadd % 2 != 0) { 
	if($row % 4 == 0) {
		$pdf->AddPage(); 
		$newrow = 0;
	}
	$pdf->Image('001.png',10,20 + $newrow * 60, 92, 50);
	$pdf->SetFont('FreesiaUPC','B',16); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('LilyUPC','B',40); 
	$pdf->Text(20,35 + $newrow * 60,'�����Թ������'); 
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('FreesiaUPC','B',70); 
	$pdf->SetXY(20,50 + $newrow * 60);
	$pdf->Cell(75,7,$username[$i] ,0,0,'R');
	$pdf->SetFont('FreesiaUPC','',12); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(20,61 + $newrow * 60);
	$pdf->Cell(75,7,'�ѵ��������: ' . thaidate($data->gexpire) ,0,0,'R');
 
	$pdf->SetXY(18,61 + $newrow * 60);
	$pdf->Cell(75,7,'���ʼ�ҹ: ' .$passC,0,0,'L');

}
$pdf->Output();
    
?>
