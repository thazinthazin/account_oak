<?php
	include 'config.php';

	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$journal_item = [];
	$name = $journal_item["name"] = "P002";   // from REG form
	$totalamount = $journal_item["totalamount"] = 300000;   // from REG form (Course Fees)
	$user_payamount = $journal_item["income_amount"] = 150000;   // from REG form (Student Pay)
	$date = strtotime(date("Y-m-d"));
	$journalid = $journal_item["journalid"] = 6;
	$userid = 2;   // from REG form (login user id)
	$frequency = 6;  // from REG form (class month)

	$journal_item["journalentryid"] = getJournalEntryID($link,$name,$date,$totalamount,$journalid,$userid);
	$journal_item["productid"] = 10;   // from REG form
	$journal_item["paymentid"] = 1;    // from REG form
	$journal_item["invoiceid"] = 1;    // from REG form
	$journal_item["cash_accountid"] = 3;  // constant
	$journal_item["income_accountid"] = 4;  // constant
	$journal_item["lia_accountid"] = 5;   // constant
	$journal_item["lia_amount"] = $totalamount;
	$journal_item["receivable_accountid"] = 1;   // constant
	$journal_item["receivable_amount"] = 0;
	$item_sql = "";

// echo "<br>Item :: ";
// print_r($journal_item);

	// cash account
	$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
	VALUES ('$journal_item[name]','$journal_item[productid]','$journal_item[totalamount]','$journal_item[cash_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";

	if ($frequency == 1) {    
		$item_sql .= monthlyPay($journal_item);
		// echo "<br>Item SQL :<br>" . $item_sql;
		// return 0;
	 } 
	 else {
	 	$item_sql .= prePay($journal_item,$frequency);
	}


	echo " <br> SQL : " . $item_sql . "<br>";

	if (mysqli_multi_query($link, $item_sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	mysqli_close($link);

	function getJournalEntryID($link,$name,$date,$totalamount,$journalid,$userid) {
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

		return $journalentryid;
	}

	function monthlyPay($journal_item) {
		$item_sql = "";
		$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
		VALUES ('$journal_item[name]','$journal_item[productid]','$journal_item[income_amount]','$journal_item[income_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";

		if ($journal_item["totalamount"] > $journal_item["income_amount"]) {
			$receivable_amount = $journal_item["totalamount"] - $journal_item["income_amount"];

			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$journal_item[name]','$journal_item[productid]','$receivable_amount','$journal_item[receivable_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";

		} else if ($journal_item["totalamount"] < $journal_item["income_amount"]) {
			$receivable_amount = $journal_item["income_amount"] - $journal_item["totalamount"];

			$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
			VALUES ('$journal_item[name]','$journal_item[productid]','$receivable_amount','$journal_item[receivable_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";
		}
		return $item_sql;
	}

	function prePay($journal_item,$frequency) {
		$item_sql = "";
	 	$journal_item["income_amount"] = $journal_item["totalamount"] / $frequency;
	 	$actual_cost_per_month = $journal_item["totalamount"] / $frequency;
	 	$new_frequency = $journal_item["income_amount"] / $actual_cost_per_month;
	 	$diff_amount = $journal_item["totalamount"] - $journal_item["income_amount"];

	 	if (($diff_amount > 0) && ($frequency != $new_frequency)) {
	 		$journal_item["totalamount"] = $journal_item["income_amount"];

	 		$item_sql .= prePay($journal_item,$new_frequency);
	 	} else {
		 	for ($i=0; $i < $frequency; $i++) { 
				// income account
				$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
				VALUES ('$journal_item[name]','$journal_item[productid]','$journal_item[income_amount]','$journal_item[income_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";

				$journal_item["lia_amount"] -= $journal_item["income_amount"];
				// liability account
				$item_sql .= "INSERT INTO `journal_item`( `name`, `productid`, `credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`)
				VALUES ('$journal_item[name]','$journal_item[productid]','$journal_item[lia_amount]','$journal_item[lia_accountid]','$journal_item[journalentryid]','$journal_item[journalid]','$journal_item[paymentid]','$journal_item[invoiceid]');";
		 	}
	 	}
	 	return $item_sql;
	}

?>