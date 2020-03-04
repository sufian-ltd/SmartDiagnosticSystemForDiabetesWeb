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

    $dbLabTest->save($patientId,$prescription['id'],$biochemistry,$immunology,$blood,$hormone,
        $digestiveSystem,$stressAdrenalFatigue,$microbiology,$mineralDeficiency,$eco,$ecg,$bloodSuger,
        $bloodGlucose,$oralGlucoseTolerance,$twoHourPostprandial,$hemoglobinA1C,$fastingPlasmaGlucose,
        $randomPlasmaGlucose,$insulinAutoantibodies,$glutamicAcidDecarboxylaseAutoantibodies,
        $insulinomaAssociatedAutoantibodies,$zincTransport,$isletCellCytoplasmicAutoantibodies,$date);
    $patientId=$_SESSION['patientId'];
    $appointmentId=$_SESSION['id'];
    showPdf($patientId,$appointmentId,$prescription['id']);
}
?>
<?php
function showPdf($patientId,$appointmentId,$prescriptionId)
{
    require_once('tcpdf/tcpdf.php');

    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Prescription");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 11);
    $obj_pdf->AddPage();
    $content = '';
    $content .= fetch_data($patientId,$appointmentId,$prescriptionId);
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('file.pdf', 'I');
}
?>
<?php
function fetch_data($patientId,$appointmentId,$prescriptionId)
{
    $dbPrescription = new DBPrescription();
    $dbPrescriptionData = new DBPrescriptionData();
    $dbLabTest = new DBLabTest();
    $dbTestReport = new DBTestReport();
    $dbAppointment=new DBAppointment();
    $dbPatient=new DBPatient();
    $patientRes=$dbPatient->getPatientById($patientId);
    $appointmentRes=$dbAppointment->getAppointmentById($appointmentId);
    $prescriptionRes=$dbPrescription->getPrescriptionById($prescriptionId);
    $prescriptionDataRes=$dbPrescriptionData->getPrescriptionDataByPrescriptionId($prescriptionId);
    $labTestRes=$dbLabTest->getTestReportByPrescriptionIdAndPatientId($prescriptionId,$patientId);

    $output = '';
    $output .= '
        <div>
            <label>Dr. Abu Sufian</label><br>
            <label>MBBS,MD,FCPS</label><br>
            <label>Call: 01876639192, 019451231</label><br>
            <label>Professor,Cardiology,Chittagong Medical College</label>
            <br><br><br>
            
            <label>Patient Name : '.$patientRes["name"].' </label>
            <label> Gender : '.$patientRes["gender"].'</label><br>
            <label>Blood Pressure : '.$patientRes["age"].' </label>
            <label> Age : '.$patientRes["bp"].' </label>
            <label> Weight : '.$patientRes["weight"].' KG</label><br>
            <label>Date : '.$appointmentRes["date"].'</label><br>
            <br><br><br>
            
            <label style="color: #e60009">Diagnosis</label><br>
            <label>'.$prescriptionRes["problem"].'</label>
            <br><br><br>
            
            ';
            foreach ($prescriptionDataRes as $values) {
            $output .= '
            <table>
                <tr>
                    <td>'.$values["medicine"].'</td>
                    <td align="center">'.$values["time1"].'</td>
                    <td>'.$values["eatTime"].'</td>
                    <td>'.$values["day1"].'</td>
                </tr>
            </table>
            <br>';
            }
            $test='<br><br><br>'.'<label style="color: #e60009;">The List of Lab Test Provided By Doctor</label><br>';

            if($labTestRes['biochemistry']==1)
                $test.='Biochemistry Test'.'<br>';
            if($labTestRes['immunology']==1)
                $test.='Immunology Test'.'<br>';
            if($labTestRes['blood']==1)
                $test.='Blood Test'.'<br>';
            if($labTestRes['hormone']==1)
                $test.='Hormone Test'.'<br>';
            if($labTestRes['digestiveSystem']==1)
                $test.='DigestiveSystem Test'.'<br>';
            if($labTestRes['stressAdrenalFatigue']==1)
                $test.='Stress Adrenal Fatigue Test'.'<br>';
            if($labTestRes['microbiology']==1)
                $test.='Microbiology Test'.'<br>';
            if($labTestRes['mineralDeficiency']==1)
                $test.='MineralDeficiency Test'.'<br>';
            if($labTestRes['eco']==1)
                $test.='ECO Test'.'<br>';
            if($labTestRes['ecg']==1)
                $test.='ECG Test'.'<br>';
            if($labTestRes['bloodSuger']==1)
                $test.='Blood Suger Test'.'<br>';
            if($labTestRes['bloodGlucose']==1)
                $test.='Blood Glucose Test'.'<br>';
            if($labTestRes['oralGlucoseTolerance']==1)
                $test.='Oral Glucose To lerance Test'.'<br>';
            if($labTestRes['twoHourPostprandial']==1)
                $test.='Two Hour Postprandial Test'.'<br>';
            if($labTestRes['hemoglobinA1C']==1)
                $test.='Hemoglobin A1C Test'.'<br>';
            if($labTestRes['fastingPlasmaGlucose']==1)
                $test.='Fasting Plasma Glucose Test'.'<br>';
            if($labTestRes['randomPlasmaGlucose']==1)
                $test.='Random Plasma Glucose Test'.'<br>';
            if($labTestRes['insulinAutoantibodies']==1)
                $test.='Insulin Autoantibodies Test'.'<br>';
            if($labTestRes['glutamicAcidDecarboxylaseAutoantibodies']==1)
                $test.='Glutamic Acid Decarboxylase Autoantibodies Test'.'<br>';
            if($labTestRes['insulinomaAssociatedAutoantibodies']==1)
                $test.='Insulinoma Associated Autoantibodies Test'.'<br>';
            if($labTestRes['zincTransport']==1)
                $test.='Zinc Transport Test'.'<br>';
            if($labTestRes['isletCellCytoplasmicAutoantibodies']==1)
                $test.='Islet Cell Cytoplasmic Autoantibodies Test'.'<br>';
            $output .= $test.'<br><br><br>';
            $output.='
            <label style="color: #e60009;">Doctor Advise</label><br>
            <label>'.$prescriptionRes["advise"].'</label><br><br>
            <label style="color: #e60009">Next Date To Meet: </label>
            <label>'.$prescriptionRes["nextDate"].'</label>
        </div>
    ';
    return $output;
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
        <br>
		<form action="" method="get">
        <div class="col-md-3">
            <div class="form-group">
                <textarea style="max-height: 200px;min-height: 200px;min-width: 100%;max-width: 100%;" name="problem" required placeholder="Diagnosis" class="form-control" id="exampleFormControlTextarea1"></textarea>
            </div>
            <div class="form-group" style="text-align: left;">

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

                <label><input type="checkbox" name="bloodSuger" value="1">Blood Suger Test</label>
                <label><input type="checkbox" name="bloodGlucose" value="1">Blood Glucose Test</label>
                <label><input type="checkbox" name="oralGlucoseTolerance" value="1">Oral glucose-tolerance Test</label>
                <label><input type="checkbox" name="twoHourPostprandial" value="1">Two-hour postprandial Test</label>
                <label><input type="checkbox" name="hemoglobinA1C" value="1">Hemoglobin A1C Test</label>
                <label><input type="checkbox" name="fastingPlasmaGlucose" value="1">Fasting plasma glucose Test</label>
                <label><input type="checkbox" name="randomPlasmaGlucose" value="1">Random plasma glucose Test</label>
                <label><input type="checkbox" name="insulinAutoantibodies" value="1">Insulin Autoantibodies</label>
                <label><input type="checkbox" name="glutamicAcidDecarboxylaseAutoantibodies" value="1">Glutamic acid decarboxylase autoantibodies</label>
                <label><input type="checkbox" name="insulinomaAssociatedAutoantibodies" value="1">Insulinoma-associated 2 autoantibodies</label>
                <label><input type="checkbox" name="zincTransport" value="1">Zinc transport</label>
                <label><input type="checkbox" name="isletCellCytoplasmicAutoantibodies" value="1">Islet cell cytoplasmic autoantibodies</label>

                <label><input type="checkbox" name="biochemistry" value="1">Biochemistry Test</label>
                <label><input type="checkbox" name="immunology" value="1">Immunology Test</label>
                <label><input type="checkbox" name="blood" value="1">Erythrocyte sedimentation rate (ESR) Test</label>
                <label><input type="checkbox" name="hormone" value="1">Hormone Test</label>
                <label><input type="checkbox" name="digestiveSystem" value="1">Digestive System Test</label>
                <label><input type="checkbox" name="stressAdrenalFatigue" value="1">StressAdrenal Fatigue Test</label>
                <label><input type="checkbox" name="microbiology" value="1">Microbiology Test</label>
                <label><input type="checkbox" name="mineralDeficiency" value="1">Mineral Deficiency Test</label>
                <label><input type="checkbox" name="eco" value="1">Eco Test</label>
                <label><input type="checkbox" name="ecg" value="1">Ecg Test</label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="form-group col-md-4">
                    <input readonly name="name" type="text" class="form-control" value="Patient Name : <?php echo $patientRes['name']?>">
                </div>
                <div class="form-group col-md-4">
                    <input readonly name="gender" type="text" class="form-control" id="inputPassword4" placeholder="Gender" value="Gender : <?php echo $patientRes['gender']?>">
                </div>
                <div class="form-group col-md-4">
                    <input readonly name="gender" type="text" class="form-control" id="inputPassword4" placeholder="Gender" value="Date : <?php echo $appointmentRes['date']?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <input readonly name="age" type="text" class="form-control" id="inputEmail4" placeholder="Age" value="Age : <?php echo $patientRes['age']?> Years">
                </div>
                <div class="form-group col-md-4">
                    <input readonly type="text" class="form-control" id="inputDate" value="Blood Pressure : <?php echo $patientRes['bp']?> mmHg">
                </div>
                <div class="form-group col-md-4">
                    <input readonly name="gender" type="text" class="form-control" id="inputPassword4" placeholder="Gender" value="Weight : <?php echo $patientRes['weight']?> KG">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med1" name="medicine1" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med1')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose1" type="text" name="time1" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day1" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime1" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med2" name="medicine2" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med2')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose2" type="text" name="time2" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day2" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime2" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med3" name="medicine3" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med3')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose3" type="text" name="time3" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day3" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime3" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med4" name="medicine4" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med4')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose4" type="text" name="time4" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day4" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime4" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med5" name="medicine5" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med5')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose5" type="text" name="time5" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day5" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime5" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med6" name="medicine6" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med6')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose6" type="text" name="time6" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day6" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime6" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med7" name="medicine7" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med7')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose7" type="text" name="time7" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day7" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime7" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input id="med8" name="medicine8" list="medicines" class="form-control" placeholder="Medicine" onchange="selectMedicine('med8')">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input id="dose8" type="text" name="time8" class="form-control" placeholder="Procedure">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <input name="day8" type="text" list="durationlist" class="form-control" placeholder="Duration">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input name="eatTime8" list="eattime" class="form-control" placeholder="Eat Time">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="form-group col-md-7">
                    <textarea style="min-height: 100px;max-height: 100px;min-width: 100%;max-width: 100%;" name="advise" class="form-control" id="exampleFormControlTextarea1" placeholder="Doctor Advise"></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label style="margin-top: 5px;margin-left: -41px;" type="submit" name="submit">Select Next Date To Meet</label>
                </div>
                <div class="form-group col-md-2" style="margin-left: -60px;">
                    <input name="nextDate" type="date" class="form-control" id="inputDate">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <button type="submit" style='background-color:#114643;color:#fff' class="btn" name="submit"><i class='glyphicon glyphicon-book'></i> Generate Prescription</button>
                </div>
            </div>
            </div>
            <datalist id="timelisttab">
                <option value="1+0+0">
                <option value="0+1+0">
                <option value="0+0+1">
                <option value="1+1+0">
                <option value="1+0+1">
                <option value="0+1+1">
                <option value="1+1+1">
            </datalist>
            <datalist id="timelistdrop">
                <option value=" drop+ drop+ drop">
                <option value="1 drop+0 drop+0 drop">
                <option value="0 drop+1 drop+0 drop">
                <option value="0 drop+0 drop+1 drop">
                <option value="1 drop+1 drop+0 drop">
                <option value="1 drop+0 drop+1 drop">
                <option value="0 drop+1 drop+1 drop">
                <option value="1 drop+1 drop+1 drop">
                <option value="2 drop+0 drop+0 drop">
                <option value="0 drop+2 drop+0 drop">
                <option value="0 drop+0 drop+2 drop">
                <option value="2 drop+2 drop+0 drop">
                <option value="2 drop+0 drop+2 drop">
                <option value="0 drop+2 drop+2 drop">
                <option value="2 drop+2 drop+2 drop">
                <option value="3 drop+0 drop+0 drop">
                <option value="0 drop+3 drop+0 drop">
                <option value="0 drop+0 drop+3 drop">
                <option value="3 drop+3 drop+0 drop">
                <option value="3 drop+0 drop+3 drop">
                <option value="3 drop+3 drop+0 drop">
                <option value="3 drop+3 drop+3 drop">

            </datalist>
            <datalist id="timelistml">
                <option value=" ml+ ml+ ml ">
            </datalist>
            <datalist id="timelistspoon">
                <option value=" spoon+ spoon+ spoon">
                <option value="1 spoon+0 spoon+0 spoon">
                <option value="0 spoon+1 spoon+0 spoon">
                <option value="0 spoon+0 spoon+1 spoon">
                <option value="1 spoon+1 spoon+0 spoon">
                <option value="1 spoon+0 spoon+1 spoon">
                <option value="0 spoon+1 spoon+1 spoon">
                <option value="1 spoon+1 spoon+1 spoon">
                <option value="2 spoon+0 spoon+0 spoon">
                <option value="0 spoon+2 spoon+0 spoon">
                <option value="0 spoon+0 spoon+2 spoon">
                <option value="2 spoon+2 spoon+0 spoon">
                <option value="2 spoon+0 spoon+2 spoon">
                <option value="0 spoon+2 spoon+2 spoon">
                <option value="2 spoon+2 spoon+2 spoon">
                <option value="3 spoon+0 spoon+0 spoon">
                <option value="0 spoon+3 spoon+0 spoon">
                <option value="0 spoon+0 spoon+3 spoon">
                <option value="3 spoon+3 spoon+0 spoon">
                <option value="3 spoon+0 spoon+3 spoon">
                <option value="3 spoon+3 spoon+0 spoon">
                <option value="3 spoon+3 spoon+3 spoon">
                <option value="1.5 spoon+0 spoon+0 spoon">
                <option value="0 spoon+1.5 spoon+0 spoon">
                <option value="0 spoon+0 spoon+1.5 spoon">
                <option value="1.5 spoon+1.5 spoon+0 spoon">
                <option value="1.5 spoon+0 spoon+1.5 spoon">
                <option value="0 spoon+1.5 spoon+1.5 spoon">
                <option value="1.5 spoon+1.5 spoon+1.5 spoon">
            </datalist>
            <datalist id="eattime">
                <option value="Full Stomach">
                <option value="Empty Stomach">
            </datalist>
            <datalist id="durationlist">
                <option value="7 Days">
                <option value="10 Days">
                <option value="14 Days">
                <option value="15 Days">
                <option value="30 Days">
                <option value="1 week">
                <option value="1 Month">
                <option value="1 Year">
                <option value="Continue">
            </datalist>
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
                <option value="Tab :Linagliptin 500mg">
                <option value="Syrup :Bestcof 50ml">
                <option value="Syrup :Cortan 5ml">
                <option value="Syrup :Motigut 5ml">
                <option value="Syrup :Bukof 7.5ml">
                <option value="Syrup :Tofen 1ml">
                <option value="Syrup :Domin 5ml">
                <option value="Drop :Norcel 20ml">
                <option value="Drop :Nozol 25ml">
                <option value="Drop :Antazol 25ml">
                <option value="Insulin :Insulatard">
                <option value="Insulin :Actrapid">
            </datalist>
		</form>
	</div>
</body>
<script>
    function selectMedicine(med) {
        console.log('name = '+med);
        var medicineName=document.getElementById(med).value;
        var m=medicineName[0]+medicineName[1]+medicineName[2];
        var dose=null;
        if(med=='med1'){
            dose=document.getElementById('dose1');
        }
        else if(med=='med2'){
            dose=document.getElementById('dose2');
        }
        else if(med=='med3'){
            dose=document.getElementById('dose3');
        }
        else if(med=='med4'){
            dose=document.getElementById('dose4');
        }
        else if(med=='med5'){
            dose=document.getElementById('dose5');
        }
        else if(med=='med6'){
            dose=document.getElementById('dose6');
        }
        else if(med=='med7'){
            dose=document.getElementById('dose7');
        }
        else if(med=='med8'){
            dose=document.getElementById('dose8');
        }
        if(m=='Tab' || m=='Cap')
            dose.setAttribute('list','timelisttab');
        else if(m=='Syr')
            dose.setAttribute('list','timelistspoon');
        else if(m=='Ins')
            dose.value=' ml+ ml+ ml ';
        else if(m=='Dro')
            dose.setAttribute('list','timelistdrop');
    }
</script>
<br><br>
<?php include "includes/footer.php" ?>