<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    //Logo
    $this->Image('logo.jpg',6,3,65);

    //MobNo
    $this->SetFont('Arial','',15);
    $this->Cell(155);
    $this->Cell(30,5,'07967 226 297');

    //Email
    $this->SetFont('Arial', '', 12);
    $this->Cell(-64);
    $this->Cell(30,15,'andersonpestprevention@gmail.com');

    //Email
    $this->Cell(-28);
    $this->Cell(30,25,'www.andersonpestprevention.co.uk');

    //Facebook
    $this->Image('fb.png',145.5,25.5,4);
    $this->Cell(-13);
    $this->Cell(30, 35, '@andersonpestprevention');

    $this->Ln(40);
}

// Page Body
function Body(){

	//Dotted Lines
	$DottedLine = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
	$DottedLineLong = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";

	//Get Date
	$date = date("d/m/Y");

	//Convert dataurl to img
	$data = $_POST['pic'];
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);

	file_put_contents('image.png', $data);

	//Top Panel
	//Top Left Panel
	$this->SetFont('Arial', '', 10);
	$this->SetXY(9,45);
	$this->Cell(119, 7,'TREATMENT REPORT',1,1,'L');	

	//Client Details
	$this->SetXY(-82, 45);
	$this->Cell(73, 50,'',1,0,'L');

	$this->Text(10, 57, "Client Details:");

	$this->Text(35, 57, $_POST["name"]);
	$this->Text(35, 65, $_POST["hname"]);
	$this->Text(35, 72.5, $_POST["ad1"]);
	$this->Text(35, 79.5, $_POST["ad2"]);
	$this->Text(35, 87, $_POST["pc"]);

	//Table Lines
	$this->Text(9.5, 59.9, $DottedLineLong);
	$this->Text(9.5, 67.8, $DottedLineLong);
	$this->Text(9.5, 74.8, $DottedLineLong);
	$this->Text(9.5, 81.8, $DottedLineLong);
	$this->Text(9.5, 88.9, $DottedLineLong);

	//FAO
	$this->Text(10, 93, "FAO:");
	$this->Text(35, 93, $_POST["fao"]);

	//Right Panel
	//Container
    $this->SetXY(9, 52);
	$this->Cell(119, 43,'',1,0,'L');

	//Visit Number
	$this->Text(130, 50, "Visit No:");
	$this->Text(128.3, 52.9, $DottedLine);

	$this->Text(151, 50, 1);

	//Contact Numnber
	$this->Text(130, 57, "Contract No:");
	$this->Text(128.3, 59.9, $DottedLine);

	$this->Text(151, 57, $_POST["no"]);

	//Date
	$this->Text(130, 64, "Date:");

	$this->Text(151, 64, $date);

	//Title Tick
	$this->SetXY(128, 66.9);
	$this->Cell(73, 7, "Tick Applicable", 1, 0, "C");


	//Rountine CheckBox
	$this->SetXY(128, 74);
	$this->Cell(30, 7, "Routine", 1, 0, "L");


	//Follow Up CheckBox
	$this->SetXY(128, 81);
	$this->Cell(30, 7, "Follow Up", 1, 0, "L");


	//Call Out CheckBox
	$this->SetXY(128, 88);
	$this->Cell(30, 7, "Call Out", 1, 0, "L");

	//Job CheckBox
	$this->SetXY(164.8, 74);
	$this->Cell(30, 7, "Job", 1, 0, "L");


	//Contract CheckBox
	$this->SetXY(164.8, 81);
	$this->Cell(30, 7, "Contract", 1, 0, "L");


	//Empty
	$this->SetXY(164.8, 88);
	$this->Cell(30, 7, "", 1, 0, "L");

	//Job type if statement
	if ($_POST['job'] == "r"){
			$this->Text(160.3, 79, "X");
	}
	elseif ($_POST['job'] == "f") {
		$this->Text(160.3, 86, "X");
	}
	elseif ($_POST['job'] == "c") {
		$this->Text(160.3, 93, "X");
	}
	elseif ($_POST['job'] == "j") {
		$this->Text(197, 79, "X");
	}
	elseif ($_POST['job'] == "ct") {
		$this->Text(197, 86, "X");
	}

	//Table Lines
	$this->Line(128,81,201,81);
	$this->Line(128,88,201,88);

	//Middle Panel
	//Container
	$this->SetXY(9, 95);
	$this->Cell(192, 105,'',1,1,'L');

	//First Section
	$this->SetXY(9, 95);	
	$this->Cell(192, 7, "Report and Findings", 1, 0, "L");

	//Second Section
	$this->SetXY(9, 140);	
	$this->Cell(192, 7, "Actions & Recommendations", 1, 0, "L");

	//Bottom Panel
	//Product Name
	$this->SetXY(9, 200);	
	$this->Cell(46, 30, "", 1, 0, "L");
	$this->Text(10, 204, "Product Name");

	//Quantity
	$this->SetXY(55, 200);	
	$this->Cell(13, 30, "", 1, 0, "L");
	$this->Text(56, 204, "Qty");

	//Active
	$this->SetXY(68, 200);	
	$this->Cell(33, 30, "", 1, 0, "L");
	$this->Text(69, 204, "Active Ingredients");

	//Spraying
	$this->SetXY(101, 200);	
	$this->Cell(25, 30, "", 1, 0, "L");
	$this->Text(102, 204, "Spraying");

	//Dusting
	$this->SetXY(126, 200);	
	$this->Cell(25, 30, "", 1, 0, "L");
	$this->Text(127, 204, "Dusting");

	//Baiting
	$this->SetXY(151, 200);	
	$this->Cell(25, 30, "", 1, 0, "L");
	$this->Text(152, 204, "Baiting");

	//Other
	$this->SetXY(176, 200);	
	$this->Cell(25, 30, "", 1, 0, "L");
	$this->Text(177, 204, "Other");

	//Table Lines
	$this->Line(9,206,201,206);
	$this->Line(9,212,201,212);
	$this->Line(9,218,201,218);
	$this->Line(9,224,201,224);


	//Signatures
	//Client
	$this->SetXY(9, 230);	
	$this->Cell(96, 20, "", 1, 0, "L");

	$this->SetXY(105, 230);	
	$this->Cell(96, 20, "", 1, 0, "L");

	$this->Text(10, 234, "Client Signature:");
	$this->Text(106, 234, "Client Name:");

	$this->SetXY(105, 230);	
	$this->Image("image.png",35, 224,65);

	//Technician
	$this->SetXY(9, 250);	
	$this->Cell(96, 25, "", 1, 0, "L");

	$this->SetXY(105, 250);	
	$this->Cell(96, 25, "", 1, 0, "L");

	$this->Text(10, 254, "Technician Signature:");
	$this->Text(106, 254, "Technician Name:");

}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Body();
$pdf->Output();
?>