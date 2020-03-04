<?php

	require_once "DB.php";

	class DBProgressReport
	{
		private $table = "progress_report_tb";

		function getProgressReport($patientId)
		{
			$sql="SELECT * FROM $this->table where patientId=:patientId order by id desc";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':patientId',$patientId);
            $stmt->execute();
            return $stmt->fetchAll();
		}
		public function getProgressReportById($id)
        {
            $sql="SELECT * FROM $this->table where id=:id";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
	}
?>