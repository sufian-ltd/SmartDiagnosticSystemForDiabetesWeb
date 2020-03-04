<?php include "includes/header.php" ?>
<?php
	include "database/DBProgressReport.php";
	$msg = "";
	$dbProgressReport = new DBProgressReport();
	$result=$dbProgressReport->getProgressReport();
?>
<div class="card">
	<div class="card-body" style="background-color:#3073AD; color: #fff;">
		<h3>Progress Report</h3>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">Date</th>
		      <th scope="col">Weight</th>
		      <th scope="col">Blood No</th>
		      <th scope="col">Suger</th>
		      <th scope="col">Albumin</th>
		      <th scope="col">Acitone</th>
		      <th scope="col">HBA1C</th>
		      <th scope="col">Blood pressure</th>
		      <th scope="col">Glucos in Blood</th>
		      <th scope="col">Blood Presure</th>
		      <th scope="col">Glucos in Blood</th>
		    </tr>
		  </thead>
		  <tbody>
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
		  </tbody>
		</table>
	</div>
</div>
<?php include "includes/footer.php" ?>