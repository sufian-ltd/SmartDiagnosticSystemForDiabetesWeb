<?php
require_once "DB.php";

class DBSupplier
{
    private $table = "supplier";

    public function addSupplier($name,$email,$contact,$address,$salary){
        $sql="INSERT into $this->table(name,email,contact,address,salary) values (:name,:email,:contact,:address,:salary)";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':contact',$contact);
        $stmt->bindParam(':address',$address);
        $stmt->bindParam(':salary',$salary);
        return $stmt->execute();
    }
    public function getSupplierById($id)
    {
        $sql="SELECT * FROM $this->table where id=:id";
        $stmt=DB::prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getSupplier()
    {
        $sql="SELECT * FROM $this->table";
        $stmt=DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
	public function searchSupplier($key)
	{
		$sql="SELECT * FROM $this->table where name like :name or email like :email or contact like :contact";
		$stmt=DB::prepare($sql);
		$key='%'.$key.'%';
		$stmt->bindParam(':name',$key);
		$stmt->bindParam(':email',$key);
		$stmt->bindParam(':contact',$key);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

?>