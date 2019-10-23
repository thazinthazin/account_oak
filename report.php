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

// $sql = "SELECT jt.`name`, jt.`totalamount`, acj.`name` AS journalname, FROM_UNIXTIME(ji.`createdon`,'%Y-%m-%d') AS createdon, ji.`debit`, ji.`credit`, coa.`name` AS coaname, mc.`fullname` 
//         FROM `journal_entry` AS jt
//         JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
//         JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
//         JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`
//         JOIN `mdl_course` AS mc ON mc.`id` = ji.`productid`";
// $result = mysqli_query($link, $sql);

$ArrFinal=[];

$sql = "SELECT ji.`productid`,jt.`name`, jt.`totalamount`, acj.`name` AS journalname, FROM_UNIXTIME(ji.`createdon`,'%Y-%m-%d') AS createdon, ji.`debit`, ji.`credit`, coa.`name` AS coaname
        FROM `journal_entry` AS jt
        JOIN `account_journal` AS acj ON acj.`id` = jt.`journalid`
        JOIN `journal_item` AS ji ON ji.`journalentryid` = jt.`id`
        JOIN `chart_of_account` AS coa ON coa.`id` = ji.`accountid`";

          if($result_all = mysqli_query($link, $sql))
          {
            if(mysqli_num_rows($result_all) > 0)
            {
              while($row=mysqli_fetch_assoc($result_all))
              {
                 $jname=$row["journalname"];
                 $tmpArr=[];
                 $tmpArr["name"]=$row["name"];
                 $tmpArr["totalamount"]=$row["totalamount"];
                 $tmpArr["journalname"]=$row["journalname"];
                 $tmpArr["createdon"]=$row["createdon"];
                 $tmpArr["debit"]=$row["debit"];
                 $tmpArr["credit"]=$row["credit"];
                 $tmpArr["coaname"]=$row["coaname"];
                 $sql_title = "";

                 if($jname===$coursefee)
                 {
                  $sql_title = "SELECT mc.`fullname` AS title FROM `mdl_course` mc WHERE mc.`id`=".$row["productid"];
                 }
                 else if($jname===$payroll)
                 {
                  $sql_title = "SELECT CONCAT(u.`firstname`,' ', u.`lastname`,'(' ,p.`pay_month`,' ',p.`pay_year`,')') AS title
                              FROM `mdl_basic_salary_payroll` p 
                              join `mdl_user` u on p.`userid`=u.`id` WHERE p.`id`=".$row["productid"];
                 }

                  if($result_title= mysqli_query($link, $sql_title))
                  {
                    if(mysqli_num_rows($result_title) > 0)
                    {
                      while($rowT=mysqli_fetch_assoc($result_title))
                      {
                        $tmpArr["title"]=$rowT["title"];
                      }
                    }
                  }
                  $ArrFinal[]=$tmpArr;
              }
            }
          }

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
            <td><?php echo $row['title'] ?></td>
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
