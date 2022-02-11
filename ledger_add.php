<?php
include('conn.php');
include("login_check.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Create Ledger</title>
	<?php 
	include('head.php');
	?>

</head>
<body>
	<?php 

	$query = "SELECT * FROM accounts";
	$result = mysqli_query($conn,$query);
	$result2 = mysqli_query($conn,$query);

	?>

	<div class="row" style="padding-top: 10px;">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<form id="abc22">
				<div class="form-group">
					<label for="cr">Credit Account:</label>
					<select class="form-control" id="cr" name="cr">
						<option value="" selected disabled placeholder="Select Credit Account">Select Credit Account</option>
						<?php
						if (mysqli_num_rows($result2)>0) 
						{
							while ($row = mysqli_fetch_assoc($result2)) {
								?>
								<option id="cr_row" value="<?php echo $row['ac_id']; ?>"><?php echo $row['ac_name']; ?></option>
								<?php 
							}
						}
						?>
					</select>
					<p id="balance_cr" class="alert alert-info" style="padding:0px;"></p>
				</div>
				<div class="form-group">
					<label for="dr">Debit Account:</label>
					<select class="form-control" id="dr" name="dr">
						<option value="" selected disabled placeholder="Select Debit Account">Select Debit Account</option>
						<?php 
						if (mysqli_num_rows($result)>0) 
						{
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<option value="<?php echo $row['ac_id']; ?>"><?php echo $row['ac_name']; ?></option>
								<?php 
							}
						}
						?>
					</select>
					<p id="balance_dr" class="alert alert-info" style="padding:0px;"></p>
				</div>
				<div class="form-group">
					<label for="head_name">Head Name:</label>
					<select class="form-control" id="head_name" name="head_name">
						<option value="" selected disabled>Select Head...</option>
						<?php 
						$h_query = "SELECT * FROM heads";
						$h_result = mysqli_query($conn,$h_query);
						if (mysqli_num_rows($h_result)>0) 
						{
							while ($h_row = mysqli_fetch_assoc($h_result)) 
							{

								?>
								<option value="<?php echo $h_row['h_id']?>"> <?php echo $h_row['h_name']?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				
				<div class="form-group">
					<label for="amount">Amount:</label>
					<input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount">
					<p id="convert"></p>
				</div>
				<div class="form-group">
					<label for="description">Description:</label>
					<textarea type="text" class="form-control" placeholder="Enter Description..." id="description" name="description"></textarea>
				</div>
				<button name="submit" id="save" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
	<?php 
	mysqli_close($conn);
	?>
</body>
</html>
<script>
	$(document).ready(function(){
		$("#balance_cr").hide();
		$("#balance_dr").hide();
		var selectedCredit;
		var balance_amount;
		$("select#cr").change(function(){
			selectedCredit = $(this).children("option:selected").val();
			$.ajax({
				type:'GET',
				url:'get_balance.php',
				data:{balanceid:selectedCredit},
				success: function(data)
				{
					balance_amount = parseInt(data);
					$("#balance_cr").show();
					$("#balance_cr").text("Remaining Balance : "+data);
				}
			})
		});

		$("select#dr").change(function(){
			var selectedDebit = $(this).children("option:selected").val();
			if(selectedDebit!=selectedCredit){
				$.ajax({
					type:'GET',
					url:'get_balance.php',
					data:{balanceid:selectedDebit},
					success: function(data)
					{
						$("#balance_dr").show();
						$("#balance_dr").text("Remaining Balance : "+data);	
					}	

				})
			}
			else{
				alert("Select different account.");
				$("#dr").val("");
			}


		});

		$("#amount").on("keyup",function(){
			
			var amount = parseInt($("#amount").val());

			if (balance_amount<=amount) {
				var conf = confirm("Are you sure?");
				if (conf==true) {
					var words = toWords($("#amount").val());
					$("#convert").text(words.toUpperCase());
				}
				else{
					$("#amount").val("");
				}

			}
			else
			{
				var words = toWords($("#amount").val());
				$("#convert").text(words.toUpperCase());
			}
			
		});

		$("#save").click(function() {
			
			$.ajax({
				type:'POST',
				url:'ledger_save.php',
				data:$("#abc22").serialize(),
				success: function(data){
					if (data) {
						var test = jQuery.parseJSON(data);
						console.log(test);
						alert(test.msg);
						parent.$.colorbox.close();
						parent.search_record();

					}
					else
					{
						alert("Failed");
					}
				}

			})
		});



});
			// convert number to words
		var th = ['', 'thousand', 'million', 'billion', 'trillion'];
		var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
		var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
		var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

		function toWords(s) 
		{

			s = s.toString();
			s = s.replace(/[\, ]/g, '');
			if (s != parseFloat(s)) return 'not a number';
			var x = s.indexOf('.');
			var fulllength=s.length;

			if (x == -1) x = s.length;
			if (x > 15) return 'too big';
			var startpos=fulllength-(fulllength-x-1);
			var n = s.split('');

			var str = '';
    		var str1 = ''; //i added another word called cent
    		var sk = 0;
    		for (var i = 0; i < x; i++) 
    		{
    		if ((x - i) % 3 == 2) {
    		if (n[i] == '1') {
    			str += tn[Number(n[i + 1])] + ' ';
    			i++;
    			sk = 1;
    		} else if (n[i] != 0) {
    			str += tw[n[i] - 2] + ' ';

    			sk = 1;
    		}
    	} else if (n[i] != 0) {
    		str += dg[n[i]] + ' ';
    		if ((x - i) % 3 == 0) str += 'hundred ';
    		sk = 1;
    	}
    	if ((x - i) % 3 == 1) {
    		if (sk) str += th[(x - i - 1) / 3] + ' ';
    		sk = 0;
    	}
    }
    if (x != s.length) {

        str += 'and '; //i change the word point to and 
        str1 += 'cents '; //i added another word called cent
        //for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ' ;
        var j=startpos;

        for (var i = j; i < fulllength; i++) {

        	if ((fulllength - i) % 3 == 2) {
        		if (n[i] == '1') {
        			str += tn[Number(n[i + 1])] + ' ';
        			i++;
        			sk = 1;
        		} else if (n[i] != 0) {
        			str += tw[n[i] - 2] + ' ';

        			sk = 1;
        		}
        	} else if (n[i] != 0) {

        		str += dg[n[i]] + ' ';
        		if ((fulllength - i) % 3 == 0) str += 'hundred ';
        		sk = 1;
        	}
        	if ((fulllength - i) % 3 == 1) {

        		if (sk) str += th[(fulllength - i - 1) / 3] + ' ';
        		sk = 0;
        	}
        }
    }
    var result=str.replace(/\s+/g, ' ') + str1;
    //return str.replace(/\s+/g, ' ');
    //$('.res').text(result);
    return result; //i added the word cent to the last part of the return value to get desired output

}
</script>

