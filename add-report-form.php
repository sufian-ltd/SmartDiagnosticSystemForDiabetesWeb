<?php
session_start();
if (isset($_SESSION['status']) != "appointment") {
    header('Location: appointment.php');
    exit();
}
?>
<?php
include "database/DBTestReport.php";
include "database/DBLabTest.php";
$dbLabTest = new DBLabTest();
$dbTestReport = new DBTestReport();
?>
<?php
if (isset($_GET['save'])) {
//    $biochemistry = $_FILES['biochemistry']['tmp_name'];
//    if(!empty($biochemistry))
//        $biochemistry = file_get_contents($biochemistry);
//    else
//        $biochemistry=null;
//
//    $immunology = $_FILES['immunology']['tmp_name'];
//    if(!empty($immunology))
//        $immunology = file_get_contents($immunology);
//    else
//        $immunology=null;
//
//    $blood = $_FILES['blood']['tmp_name'];
//    if(!empty($blood))
//        $blood = file_get_contents($blood);
//    else
//        $blood=null;
//
//    $hormone = $_FILES['hormone']['tmp_name'];
//    if(!empty($biochemistry))
//        $hormone = file_get_contents($hormone);
//    else
//        $hormone=null;
//
//    $digestiveSystem = $_FILES['digestiveSystem']['tmp_name'];
//    if(!empty($digestiveSystem))
//        $digestiveSystem = file_get_contents($digestiveSystem);
//    else
//        $digestiveSystem=null;
//
//    $stressAdrenalFatigue = $_FILES['stressAdrenalFatigue']['tmp_name'];
//    if(!empty($stressAdrenalFatigue))
//        $stressAdrenalFatigue = file_get_contents($stressAdrenalFatigue);
//    else
//        $stressAdrenalFatigue=null;
//
//    $microbiology = $_FILES['microbiology']['tmp_name'];
//    if(!empty($microbiology))
//        $microbiology = file_get_contents($microbiology);
//    else
//        $microbiology=null;
//
//    $mineralDeficiency = $_FILES['mineralDeficiency']['tmp_name'];
//    if(!empty($biochemistry))
//        $mineralDeficiency = file_get_contents($mineralDeficiency);
//    else
//        $mineralDeficiency=null;
//
//    $eco = $_FILES['eco']['tmp_name'];
//    if(!empty($eco))
//        $eco = file_get_contents($eco);
//    else
//        $eco=null;
//
//    $ecg = $_FILES['ecg']['tmp_name'];
//    if(!empty($ecg))
//        $ecg = file_get_contents($ecg);
//    else
//        $ecg=null;

    $patientId=$_GET['patientId'];
    $prescriptionId=$_GET['prescriptionId'];
//    $dbTestReport->save($patientId,$prescriptionId,$biochemistry,$immunology,$blood,$hormone,
//        $digestiveSystem,$stressAdrenalFatigue,$microbiology,$mineralDeficiency,$eco,$ecg,$date);
//    header('Location: add-report.php');
//    exit();
}
?>
<?php
if(isset($_GET['action']) && isset($_GET['action'])=="addReport")
{
    $prescriptionId=$_GET['prescriptionId'];
    $patientId=$_SESSION['patientId'];
    if($dbTestReport->isReportAdded($patientId,$prescriptionId) == "not exist"){
        $values=$dbLabTest->getReportByPrescriptionIdAndPatientId($prescriptionId,$patientId);
    }
    else{
        header('Location: add-report.php');
        exit();
    }
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
    <br/><br/>
    <form action="add-report-form.php" method="get" enctype="multipart/form-data" style="width: 500px;">
    <table class="table table-bordered table-striped" >
        <tr>
            <th>Test Name</th>
            <th>Action</th>
        </tr>
            <?php if($values['biochemistry']==1) {?>
                <tr>
                <td><?php echo "Biochemistry Lab Report"; ?></td>
                <td><input type="file" name="biochemistry"/></td>
                </tr>
            <?php } else{?>
                <td><input type="hidden" name="biochemistry"/></td>
            <?php }?>

                <?php if($values['immunology']==1) {?>
                <tr>
                    <td><?php echo "Immunology Lab Report"; ?></td>
                    <td><input type="file" name="immunology"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="immunology"/></td>
                <?php }?>

                <?php if($values['blood']==1) {?>
                <tr>
                    <td><?php echo "Blood Lab Report"; ?></td>
                    <td><input type="file" name="blood"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="blood"/></td>
                <?php }?>

                <?php if($values['hormone']==1) {?>
                <tr>
                    <td><?php echo "Hormone Lab Report"; ?></td>
                    <td><input type="file" name="hormone"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="hormone"/></td>
                <?php }?>

                <?php if($values['digestiveSystem']==1) {?>
                <tr>
                    <td><?php echo "Digestive System Lab Report"; ?></td>
                    <td><input type="file" name="digestiveSystem"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="digestiveSystem"/></td>
                <?php }?>

                <?php if($values['stressAdrenalFatigue']==1) {?>
                <tr>
                    <td><?php echo "Stress Adrenal Fatigue Lab Report"; ?></td>
                    <td><input type="file" name="stressAdrenalFatigue"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="stressAdrenalFatigue"/></td>
                <?php }?>

                <?php if($values['microbiology']==1) {?>
                <tr>
                    <td><?php echo "microbiology Lab Report"; ?></td>
                    <td><input type="file" name="microbiology"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="microbiology"/></td>
                <?php }?>

                <?php if($values['mineralDeficiency']==1) {?>
                <tr>
                    <td><?php echo "Mineral Deficiency Lab Report"; ?></td>
                    <td><input type="file" name="mineralDeficiency"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="mineralDeficiency"/></td>
                <?php }?>

                <?php if($values['eco']==1) {?>
                <tr>
                    <td><?php echo "Eco Lab Report"; ?></td>
                    <td><input type="file" name="eco"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="eco"/></td>
                <?php }?>


                <?php if($values['ecg']==1) {?>
                <tr>
                    <td><?php echo "Ecg Lab Report"; ?></td>
                    <td><input type="file" name="ecg"/></td>
                </tr>
                <?php } else{?>
                    <td><input readonly type="hidden" name="ecg"/></td>
                <?php }?>

            <input type="hidden" name="date" value="<?php echo $values['date']; ?>">
            <input type="hidden" name="prescriptionId" value="<?php echo $values['prescriptionId']; ?>">
            <input type="hidden" name="patientId" value="<?php echo $values['patientId']; ?>">
    </table>
        <button style="width: 200px;background-color: #114643;color: white" type="submit" class="btn" name="save"><i class='glyphicon glyphicon-save'></i> Save Lab Report</button>
    </form>
</div>
</body>
<?php include "includes/footer.php" ?>
