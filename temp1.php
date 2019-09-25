<?php
	include 'config.php';

	// $conn = OpenCon();
	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$name = "P001";   // from REG form
	$totalamount = 1200000;   // from REG form
	$date = strtotime(date("Y-m-d"));
	$journalid = 6;
	$userid = 2;   // from REG form

	// echo $date;
	// return 0;

	$entry_sql = "INSERT INTO `journal_entry`( `name`, `date`, `totalamount`,`journalid`,`userid`) 
	VALUES ('$name','$date','$totalamount','$journalid','$userid')";

	if (mysqli_query($link, $entry_sql)) {
	    $journalentryid = mysqli_insert_id($link);
	    echo "New record created successfully. Last inserted ID is: " . $journalentryid;
	} else {
	    echo "Error: " . $entry_sql . "<br>" . mysqli_error($link);
	}

	$productid = 10;   // from REG form
	$frequency = 12;  // from REG form
	$debit = $credit = $totalamount / $frequency;
	$dr_accountid = 3;    // from REG form
	$cr_accountid = 4;    // from REG form
	$paymentid = 1;    // from REG form
	$invoiceid = 1;    // from REG form
	$item_sql = "";

	for ($i=0; $i < $frequency; $i++) { 
		$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
		VALUES ('$name','$productid','$debit','$dr_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

		$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
		VALUES ('$name','$productid','$credit','$cr_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";
	}

	$cash_accountid = 3;  // constant
	// cash account
	$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
	VALUES ('$name','$productid','$totalamount','$cash_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

	$income_accountid = 4;  // constant
	$income_amount = $credit;
	// income account
	$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
	VALUES ('$name','$productid','$income_amount','$income_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

	$lia_accountid = 5;   // constant
	$lia_amount = $totalamount - $income_amount;
	// liability account
	$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
	VALUES ('$name','$productid','$lia_amount','$lia_accountid','$journalentryid','$journalid','$paymentid','$invoiceid');";

	echo " <br> SQL : " . $item_sql;

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

	// CloseCon($conn);
?>