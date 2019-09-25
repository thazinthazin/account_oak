<?php
	include 'config.php';

	$conn = OpenCon();
	$link = new mysqli("localhost", "root", "", "account_oak") or die("Connect failed: %s\n". $conn -> error);
	echo "Connected Successfully.<br>";

	$name = "tester2";
	$ref = "ref1";
	$code = "S1";
	$state = "state";
	$amount = "200";
	$testdate = "2019-09-07";
	$date = $createdon = $modifiedon = strtotime($testdate);
	$journalcode = "tes";
	$createdby = 1;
	$modifiedby = 2;
	// print "String date" . $date . "<br>";
	// print "Covert date" . date('Y-m-d', $date+36000) . "<br>";
	// return $date;

	// $name = $_POST['name'];
	// $ref = $_POST['ref'];
	// $date = strtotime($_POST['date']);
	// $journalid = $_POST['journal'];
	// $state = $_POST['state'];
	// $userid = $_POST['user'];
	// $amount = $_POST['amount'];

	$sql = "INSERT INTO `journal_entry`( `name`, `ref`,`code`, `date`, `state`, `totalamount`,`journalcode`,`createdby`,`modifiedby`,`createdon`,`modifiedon`) 
	VALUES ('$name','$ref','$code','$date','$state','$amount','$journalcode','$createdby','$modifiedby','$createdon','$modifiedon')";

	// echo "SQL : " . $sql;

	if (mysqli_query($link, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	// mysqli_close($link);

	CloseCon($conn);
?>