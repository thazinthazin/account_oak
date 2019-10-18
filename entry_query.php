<?php

	// $link = new mysqli("localhost", "root", "", "thuyeindb") or die("Connect failed: %s\n". $conn -> error);
	include('config.php');
	// echo "Connected Successfully.<br>";

	    // Check if form is submitted successfully 
    if(isset($_POST["submit"]))
    { 
        // Check if any option is selected 
        if(isset($_POST["Description1"]) && ($_POST["Amount1"]) && ($_POST["Date1"]) && ($_POST["Journal1"]))
        { 

			$name = $_POST['Description1'];
			$totalamount = $_POST['Amount1'];
			$date = strtotime($_POST['Date1']);
			$journalid = $_POST['Journal1'];
			$userid = 2;
			$productid = $paymentid = $invoiceid = 1;
			$cash_accountid = 5;  // constant
			$expense_accountid = 3;   // constant
			$journalentryid = 0;
			$item_sql = "";

			$sql = "INSERT INTO `journal_entry`(`name`,`date`,`journalid`,`userid`,`totalamount`) 
			VALUES ('$name','$date','$journalid','$userid','$totalamount');";

			if (mysqli_query($link, $sql)) {
			    $journalentryid = mysqli_insert_id($link);
			    echo "New record created successfully. Last inserted ID is: " . $journalentryid;
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}

			$item_sql = "";

			// expense amount
			$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`debit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			VALUES ('$name','$productid','$totalamount','$expense_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

			// cash amount
			$item_sql .= "INSERT INTO `journal_item`(`name`,`productid`,`credit`,`accountid`,`journalentryid`,`journalid`,`paymentid`,`invoiceid`,`createdon`)
			VALUES ('$name','$productid','$totalamount','$cash_accountid','$journalentryid','$journalid','$paymentid','$invoiceid','$date');";

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
	
	header("location:entry_form.php");
    // return 0;
?>