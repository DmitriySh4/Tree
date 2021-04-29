<?php
	ini_set('display_errors', 1);
	require_once '../Models/Tree.php';
	require_once '../Controllers/Controller.php';
	
	/**
	 * 
	 */
	
	class TreeController extends Controller
	{
		public function __construct()
		{
			$this->rootModel = new Tree();
		}

		public function CreateRoot($text, $position, $parents) 
		{
			$result = $this->rootModel->createRoot($text, $position, $parents);
			echo $result;
		}

		public function GetRoots()
		{
			$result = $this->rootModel->getRoots();
			echo json_encode($result);
		}

		public function DeleteRoot($id) 
		{
			$result = $this->rootModel->deleteRoot($id);
			echo $result;
		}

		public function UpdateRoot($text, $id) 
		{
			$result = $this->rootModel->updateRoot($text, $id);
			echo $result;
		}
	}

	if (isset($_POST['delete_id'])) {
		$id = $_POST['delete_id'];
		$tree = new TreeController();
		$tree->DeleteRoot($_POST['delete_id']);
	}

	if (isset($_POST['text']) && isset($_POST['parents'])) {
		$tree = new TreeController();
		$tree->CreateRoot($_POST['text'], $_POST['position'], implode(",", $_POST['parents']));
	}

	if (isset($_GET['getRoots'])) {
		$tree = new TreeController();
		$tree->GetRoots();
	}

	if (isset($_POST['edit_id'])) {
		$tree = new TreeController();
		$tree->UpdateRoot($_POST['textEdit'], $_POST['edit_id']);
	}
?>