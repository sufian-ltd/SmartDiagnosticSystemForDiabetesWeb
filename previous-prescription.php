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
    include "database/DBPrescriptionData.php";
	$msg = "";
    $dbPrescription = new DBPrescription();
    $dbPrescriptionData = new DBPrescriptionData();
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
<div class="container-fluid" align="center" style="min-height: 450px;">
    <br><br>
		<table class="table table-bordered">
		    <tr>
<!--		      <th>ID</th>-->
              <th>Date</th>
		      <th>Diagnosis</th>
		      <th>Advise</th>
		      <th>Next Date To Meet</th>
		      <th>Medicine and Rules</th>
		      <th>Action</th>
		    </tr>
		  	<?php foreach ($prescriptionRes as $values) { ?>
			    <tr align="center">
<!--			      <td>--><?php //echo $values['id'] ?><!--</td>-->
                  <td><?php echo $values['date'] ?></td>
			      <td><?php echo $values['problem'] ?></td>
			      <td><?php echo $values['advise'] ?></td>
			      <td><?php echo $values['nextDate'] ?></td>
                  <?php
                    $prescriptionDataRes=$dbPrescriptionData->getPrescriptionDataByPrescriptionId($values['id']);
                  ?>
                  <td style="width:48%;">
                    <?php $i=0; ?>
                    <?php foreach ($prescriptionDataRes as $val) { ?>
                        <?php ++$i;?>
                        <div style="text-align: left">
                            <label style="margin-right: 0px;width: 35%;"><?php echo $i.": ".$val['medicine'] ?></label>
                            <label style="margin-right: 0px;width: 20%;"> <?php echo $val['time1'] ?></label>
                            <label style="margin-right: 0px;width: 20%;"> <?php echo $val['eatTime'] ?></label>
                            <label style="margin-right: 0px;width: 15%;"> <?php echo $val['day1'] ?> Days</label>
                        </div>
                    <?php } ?>
                  </td>
<!--			      <td>-->
<!--                    --><?php //echo "<a class='btn' style='background-color:#114643;color:#fff' href='prescription-data.php?action=detail&prescriptionId=" . $values['id'] . "'>
//                <i class='glyphicon glyphicon-yen'></i> Check Details</a>"; ?>
<!--                  </td>-->
                  <td>
                    <?php echo "<a class='btn' style='background-color:#114643;color:#fff' href='lab-test.php?action=detail&prescriptionId=" . $values['id'] . "&patientId=" . $patientId . "'>
                    <i class='glyphicon glyphicon-gift'></i> Check Test Report</a>"; ?>
                  </td>
			    </tr>
		    <?php } ?>
		</table>
</div>
</body>
<?php include "includes/footer.php" ?>