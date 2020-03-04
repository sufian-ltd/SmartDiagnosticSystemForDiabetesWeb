<?php
require_once "DB.php";
class DBTestReport
{
    private $table = "test_report_tb";

    public function save($patientId,$prescriptionId,$biochemistry,$immunology,$blood,$hormone,
                         $digestiveSystem,$stressAdrenalFatigue,$microbiology,$mineralDeficiency,$eco,$ecg,$date)
    {
        $sql="INSERT into $this->table(patientId,prescriptionId,biochemistry,immunology,blood,hormone,
        digestiveSystem,stressAdrenalFatigue,microbiology,mineralDeficiency,eco,ecg,date) 
        values (:patientId,:prescriptionId,:biochemistry,:immunology,:blood,:hormone,
        :digestiveSystem,:stressAdrenalFatigue,:microbiology,:mineralDeficiency,:eco,:ecg,:date)";
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
        $stmt->bindParam(':date',$date);
        return $stmt->execute();
    }

    public function addBrand($name, $status, $totalProduct)
    {
        $sql="INSERT into $this->table(name,status,totalProduct) values (:name,:status,:totalProduct)";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':totalProduct',$totalProduct);
        return $stmt->execute();
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

    public function isReportAdded($patientId,$prescriptionId)
    {
        $sql = "SELECT * FROM $this->table where patientId=:patientId and prescriptionId=:prescriptionId";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':patientId', $patientId);
        $stmt->bindParam(':prescriptionId', $prescriptionId);
        $stmt->execute();
        if ($stmt->rowCount()>0)
            return "exist";
        else
            return "not exist";
    }
}