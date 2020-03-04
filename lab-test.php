<?php
session_start();
if (isset($_SESSION['status']) != "appointment") 
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
	include "database/DBLabTest.php";
    include "database/DBTestReport.php";
	$msg = "";
    $dbLabTest = new DBLabTest();
?>
<?php
if(isset($_GET['action']) && isset($_GET['action'])=="detail")
{
    $prescriptionId=$_GET['prescriptionId'];
    $patientId=$_GET['patientId'];
    $values=$dbLabTest->getTestReportByPrescriptionIdAndPatientId($prescriptionId,$patientId);
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
		<table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Blood Suger Test</th>
                <th>Blood Glucose Test</th>
                <th>Oral glucose-tolerance Test</th>
                <th>Two-hour postprandial Test</th>
                <th>Hemoglobin A1C Test</th>
                <th>Fasting plasma glucose Test</th>
                <th>Random plasma glucose Test</th>
                <th>Insulin autoantibodies</th>
                <th>Glutamic acid decarboxylase autoantibodies</th>
                <th>Insulinoma-associated 2 autoantibodies</th>
                <th>Zinc transport</th>
                <th>Islet cell cytoplasmic autoantibodies</th>
            </tr>
            <tr>
<!--    bloodSuger bloodGlucose oralGlucoseTolerance twoHourPostprandial hemoglobinA1C fastingPlasmaGlucose-->
<!--    // randomPlasmaGlucose insulinAutoantibodies glutamicAcidDecarboxylaseAutoantibodies-->
<!--    // insulinomaAssociatedAutoantibodies zincTransport isletCellCytoplasmicAutoantibodies-->
                <?php if($values['bloodSuger']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=bloodSuger'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['bloodGlucose']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=bloodGlucose'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['oralGlucoseTolerance']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=oralGlucoseTolerance'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['twoHourPostprandial']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=twoHourPostprandial'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['hemoglobinA1C']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=hemoglobinA1C'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>


                <?php if($values['fastingPlasmaGlucose']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=fastingPlasmaGlucose'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['randomPlasmaGlucose']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=randomPlasmaGlucose'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['insulinAutoantibodies']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=insulinAutoantibodies'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['glutamicAcidDecarboxylaseAutoantibodies']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=glutamicAcidDecarboxylaseAutoantibodies'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['insulinomaAssociatedAutoantibodies']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=insulinomaAssociatedAutoantibodies'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['zincTransport']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=zincTransport'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>

                <?php if($values['isletCellCytoplasmicAutoantibodies']==1) {?>
                    <td>
                        <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=isletCellCytoplasmicAutoantibodies'>View Report</a>"; ?>
                    </td>
                <?php }else {?>
                    <td>No Report</td>
                <?php }?>


            </tr>
            <tr>
		      <th>Biochemistry</th>
		      <th>Immunology</th>
		      <th>Blood</th>
		      <th>Hormone</th>
			  <th>Digestive System</th>
			  <th>Stress Adrenal Fatigue</th>
			  <th>Microbiology</th>
			  <th>Mineral Deficiency</th>
			  <th>Eco</th>
			  <th>Ecg</th>
		    </tr>

<!--            --><?php //foreach ($labTestRes as $values) { ?>
                <tr>
                    <?php if($values['biochemistry']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=biochemistry'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['immunology']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=immunology'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['blood']==1) {?>
                        <td style="width: 89px;">
                            <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=blood'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['hormone']==1) {?>
                        <td style="width: 89px;">
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=hormone'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['digestiveSystem']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643'  href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=digestiveSystem'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['stressAdrenalFatigue']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=stressAdrenalFatigue'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['microbiology']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=microbiology'>View Report</a>"; ?>
                        </td>
                    <?php } else {?>
                    <td><?php echo "No Report"; }?></td>

                    <?php if($values['mineralDeficiency']==1) {?>
                        <td>
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=mineralDeficiency'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['eco']==1) {?>
                        <td style="width: 89px;">
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=eco'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>

                    <?php if($values['ecg']==1) {?>
                        <td style="width: 89px;">
                            <?php echo "<a style='color:#114643' href='lab-test.php?action=viewReport&patientId=" . $values['patientId'] . "&prescriptionId=" . $values['prescriptionId'] . "&column=ecg'>View Report</a>"; ?>
                        </td>
                    <?php }else {?>
                        <td>No Report</td>
                    <?php }?>
                </tr>
		</table>
        <?php
            if($_GET['action'] == 'viewReport') {
                $dbTestReport = new DBTestReport();
                $patientId=$_GET['patientId'];
                $prescriptionId=$_GET['prescriptionId'];
                $column=$_GET['column'];
                $testReportRes=$dbTestReport->getTestReportByPrescriptionIdAndPatientId($prescriptionId,
                    $patientId);
                echo '<img style="width:100%;height:650px;" src="data:image/jpg;base64,' . base64_encode($testReportRes[$column]) . '">';
            }
        ?>
    </div>
</body>
<br><br>
<?php include "includes/footer.php" ?>