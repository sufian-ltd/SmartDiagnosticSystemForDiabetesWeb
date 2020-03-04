<?php include "includes/header.php" ?>
<?php
session_start();
if (isset($_SESSION['status']) != "appointment") 
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
	include "database/DBTestReport.php";
	$msg = "";
    $dbTestReport = new DBTestReport();
?>
<?php
if(isset($_GET['action']) && isset($_GET['action'])=="showReport")
{
    $id=$_GET['id'];
    $column=$_GET['column'];
    $labTestRes=$dbLabTest->getTestReportByPrescriptionIdAndPatientId($prescriptionId,$patientId);
}
?>
<div class="card">
	<div class="card-body" style="background-color:#3073AD; color: #fff;">
		<h3>Lab Test Report Details</h3>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped">
		  <thead>
		    <tr>
		      <th scope="col">Patient ID</th>
		      <th scope="col">Prescription ID</th>
		      <th scope="col">Biochemistry</th>
		      <th scope="col">Immunology</th>
		      <th scope="col">Blood</th>
		      <th scope="col">Hormone</th>
			  <th scope="col">DigestiveSystem</th>
			  <th scope="col">StressAdrenalFatigue</th>
			  <th scope="col">Microbiology</th>
			  <th scope="col">MineralDeficiency</th>
			  <th scope="col">Eco</th>
			  <th scope="col">Ecg</th>
			  <th scope="col">Date</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($testReportRes as $values) { ?>
			    <tr>
			      <td><?php echo $values['patientId'] ?></td>
			      <td><?php echo $values['prescriptionId'] ?></td>
			      <?php if(!empty($values['biochemistry'])) {?>
			      <td>
                    <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=biochemistry'>View Report</a>"; ?>
                  </td>
                  <?} else {?>
              	  <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['immunology'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=immunology'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['blood'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=blood'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['hormone'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=hormone'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['digestiveSystem'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=digestiveSystem'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['stressAdrenalFatigue'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=stressAdrenalFatigue'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['microbiology'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=microbiology'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['mineralDeficiency'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=mineralDeficiency'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['eco'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=eco'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <?php if(!empty($values['ecg'])) {?>
                        <td>
                            <?php echo "<a class='btn btn-danger' href='test-report-data.php?action=showReport&id=" . $values['id'] . "&column=ecg'>View Report</a>"; ?>
                        </td>
                    <?} else {?>
                    <td><?php echo "No Report"; }?></td>
                    <td><?php echo $values['date'] ?></td>
			    </tr>
		    <?php } ?>
		  </tbody>
		</table>
	</div>
</div>
<?php include "includes/footer.php" ?>