<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  	crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  	<script src="js/main.js"></script>
  	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<header>
		<h2 class="text-center">Test task: Tree</h2>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="tree">
					<button class="root btn btn-success">Create Root</button>
					<div class="branch-t"></div>
					<div class="modal" id="addModal" tabindex="-1" role="dialog">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      	<div class="modal-header">
						        <h5 class="modal-title">Enter Root text</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          		<span aria-hidden="true">&times;</span>
					        	</button>
					      	</div>
					      	<form method="post" id="addForm">
							      <div class="modal-body">					
										<div class="form-group">
											<label for="text">Enter text</label>
											<input type="text" id="text" class="form-control" maxlength="20" minlength="3" required>	
										</div>
							      </div>
							      <div class="modal-footer">
								        <input type="submit" class="btn btn-primary" id="saveText" value="Save">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							      </div>
					      	</form>
					    </div>
					  </div>
					</div>
					<div class="modal" id="editModal" tabindex="-1" role="dialog">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
					      	<div class="modal-header">
						        <h5 class="modal-title">Text Editor</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          		<span aria-hidden="true">&times;</span>
					        	</button>
					      	</div>
					      	<form method="post" id="editForm">
							      <div class="modal-body">					
										<div class="form-group">
											<label for="text">Enter New text</label>
											<input type="text" id="textNew" class="form-control" maxlength="20" minlength="3" required>	
										</div>
							      </div>
							      <div class="modal-footer">
								        <input type="submit" class="btn btn-primary" id="editText" value="Save">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							      </div>
					      	</form>
					    </div>
					  </div>
					</div>
					<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Delete Confirmation</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <p>This is very dangerous. You shouldn't do it! Are you really really sure?</p>
					      </div>
					      <div class="modal-footer">
					      	<span id="timer"></span>
					        <button type="button" class="deleteC btn btn-primary">Yes I am</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>