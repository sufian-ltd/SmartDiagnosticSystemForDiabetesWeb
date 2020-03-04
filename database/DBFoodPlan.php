<?php
require_once "DB.php";

class DBFoodPlan
{
    private $table = "food_plan_tb";

    public function addFoodPlan($patientId,$plan){
        $sql="INSERT into $this->table(patientId,plan) values (:patientId,:plan)";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->bindParam(':plan',$plan);
        return $stmt->execute();
    }

    public function getFoodPlanByPatientId($patientId)
    {
        $sql="SELECT * FROM $this->table where patientId=:patientId";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':patientId',$patientId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updatePlan($patientId,$plan)
    {
        $sql="UPDATE $this->table set plan=:plan where patientId=:patientId";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':plan',$plan);
        $stmt->bindParam(':patientId',$patientId);
        return $stmt->execute();
    }

    public function haveFoodPlan($patientId){
        $sql = "SELECT * FROM $this->table where patientId=:patientId";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':patientId', $patientId);
        $stmt->execute();
        if ($stmt->rowCount()>0)
            return "exist";
        else
            return "not exist";
    }
}