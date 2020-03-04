<?php
require_once "DB.php";
class DBAppointment
{
    private $table = "appointment_tb";
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
        $sql="SELECT * FROM $this->table where status=:status";
        $stmt=DB::prepare($sql);
        $status="pending";
        $stmt->bindParam(':status',$status);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAppointmentById($id)
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