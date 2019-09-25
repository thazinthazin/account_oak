<?php
	include 'config.php';

	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$name = "P002";   // from REG form
	$totalamount = 100000;   // from REG form (Course Fees)
	$user_payamount = 150000;   // from REG form (Student Pay)
	$date = strtotime(date("Y-m-d"));
	$journalid = 6;
	$userid = 2;   // from REG form (login user id)
 
	$check_paymentno_sql = "SELECT * FROM `journal_entry` WHERE `name` = '$name'";
	$result = $link->query($check_paymentno_sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        // echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
	        $journalentryid = $row["id"];
	        echo "Journal Entry ID for Payment is: " . $journalentryid;
	    }
	} else {
		$entry_sql = "INSERT INTO `journal_entry`( `name`, `date`, `totalamount`,`journalid`,`userid`) 
		VALUES ('$name','$date','$totalamount','$journalid','$userid')";

		if (mysqli_query($link, $entry_sql)) {
		    $journalentryid = mysqli_insert_id($link);
		    echo "New record created successfully. Journal Entry ID for Enroll is: " . $journalentryid;
		} else {
		    echo "Error: " . $entry_sql . "<br>" . mysqli_error($link);
		}
	}

	$productid = 10;   // from REG form
	$frequency = 1;  // from REG form
	$paymentid = 1;    // from REG form
	$invoiceid = 1;    // from REG form
	$item_sql = "";
	$cash_accountid = 3;  // constant
	$income_accountid = 4;  // constant
	$income_amount = $user_payamount;
	$lia_accountid = 5;   // constant
	$lia_amount = $totalamount;
	$receivable_accountid = 1;   // constant
	$receivable_amount = 0;

	// cash account
	$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
	VALUES ('$name','$productid','$totalamount','$cash_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

	if ($frequency == 1) {    
		// $totalamount == $user_payamount
		$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
		VALUES ('$name','$productid','$income_amount','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

		if ($totalamount > $user_payamount) {
			$receivable_amount = $totalamount - $user_payamount;
			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$name','$productid','$receivable_amount','$receivable_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";
		} else if ($totalamount < $user_payamount) {
			$receivable_amount = $user_payamount - $totalamount;
			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$name','$productid','$receivable_amount','$receivable_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";
		}
	 } 
	 else {
	 	$income_amount = $totalamount / $frequency;
	 	for ($i=0; $i < $frequency; $i++) { 
			// income account
			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$name','$productid','$income_amount','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

			$lia_amount -= $income_amount;
			// liability account
			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$name','$productid','$lia_amount','$lia_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";
	 	}
	}


	echo " <br> SQL : " . $item_sql . "<br>";

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

?>