<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
require('./pdf/fpdf.php');



class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('./photo/black echo.png', 0, 0, 25);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(-70, 30, 'Echo Medical System', 0, 1, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Function to create table with labels and values side by side
    function FancyTable($header, $data)
    {
        // Set position Y (move table down)
        $this->SetY(40); // Adjust this value as needed

        // Colors, line width and bold font for header
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Width of the columns
        $w = array(42, 60); // Widths of the columns: label and value

        // Color and font restoration for data
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = false;
        foreach ($data as $row) {
            for ($i = 0; $i < count($header); $i++) {
                // Print header (label)
                $this->SetX(1.8); // Ensure each label starts from the left edge
                $this->Cell($w[0], 9, $header[$i], 1, 0, 'L', true);
                // Print corresponding value
                $this->Cell($w[1], 9, $row[$i], 1, 1, 'L', $fill);
            }
            $this->Ln();
            $fill = !$fill;
        }

        // Move to a new line for signature and stamp area
        $this->Ln(5); // Add some space after the table

        // Add signature and stamp areas
        $this->SetX(10);
        $this->Cell(60, 0, 'Signature:', 0, 0, 'L');
        $this->Cell(50, 0, 'Stamp:', 0, 1, 'L');

    }
}

// Column headings
$header = array('Patient Name', 'Reservation Date', 'DR Name', 'Reservation Type', 'Patient ID', 'Payed');


$id = $_GET['id'];
$uid = $_GET['uid'];
$sql = mysqli_query($connect, "SELECT doctors.doctorName as docname, appointment.* from appointment join doctors on doctors.id=appointment.doctorId where apid = $id ");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $data = array(
        array($row['patient_Name'], $row['appointmentDate'], $row['docname'], $row['doctorSpecialization'],$row['userId'], $row['consultancyFees'] . '  EGP'),
        // Add more rows as needed
    );
}

$pdf = new PDF('P', 'mm', array(105, 148)); // A6 size (105 x 148 mm)
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output();


// class PDF extends FPDF
// {
//     // Page header
//     function Header()
//     {
//         // Logo
//         $this->Image('./photo/black echo.png', 10, 6, 30);
//         // Arial bold 15
//         $this->SetFont('Arial', 'B', 15);
//         // Move to the right
//         $this->Cell(80);
//         // Title
//         $this->Cell(30, 10, 'Echo Medical System', 0, 1, 'C');
//         // Line break
//         $this->Ln(20);
//     }

//     // Page footer
//     function Footer()
//     {
//         // Position at 1.5 cm from bottom
//         $this->SetY(-15);
//         // Arial italic 8
//         $this->SetFont('Arial', 'I', 8);
//         // Page number
//         $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
//     }

//     // Function to create table with labels and values side by side
//     function FancyTable($header, $data)
//     {
//         // Set position Y (move table down)
//         $this->SetY(60); // Adjust this value as needed

//         // Colors, line width and bold font for header
//         $this->SetFillColor(255, 0, 0);
//         $this->SetTextColor(255);
//         $this->SetDrawColor(128, 0, 0);
//         $this->SetLineWidth(.3);
//         $this->SetFont('', 'B');

//         // Width of the columns
//         $w = array(95, 95); // Widths of the columns: label and value

//         // Color and font restoration for data
//         $this->SetFillColor(224, 235, 255);
//         $this->SetTextColor(0);
//         $this->SetFont('');

//         // Data
//         $fill = false;
//         foreach ($data as $row) {
//             for ($i = 0; $i < count($header); $i++) {
//                 // Print header (label)
//                 $this->SetX(10); // Ensure each label starts from the left edge
//                 $this->Cell($w[0], 8, $header[$i], 1, 0, 'L', true);
//                 // Print corresponding value
//                 $this->Cell($w[1], 8, $row[$i], 1, 1, 'L', $fill);
//             }
//             $this->Ln();
//             $fill = !$fill;
//         }
//     }
// }

// // Column headings
// $header = array('Patient Name', 'Reservation Date', 'DR Name', 'Reservation Type', 'Patient ID', 'Payed');
// // Data loading
// $data = array(
//     array('Ahmed Mohamed', '2024-05-15', 'Dr. Ali', 'Cardiac', '12345', '100 EGP'),
//     // Add more rows as needed
// );

// $pdf = new PDF();
// // Column headings
// $pdf->SetFont('Arial', '', 14);
// $pdf->AddPage();
// $pdf->FancyTable($header, $data);
// $pdf->Output();

