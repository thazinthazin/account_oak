<?php

require_once('../config.php');
include('config.php');
require_once($CFG->libdir . '/pagelib.php');
global $PAGE;
$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("End of Month");
$PAGE->set_heading("End of Month");
$PAGE->set_url($CFG->wwwroot.'/endofmonth.php');

$PAGE->navbar->ignore_active();
$PAGE->navbar->add('End of Month', new moodle_url('endofmonth.php'));

echo $OUTPUT->header();
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
	$sql = "SELECT `id`, `payment_no`, `monthly_amount`, `eom_date`, `status` FROM `eom_status`";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){ 
	?>

	<form action="" method="post">
	<input type="hidden" name="hidPaymentRowIndex" id="hidPaymentRowIndex" value=""/>

		<table class="admintable generaltable" id="tbl_sss">
			<thead>
				<tr>
					<th><input type="checkbox" id="chkAll" onchange="checkAll(this)" name="chk[]"/></th>
	            	<th>#</th>
	                <th>Name</th>
	                <th>Monthly Amount</th>
	                <th>Date</th>
	                <th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count=1;
				while($row = mysqli_fetch_array($result)) { ?>
	                <tr>
	                    <td><input type ="checkbox" class="checkbox" id="<?php echo $row['id'] ?>" name="rowid[]" onchange="PayStatusChanged(this)" /></td>
	                    <td><?php echo $count; ?></td>
	                    <td><?php echo $row['payment_no'] ?><input type ="hidden" id="<?php echo $row['payment_no'] ?>" /></td>
	                    <td><?php echo $row['monthly_amount'] ?><input type ="hidden" id="<?php echo $row['monthly_amount'] ?>" /></td>
	                    <td><?php echo $row['eom_date'] ?><input type ="hidden" id="<?php echo $row['eom_date'] ?>" /></td>
	                    <td><?php echo $row['status'] ?><input type ="hidden" id="<?php echo $row['status'] ?>" /></td>
	                </tr>
	            <?php $count++; } ?>
			</tbody>
		</table>

		<button type="submit" class="btn btn-primary" id="submit" name="submit" onclick="return val()">Run EOM</button>
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

// function 
function PayStatusChanged(a)
{
    if(a.checked == true)
    {
    	var table = document.getElementById("tbl_sss");
		var rowId = a.parentNode.parentNode.rowIndex;
		
		var datas =document.getElementById("tbl_sss").rows[rowId].cells[2].innerHTML;
		
        var selectobject=document.getElementById("hidPaymentRowIndex");
        var selectedrowindxs=$('#hidPaymentRowIndex').val();
        if(selectedrowindxs==="")
        {
            selectobject.value=datas;
        }
        else
        {
            selectobject.value=selectedrowindxs+","+datas;
        }
    }
    else if(a.checked == false)
    {
    	var table = document.getElementById("tbl_sss");
        var rowId = a.parentNode.parentNode.rowIndex;

        var datas =document.getElementById("tbl_sss").rows[rowId].cells[2].innerHTML;
        
        var selectobject=document.getElementById("hidPaymentRowIndex");
        var selectedrowindxs=$('#hidPaymentRowIndex').val();
        var str_arr = selectedrowindxs.split(",");
		var arr = selectedrowindxs.split(",");

		for( var i = 0; i < arr.length; i++){ 
		   if ( Number(arr[i])  ===Number(datas)) {
			 arr.splice(i, 1); 
		   }
		}
        selectobject.value=arr.join();
    }
    alert($('#hidPaymentRowIndex').val());
}

function val()
{
    var payment_no=document.getElementById("payment_no").value;
    var monthly_amount=document.getElementById("monthly_amount").value;
    var eom_date=document.getElementById("eom_date").value;
    if(payment_no == '')
    {
        alert(payment_no+" is empty");
    }
    else
    {
	    $.ajax({
	        type:"POST",
	        url:"endofmonth_query.php",
	        data: "{'payment_no':'" + payment_no + "','monthly_amount':'" + monthly_amount + "','eom_date':'" + eom_date + "'}",
	        cache:false,
	        success:function(html){
	            alert(data);
	        }
	    });
    }
return false;
}

</script>

</body>
</html>
