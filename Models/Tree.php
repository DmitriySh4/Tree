<?php 
require_once('../Models/Model.php');
	/**
	 * 
	 */
	class Tree extends Model
	{
		function __construct()
		{
			$this->db = new Database();
		}
		public function getRoots() 
		{
			$sql = "SELECT * FROM roots GROUP BY id, parents";
			$result = $this->db->query($sql);
			$rows = $result->fetchAll();
			return $rows;
		}

		public function createRoot($text, $position, $parents) 
		{
			$sql = "INSERT INTO roots(text, position, parents) 
			VALUES ('$text', '$position', '$parents')";
			$this->db->query($sql);
			$last_id = $this->db->lastInsertID();
			return $last_id;
		}

		public function deleteRoot($id) 
		{
			$sql="DELETE FROM roots WHERE id =".$id." OR parents LIKE '%". $id ."%'";
			$this->db->query($sql);
			return $id;
		}

		public function updateRoot($text, $id) 
		{
			$sql = "UPDATE roots SET text = '$text' WHERE id = '$id'";
			$this->db->query($sql);
			return $id;
		}
	}
?>