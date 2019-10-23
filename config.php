<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "account_oak";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 $coursefee="Course Fees";
 $registerfee="Registration Fees";
 $payroll="Payroll";
 $salaries="Salaries";
 $uniform="Uniform";
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
