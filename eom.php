<?php

$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $link -> error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<style type="text/css">
h2 {
  display: inline-block;
  text-align: left;
  font-weight: 700;
  font-size: 1.875rem;
  margin-bottom: .5rem;
  font-family: inherit;
  line-height: 1.2;
  color: inherit;
}
th {
    text-align: inherit;
    color: #306136;
}
</style>
</head>
<body>

    <h2>End Of Month Status</h2>

	<?php 
	// Check connection
	if($link === false){
		 die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	// Attempt select query execution
	$sql = "SELECT pd.`id`, pd.`title`, pd.`payableamount`, pd.`createdon` FROM `payment_details`AS pd";

	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){ 
	?>

	<form action="eom_query.php" method="post">
		<!-- <input type="hidden" name="rowid[]" value="true" /> -->

		<table class="admintable generaltable">
			<thead>
				<tr>
					<th><input type="checkbox" id="checkAll"/></th>
	            	<th>#</th>
	                <th>Name</th>
	                <th>Amount</th>
	                <th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($row = mysqli_fetch_array($result)){ ?>
	                <tr>
	                    <td><input type ="checkbox" class="checkbox" id="<?php echo $row['id'] ?>" name="rowid[]" /> </td>
	                    <td><?php echo $row['id'] ?><input type="hidden" name="stdid[]" value="<?php echo $row['id'] ?>"></td>
	                    <td><?php echo $row['title'] ?><input type="hidden" name="title[]" value="<?php echo $row['title'] ?>"></td>
	                    <td><?php echo $row['payableamount'] ?><input type="hidden" name="payableamount[]" value="<?php echo $row['payableamount'] ?>"></td>
	                    <td><?php echo $row['createdon'] ?><input type="hidden" name="createdon[]" value="<?php echo $row['createdon'] ?>"></td>
	                </tr>
	            <?php } ?>
			</tbody>
		</table>

		<button type="submit" class="btn btn-primary" id="submit" name="submit">Run EOM</button>
	</form>

<?php 
	// Free result set
	mysqli_free_result($result);
} else{
 	echo "<em>No records were found.</em>";
}} else{
  	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
 }

 // Close connection
 mysqli_close($link);

?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#checkAll').click(function(){
			if (this.checked) {
				$('.checkbox').each(function(){
					this.checked = true;
				});
			} else {
				$('.checkbox').each(function(){
					this.checked = false;
				});
			}
		});
	});

</script>

</body>
</html>