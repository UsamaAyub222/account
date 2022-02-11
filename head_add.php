<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Create Head</title>
	<?php 
	include('head.php');
	?>
</head>
<body>
	
	<div class="row" style="padding-top: 20px;">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<form id="head_add" method="post">
				
				<div class="form-group">
					<label for="name">Head Name:</label>
					<input type="text" class="form-control" name="name">
				</div>
				<button type="button" id="head_save" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-sm-3"></div>
	</div>

</body>
</html>
<script>
$(document).ready(function(){
	$("#head_save").click(function(){
		$.ajax({
				type:'POST',
				url:'head_save.php',
				data:$("#head_add").serialize(),
				success: function(data){
					
					var test = jQuery.parseJSON(data);
					console.log(test);
					parent.$.colorbox.close();
					
					alert(test.msg);
					parent.readHeadsRecords();
				}

			})
	});
});
</script>