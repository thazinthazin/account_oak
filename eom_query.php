<?php
  $link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $link -> error);

  	echo "Connected Successfully.<br>";
  	echo "Form Data >> " . $_POST["formdata"];
	
        // Check if any option is selected 
        if(isset($_POST["formdata"]))
        { 
        	$name = $credit = $debit = $date = "";

        	$income_accountid = 4;  // constant
			$defer_incomeid = 9;  // constant
			$productid = 1;  // constant
			$journalid = 1;  // constant
			$paymentid = 1;  // constant
			$invoiceid = 1;  // constant
			$journalentryid = 0;

			$item_sql = "";

        	$form_data = $_POST["formdata"];
			$temp_row = explode('|', $form_data);
			$row = [];

			for ($i=0; $i < count($temp_row)-1; $i++) { 
				echo "<br/> i : value >> " . $i . "<br/>";

				$row[$i] = explode(',', $temp_row[$i]);
				$j = 0;
				foreach ($row[$i] as $value) {
					echo "VAlue >> " . $value . "<br/>";

					switch ($j) {
					    case 0:
					        $name = $value;
					        break;
					    case 1:
					        $credit = $debit = $value;
					        break;
					    case 2:
					        $date = $value;
					        break;
					    default:
					        echo "Something wrong!";
					}
					$j++;
				}

				// Retrieve Journal_entry id
            	$check_paymentno_sql = "SELECT * FROM `journal_entry` WHERE `name` = '$name' ORDER BY id DESC LIMIT 1";
            	// echo $check_paymentno_sql . "<br>";
            	$result = $link->query($check_paymentno_sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        $journalentryid = $row["id"];
	        			echo "Journal Entry ID for Payment is: " . $journalentryid;
				    }
				}

				$item_sql .= "UPDATE `eom_status` SET `status`=1 WHERE `payment_no`='$name' AND `eom_date`='$date';";

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

?>
