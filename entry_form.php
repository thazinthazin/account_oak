<?php

  require_once('../config.php');
  include('config.php');
  require_once($CFG->libdir . '/pagelib.php');
  global $PAGE;
  $PAGE->set_context(get_system_context());
  $PAGE->set_pagelayout('admin');
  $PAGE->set_title("Account Entry Form");
  $PAGE->set_heading("Account Entry Form");
  $PAGE->set_url($CFG->wwwroot.'/entry_form.php');

  $PAGE->navbar->ignore_active();
  $PAGE->navbar->add('Account Entry Form', new moodle_url('entry_form.php'));

  echo $OUTPUT->header();
?>

<!DOCTYPE html>
<html>
<head>
  <title>EOM Status</title>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
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
<body>

  <h2>Account Entry Form</h2>

  <form id="entryform" method="post" name="entryform" action="entry_query.php">

          <fieldset class="clearfix collapsible containsadvancedelements" id="id_newfilter">

            <div class="fcontainer clearfix" id="yui_3_17_2_1_1559537814128_525">
            <div class="col-md-2">
              <div class="form-group">
                <label for="journal">Payment Type:</label>
                <select id="journal" class="selectpicker form-control" data-live-search="true" title="Select Account Journal">
                    <?php 

                    //sql for account journal
                    $sql="SELECT * FROM `account_journal`";
                    $result= mysqli_query($link,$sql);
                    while($row = mysqli_fetch_assoc($result)) { 
                      $id=$row[id];
                      $name=$row[name];
                    ?>
                    <option value="<?php echo "$id"; ?>"><?php echo "$name";?></option>

                    <?php    
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" class="form-control" name="date">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="amount">Amount</label>
                <input type="integer" id="amount" class="form-control" name="amount" placeholder="Amount" required>

                <select id="currency" class="selectpicker form-control" data-live-search="true" title="Select Academic">
                    <?php 

                    //sql for course/ subcategory
                    $sql="SELECT * FROM `currency`";
                    $result= mysqli_query($link,$sql);
                    while($row = mysqli_fetch_assoc($result)) { 
                      $id=$row[id];
                      $currency=$row[currency];
                    ?>
                    <option value="<?php echo "$id"; ?>"><?php echo "$currency";?></option>

                    <?php    
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="paymenttype">Cash / Bank</label>
                <select id="paymenttype" class="selectpicker form-control" data-live-search="true" title="Select Academic">
                    <?php 

                    //sql for course/ subcategory
                    $sql="SELECT * FROM `payment_type`";
                    $result= mysqli_query($link,$sql);
                    while($row = mysqli_fetch_assoc($result)) { 
                      $id=$row[id];
                      $paymenttype=$row[paymenttype];
                    ?>
                    <option value="<?php echo "$id"; ?>"><?php echo "$paymenttype";?></option>

                    <?php    
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" class="form-control" name="description" placeholder="description" required>
              </div>
            </div>

            <button type="submit" class="btn btn-primary" value="" onclick="accountentry()">Save</button>
            <button type="" class="btn btn-primary" value="" >Cancel</button>
      </div>
      </fieldset>
  </form>

<?php 
// Close connection
mysqli_close($link);
echo $OUTPUT->footer();
?>

<script type="text/javascript">

function accountentry() {
  var Journal = document.getElementById("journal").value;
  var Date = document.getElementById("date").value;
  var Amount = document.getElementById("amount").value;
  var Currency = document.getElementById("currency").value;
  var Description = document.getElementById("description").value;


  var dataString = 'submit=submit&Journal1='+ Journal +'&Date1='+ Date + '&Amount1='+ Amount +'&Currency1='+ Currency +'&Description1='+ Description;
  // alert(dataString);

    $.ajax({
      type: "POST",
      url: "entry_query.php",
      data: dataString,
      cache: false,
      success: function(result)
        {
          // alert(result);
          window.location.reload();
        }
    });
  }
</script>

</body>
</html>