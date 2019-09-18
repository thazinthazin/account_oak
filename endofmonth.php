<?php
	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	// $test_date = strtotime(date("2019-06-07"));
	// echo "Date >> " . $test_date; return 0;

	$date = strtotime(date("Y-m-d"));
	$income_accountid = 4;  // constant
	$defer_incomeid = 9;  // constant

	$item_sql = "";

	$sql = "SELECT entry.`name`,entry.`totalamount`,entry.`frequency`,entry.`id` AS journalentryid,item.`debit` AS user_payment,item.`journalid`,entry.`userid`,item.`productid`,item.`paymentid`,item.`invoiceid`,item.`id` AS itemid FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.`name` = entry.`name`
		WHERE FROM_UNIXTIME(item.`createdon`,'%Y-%m-%d') > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0 AND item.`eom_status`=0";

	$result = $link->query($sql);

	if ($result->num_rows > 0) {
		echo "condition 1";
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "Journal Entry ID for Payment is: " . $row["journalentryid"];

	        $cost_per_month = $row["totalamount"] / $row["frequency"];

	        // income amount
			$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			VALUES ('$row[name]','$row[productid]','$cost_per_month','$income_accountid','$row[journalentryid]','$row[journalid]','$row[paymentid]','$row[invoiceid]','$date');";

			// defer income amount
			$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			VALUES ('$row[name]','$row[productid]','$cost_per_month','$defer_incomeid','$row[journalentryid]','$row[journalid]','$row[paymentid]','$row[invoiceid]','$date');";

			$item_sql .= "UPDATE `journal_item` SET `eom_status`=1 WHERE id='$row[itemid]';";
	    }

	    echo " <br> SQL : " . $item_sql . "<br>";

		if (mysqli_multi_query($link, $item_sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		
	} else {
		echo "condition 2";
		
	}

	mysqli_close($link);

?>