<?php
include('conn.php');
include("login_check.php");
include('menue.php');
?>



<div class="justify-content-end" style="padding: 10px;">
	<a href="<?php echo $config['base_url']; ?>/ledger_add.php" class="btn btn-primary iframe" role="button" title="Add Ledger" style="float: right;"><i class="fas fa-plus"></i></a>	
</div>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10" >
		<form class="form-inline justify-content-end">
			<label for="fdate" class="mr-sm-2">From:</label>
			<input type="date" class="form-control mb-2 mr-sm-2" id="fdate" name="fdate">
			<label for="tdate" class="mr-sm-2">To:</label>
			<input type="date" class="form-control mb-2 mr-sm-2" id="tdate" name="tdate">
			<label for="account" class="mr-sm-2">Account:</label>
			<select class="form-control mb-2 mr-sm-2" id="getid" name="s_account">
				<option value="">Select Account..</option>
				<?php 
				$query2 = "SELECT * FROM accounts";
				$search = mysqli_query($conn,$query2);
				if (mysqli_num_rows($search)>0) 
				{
					while($s = mysqli_fetch_assoc($search))
					{
						?>
						<option value="<?php echo $s['ac_id'] ?>" ><?php echo $s['ac_name'] ?></option>
						<?php 
					}
				}
				?>
			</select>
			<button type="button" onclick="search_record()" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
		</form>
		
		<table class="table table-hover" id="get_detail">

		</table>

	</div>	
	<div class="col-sm-1"></div>
</div>

</body>
</html>

<script>
	function readLedgers(){
		$.ajax({
			type:'GET',
			url:'ledgers_get.php',
			success: function(data){
				if(data){
					$('#get_detail').html(data);
				}
				
			}

		})
	}

	function search_record(){
		var id = $("#getid").val();
		var fromd = $("#fdate").val();
		var tod = $("#tdate").val();
		
		$.ajax({
			type:'GET',
			url:'ledgers_get.php',
			data:{
				s_account:id,
				f_date:fromd,
				to_date:tod
			},
			success: function(data){
				if (data) {
					$('#get_detail').html(data);
				}
				else
				{
					alert("Failed");
				}
			}

		})
	}
	$(document).ready(function(){

		search_record();
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
