<?php
include('conn.php');
include("login_check.php");
$query = "SELECT * FROM heads";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

?>
    <tr>
        <td><?php echo $row['h_id']; ?></td>
        <td><?php echo $row['h_name']; ?></td>
        <td>
            <a class="btn btn-info iframe" href="head_edit.php?id=<?php echo $row['h_id']; ?>">Edit</a> |
            <button class="btn btn-danger" type="button" onclick="delete_Headrecord(<?php echo $row['h_id']; ?>)">Delete</button>
        </td>
    </tr>
<?php
    }
} else {
    echo "0 results";
}
mysqli_close($conn);

?>
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