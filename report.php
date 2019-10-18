<?php

require_once('../config.php');
include('config.php');
require_once($CFG->libdir . '/pagelib.php');
global $PAGE;
$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Accounting Report");
$PAGE->set_heading("Accounting Report");
$PAGE->set_url($CFG->wwwroot.'/report.php');

$PAGE->navbar->ignore_active();
$PAGE->navbar->add('Accounting Report', new moodle_url('report.php'));

echo $OUTPUT->header();

$sql = "SELECT jt.`name`, jt.`totalamount`, acj.`name` AS journalname, ji.`createdon`, ji.`debit`, ji.`credit`, coa.`name` AS coaname, mc.`fullname` 
        FROM `journal_entry` AS jt
        JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
        JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
        JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
        JOIN `mdl_course` AS mc ON mc.`id` = ji.`productid`";
$result = mysqli_query($link, $sql);

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

    <h2 class="pull-left">Accounting Report</h2>

     <table class="table table-bordered admintable generaltable" id="tab">
      <thead>
        <tr>
        <th>#</th>
          <th>Payment No</th>
          <th>Journal</th>
          <th>Course</th>
          <th>Monthly Amount</th>
          <th>Debit Amount</th>
          <th>Credit Amount</th>
          <th>Chart of Account</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count=1;
        while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['journalname'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['totalamount'] ?></td>
            <td><?php echo $row['debit'] ?></td>
            <td><?php echo $row['credit'] ?></td>
            <td><?php echo $row['coaname'] ?></td>
            <td><?php echo $row['createdon'] ?></td>
          </tr>
        <?php $count++; } ?>
      </tbody>
    </table>

<?php
// Close connection
mysqli_close($link);

echo $OUTPUT->footer();
?>

<script type="text/javascript">
	$('#tab').on('click', 'tr', function () {
      $('td,th', this).css('background', '#90EE90');
  });  
</script>

</body>
</html>