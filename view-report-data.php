<?php
session_start();
if (isset($_SESSION['status']) != "appointment")
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
if(isset($_GET['action']) && isset($_GET['action'])=="viewReport")
{
    include "database/DBTestReport.php";
    $dbTestReport = new DBTestReport();
    $patientId=$_GET['patientId'];
    $prescriptionId=$_GET['prescriptionId'];
    $column=$_GET['column'];
    $testReportRes=$dbTestReport->getTestReportByPrescriptionIdAndPatientId($prescriptionId,$patientId);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif;color: black">
<?php include "includes/admin-navbar.php";?>
<div class="container" align="center" style="min-height: 450px;">
    <br><br>
    <?php echo '<img style="width:100%;height:100%" src="data:image/jpg;base64,' . base64_encode($testReportRes[$column]) . '">' ?>
    <br><br>
</div>
</body>
<?php include "includes/footer.php" ?>