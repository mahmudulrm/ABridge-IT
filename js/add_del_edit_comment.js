function showEditBox(editobj,id) {
	$('#frmAdd').hide();
	$(editobj).prop('disabled','true');
	var currentMessage = $("#message_" + id + " .message-content").html();
	var editMarkUp = '<textarea rows="5" cols="80" class="textarea-style-1" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" class="btn-style-edit" onClick="callCrudAction(\'edit\','+id+')">Save</button><button name="cancel" class="btn-style-delete" onClick="cancelEdit(\''+currentMessage+'\','+id+')">Cancel</button>';
	$("#message_" + id + " .message-content").html(editMarkUp);
}
function cancelEdit(message,id) {
	$("#message_" + id + " .message-content").html(message);
	$('#frmAdd').show();
}
function callCrudAction(action,id) {
	$("#loaderIcon").show();
	var queryString;
	switch(action) {
		case "add":
		queryString = 'action='+action+'&txtmessage='+ $("#txtmessage").val();
		queryString += '&post_id='+ $("#post_id").val();
		queryString += '&poster_name='+ $("#poster_name").val();
		break;
		case "edit":
		queryString = 'action='+action+'&message_id='+ id + '&txtmessage='+ $("#txtmessage_"+id).val();
		break;
		case "delete":
		queryString = 'action='+action+'&message_id='+ id;
		break;
	}	 
	jQuery.ajax({
		url: "include/comment_action.php",
		data:queryString,
		type: "POST",
		success:function(data){
			switch(action) {
				case "add":
				$("#comment-list-box").append(data);
				break;
				case "edit":
				$("#message_" + id + " .message-content").html(data);
				$('#frmAdd').show();
				$("#message_"+id+" .btn-style-edit").prop('disabled','');	
				break;
				case "delete":
				$('#message_'+id).fadeOut();
				break;
			}
			$("#txtmessage").val('');
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
}


