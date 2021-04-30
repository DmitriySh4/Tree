<?php 
include '../Controllers/TreeController.php';
	
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