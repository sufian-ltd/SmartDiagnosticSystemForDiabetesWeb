<?php
require_once "DB.php";
class DBLabTest
{
    private $table = "lab_test_tb";
    public function save($patientId,$prescriptionId,$biochemistry,$immunology,$blood,$hormone,
        $digestiveSystem,$stressAdrenalFatigue,$microbiology,$mineralDeficiency,$eco,$ecg
        ,$bloodSuger, $bloodGlucose,$oralGlucoseTolerance,$twoHourPostprandial,$hemoglobinA1C,
         $fastingPlasmaGlucose, $randomPlasmaGlucose,$insulinAutoantibodies,
         $glutamicAcidDecarboxylaseAutoantibodies, $insulinomaAssociatedAutoantibodies,
         $zincTransport,$isletCellCytoplasmicAutoantibodies,$date)
    {
        $sql="INSERT into $this->table(patientId,prescriptionId,biochemistry,immunology,blood,hormone,
        digestiveSystem,stressAdrenalFatigue,microbiology,mineralDeficiency,eco,ecg,
        bloodSuger,bloodGlucose,oralGlucoseTolerance,twoHourPostprandial,hemoglobinA1C,
        fastingPlasmaGlucose,randomPlasmaGlucose,
        insulinAutoantibodies,glutamicAcidDecarboxylaseAutoantibodies,insulinomaAssociatedAutoantibodies,
        zincTransport,isletCellCytoplasmicAutoantibodies,date) 
        values (:patientId,:prescriptionId,:biochemistry,:immunology,:blood,:hormone,
        :digestiveSystem,:stressAdrenalFatigue,:microbiology,:mineralDeficiency,:eco,:ecg,
        :bloodSuger,:bloodGlucose,:oralGlucoseTolerance,:twoHourPostprandial,:hemoglobinA1C,
        :fastingPlasmaGlucose,:randomPlasmaGlucose,
        :insulinAutoantibodies,:glutamicAcidDecarboxylaseAutoantibodies,:insulinomaAssociatedAutoantibodies,
        :zincTransport,:isletCellCytoplasmicAutoantibodies,:date)";

        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->bindParam(':prescriptionId',$prescriptionId);
        $stmt->bindParam(':biochemistry',$biochemistry);
        $stmt->bindParam(':immunology',$immunology);
        $stmt->bindParam(':blood',$blood);
        $stmt->bindParam(':hormone',$hormone);
        $stmt->bindParam(':digestiveSystem',$digestiveSystem);
        $stmt->bindParam(':stressAdrenalFatigue',$stressAdrenalFatigue);
        $stmt->bindParam(':microbiology',$microbiology);
        $stmt->bindParam(':mineralDeficiency',$mineralDeficiency);
        $stmt->bindParam(':eco',$eco);
        $stmt->bindParam(':ecg',$ecg);
        $stmt->bindParam(':bloodSuger',$bloodSuger);
        $stmt->bindParam(':bloodGlucose',$bloodGlucose);
        $stmt->bindParam(':oralGlucoseTolerance',$oralGlucoseTolerance);
        $stmt->bindParam(':twoHourPostprandial',$twoHourPostprandial);
        $stmt->bindParam(':hemoglobinA1C',$hemoglobinA1C);
        $stmt->bindParam(':fastingPlasmaGlucose',$fastingPlasmaGlucose);
        $stmt->bindParam(':randomPlasmaGlucose',$randomPlasmaGlucose);
        $stmt->bindParam(':insulinAutoantibodies',$insulinAutoantibodies);
        $stmt->bindParam(':glutamicAcidDecarboxylaseAutoantibodies',$glutamicAcidDecarboxylaseAutoantibodies);
        $stmt->bindParam(':insulinomaAssociatedAutoantibodies',$insulinomaAssociatedAutoantibodies);
        $stmt->bindParam(':zincTransport',$zincTransport);
        $stmt->bindParam(':isletCellCytoplasmicAutoantibodies',$isletCellCytoplasmicAutoantibodies);
        $stmt->bindParam(':date',$date);
        return $stmt->execute();

        // bloodSuger bloodGlucose oralGlucoseTolerance twoHourPostprandial hemoglobinA1C fastingPlasmaGlucose
        // randomPlasmaGlucose insulinAutoantibodies glutamicAcidDecarboxylaseAutoantibodies
        // insulinomaAssociatedAutoantibodies zincTransport isletCellCytoplasmicAutoantibodies
    }
    public function getAllApointment()
    {
        $sql="SELECT * FROM $this->table";
        $stmt=DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getTestReportByPrescriptionIdAndPatientId($prescriptionId,$patientId)
    {
        $sql="SELECT * FROM $this->table where patientId=:patientId and prescriptionId=:prescriptionId";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->bindParam(':prescriptionId',$prescriptionId);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getReportByPrescriptionIdAndPatientId($prescriptionId,$patientId)
    {
        $sql="SELECT * FROM $this->table where patientId=:patientId and prescriptionId=:prescriptionId";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->bindParam(':prescriptionId',$prescriptionId);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getBrandById($id)
    {
        $sql="SELECT * FROM $this->table where id=:id";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function accept($id,$status)
    {
        $sql="UPDATE $this->table set status=:status where id=:id";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }
    public function deleteBrand($id)
    {
        $sql="DELETE from $this->table where id=:id";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }
    public function searchBrand($key)
    {
        $sql="SELECT * FROM $this->table where name like :name";
        $stmt=DB::prepare($sql);
        $key='%'.$key.'%';
        $stmt->bindParam(':name',$key);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addQtnToCategory($category,$qtn)
    {
        $sql="UPDATE $this->table set totalProduct=:totalProduct where name=:name";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':totalProduct',$qtn);
        $stmt->bindParam(':name',$category);
        return $stmt->execute();
    }
}