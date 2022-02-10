<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Create Account</title>
	<?php 
	include('head.php');
	?>
</head>

<body>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<form id="add_acc" method="post">
				<div class="form-group">
					<label for="name">Account Name:</label>
					<input type="text" class="form-control" placeholder="Enter Account Name" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="type">Type:</label>
					<select class="form-control" name="type">
						<option selected disabled>Select Type...</option>
						<option value="Bank">Bank</option>
						<option value="Normal">Normal</option>
						<option value="Detail">Detail</option>
					</select>
				</div>
				<button type="button" id="save_acc" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-sm-3"></div>
	</div>

</body>

</html>
<script>
$(document).ready(function(){
	$("#save_acc").click(function(){
		$.ajax({
				type:'POST',
				url:'account_save.php',
				data:$("#add_acc").serialize(),
				success: function(data){
					
					var test = jQuery.parseJSON(data);
					console.log(test);
					parent.$.colorbox.close();
					
					alert(test.msg);
					parent.readRecords();
				}

			})
	});
});
</script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/colorbox.css">
	<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".group1").colorbox({rel:'group1'});
		$(".group2").colorbox({rel:'group2', transition:"fade"});
		$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
		$(".group4").colorbox({rel:'group4', slideshow:true});
		$(".ajax").colorbox();
		$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
		$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
		$(".iframe").colorbox({iframe:true, width:"90%", height:"80%"});
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert('onOpen: colorbox is about to open'); },
			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});

		$('.non-retina').colorbox({rel:'group5', transition:'none'})
		$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
		
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
		$(".detailid").tooltip();
	});
</script>