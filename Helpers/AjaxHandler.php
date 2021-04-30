<?php 
include '../Controllers/TreeController.php';
	$tree = new TreeController();

	if (isset($_POST['delete_id'])) {
		$id = $_POST['delete_id'];		
		$tree->DeleteRoot($_POST['delete_id']);
	}

	if (isset($_POST['text']) && isset($_POST['parents'])) {
		$tree->CreateRoot($_POST['text'], $_POST['position'], implode(",", $_POST['parents']));
	}

	if (isset($_GET['getRoots'])) {
		$tree->GetRoots();
	}

	if (isset($_POST['edit_id'])) {
		$tree->UpdateRoot($_POST['textEdit'], $_POST['edit_id']);
	}
?>