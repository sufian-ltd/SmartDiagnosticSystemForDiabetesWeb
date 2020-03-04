<?php
session_start();
if (isset($_SESSION['status']) != "appointment") 
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
	include "database/DBPrescription.php";
	$msg = "";
    $dbPrescription = new DBPrescription();
    $patientId=$_SESSION['patientId'];   
    $prescriptionRes=$dbPrescription->getPrescriptionByPatientId($patientId);
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
		<table class="table table-bordered table-hover table-striped">
		    <tr>
		      <th>ID</th>
		      <th>Problem</th>
		      <th>Advise</th>
		      <th>Next Date To Meet</th>
		      <th>Date</th>
		      <th>Action</th>
		    </tr>
		  	<?php foreach ($prescriptionRes as $values) { ?>
			    <tr align="center">
			      <td><?php echo $values['id'] ?></td>
			      <td><?php echo $values['problem'] ?></td>
			      <td><?php echo $values['advise'] ?></td>
			      <td><?php echo $values['nextDate'] ?></td>
			      <td><?php echo $values['date'] ?></td>
			      <td>
                    <?php echo "<a class='btn' style='background-color:#114643;color:#fff' href='add-report-form.php?action=addReport&prescriptionId=" . $values['id'] . "'>
                    <i class='glyphicon glyphicon-adjust'></i> Add Report</a>"; ?>
                  </td>
			    </tr>
		    <?php } ?>
		</table>
</div>
</body>
<?php include "includes/footer.php" ?>