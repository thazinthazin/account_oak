<?php
  $link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $link -> error);

  	echo "Connected Successfully.<br>";
  	echo "Form Data >> " . $_POST["formdata"];

	$form_data = $_POST["formdata"];
	$temp_row = explode('|', $form_data);
	$row = [];

	for ($i=0; $i < count($temp_row)-1; $i++) { 
		echo "i : value >> " . $i . "<br/>";
		$row[$i] = explode(',', $temp_row[$i]);
		foreach ($row[$i] as $value) {
			echo "VAlue >> " . $value . "<br/>";
		}
	}
	return 0;

    // Check if form is submitted successfully 
   //  if(isset($_POST["submit"]))  
   //  { 
   //      // Check if any option is selected 
   //      if(isset($_POST["stdid"]) && ($_POST["name"]) && ($_POST["amount"]) && ($_POST["createdon"]))
   //      { 
   //      	$name = $_POST["name"];
   //      	$credit = $_POST["amount"];
   //      	$debit = $_POST["amount"];
   //      	$date = $_POST["createdon"];
   //      	$income_accountid = 4;  // constant
			// $defer_incomeid = 9;  // constant
			// $productid = 1;  // constant
			// $journalid = 1;  // constant
			// $paymentid = 1;  // constant
			// $invoiceid = 1;  // constant
			// $journalentryid = 0;

			// $item_sql = "";

   //          // Retrieving each selected option 
   //          for ($i=0; $i < sizeof($_POST["stdid"]); $i++) {

   //          	$check_paymentno_sql = "SELECT * FROM `journal_entry` WHERE `name` = '$name[$i]' ORDER BY id DESC LIMIT 1";
   //          	$result = $link->query($check_paymentno_sql);

			// 	if ($result->num_rows > 0) {
			// 	    // output data of each row
			// 	    while($row = $result->fetch_assoc()) {
			// 	        $journalentryid = $row["id"];
	  //       			echo "Journal Entry ID for Payment is: " . $journalentryid;
			// 	    }
			// 	}
            	      			
	  //     		// income amount
			// 	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			// 	VALUES ('$name[$i]','$productid','$credit[$i]','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date[$i]');";

			// 	// defer income amount
			// 	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			// 	VALUES ('$name[$i]','$productid','$debit[$i]','$defer_incomeid','$journalentryid','$journalid','$paymentid','$invoiceid','$date[$i]');";

			// 	$journalentryid = 0;
   //          }
   //          echo " <br> SQL : " . $item_sql . "<br>";

			// if (mysqli_multi_query($link, $item_sql)) {
			// 	echo json_encode(array("statusCode"=>200));
			// } 
			// else {
			// 	echo json_encode(array("statusCode"=>201));
			// }

			// mysqli_close($link);
   //      } 
   //  else
   //      echo "Select an option first !!"; 
   //  } 
   //  return 0;

?>
