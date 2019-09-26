<?php

$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $link -> error);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
	$sql = "SELECT `id`, `name`, `amount`, `createdon` FROM `journal_type`";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){ 
	?>

	<form action="eom_query.php" method="post">
	<input type="hidden" name="hidPaymentRowIndex" id="hidPaymentRowIndex" value=""/>

		<table class="admintable generaltable" id="tbl_sss">
			<thead>
				<tr>
					<th><input type="checkbox" id="chkAll" onchange="checkAll(this)" name="chk[]"/></th>
	            	<th>#</th>
	                <th>Name</th>
	                <th>Amount</th>
	                <th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count=1;
				while($row = mysqli_fetch_array($result)){ ?>
	                <tr>
	                    <td><input type ="checkbox" class="checkbox" id="<?php echo $row['id'] ?>" name="rowid[]" onclick="PayStatusChanged()" /> </td>
	                    <td><?php echo $count; ?></td>
	                    <td><?php echo $row['name'] ?><input type="hidden" name="name[]" value="<?php echo $row['name'] ?>"></td>
	                    <td><?php echo $row['amount'] ?><input type="hidden" name="amount[]" value="<?php echo $row['amount'] ?>"></td>
	                    <td><?php echo $row['createdon'] ?><input type="hidden" name="createdon[]" value="<?php echo $row['createdon'] ?>"></td>
	                </tr>
	            <?php $count++; } ?>
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
     function checkAll(ele) {
	     var checkboxes = document.getElementsByTagName('input');
	     if (ele.checked) {
	         for (var i = 0; i < checkboxes.length; i++) {
	             if (checkboxes[i].type == 'checkbox') {
	                 checkboxes[i].checked = true;
	             }
	         }
	         alert("All checked");
	     } else {
	         for (var i = 0; i < checkboxes.length; i++) {
	             console.log(i)
	             if (checkboxes[i].type == 'checkbox') {
	                 checkboxes[i].checked = false;
	             }
	         }
	         alert("Unchecked");
	     }
	 }

	function PayStatusChanged() {
        //Reference the Table.
        var grid = document.getElementById("tbl_sss");
        var checkall = document.getElementById("chkAll");
        
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
        var message = "Name\n";
        var checkStatus = 0;
 
        //Loop through the checkBoxes.
        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
                message += row.cells[2].innerHTML;
                message += "\n";
                checkStatus += 1;
            }
        }
        if (checkStatus == (checkBoxes.length-1)) {
        	checkall.checked = true;
        } else if (checkall.checked) {
        	checkall.checked = false;
        }
        alert(message + "Status" + checkStatus + "length" + checkBoxes.length);
    }

 //    var dataString = "name=" + name + "&amount=" + amount + "&createdon=" + createdon + text;

	// $.ajax({  
	//   	url:"endofmonth_query.php",  
	//   	method:"POST",  
	//   	data:dataString,
	//   	success:function(data){ 
	//   		jsonData = JSON.parse(data);
	//   		alert(jsonData);
	// 	} 
	// });

// function 
// function PayStatusChanged(a)
// {
//     if(a.checked == true)
//     {
//     	var table = document.getElementById("tbl_sss");
// 		var rowId = a.parentNode.parentNode.rowIndex;
// 		var datas =document.getElementById("tbl_sss").rows[rowId].cells[2].innerHTML;
		
//         var selectobject=document.getElementById("hidPaymentRowIndex");
//         var selectedrowindxs=$('#hidPaymentRowIndex').val();
//         if(selectedrowindxs==="")
//         {
//             selectobject.value=datas;
//         }
//         else
//         {
//             selectobject.value=selectedrowindxs+","+datas;
//         }
//     }
//     else if(a.checked == false)
//     {
//     	var table = document.getElementById("tbl_sss");
//         var rowId = a.parentNode.parentNode.rowIndex;
//         var datas =document.getElementById("tbl_sss").rows[rowId].cells[2].innerHTML;
        
//         var selectobject=document.getElementById("hidPaymentRowIndex");
//         var selectedrowindxs=$('#hidPaymentRowIndex').val();
//         var str_arr = selectedrowindxs.split(",");
// 		var arr = selectedrowindxs.split(",");
// 		for( var i = 0; i < arr.length; i++){ 
// 		   if ( Number(arr[i])  ===Number(datas)) {
// 			 arr.splice(i, 1); 
// 		   }
// 		}
//         selectobject.value=arr.join();
//     }
//     alert($('#hidPaymentRowIndex').val());
// }

</script>

</body>
</html>
