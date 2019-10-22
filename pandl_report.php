<?php

require_once('../config.php');
include('config.php');
require_once($CFG->libdir . '/pagelib.php');
global $PAGE;
$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("P & L Report");
$PAGE->set_heading("P & L Report");
$PAGE->set_url($CFG->wwwroot.'/pandl_report.php');

$PAGE->navbar->ignore_active();
$PAGE->navbar->add('P & L Report', new moodle_url('pandl_report.php'));

echo $OUTPUT->header();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<style type="text/css">
h2 {
  display: inline-block;
  text-align: left;
  font-weight: 700;
  font-size: 1.875rem;
  margin-bottom: .5rem;
  font-family: inherit;
  line-height: 1.2;
  color: inherit;
}
</style>
</head>
<body>

<div class="row">
  <h2 class="pull-left">Profit & Loss Report</h2>
</div>

  <?php
    $startDate = (isset($_POST["from_date"])) ? $_POST["from_date"] : '';
    $endDate = (isset($_POST["to_date"])) ? $_POST["to_date"] : '';
  ?>

<form action="p&l_report.php" method="post">
  <div class="input-daterange">
    <div class="col-md-2">
      <div class="form-group">
        <label for="from_date">Start Date</label>
        <input type="text" id="from_date" class="form-control" name="from_date" value="<?php echo $startDate; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label for="to_date">End Date</label>
        <input type="text" id="to_date" class="form-control" name="to_date" value="<?php echo $endDate; ?>">
      </div>
    </div>
  </div>

  <button type="submit" id="filter" class="btn btn-primary" name="filter">Filter</button>
</form>
    
    <div class="row">
      <h3 class="pull-left">Income</h3>
    </div>

    <div id="order_table">

      <?php 
        // totalIncome($link, '2019-08-01','2019-10-30');
        // totalIncome($link, '','');
        totalIncome($link, $startDate, $endDate);

      function totalIncome($link, $startDate='', $endDate=''){
      ?>

     <table class="table">
      <tbody>
        <?php
        $sql = "SELECT acj.`name` AS journalname, SUM(ji.`credit`) AS amount, SUM(coa.`name`) AS coaname
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 10 ";
          if ($startDate != '' && $endDate != '') {
            $sql .= "AND FROM_UNIXTIME(ji.`createdon`,'%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ";
          }
          
          $sql .= "GROUP BY acj.`name`";

          // echo $sql . "<br/>";

        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row['journalname'] ?></td>
            <td><?php echo $row['amount'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  <?php } ?>

    <div class="row">
      <h3 class="pull-left">Expenses</h3>
    </div>

    <?php 
     // totalExpense($link, '2019-08-01','2019-10-30');
        // totalExpense($link, '','');
    totalExpense($link, $startDate, $endDate);

    function totalExpense($link, $startDate='', $endDate=''){
    ?>

     <table class="table">
      <tbody>
        <?php
        $sql = "SELECT acj.`name` AS journalname, SUM(ji.`debit`) AS amount, SUM(coa.`name`) AS coaname
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 3 ";
          if ($startDate != '' && $endDate != '') {
            $sql .= "AND FROM_UNIXTIME(ji.`createdon`,'%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ";
          }
          
          $sql .= "GROUP BY acj.`name`";

          // echo $sql . "<br/>";

        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row['journalname'] ?></td>
            <td><?php echo $row['amount'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <?php } ?>

  </div>

<?php
// Close connection
mysqli_close($link);
echo $OUTPUT->footer();
?>

<script type="text/javascript">
  $(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });
});
</script>

</body>
</html>
