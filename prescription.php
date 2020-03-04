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
	include "database/DBLabTest.php";
	include "database/DBTestReport.php";
	include "database/DBPatient.php";
	include "database/DBAppointment.php";
    $msg = "";
    $dbPrescription = new DBPrescription();
    $dbPrescriptionData = new DBPrescriptionData();
    $dbLabTest = new DBLabTest();
    $dbTestReport = new DBTestReport();
    $dbAppointment=new DBAppointment();
    $dbPatient=new DBPatient();
    $patientId=$_SESSION['patientId'];   
    $appointmentId=$_SESSION['id'];
    $patientRes=$dbPatient->getPatientById($patientId);
    $appointmentRes=$dbAppointment->getAppointmentById($appointmentId);
?>
<?php
	if(isset($_GET['submit']))
	{
		$medicine1=$_GET['medicine1'];
		$medicine2=$_GET['medicine2'];
		$medicine3=$_GET['medicine3'];
		$medicine4=$_GET['medicine4'];
		$medicine5=$_GET['medicine5'];
		$medicine6=$_GET['medicine6'];
		$medicine7=$_GET['medicine7'];
		$medicine8=$_GET['medicine8'];

		$time1=$_GET['time1'];
		$time2=$_GET['time2'];
		$time3=$_GET['time3'];
		$time4=$_GET['time4'];
		$time5=$_GET['time5'];
		$time6=$_GET['time6'];
		$time7=$_GET['time7'];
		$time8=$_GET['time8'];

		$day1=$_GET['day1'];
		$day2=$_GET['day2'];
		$day3=$_GET['day3'];
		$day4=$_GET['day4'];
		$day5=$_GET['day5'];
		$day6=$_GET['day6'];
		$day7=$_GET['day7'];
		$day8=$_GET['day8'];

		$eatTime1=$_GET['eatTime1'];
		$eatTime2=$_GET['eatTime2'];
		$eatTime3=$_GET['eatTime3'];
		$eatTime4=$_GET['eatTime4'];
		$eatTime5=$_GET['eatTime5'];
		$eatTime6=$_GET['eatTime6'];
		$eatTime7=$_GET['eatTime7'];
		$eatTime8=$_GET['eatTime8'];

		$biochemistry=0;
		$immunology=0;
		$blood=0;
		$hormone=0;
		$digestiveSystem=0;
		$stressAdrenalFatigue=0;
		$microbiology=0;
		$mineralDeficiency=0;
		$eco=0;
		$ecg=0;

		$biochemistry=$_GET['biochemistry'];
		$immunology=$_GET['immunology'];
		$blood=$_GET['blood'];
		$hormone=$_GET['hormone'];
		$digestiveSystem=$_GET['digestiveSystem'];
		$stressAdrenalFatigue=$_GET['stressAdrenalFatigue'];
		$microbiology=$_GET['microbiology'];
		$mineralDeficiency=$_GET['mineralDeficiency'];
		$eco=$_GET['eco'];
		$ecg=$_GET['ecg'];

        $bloodSuger=$_GET['bloodSuger'];
        $bloodGlucose=$_GET['bloodGlucose'];
        $oralGlucoseTolerance=$_GET['oralGlucoseTolerance'];
        $twoHourPostprandial=$_GET['twoHourPostprandial'];
        $hemoglobinA1C=$_GET['hemoglobinA1C'];
        $fastingPlasmaGlucose=$_GET['fastingPlasmaGlucose'];
        $randomPlasmaGlucose=$_GET['randomPlasmaGlucose'];
        $insulinAutoantibodies=$_GET['insulinAutoantibodies'];
        $glutamicAcidDecarboxylaseAutoantibodies=$_GET['glutamicAcidDecarboxylaseAutoantibodies'];
        $insulinomaAssociatedAutoantibodies=$_GET['insulinomaAssociatedAutoantibodies'];
        $zincTransport=$_GET['zincTransport'];
        $isletCellCytoplasmicAutoantibodies=$_GET['isletCellCytoplasmicAutoantibodies'];

		$problem=$_GET['problem'];
		$date=$appointmentRes['date'];
		$nextDate=$_GET['nextDate'];
		$advise=$_GET['advise'];

		$dbPrescription->save($problem,$_SESSION['patientId'],$date,$nextDate,$advise);
		$prescription=$dbPrescription->getLastPrescription();

		if(!empty($medicine1) && !empty($time1) && !empty($day1) && !empty($eatTime1))
			$dbPrescriptionData->save($prescription['id'],$medicine1,$time1,$day1,$eatTime1);
		if(!empty($medicine2) && !empty($time2) && !empty($day2) && !empty($eatTime2))
			$dbPrescriptionData->save($prescription['id'],$medicine2,$time2,$day2,$eatTime2);
		if(!empty($medicine3) && !empty($time3) && !empty($day3) && !empty($eatTime3))
			$dbPrescriptionData->save($prescription['id'],$medicine3,$time3,$day3,$eatTime3);
		if(!empty($medicine4) && !empty($time4) && !empty($day4) && !empty($eatTime4))
			$dbPrescriptionData->save($prescription['id'],$medicine4,$time4,$day4,$eatTime4);
		if(!empty($medicine5) && !empty($time5) && !empty($day5) && !empty($eatTime5))
			$dbPrescriptionData->save($prescription['id'],$medicine5,$time5,$day5,$eatTime5);
		if(!empty($medicine6) && !empty($time6) && !empty($day6) && !empty($eatTime6))
			$dbPrescriptionData->save($prescription['id'],$medicine6,$time6,$day6,$eatTime6);
		if(!empty($medicine7) && !empty($time7) && !empty($day7) && !empty($eatTime7))
			$dbPrescriptionData->save($prescription['id'],$medicine7,$time7,$day7,$eatTime7);
		if(!empty($medicine8) && !empty($time8) && !empty($day8) && !empty($eatTime8))
			$dbPrescriptionData->save($prescription['id'],$medicine8,$time8,$day8,$eatTime8);

        // bloodSuger bloodGlucose oralGlucoseTolerance twoHourPostprandial hemoglobinA1C fastingPlasmaGlucose
        // randomPlasmaGlucose insulinAutoantibodies glutamicAcidDecarboxylaseAutoantibodies
        // insulinomaAssociatedAutoantibodies zincTransport isletCellCytoplasmicAutoantibodies

		$dbLabTest->save($patientId,$prescription['id'],$biochemistry,$immunology,$blood,$hormone,
		$digestiveSystem,$stressAdrenalFatigue,$microbiology,$mineralDeficiency,$eco,$ecg,$bloodSuger,
        $bloodGlucose,$oralGlucoseTolerance,$twoHourPostprandial,$hemoglobinA1C,$fastingPlasmaGlucose,
        $randomPlasmaGlucose,$insulinAutoantibodies,$glutamicAcidDecarboxylaseAutoantibodies,
        $insulinomaAssociatedAutoantibodies,$zincTransport,$isletCellCytoplasmicAutoantibodies,$date);

        header('Location: appointment.php');
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
    <div class="container-fluid" align="center">
        <br><br>
		<form action="" method="get">
		 <div class="form-row">
		    <div class="form-group col-md-6">
		      <input style="background: #1e6f6a;color: #fff;" readonly name="name" type="text" class="form-control" value="Patient Name : <?php echo $patientRes['name']?>">
		    </div>
		    <div class="form-group col-md-6">
		      <input style="background: #1e6f6a;color: #fff;" readonly name="gender" type="text" class="form-control" id="inputPassword4" placeholder="Gender" value="Gender : <?php echo $patientRes['gender']?>">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <input style="background: #1e6f6a;color: #fff;" readonly name="age" type="text" class="form-control" id="inputEmail4" placeholder="Age" value="Age : <?php echo $patientRes['age']?>">
		    </div>
		    <div class="form-group col-md-6">
		      <input style="background: #1e6f6a;color: #fff;" readonly type="text" class="form-control" id="inputDate" value="Date : <?php echo $appointmentRes['date']?>">
		    </div>
		  </div>
		  <div class="form-group col-md-12">
		    <textarea style="min-height: 60px;max-height: 60px;min-width: 100%;max-width: 100%;" name="problem" required placeholder="Diagnosis" class="form-control" id="exampleFormControlTextarea1"></textarea>
		  </div>
		  <div class="">
		    <div class="form-group col-md-12" style="border-style: double;margin-left: 15px;background: #1e6f6a;color: #fff">
                <input type="hidden" name="bloodSuger" value="0">
                <input type="hidden" name="bloodGlucose" value="0">
                <input type="hidden" name="oralGlucoseTolerance" value="0">
                <input type="hidden" name="twoHourPostprandial" value="0">
                <input type="hidden" name="hemoglobinA1C" value="0">
                <input type="hidden" name="fastingPlasmaGlucose" value="0">
                <input type="hidden" name="randomPlasmaGlucose" value="0">
                <input type="hidden" name="insulinAutoantibodies" value="0">
                <input type="hidden" name="glutamicAcidDecarboxylaseAutoantibodies" value="0">
                <input type="hidden" name="insulinomaAssociatedAutoantibodies" value="0">
                <input type="hidden" name="zincTransport" value="0">
                <input type="hidden" name="isletCellCytoplasmicAutoantibodies" value="0">

		    	<input type="hidden" name="biochemistry" value="0">
				<input type="hidden" name="immunology" value="0">
				<input type="hidden" name="blood" value="0">
				<input type="hidden" name="hormone" value="0">
				<input type="hidden" name="digestiveSystem" value="0">
				<input type="hidden" name="stressAdrenalFatigue" value="0">
				<input type="hidden" name="microbiology" value="0">
				<input type="hidden" name="mineralDeficiency" value="0">
				<input type="hidden" name="eco" value="0">
				<input type="hidden" name="ecg" value="0">

                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="bloodSuger" value="1">Blood Suger Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="bloodGlucose" value="1">Blood Glucose Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="oralGlucoseTolerance" value="1">Oral glucose-tolerance Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="twoHourPostprandial" value="1">Two-hour postprandial Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="hemoglobinA1C" value="1">Hemoglobin A1C Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="fastingPlasmaGlucose" value="1">Fasting plasma glucose Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="randomPlasmaGlucose" value="1">Random plasma glucose Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="insulinAutoantibodies" value="1">Insulin Autoantibodies</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="glutamicAcidDecarboxylaseAutoantibodies" value="1">Glutamic acid decarboxylase autoantibodies</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="insulinomaAssociatedAutoantibodies" value="1">Insulinoma-associated 2 autoantibodies</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="zincTransport" value="1">Zinc transport</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="isletCellCytoplasmicAutoantibodies" value="1">Islet cell cytoplasmic autoantibodies</label>

		  		<label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="biochemistry" value="1">Biochemistry Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="immunology" value="1">Immunology Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="blood" value="1">Erythrocyte sedimentation rate (ESR) Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="hormone" value="1">Hormone Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="digestiveSystem" value="1">Digestive System Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="stressAdrenalFatigue" value="1">StressAdrenal Fatigue Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="microbiology" value="1">Microbiology Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="mineralDeficiency" value="1">Mineral Deficiency Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="eco" value="1">Eco Test</label>
                <label style="margin: 10px;"><input style="margin-right: 5px;" type="checkbox" name="ecg" value="1">Ecg Test</label>
		    </div>
		  </div>
            <div class="container">
		  <div class="form-group col-md-3">
		      <input name="medicine1" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
		  </div>
		  <div class="form-group col-md-2">
		    <div class="form-check">
		      <select name="time1" id="inputState" class="form-control">
		        <option value="1+0+0">1+0+0</option>
		        <option value="0+1+0">0+1+0</option>
		        <option value="0+0+1">0+0+1</option>
		        <option value="1+1+0">1+1+0</option>
		        <option value="1+0+1">1+0+1</option>
		        <option value="0+1+1">0+1+1</option>
		        <option value="1+1+1">1+1+1</option>
		      </select>
		    </div>
		  </div>
            <div class="form-group col-md-1">
		      <input name="day1" type="text" class="form-control" id="inputDays" placeholder="Days">
		    </div>
		  	<div class="form-group col-md-2">
		    <div class="form-check">
		      <label class="form-check-label" for="gridCheck">
                  <input class="form-check-input" type="radio" name="eatTime1" value="Empty stomach" id="gridCheck">
                  Empty stomach
		      </label>
		    </div>
		    </div>
		  <div class="form-group col-md-2">
		    <div class="form-check">
		      <label class="form-check-label" for="gridCheck">
                  <input checked="true" class="form-check-input" type="radio" name="eatTime1" value="Half stomach" id="gridCheck">
                  Half stomach
		      </label>
		    </div>
		  </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <label class="form-check-label" for="gridCheck">
                        <input checked="true" class="form-check-input" type="radio" name="eatTime1" value="Full Stomach" id="gridCheck">
                        Full Stomach
                    </label>
                </div>
            </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine2" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time2" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day2" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime2" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime2" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime2" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine3" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time3" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day3" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime3" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime3" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime3" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine4" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time4" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day4" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime4" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime4" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime4" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine5" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time5" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day5" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime5" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime5" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime5" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine6" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time6" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day6" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime6" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime6" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime6" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine7" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time7" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day7" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime7" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime7" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime7" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="form-group col-md-3">
                <input name="medicine8" list="medicines" class="form-control" id="inputMedicine" placeholder="Medicine">
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <select name="time8" id="inputState" class="form-control">
                        <option value="1+0+0">1+0+0</option>
                        <option value="0+1+0">0+1+0</option>
                        <option value="0+0+1">0+0+1</option>
                        <option value="1+1+0">1+1+0</option>
                        <option value="1+0+1">1+0+1</option>
                        <option value="0+1+1">0+1+1</option>
                        <option value="1+1+1">1+1+1</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-1">
                <input name="day8" type="text" class="form-control" id="inputDays" placeholder="Days">
            </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input class="form-check-input" type="radio" name="eatTime8" value="Empty stomach" id="gridCheck">
                            Empty stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime8" value="Half stomach" id="gridCheck">
                            Half stomach
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="form-check">
                        <label class="form-check-label" for="gridCheck">
                            <input checked="true" class="form-check-input" type="radio" name="eatTime8" value="Full Stomach" id="gridCheck">
                            Full Stomach
                        </label>
                    </div>
                </div>
            </div>
		  <div class="form-group col-md-12" style="margin-left: 15px;margin-right: 15px;">
		    <textarea style="min-height: 60px;max-height: 60px;min-width: 100%;max-width: 100%;" name="advise" class="form-control" id="exampleFormControlTextarea1" placeholder="Doctor Advise"></textarea>
		  </div>
            <div class="form-group col-md-2" style="margin-left: 11px;">
                <label style="margin-top: 5px;" type="submit" name="submit">Select Next Date To Meet</label>
            </div>
          <div class="form-group col-md-2">
              <input name="nextDate" type="date" class="form-control" id="inputDate">
          </div>
            <div class="form-group col-md-2">
                <button type="submit" style='background-color:#114643;color:#fff' class="btn" name="submit"><i class='glyphicon glyphicon-book'></i> Generate Prescription</button>
            </div>
            <datalist id="medicines">
                <option value="Tab :Tolbutamide 500mg">
                <option value="Tab :Glimepiride 2mg">
                <option value="Tab :Glipizide 5mg">
                <option value="Tab :Glyburide 500mg">
                <option value="Tab :micronized 250mg">
                <option value="Tab :Repaglinide 2mg">
                <option value="Tab :Nateglinide 120mg">
                <option value="Tab :Metformin 500mg">
                <option value="Tab :Acarbose 25mg">
                <option value="Tab :Pioglitazone 10mg">
                <option value="Tab :Rosiglitazone 4mg">
                <option value="Tab :Exenatide 5mcg">
                <option value="Tab :Liraglutide 0.6mg">
                <option value="Tab :Albiglutide  30mg">
                <option value="Tab :Dulaglutide 0.75mg">
                <option value="Tab :Alogliptin 25mg">
                <option value="Tab :Sitagliptin 100mg">
                <option value="Tab :Saxagliptin 2.5mg">
                <option value="Tab :Linagliptin 6mg">
                <option value="Tab :Canagliflozin 100mg">
                <option value="Tab :Dapagliflozin 5mg">
                <option value="Tab :Empagliflozin 10mg">
                <option value="Tab :Alogliptin 12.5mg">
                <option value="Tab :Alogliptin 12.5mg">
                <option value="Tab :Empagliflozi 10mg">
                <option value="Tab :Empagliflozin 5mg">
                <option value="Tab :Canagliflozin 50mg">
                <option value="Tab :Dapagliflozin 500mg">
                <option value="Tab :Glyburide 1.25 mg">
                <option value="Tab :Glipizide 250mg">
                <option value="Tab :Linagliptin 500mg">">
            </datalist>
		</form>
	</div>
</body>
<br><br>
<?php include "includes/footer.php" ?>