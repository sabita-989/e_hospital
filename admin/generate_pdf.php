<?php
//include connection file
include('../dbconnection.php');
include_once('../fpdf/fpdf.php');
$id = $_GET['id'];
class PDF extends FPDF
{
// Page header
function Header()
{   
    $this->SetFont('Arial','B',34);
    // Move to the right
    $this->Cell(30);
    // Title
    $this->Cell(5,10,'BirSewa',0,0,'C');
    // Line break
    $this->Ln();
    $this->SetFont('Arial','B',10);
    $this->Cell(72,10,'Address : Bijaychowk,Gaushala',0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',10);
    $this->Cell(60.5,2,'Phone: 6615478, 6698745',0,0,'C');
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$sql ="select *from appointment_db where appointment_id =".$id;
$result = $conn->query($sql);
$row=mysqli_fetch_assoc($result);
$id=$row['appointment_id'];
$name= $row['p_name'];
$gender= $row['gender'];
$problem= $row['problem'];
$shift= $row['shift'];
$age= $row['age'];
$phone= $row['phone'];
$address= $row['p_address'];
$inputdate= $row['inputdate'];
$appointment_time= $row['appointment_time'];
$stat= $row['a_status'];
if($stat==1){$status= "Verified";}else{$status= "Not Verified";}

$sqls ="select d_name from doctor_db where doctor_id=".$row['doctor_id'];
$results = $conn->query($sqls);
$rows=$results-> fetch_assoc();
$doctor_name = $rows['d_name'];

$sqlp ="select ammount from payment_db where appointment_id=".$row['appointment_id'];
$resultp = $conn->query($sqlp);
$rowp=$resultp-> fetch_assoc();
        if(isset($rowp['ammount'])=='100'){
          $paymentStatus= "Paid";
        }
        else{
            $paymentStatus= "Not Paid";
        }


$pdf = new PDF('P','mm','A4');
//header
$pdf->AddPage();
$pdf->Line(5, 35, 210-5, 35);
//foter page
$pdf->AliasNbPages();

$pdf->Cell(9);
$pdf->Cell(40,10,'Appointment ID: ',0);
$pdf->Cell(100,10,$id,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Name: ',0);
$pdf->Cell(100,10,$name,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Age: ',0);
$pdf->Cell(100,10,$age,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Gender: ',0);
$pdf->Cell(100,10,$gender,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Phone: ',0);
$pdf->Cell(100,10,$phone,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Address: ',0);
$pdf->Cell(100,10,$address,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Problem: ',0);
$pdf->Cell(100,10,$problem,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Doctor: ',0);
$pdf->Cell(100,10,$doctor_name,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Date: ',0);
$pdf->Cell(100,10,$inputdate,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Shift: ',0);
$pdf->Cell(100,10,$shift,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Status: ',0);
$pdf->Cell(100,10,$status,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Request Time: ',0);
$pdf->Cell(100,10,$appointment_time,0);
$pdf->Ln();

$pdf->Cell(9);
$pdf->Cell(40,10,'Payment Status: ',0);
$pdf->Cell(100,10,$paymentStatus,0);
$pdf->Ln();



$pdf->Output();
?>