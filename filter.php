<?php

$connect = new PDO("mysql:host=localhost;dbname=thuyeindb", "root", "");

$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{
 if(empty($_POST["start_date"]))
 {
  $start_date_error = '<label class="text-danger">Start Date is required</label>';
 }
 else if(empty($_POST["end_date"]))
 {
  $end_date_error = '<label class="text-danger">End Date is required</label>';
 }
 else
 {
  $file_name = 'P & L Report.csv';
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name");
  header("Content-Type: application/csv;");

  $file = fopen('php://output', 'w');

  $header = array("Journal", "Amount", "Date");

  fputcsv($file, $header);

  $query = "SELECT acj.`name` AS journalname, SUM(ji.`credit`) AS amount, SUM(coa.`name`) AS coaname, ji.`createdon`
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 10 GROUP BY acj.`name`
          AND ji.`createdon` >= '".$_POST["start_date"]."' AND ji.`createdon` <= '".$_POST["end_date"]."' ORDER BY ji.`createdon` DESC";

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $data = array();
   $data[] = $row["journalname"];
   $data[] = $row["amount"];
   $data[] = $row["createdon"];
   fputcsv($file, $data);
  }
  fclose($file);
  exit;
 }
}

$query = "SELECT acj.`name` AS journalname, SUM(ji.`credit`) AS amount, SUM(coa.`name`) AS coaname, ji.`createdon`
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 10 GROUP BY acj.`name`
          AND ji.`createdon` >= '".$_POST["start_date"]."' AND ji.`createdon` <= '".$_POST["end_date"]."' ORDER BY ji.`createdon` DESC";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>

<html>
 <head>
  <title>P & L Report</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 </head>
 <body>
  <div class="container box">
   <h1 align="center">Profit & Loss Report</h1>
   <br />
   <div class="table-responsive">
    <br />
    <div class="row">
     <form method="post">
      <div class="input-daterange">
       <div class="col-md-4">
        <input type="text" name="start_date" class="form-control" readonly />
        <?php echo $start_date_error; ?>
       </div>
       <div class="col-md-4">
        <input type="text" name="end_date" class="form-control" readonly />
        <?php echo $end_date_error; ?>
       </div>
      </div>
      <div class="col-md-2">
       <input type="submit" name="export" value="Export" class="btn btn-info" />
      </div>
     </form>
    </div>
    <br />
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Journal</th>
       <th>Amount</th>
       <th>Date</th>
      </tr>
     </thead>
     <tbody>
      <?php
      foreach($result as $row)
      {
       echo '
       <tr>
        <td>'.$row["journalname"].'</td>
        <td>'.$row["amount"].'</td>
        <td>'.date("m/d/Y", strtotime($row["createdon"])).'</td>
       </tr>
       ';
      }
      ?>
     </tbody>
    </table>
    <br />
    <br />
   </div>
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });
});

</script>