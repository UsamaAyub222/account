<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Accounts</title>
	<?php 
	include('head.php');
	?>
</head>
<body>
	<?php include('menue.php');?>
	<div class="justify-content-end" style="padding: 10px;">
		<a href="<?php echo $config['base_url']; ?>/account_add.php" class="btn btn-primary iframe" role="button" title="Add Account" style="float: right;"><i class="fas fa-plus"></i></a>	
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<table class="table table-hover">
				<thead class="table-primary">
					<tr>
						<th>ID</th>
						<th>Account Name</th>
						<th>Type</th>
						<th>Balance</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="read_data">
					
				</tbody>
			</table>
		</div>
		<div class="col-sm-3"></div>
	</div>

</body>
</html>
<script>
	$(document).ready(function(){
		readRecords();
		
	});
	
	function delete_record(id){
		var conf = confirm("Are you sure?");
		if (conf==true) {
			$.ajax({
				type:'GET',
				url:'account_delete.php',
				data:{delete:id},
				success: function(data){
					
					var test = jQuery.parseJSON(data);
					console.log(test);
					alert(test.msg);
					//jQuery("#ac_"+test.msg2).hide();
					readRecords();
				}

			})
		}
	}
	function readRecords(){
		$.ajax({
			type:'GET',
			url:'account_get.php',
			success: function(data){
				$('#read_data').html(data);
			}

		})
	}
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