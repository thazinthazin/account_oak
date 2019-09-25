<?php
	$name = "P001";   // from REG form
	$totalamount = 600000;   // from REG form (Course Fees)
	$frequency = 6;    // from REG form

	// $date = strtotime(date("Y-m-d"));
	$date = strtotime(date("2019-09-01"));   // for testing

	$journalid = 7;
	$userid = 2;   // from REG form (login user id)
	$productid = 10;   // from REG form
	$paymentid = 1;    // from REG form
	$invoiceid = 1;    // from REG form
	$defer_incomeid = 9;  // constant
	$receivable_accountid = 1;   // constant

	setEnroll($name,$totalamount,$date,$journalid,$userid,$productid,$paymentid,$invoiceid,$defer_incomeid,$receivable_accountid,$frequency);

	function setEnroll($name,$totalamount,$date,$journalid,$userid,$productid,$paymentid,$invoiceid,$defer_incomeid,$receivable_accountid,$frequency){
		$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

		$sql = "INSERT INTO `journal_entry`(`name`,`date`,`journalid`,`userid`,`totalamount`,`frequency`) VALUES ('$name','$date','$journalid','$userid','$totalamount','$frequency');";

	if (mysqli_query($link, $sql)) {
	    $journalentryid = mysqli_insert_id($link);
	    echo "New record created successfully. Last inserted ID is: " . $journalentryid;
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

	$item_sql = "";

	// account receivable amount
	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$totalamount','$receivable_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

	// defer income amount
	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$totalamount','$defer_incomeid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

	echo " <br> SQL : " . $item_sql . "<br>";

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

	//return $journalentryid;
	}


?>