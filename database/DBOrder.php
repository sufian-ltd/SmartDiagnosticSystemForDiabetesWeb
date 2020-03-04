<?php
    require_once "DB.php";
    class DBOrder
    {
        private $table = "orders";
        public function saveOrder($userId,$userName,$totalProduct,$totalCost,$delivery,$payment,$date)
        {
            $sql="INSERT into $this->table(userId,userName,totalProduct,totalCost,delivery,payment,date)
                  values (:userId,:userName,:totalProduct,:totalCost,:delivery,:payment,:date)";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':userId',$userId);
            $stmt->bindParam(':userName',$userName);
            $stmt->bindParam(':totalProduct',$totalProduct);
            $stmt->bindParam(':totalCost',$totalCost);
            $stmt->bindParam(':delivery',$delivery);
            $stmt->bindParam(':payment',$payment);
            $stmt->bindParam(':date',$date);
            return $stmt->execute();
        }
        public function getOrders($status)
        {
            $sql="SELECT * FROM $this->table where status=:status";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':status',$status);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getOrderById($userId)
        {
            $sql="SELECT * FROM $this->table where userId=:userId";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':userId',$userId);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function acceptOrder($id)
        {
            $sql="UPDATE $this->table set status=:status where id=:id";
            $stmt=DB::prepare($sql);
            $status="Approved";
            $stmt->bindParam(':status',$status);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        }
        public function deliverOrder($id)
        {
            $sql="UPDATE $this->table set status=:status where id=:id";
            $stmt=DB::prepare($sql);
            $status="Delivered";
            $stmt->bindParam(':status',$status);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        }
        public function rejectOrder($id)
        {
            $sql="DELETE from $this->table where id=:id";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        }
        public function searchOrder($key,$status)
        {
            $sql="SELECT * FROM $this->table where userId like :userId or productId like :productId
                or productName like :productName and status=:status";
//            $sql="SELECT * FROM $this->table where category like ? or subCategory like ? or productName like ?";
            $stmt=DB::prepare($sql);
            $key='%'.$key.'%';
            $stmt->bindParam(':userId',$key);
            $stmt->bindParam(':productId',$key);
            $stmt->bindParam(':productName',$key);
            $stmt->bindParam(':status',$status);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>