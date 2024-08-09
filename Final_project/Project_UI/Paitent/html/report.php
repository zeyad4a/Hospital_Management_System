<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
require('./pdf/fpdf.php');

class PDF extends FPDF
{
    // إنشاء رأس الصفحة
    function Header()
    {
        // إضافة الصورة (تأكد من تحديد المسار الصحيح للصورة)
        $this->Image('../photo/echol.png', 10, 6, 20);

        // ضبط الخط للنص
        $this->SetFont('Arial', 'B', 12);

        // حساب موضع النص "ECHO Medical Report" ليكون في المنتصف
        $pageWidth = $this->GetPageWidth();
        $echoText = 'ECHO Medical Report';
        $echoTextWidth = $this->GetStringWidth($echoText);
        $echoTextX = ($pageWidth - $echoTextWidth) / 2;

        // حساب موضع النص "Patient Report" ليكون في المنتصف
        $patientText = 'Patient Report';
        $patientTextWidth = $this->GetStringWidth($patientText);
        $patientTextX = ($pageWidth - $patientTextWidth) / 2;

        // ضبط موضع النصوص
        $this->SetXY($echoTextX, 10); // 10 هو الارتفاع من أعلى الصفحة
        // إضافة النص الأول
        $this->Cell($echoTextWidth, 10, $echoText, 0, 1, 'C');

        // ضبط موضع النص الثاني تحت النص الأول
        $this->SetXY($patientTextX, 20); // 20 هو الارتفاع من أعلى الصفحة بعد النص الأول
        // إضافة النص الثاني
        $this->Cell($patientTextWidth, 10, $patientText, 0, 1, 'C');

        // Line break
        $this->Ln(20);
    }

    // إنشاء تذييل الصفحة
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'page ' . $this->PageNo(), 0, 0, 'C');
    }

    // إنشاء جدول
    function CreateTable($header, $data)
    {
        // تحديد عرض الأعمدة
        $widths = array(26, 40, 39, 48, 38); // عرض كل عمود بالترتيب

        // عنوان الأعمدة
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $i => $col) {
            $this->Cell($widths[$i], 10, $col, 1, 0, 'C');
        }
        $this->Ln();

        // بيانات الجدول
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $i => $col) {
                $this->Cell($widths[$i], 10, $col, 1, 0, 'C');
            }
            $this->Ln();
        }
    }

    // إضافة التفاصيل بخط سميك
    function AddDetails($treatment, $report , $Scan)
    {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Treatment:', 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $treatment);
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Scan:', 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $Scan);
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Report:', 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $report);
    }
}

$header = array('ID', 'Patient Name', 'Reservation Date', 'Doctor', 'Reservation');

$id = $_GET['id'];
$uid = $_GET['uid'];
$sql = mysqli_query($connect, "SELECT doctors.doctorName as docname, appointment.* from appointment join doctors on doctors.id=appointment.doctorId where apid = $id ");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $data = array(
        array( $row['apid'] , $row['patient_Name'], $row['appointmentDate'], $row['docname'], $row['doctorSpecialization']),
    );
}

$sql2 = mysqli_query($connect, "SELECT * from tblmedicalhistory where UserID = '$uid' AND apid = '$id' ");
if (mysqli_num_rows($sql2) > 0) {
    $row2 = mysqli_fetch_assoc($sql2);
    $treatment = $row2['treatment'] ;
    $report = $row2['Report'] ;
    $Scan = $row2['Scan'] ;
}else{
    $treatment = 'The Treatment Has Not Been Written Yet';
    $report = 'The Report Has Not Been Written Yet';
    $Scan = 'The Scan Has Not Been Written Yet';
}
// إنشاء PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->CreateTable($header, $data);
$pdf->AddDetails($treatment, $report, $Scan);
$pdf->Output();
