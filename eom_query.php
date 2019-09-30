<?php
  // $link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $link -> error);
  include('config.php');

  $sql = "SELECT * FROM `eom_status`";
  $result = mysqli_query($link, $sql);
        	
  echo "Connected Successfully.<br>";

    // Check if form is submitted successfully 
    if(isset($_POST["submit"]))  
    { 
        // Check if any option is selected 
        if(isset($_POST["payment_no"]) && ($_POST["monthly_amount"]) && ($_POST["eom_date"]))
        { 
        	$name = $_POST["payment_no"];
        	$credit = $_POST["monthly_amount"];
        	$debit = $_POST["monthly_amount"];
        	$date = $_POST["eom_date"];
        	$income_accountid = 4;  // constant
			$defer_incomeid = 9;  // constant
			$productid = 1;  // constant
			$journalid = 1;  // constant
			$paymentid = 1;  // constant
			$invoiceid = 1;  // constant
			$journalentryid = 0;
			$item_sql = "";
            // Retrieving each selected option 
            for ($i=0; $i < sizeof($_POST["name"]); $i++) {
            	$check_paymentno_sql = "SELECT * FROM `journal_entry` WHERE `name` = '$name[$i]' ORDER BY id DESC LIMIT 1";
            	$result = $link->query($check_paymentno_sql);
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        $journalentryid = $row["id"];
	        			echo "Journal Entry ID for Payment is: " . $journalentryid;
				    }
				}
            	      			
	      		// income amount
				$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
				VALUES ('$name','$productid','$credit','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";
				// defer income amount
				$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
				VALUES ('$name','$productid','$debit','$defer_incomeid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";
				$journalentryid = 0;
            }
            echo " <br> SQL : " . $item_sql . "<br>";
			if (mysqli_multi_query($link, $item_sql)) {
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>201));
			}
			mysqli_close($link);
        } 
    else
        echo "Select an option first !!"; 
    } 
    return 0;
?>
