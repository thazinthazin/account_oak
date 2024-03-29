<?php

	require_once('../config.php');
	include('config.php');
	require_once($CFG->libdir . '/pagelib.php');
	global $PAGE;
	$PAGE->set_context(get_system_context());
	$PAGE->set_pagelayout('admin');
	$PAGE->set_title("End of Month");
	$PAGE->set_heading("End of Month");
	$PAGE->set_url($CFG->wwwroot.'/eom.php');

	$PAGE->navbar->ignore_active();
	$PAGE->navbar->add('End of Month', new moodle_url('eom.php'));

	echo $OUTPUT->header();

	$sql = "SELECT * FROM `eom_status` WHERE status=0";
  	$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>EOM Status</title>
	<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
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
<body>

	<h2>End Of Month Status</h2>

<form id="test-form" action="eom_query.php" method="post">
  <input type="hidden" name="formdata" id="formdata" value="">
  <table class="table table-bordered admintable generaltable" id="tbl">
  	<!-- <input type="hidden" name="data"> -->
    <thead>
      <tr>
    	<th>#</th>
        <th>Payment No</th>
        <th>Monthly Amount</th>
        <th>Date</th>
        <th><input type="checkbox" id="chkAll" onchange="checkAll(this)"/></th>
      </tr>
    </thead>
    <tbody>
    	<?php
			$count=1;
			while($row = mysqli_fetch_array($result)) { ?>
	      <tr id="6" role="row" class="odd">
	        <td data-content="ratio"><?php echo $count; ?></td>
	        <td class="sorting_1" data-content="domain" id="<?php echo $row['payment_no'] ?>"><?php echo $row['payment_no'] ?></td>
	        <td class="sorting_1" data-content="matched" id="<?php echo $row['monthly_amount'] ?>"><?php echo $row['monthly_amount'] ?></td>
	        <td class="sorting_1" data-content="matched" id="<?php echo $row['eom_date'] ?>"><?php echo $row['eom_date'] ?></td>
	        <td><input name="id[]" value="" type="checkbox"></td>
	      </tr>
	    <?php $count++; } ?>
    </tbody>
  </table>
  <button class="btn btn-primary" type="submit" value="save">Run EOM</button>
</form>

<?php 
// Close connection
mysqli_close($link);
echo $OUTPUT->footer();
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
	         // alert("All checked");
	     } else {
	         for (var i = 0; i < checkboxes.length; i++) {
	             console.log(i)
	             if (checkboxes[i].type == 'checkbox') {
	                 checkboxes[i].checked = false;
	             }
	         }
	         // alert("Unchecked");
	     }
	}
	// First, I'm stopping the default behaviors
	$("button").on("click", function(event){
	  event.stopPropagation();
	  event.preventDefault();
	});
	// Now, when we click save, I want to format
	//  a string.
	$("button[value='save']").on("click", function(){
	  var returnString = "";
	  
	  // The following selector gets all the rows
	  //   that have a CHECKED checkbox. Note I
	  //   don't get the checkbox, simply the row.
	  var rowEls = $("#test-form").find("tr:has(input[type='checkbox']:checked)");
	  
	  // For every row, we'll add to our string...
	  rowEls.each(function(){
        if ($("#chkAll").is(":checked")) {
        	// window.alert("check all");
        	$("#tbl tr:first").remove(); 
        	return;
        }
	    var rowEl = $(this);
	    
	    // First, a row id
	    // returnString += rowEl.attr("id")+" - ";
	    var cells = rowEl.children("td");
	    
	    // Next the contents of each cell THAT
	    //  HAS A data-content ATTRIBUTE. This
	    //  way, we don't get the remove/keep.
	    cells.each(function(){
          if ($(this).is(':first-child')) {return;}
	      else if($(this).data("content")){
	        // returnString += $(this).data("content")+"="+$(this).text();
	        returnString += $(this).text();
	         // if ($(this).is(':last-child')) {returnString += " | ";}
	        if ($(this).is(':nth-last-child(2)')) {returnString += "";}
	        else {returnString += ",";}
	      }
	    })
	    
	    returnString += "|";
	  })
	  
	  console.log(returnString);
	  $('#formdata').val(returnString);
	  $("#test-form").submit();
	    
	})
</script>

</body>
</html>