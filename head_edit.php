<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Update Head</title>
	<?php 
	include('head.php');
	?>
</head>
<body>
	<?php 
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	?>
	
	<div class="row" style="padding-top: 20px;">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<form id="head_edit_save" method="post">
				<input type="hidden" name="head_id" value="<?php echo $id;?>">
				<div class="form-group">
					<label for="name">Head Name:</label>
					<?php 
						$query = "SELECT * FROM heads WHERE h_id='{$id}'";
						$result = mysqli_query($conn,$query);
						if (mysqli_num_rows($result)>0) 
						{
							$row = mysqli_fetch_assoc($result)
							

								?>
							<input type="text" name="name" class="form-control" value="<?php echo $row['h_name']?>">	
								<?php
							
						}
						?>
					
				</div>
				<button type="button" id="head_edit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-sm-3"></div>
	</div>

</body>
</html>
<script>
$(document).ready(function(){
	$("#head_edit").click(function(){
		$.ajax({
				type:'POST',
				url:'head_editsave.php',
				data:$("#head_edit_save").serialize(),
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