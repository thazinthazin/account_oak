<?php
	require_once('../config.php');
	include('config.php');
	// $link = new mysqli("localhost", "root", "", "thuyeindb") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$name = $_POST['paymentnumber'];
	$totalamount = $_POST['netamount'];
	$headerdate = strtotime($_POST['headerdate']);
	$detaildate = strtotime($_POST['detailsdate']);
	$productid = $_POST['CourseClassID'];
	$userid = $_POST['LoginUserID'];
	$paymentid = $_POST['PaymentHeaderID'];
	$invoiceid = $_POST['PaymentDetailID'];
	$user_payamount = $_POST['user_payamount'];

	// $name = "P001";   // from REG form
	// $totalamount = 600000;   // from REG form (Course Fees)
	// $user_payamount = 200000;   // from REG form (Student Pay)
	// $date = strtotime(date("Y-m-d"));
	// $date = strtotime(date("2019-09-01"));   // for testing
	// $userid = 2;   // from REG form (login user id)
	// $productid = 10;   // from REG form
	// $paymentid = 1;    // from REG form
	// $invoiceid = 1;    // from REG form
	$journalid = 7;
	$defer_incomeid = 11;  // constant
	$receivable_accountid = 1;   // constant
	$cash_accountid = 5;   // constant
	$journalentryid = 0;    // constant
	$item_sql = "";

	$check_paymentno_sql = "SELECT * FROM `journal_entry` WHERE `name` = '$name'";
	$result = $link->query($check_paymentno_sql);

	if ($result->num_rows > 0) {
		echo "condition 1";
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        // echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
	        $journalentryid = $row["id"];
	        echo "Journal Entry ID for Payment is: " . $journalentryid;
	    }
	} else {
		echo "condition 2";
		$journalentryid = setEnroll($link,$name,$totalamount,$headerdate,$journalid,$userid,$productid,$paymentid,$invoiceid,$defer_incomeid,$receivable_accountid);
		echo "Journal Entry ID for Enroll is: " . $journalentryid;

		// account receivable amount
		$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
		VALUES ('$name','$productid','$totalamount','$receivable_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$headerdate');";

		// defer income amount
		$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
		VALUES ('$name','$productid','$totalamount','$defer_incomeid','$journalentryid','$journalid','$paymentid','$invoiceid','$headerdate');";
	}

	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$user_payamount','$receivable_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$detaildate');";

	$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
	VALUES ('$name','$productid','$user_payamount','$cash_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$detaildate');";

	echo " <br> SQL : " . $item_sql . "<br>";

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

	function setEnroll($link,$name,$totalamount,$headerdate,$journalid,$userid,$productid,$paymentid,$invoiceid,$defer_incomeid,$receivable_accountid){

		$sql = "INSERT INTO `journal_entry`(`name`,`date`,`journalid`,`userid`,`totalamount`) VALUES ('$name','$headerdate','$journalid','$userid','$totalamount');";

		if (mysqli_query($link, $sql)) {
		    $journalentryid = mysqli_insert_id($link);
		    echo "New record created successfully. Last inserted ID is: " . $journalentryid;
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}

		return $journalentryid;
	}
?>