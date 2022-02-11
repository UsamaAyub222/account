<?php
include('conn.php');
include("login_check.php");

?>


<thead class="table-primary">
	<tr>
		<th>Head</th>
		<th>Amount  <a class="my_arrow" data22="ASC"><i class="fas fa-arrow-up"></i></a>  <a class="my_arrow active" data22="DESC   " ><i class="fas fa-arrow-down"></i></a></th>
	</tr>
</thead>
<tbody>
	<?php
	$cond = '';
	if (isset($_GET['f_date']) and $_GET['f_date'] != "" and isset($_GET['to_date']) and $_GET['to_date'] != "") {
		$cond .= " and ledgers.led_date BETWEEN '" . $_GET['f_date'] . "' AND '" . $_GET['to_date'] . "'";
	} 
    else {
		$cond .= " and ledgers.led_date=CURDATE()";
	}

	//WHERE 1 = empty;
    
    $sort = $_GET['sd'];

    $query = "SELECT heads.h_name as Head, SUM(ledgers.amount) as Expense  FROM ledgers JOIN heads ON ledgers.head=heads.h_id WHERE 1 " . $cond . "GROUP BY heads.h_name ORDER BY Expense ".$sort;
    $result = mysqli_query($conn, $query);
    
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {

	?>
			<tr>
				<td><?php echo $row['Head']; ?></td>
				<td><?php echo number_format($row['Expense']); ?></td>				
			</tr>
	<?php

		}
	} else {
		echo "0 results";
	}
	mysqli_close($conn);

	?>
</tbody>


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