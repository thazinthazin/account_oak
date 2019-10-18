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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
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
th {
    text-align: inherit;
    color: #306136;
}
</style>
</head>
<body>

    <div class="row">
      <h2 class="pull-left">Profit & Loss Report</h2>
    </div>
    
    <div class="row">
      <h3 class="pull-left">Income</h3>
    </div>

     <table class="table">
      <tbody>
        <?php
        $sql = "SELECT acj.`name` AS journalname, SUM(ji.`credit`) AS amount, SUM(coa.`name`) AS coaname
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 10 ";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row['journalname'] ?></td>
            <td><?php echo $row['amount'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="row">
      <h3 class="pull-left">Expenses</h3>
    </div>

     <table class="table">
      <tbody>
        <?php
        $sql = "SELECT acj.`name` AS journalname, SUM(ji.`debit`) AS amount, SUM(coa.`name`) AS coaname
          FROM `journal_entry` AS jt
          JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
          JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
          JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
          WHERE coa.`id` = 3 GROUP BY acj.`name`";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row['journalname'] ?></td>
            <td><?php echo $row['amount'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

<?php
// Close connection
mysqli_close($link);

echo $OUTPUT->footer();
?>

<script type="text/javascript">

</script>

</body>
</html>