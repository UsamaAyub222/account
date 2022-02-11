<?php
include('conn.php');
include("login_check.php");
include('menue.php');
?>

<div class="row" style="padding-top: 20px;">
	<div class="col-sm-3"></div>
	<div class="col-sm-6" >
		<form class="form-inline justify-content-end">
			<label for="fdate" class="mr-sm-2">From:</label>
			<input type="date" class="form-control mb-2 mr-sm-2" id="fdate" name="fdate">
			<label for="tdate" class="mr-sm-2">To:</label>
			<input type="date" class="form-control mb-2 mr-sm-2" id="tdate" name="tdate">
			
			<button type="button" onclick="head_record()" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
		</form>
		
		<table class="table table-hover" id="report_detail">

		</table>

	</div>	
	<div class="col-sm-3"></div>
</div>

</body>
</html>

<script>
	

	function head_record(){
		var fromd = $("#fdate").val();
		var tod = $("#tdate").val();
		var sort = $(".active").attr('data22');
        $.ajax({
			type:'GET',
			url:'h_report_get.php',
			data:{
				f_date:fromd,
				to_date:tod,
                sd:sort
			},
			success: function(data){
				if (data) {
					$('#report_detail').html(data);
				}
				else
				{
					alert("Failed");
				}
			}

		})
	}
	$(document).ready(function(){
       
        $(document).on("click",".my_arrow",function (){
            
            $(".my_arrow").removeClass("active");
            $(this).addClass("active");
            $(this).css("cssText","color: red !important");
            head_record();
        });
        head_record();
		
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
