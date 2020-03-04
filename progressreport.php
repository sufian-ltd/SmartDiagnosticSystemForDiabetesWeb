<?php
session_start();
if (isset($_SESSION['status']) != "appointment")
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
	include "database/DBProgressReport.php";
	$msg = "";
	$dbProgressReport = new DBProgressReport();
    $patientId=$_SESSION['patientId'];
    $result=$dbProgressReport->getProgressReport($patientId);
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
		      <th>Date</th>
		      <th>Weight</th>
		      <th>Blood No</th>
		      <th>Suger</th>
		      <th>Albumin</th>
		      <th>Acitone</th>
		      <th>HBA1C</th>
		      <th>Blood pressure</th>
		      <th>Glucos in Blood</th>
		      <th>Blood Presure</th>
		      <th>Glucos in Blood</th>
		    </tr>
		  	<?php foreach ($result as $values) { ?>
			    <tr>
			      <td><?php echo $values['date'] ?></td>
			      <td><?php echo $values['weight'] ?></td>
			      <td><?php echo $values['blood'] ?></td>
			      <td><?php echo $values['suger'] ?></td>
			      <td><?php echo $values['albumin'] ?></td>
			      <td><?php echo $values['acitone'] ?></td>
			      <td><?php echo $values['hbA1c'] ?></td>
			      <td><?php echo $values['bp1'] ?></td>
			      <td><?php echo $values['gb1'] ?></td>
			      <td><?php echo $values['bp2'] ?></td>
			      <td><?php echo $values['gb2'] ?></td>
			    </tr>
		    <?php } ?>
		</table>
</div>
</body>
<?php include "includes/footer.php" ?>