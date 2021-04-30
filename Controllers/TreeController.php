<?php
	ini_set('display_errors', 1);
	require_once '../Models/Tree.php';
	require_once 'Controller.php';
	require_once '../Helpers/AjaxHandler.php';
	
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
?>