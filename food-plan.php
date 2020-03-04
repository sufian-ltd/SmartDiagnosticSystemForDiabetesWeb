<?php
session_start();
if (isset($_SESSION['status']) != "appointment") 
{
    header('Location: appointment.php');
    exit();
}
?>
<?php
include "database/DBFoodPlan.php";
$msg = "";
$plan=0;
$dbFoodPlan = new DBFoodPlan();
$patientId=$_SESSION['patientId'];
?>
<?php
if($dbFoodPlan->haveFoodPlan($patientId)=="exist"){
    $planRes=$dbFoodPlan->getFoodPlanByPatientId($patientId);
    $plan=$planRes['plan'];
}
else{
    $plan=0;
}
?>
<?php
if(isset($_POST['save']) ) {
    $plan=$_POST['plan'];
    if($dbFoodPlan->haveFoodPlan($patientId)=="exist"){
        $plan=$dbFoodPlan->updatePlan($patientId,$plan);
    }
    else{
        $dbFoodPlan->addFoodPlan($patientId,$plan);
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
<body style="font-family: serif;">
<?php include "includes/admin-navbar.php";?>
<div class="container" align="center">
    <br><br>
    <form action="food-plan.php" method="post" style="width: 400px">
        <br/>
        <div class="form-group">
            <select class="form-control" required="true" name="plan" id="plan">
                <option value="none">Select Food Plan</option>
                <option value="1">Food Plan 1</option>
                <option value="2">Food Plan 2</option>
                <option value="3">Food Plan 3</option>
                <option value="4">Food Plan 4</option>
            </select>
        </div>
        <div class="form-group">
            <button style="width: 400px;background-color: #114643;color: white" type="submit" class="btn" name="save"><i class='glyphicon glyphicon-save'></i> Save Food Plan</button>
        </div>
    </form>
    <br>
    <?php
        if($plan==0){
            echo "<div align='center' style='background-color: #114643;color: #fff;width: 400px;' class='alert'>No Food Plan Assign To This Patient.....!!!!!!!!!!!!</div>";
        }
        else if ($plan==1){
            echo "<iframe src='pdf/Diabetic-patient-food-list.pdf' width='100%' 
                    style='height: 550px;'></iframe>";
        }
        else if ($plan==2){
            echo "<iframe src='pdf/Diabetic-patient-food-list2.pdf' width='100%' 
                    style='height:550px'></iframe>";
        }
        else if ($plan==3){
            echo "<iframe src='pdf/Diabetic-patient-food-list3.pdf' width='100%' 
                    style='height:550px'></iframe>";
        }
        else if ($plan==4){
            echo "<iframe src='pdf/Diabetic-patient-food-lis4.pdf' width='100%' 
                    style='height:550px'></iframe>";
        }
    ?>
</div>
<?php include "includes/footer.php" ?>
</body>
</html>
