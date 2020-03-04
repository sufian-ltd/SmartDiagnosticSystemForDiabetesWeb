<?php	
	session_start();
    if (isset($_SESSION['USER']) != "admin") {
        header('Location: index.php');
        exit();
    }
?>
<?php
	include "database/DBAppointment.php";
	$msg = "";
	$dbAppointment = new DBAppointment();
?>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'accept') {
    $id = $_GET['id'];
    $patientId=$_GET['patientId'];
    if($dbAppointment->accept($id,"accept")){
    	$_SESSION["status"]="appointment";
    	$_SESSION["id"]=$id;
    	$_SESSION["patientId"]=$patientId;
    	header('Location: prescription-copy.php');
        exit;
    }
}
?>
<?php
	$result=$dbAppointment->getAllApointment();
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
<div class="container" align="center">
        <br><br>
		<table class="table table-bordered table-striped table-hover">
		    <tr>
		      <th>Serial No</th>
		      <th>Patient Id</th>
		      <th>Patient Name</th>
              <th>Doctor Id</th>
		      <th>Doctor name</th>
		      <th>Date</th>
		      <th>Action</th>
		    </tr>
		  	<?php foreach ($result as $values) { ?>
			    <tr>
			      <td><?php echo $values['id'] ?></td>
			      <td><?php echo $values['patientId'] ?></td>
                    <td><?php echo $values['patientName'] ?></td>
			      <td><?php echo $values['doctorId'] ?></td>
			      <td><?php echo $values['doctorName'] ?></td>
			      <td><?php echo $values['date'] ?></td>
			      <td>
                    <?php echo "<a class='btn' style='background-color:#114643;color:#fff' href='appointment.php?action=accept&id=" . $values['id'] . "&patientId=" . $values['patientId'] . "'>
                <i class='glyphicon glyphicon-bell'></i> Make Prescription</a>"; ?>
                  </td>
			    </tr>
		    <?php } ?>
		</table>
</div>
</body>
<br><br>
<?php include "includes/footer.php" ?>