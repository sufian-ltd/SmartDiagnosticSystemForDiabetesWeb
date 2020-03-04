<?php
require_once "DB.php";
class DBPrescriptionData
{
    private $table = "prescription_data_tb";
    public function save($prescriptionId, $medicine, $time1,$day1,$eatTime)
    {
        $sql="INSERT into $this->table(prescriptionId,medicine,time1,day1,eatTime) values (:prescriptionId,:medicine,:time1,:day1,:eatTime)";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':prescriptionId',$prescriptionId);
        $stmt->bindParam(':medicine',$medicine);
        $stmt->bindParam(':time1',$time1);
        $stmt->bindParam(':day1',$day1);
        $stmt->bindParam(':eatTime',$eatTime);
        return $stmt->execute();
    }
    public function getAllApointment()
    {
        $sql="SELECT * FROM $this->table";
        $stmt=DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getPrescriptionDataByPrescriptionId($prescriptionId)
    {
        $sql="SELECT * FROM $this->table where prescriptionId=:prescriptionId";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':prescriptionId',$prescriptionId);
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