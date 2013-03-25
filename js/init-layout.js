var rootURL = "127.0.0.1/dustjs-slim-rest-app-example";
$.ajaxSetup({ cache: false });

function show(template, context) {
	dust.render(template, context, function(err, html) {
	    if (err) return console.log(err);
	    document.body.innerHTML = html;
	    // eval(after);
	    ready(template);
	});
}

$(document).ready(function() {
	dust.onLoad = function(templateName, callback) {
	    $.get(["templates/", ".html"].join(templateName), function(data) {
	        callback(undefined, data);
	    }, "html"); 
	};

	findAll();

});

function findAll() {
	$.ajax({
		type: 'GET',
		url: rootURL,
		dataType: "json", // data type of response
		success: renderList
	});
}

function renderList(data) {
	show('list',data);	
}

function ready(template) {
	switch(template)
	{
	case 'list':
	  $('#todo-table').dataTable();
	  break;
	case 'edit':
	  $('#divDueDate').datepicker({
	  		dateFormat: 'yy-mm-dd',
			onSelect: function(dateText, inst) {$('#inputDueDate').val(dateText);	},
			defaultDate: $('#inputDueDate').val()
  		});

	  break;
	default:
	 break;
	}
}

function saveTodo(id, description, priority, due_date, status, after) {
	if (id=='') {
		//save new ToDo
		$.ajax({
			type: 'POST',
			contentType: 'application/json',
			url: rootURL,
			dataType: "json",
			data: JSON.stringify({"description":description,"priority":priority,"due_date":due_date,"status":status}),
			success: function(data, textStatus, jqXHR){
				eval(after);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('error adding ToDo: ' + jqXHR['responseText']);
				eval(after);
			}
		});
	} else {
		//try updating existing one
		$.ajax({
			type: 'PUT',
			contentType: 'application/json',
			url: rootURL + '/' + id,
			dataType: "json",
			data: JSON.stringify({"id":id,"description":description,"priority":priority,"due_date":due_date,"status":status}),
			success: function(data, textStatus, jqXHR){
				eval(after);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('error adding ToDo: ' + jqXHR['responseText']);
				eval(after);
			}
		});
	}
	

}
function deleteTodo(id, after) {
	if (confirm('Are you sure you want to delete the ToDo: '+id+' ?')) {
		if (id!='') {
			$.ajax({
				type: 'DELETE',
				url: rootURL+ '/' + id,
				success: function(data, textStatus, jqXHR){
					eval(after);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('error adding ToDo: ' + jqXHR['responseText']);
					eval(after);
				}
			});
		}
	}
	
}