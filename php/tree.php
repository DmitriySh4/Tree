<?php
	include 'connect.php';
	
	/**
	 * 
	 */
	ini_set('display_errors', 1);
	class Tree
	{
		public $conn;
		public $update_id;
		public $del_id;
		public $text;
		public $textEdit;
		public $position;
		public $parents;

		public function __construct($conn, $del_id = null, $update_id = null, $text = null, $position = null, $parents = null)
		{
			$this->conn = $conn;
			$this->del_id = isset($_POST['delete_id']) ? $_POST['delete_id'] : null;
			$this->update_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;
			$this->text = isset($_POST['text']) ? $_POST['text'] : null;
			$this->textEdit = isset($_POST['textEdit']) ? $_POST['textEdit'] : null;
			$this->position = isset($_POST['position']) ? $_POST['position'] : null;
			$this->parents = isset($_POST['parents']) ? implode(",", $_POST['parents']) : null;
		}
		public function CreateRoot() 
		{
			$sql = "INSERT INTO roots(text, position, parents) 
			VALUES ('$this->text', '$this->position', '$this->parents')";
			if (mysqli_query($this->conn, $sql)) {
				$last_id = $this->conn->insert_id;
		  		echo $last_id;
				} else {
				  echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
				}
			mysqli_close($this->conn);
		}

		public function GetRoots()
		{
			$sql = "SELECT * FROM roots GROUP BY id, parents";
			$result = $this->conn->query($sql);
			$rows=$result->fetch_all(MYSQLI_ASSOC);
			echo json_encode($rows);
			mysqli_close($this->conn);
		}

		public function DeleteRoot() 
		{
			$sql="DELETE FROM roots WHERE id =".$this->del_id." OR parents LIKE '%". $this->del_id ."%'";
			if (mysqli_query($this->conn, $sql)) {
				echo "Root deleted $this->del_id";
				} else {
				  echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
				}
			mysqli_close($this->conn);
		}

		public function UpdateRoot() 
		{
			$sql = "UPDATE roots SET text = '$this->textEdit' WHERE id = '$this->update_id'";
			if (mysqli_query($this->conn, $sql)) {
				echo $this->update_id;
				} else {
				  echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
				}
			mysqli_close($this->conn);
		}
	}

	if (isset($_POST['delete_id'])) {
		$id = $_POST['delete_id'];
		$tree = new Tree($conn);
		$tree->DeleteRoot();
	}

	if (isset($_POST['text']) && isset($_POST['parents'])) {
		$tree = new Tree($conn);
		$tree->CreateRoot();
	}

	if (isset($_GET['getRoots'])) {
		$tree = new Tree($conn);
		$tree->GetRoots();
	}

	if (isset($_POST['edit_id'])) {
		$tree = new Tree($conn);
		$tree->UpdateRoot();
	}
	
?>