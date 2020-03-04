<?php
require_once "DB.php";
class DBPrescription
{
    private $table = "prescription_tb";
    public function save($problem,$patientId, $date, $nextDate,$advise)
    {
        $sql="INSERT into $this->table(problem,patientId,date,nextDate,advise) values (:problem,:patientId,:date,:nextDate,:advise)";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':problem',$problem);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':nextDate',$nextDate);
        $stmt->bindParam(':advise',$advise);
        return $stmt->execute();
    }
    public function getLastPrescription()
    {
        $sql="SELECT * FROM $this->table order by id desc limit 1";
        $stmt=DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getPrescriptionById($id)
    {
        $sql="SELECT * FROM $this->table where id=:id";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getPrescriptionByPatientId($patientId)
    {
        $sql="SELECT * FROM $this->table where patientId=:patientId order by id desc";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->execute();
        return $stmt->fetchAll();
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