$(document).ready(function(){
	$.ajax({
		url: "../Controllers/TreeController.php",
		type: "GET",
		data: { getRoots : true},
		// dataType: "json",
		success: function(response){
	        var data = JSON.parse(response);
	        if (data.length > 0) {
	        	$('.root').hide();
		        for (var i = 0; i < data.length; i++) {
		        	buildTree(data[i].id, data[i].position, data[i].text, data[i].parents);
		        }
	        }
		}
	});

	$('.root').click(function() {
	  $.ajax({
        type: 'POST',
        url: '../Controllers/TreeController.php',
        data: { text: "Root", position: 1, parents: [0] },
        success: function(response) {
            $('.root').hide();
            $( '<div class="branch" data-src="'+response+'" position="1" parent="0"><button class="delete btn btn-danger">-</button><button class="btn btn-light edit">Root</button><button class="add btn btn-success">+</button></div>').appendTo('.tree');
        }
    	});
	});

	$(document.body).on('click', '.delete', function() {
		var del_id = $(this).parent().attr('data-src');
		var parents = $(this).parent().attr('parent');
	  	if (parents != 0) {
		  $.ajax({
	        type: 'POST',
	        url: '../Controllers/TreeController.php',
	        data: {delete_id: del_id},
	        success: function(response) {
	            $('div[data-src="'+del_id+'"]').remove();
	            $('.branch').each(function() {
	            	if ($(this).attr('parent').includes(del_id)) {
	            		$(this).remove();
	            	}
	            });
	        }
	    	});
	    }
	    else {
	    	delete_root(del_id, parents);
	    }
	});
	$(document.body).on('click', '.add', function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		var parent_id = $(this).parent().attr('data-src');
		var position = $(this).parent().attr('position');
		var grandparents = $(this).parent().attr('parent');
		var parents = [];
		if (grandparents != 0) {
			parents.push(grandparents);
		}
		parents.push(parent_id);
		add_root(position, parents, parent_id);
	});

	$(document.body).on('click', '.edit', function(e) {
		var id = $(this).parent().attr('data-src');
		edit_root(id);
	});
});

function add_root(pos, parents, parent_id) {
	// Unfortunately, can't use detach() here, as it keeps passed js variables. Clone/remove is used to prevent duplicated records.
	var modal = $('#addModal');
	$(modal).clone().appendTo('.tree');
	$(modal).modal('show');
	$('#addForm').on('submit', function(e) {
		e.preventDefault();		
		var text = $('#text').val();
		var newpos = +pos +1;
		$(modal).modal('hide');
		$(modal).remove();

	  $.ajax({
        type: 'POST',
        url: '../Controllers/TreeController.php',
        data: { text: text, position: newpos, parents: parents },
        success: function(response) {
        	$( '<div class="branch" data-src="'+response+'" position="'+newpos+'" parent="'+parents+'"><button class="delete btn btn-danger">-</button><button class="btn btn-light edit">' + text + '</button><button class="add btn btn-success">+</button></div>').insertAfter('.branch[data-src='+parent_id+']').css('margin-left', +newpos*20);
        }
    	});
	});
}

function edit_root(id) {
	
	var modal = $('#editModal');
	$(modal).clone().appendTo('.tree');
	$(modal).modal('show');
	$('#editForm').on('submit', function(e) {
		e.preventDefault();		
		var text = $('#textNew').val();
		$(modal).modal('hide');
		$(modal).remove();
	  $.ajax({
        type: 'POST',
        url: '../Controllers/TreeController.php',
        data: { textEdit: text, edit_id: id },
        success: function(response) {
        	$('.branch[data-src="'+response+'"] .edit').text(text);
        }
    	});
	});
}

function delete_root(id, parents) {
	var modal = $('#deleteModal');
	$(modal).modal('show');
	var timer = 20;
	var interval = setInterval(function() {
	    timer--;
	    $('#timer').html(timer);
	    if (timer == 0) {
	        $(modal).modal('hide');
	        clearInterval(interval);
	    }
	}, 1000); 
	$('#deleteModal').on('hidden.bs.modal', function () {
		$('#timer').html('');
	    clearInterval(interval);
	});
	$(document.body).on('click', '.deleteC', function() {
		clearInterval(interval);
		$(modal).modal('hide');
		$.ajax({
	        type: 'POST',
	        url: '../Controllers/TreeController.php',
	        data: {delete_id: id},
	        success: function(response) {
            	$('.branch').remove();
            	$('.root').show();
	        }
	    });
	});
	
}

function buildTree(id, pos, text, parents) {
	var parentsString = parents.toString();
	$('<div class="branch" data-src="'+id+'" position="'+pos+'" parent="'+parentsString+'"><button class="delete btn btn-danger">-</button><button class="btn btn-light edit">' + text + '</button><button class="add btn btn-success">+</button></div>').appendTo('.tree').css('margin-left', pos>1 ? +pos*20 : 0);
}