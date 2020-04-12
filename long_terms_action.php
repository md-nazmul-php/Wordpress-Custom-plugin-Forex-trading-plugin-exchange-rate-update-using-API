<?php

  global $wpdb;//global declare database



  $table_name = $wpdb->prefix . 'longfxdatatable';


  if (isset($_POST['newsubmit'])) {


  	$currencyname = $_POST['currencyname'];
    $action = $_POST['action'];
    $price_entry = $_POST['price_entry'];
    $stop_loss = $_POST['stop_loss'];
    $price_target = $_POST['price_target'];
    $day_in_market = $_POST['day_in_market'];
    $position_size = $_POST['position_size'];


    $wpdb->query("INSERT INTO $table_name(currencyname, action, price_entry, stop_loss, price_target, day_in_market, position_size) VALUES('$currencyname','$action','$price_entry','$stop_loss','$price_target','$day_in_market','$position_size')");//insert query

    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";

  }


// start update query set


    if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $currencyname = $_POST['uptcurrencyname'];
    $action = $_POST['uptaction'];
    $price_entry = $_POST['uptprice_entry'];
    $stop_loss = $_POST['uptstop_loss'];
    $price_target = $_POST['uptprice_target'];
    $day_in_market = $_POST['uptday_in_market'];
    $position_size = $_POST['uptposition_size'];

    $wpdb->query("UPDATE $table_name SET 

      currencyname='$currencyname',
            action='$action',
       price_entry='$price_entry',
         stop_loss='$stop_loss',
      price_target='$price_target',
     day_in_market='$day_in_market',
     position_size='$position_size'

     WHERE id='$id'


      ");


   echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";
  }



  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");

    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";//delete query
  }
  ?>


  <div class="wrap"><br>


<hr>



    <h2 style="text-align: center;">Long Protfolio</h2><br>
    <p style="text-align: center;">Use currency name like <b>USDCAD</b> it mean USD to CAD conversion </p><br> <p style="text-align: center;">Always use upercase for the currency name and Action like SELL/BUY and USDEUR nut use buy/sell or usdeur</p><br>
     <p style="text-align: center;">Use shortcode <b>[fx-table-long]</b> any where in your page and posts to display the table. </p><br>
    <table class="wp-list-table widefat striped" style="text-align: center;">
      <thead>
        <tr>
          <th width="10%">ID</th>
          <th width="10%">Currency Name</th>
          <th width="10%">Action</th>
          <th width="10%">Price Entry</th>
          <th width="10%">Stop Loss</th>
          <th width="10%">Price Target</th>
          <th width="10%">Day in Market</th>
          <th width="10%">Position Size</th>
    

          <th width="13%">Actions</th>
        </tr>

      </thead> 
      <tbody>

      	<script type="text/javascript">
    function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase(); 
    }, 1);
}
</script>

        <form action="" method="post">
          <tr>
            <td><input type="text" value="AUTO_GENERATED" disabled></td>

            <td><input type="text" id="currencyname" name="currencyname" onkeydown="upperCaseF(this)"  placeholder="EURUSD"></td>
            <td><input type="text"   id="insertfield" name="action" onkeydown="upperCaseF(this)" placeholder="BUY/SELL"></td>
            <td><input type="number" id="insertfield" name="price_entry" step=any placeholder="1.34"></td>
            <td><input type="number" id="insertfield" step=any name="stop_loss" placeholder="14"></td>
            <td><input type="number" id="insertfield" step=any name="price_target" placeholder="10"></td>
            <td><input type="number" id="insertfield"  name="day_in_market" placeholder="17"></td>
            <td><input type="number" id="insertfield"  name="position_size" placeholder="10"></td>
          
            <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
          </tr>
        </form>




        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
            echo "
              <tr>
                <td width='10%'>$print->id</td>
                <td width='10%'>$print->currencyname</td>
                <td width='10%'>$print->action</td>
                 <td width='10%'>$print->price_entry</td>
                <td width='10%'>$print->stop_loss</td>
                <td width='10%'>$print->price_target</td>
                 <td width='10%'>$print->day_in_market</td>
                <td width='10%'>$print->position_size</td>
                

                <td width='15%'><a href='admin.php?page=fx-table%2Fmain.php%2Flong&upt=$print->id'><button type='button'>Edit </button></a>
                 <a href='admin.php?page=fx-table%2Fmain.php%2Flong&del=$print->id'><button type='button'>Delete</button></a></td>
              </tr>
            ";
          }
        ?>
      </tbody>  
    </table>
    <br>
   



    <?php
      if (isset($_GET['upt'])) {
        $upt_id = $_GET['upt'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
        foreach($result as $print) {
  
      $currencyname = $print->currencyname;
      $action = $print->action;
      $price_entry = $print->price_entry;
      $stop_loss = $print->stop_loss;
      $price_target = $print->price_target;
      $day_in_market = $print->day_in_market;
      $position_size =$print->position_size;

        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>

                <td width='10%'>$print->id <input type='hidden' id='uptid' name='uptid' value='$print->id'></td>




                <td width='10%'><input type='text'   id='uptcurrencynameinsertfieldm' name='uptcurrencyname' value='$print->currencyname'></td>

                <td width='10%'><input type='text'  id='uptaction' name='uptaction' value='$print->action'></td>

                <td width='10%'><input type='number' step=any id='insertfield' name='uptprice_entry' value='$print->price_entry'></td>


                <td width='10%'><input type='number' step=any id='insertfield' name='uptstop_loss' value='$print->stop_loss'></td>

                <td width='10%'><input type='number' step=any id='insertfield' name='uptprice_target' value='$print->price_target'></td>

                <td width='10%'><input type='number'  id='insertfield' name='uptday_in_market' value='$print->day_in_market'></td>

                <td width='10%'><input type='number'  id='insertfield' name='uptposition_size' value='$print->position_size'></td>

                <td width='10%'><button id='uptsubmit' name='uptsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=fx-table%2Fmain.php%2Flong'><button type='button'>CANCEL</button></a></td>
             
              </tr>
            </form>
          </tbody>
        </table>";
      }