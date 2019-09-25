<?php
	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$name = "P001";   // from REG form
	$totalamount = 600000;   // from REG form (Course Fees)
	$user_payamount = 100000;   // from REG form (Student Pay)
	$frequency = 6;   // from REG form
	$date = strtotime(date("Y-m-d"));
	$journalid = 7;
	$userid = 2;   // from REG form (login user id)
	$productid = 10;   // from REG form
	$paymentid = 1;    // from REG form
	$invoiceid = 1;    // from REG form

	$income_accountid = 4;  // constant
	$defer_incomeid = 9;  // constant
	$receivable_accountid = 1;   // constant
	$cash_accountid = 3;   // constant
	$journalentryid = 1;    // constant

	$cost_per_month = $totalamount / $frequency;
	$item_sql = "";

	// income amount
	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$cost_per_month','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

	// defer income amount
	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$cost_per_month','$defer_incomeid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

	echo " <br> SQL : " . $item_sql . "<br>";

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

?>