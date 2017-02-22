<div id="myModal" class="modal">
	<div class="modal-content">
		<div class="modal-header">
			<span class="close">&times;</span>
			<h4>Permission alart</h4>
		</div>
		<div class="modal-body">
			<p>You are not authorized</p>
		</div>
	</div>
</div>
<script>
	var modal = document.getElementById('myModal');
	function divFunction(){
		modal.style.display = "block";
	}
	var span = document.getElementsByClassName("close")[0];
	span.onclick = function() {
		modal.style.display = "none";
	}
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>