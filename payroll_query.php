<?php

	// $link = new mysqli("localhost", "root", "", "thuyeindb") or die("Connect failed: %s\n". $conn -> error);
	include('config.php');
	echo "Connected Successfully.<br>";

	$name = $_POST['name'];
	$totalamount = $_POST['total_amount'];
	$date = $_POST['date'];
	$userid = $_POST['loginuserid'];
	$productid = $_POST['productid'];
	$paymentid = $_POST['paymentid'];
	$invoiceid = $_POST['invoiceid'];

	// $name = "U001";   // from REG form
	// $totalamount = 600000;   // from REG form (Course Fees)
	// $date = strtotime(date("Y-m-d"));
	// $userid = 5;   // from REG form (login user id)
	// $productid = 1;   // from REG form
	// $paymentid = 1;   // from REG form
	// $invoiceid = 1;   // from REG form

	$journalid = 9;
	$cash_accountid = 5;  // constant
	$expense_accountid = 3;   // constant
	$journalentryid = 0; 

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
		$journalentryid = setEnroll($link,$name,$totalamount,$date,$journalid,$userid,$productid,$paymentid,$invoiceid,$cash_accountid,$expense_accountid);
		echo "Journal Entry ID for Enroll is: " . $journalentryid;
	}

	mysqli_close($link);

	function setEnroll($link,$name,$totalamount,$date,$journalid,$userid,$productid,$paymentid,$invoiceid,$cash_accountid,$expense_accountid){

		$sql = "INSERT INTO `journal_entry`(`name`,`date`,`journalid`,`userid`,`totalamount`) VALUES ('$name','$date','$journalid','$userid','$totalamount');";

		if (mysqli_query($link, $sql)) {
		    $journalentryid = mysqli_insert_id($link);
		    echo "New record created successfully. Last inserted ID is: " . $journalentryid;
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}

		$item_sql = "";

		// account receivable amount
		$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
		VALUES ('$name','$productid','$totalamount','$expense_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

		// defer income amount
		$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
		VALUES ('$name','$productid','$totalamount','$cash_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

		echo " <br> SQL : " . $item_sql . "<br>";

		if (mysqli_multi_query($link, $item_sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}

		return $journalentryid;
	}
?>