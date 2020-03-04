<?php
session_start();
if (isset($_SESSION['status']) != "appointment") 
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
	include "database/DBPrescriptionData.php";
	$msg = "";
    $dbPrescriptionData = new DBPrescriptionData();
?>
<?php
	if(isset($_GET['action']) && isset($_GET['action'])=="detail")
	{
		$prescriptionId=$_GET['prescriptionId'];
		$prescriptionDataRes=$dbPrescriptionData->getPrescriptionDataByPrescriptionId($prescriptionId);
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
		<table class="table table-bordered table-hover table-striped">
		    <tr>
		      <th>ID</th>
		      <th>Medicine</th>
		      <th>Eating Time</th>
		      <th>Number of Days</th>
		      <th>Eating Rule</th>
		    </tr>
		  	<?php foreach ($prescriptionDataRes as $values) { ?>
			    <tr align="center">
			      <td><?php echo $values['id'] ?></td>
			      <td><?php echo $values['medicine'] ?></td>
			      <td><?php echo $values['time1'] ?></td>
			      <td><?php echo $values['day1'] ?></td>
			      <td><?php echo $values['eatTime'] ?></td>
			    </tr>
		    <?php } ?>
		</table>
    </div>
</body>
<?php include "includes/footer.php" ?>