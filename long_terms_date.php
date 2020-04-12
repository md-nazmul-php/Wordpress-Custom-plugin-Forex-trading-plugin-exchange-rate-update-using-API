<?php
// date function related file

  ?>
       
<b style="text-align: center;">insert the date below, but don't add multitime </b>

       <?php

  global $wpdb;//global declare database




$table_name = $wpdb->prefix . 'lfxtabledtupdate';



  if (isset($_POST['datesubmit'])) {


  	$date_long = $_POST['date_long'];


    $wpdb->query("INSERT INTO $table_name(date_long) VALUES('$date_long')");//insert query


    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";

  }


// start update query set

if (isset($_POST['dateuprsubmit'])) {
    $id = $_POST['uprid'];
    $date_long = $_POST['uprdate_long'];
   

    $wpdb->query("UPDATE $table_name SET date_long='$date_long' WHERE id='$id'");

   echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";
  }



  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");

    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Flong');</script>";//delete query
  }
  ?>





    <table class="wp-list-table widefat striped" style="text-align: center;">
      <thead>
        <tr>
          <th width="10%">ID</th>
          <th width="10%">Date</th>
    
        </tr>

      </thead> 
      <tbody>

        <form action="" method="post">
          <tr>
            <td><input type="text" value="AUTO_GENERATED" disabled></td>

            <td><input type="text" id="date_long" name="date_long" placeholder="dd-mm-yyyy"></td>
          
            <td><button id="datesubmit" name="datesubmit" type="submit">INSERT</button></td>
          </tr>
        </form>





        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
            echo "
              <tr>
                <td width='10%'>$print->id</td>
                <td width='10%'>$print->date_long</td>
                

                <td width='15%'><a href='admin.php?page=fx-table%2Fmain.php%2Flong&upr=$print->id'><button type='button'>Edit </button></a>

                 <a href='admin.php?page=fx-table%2Fmain.php%2Flong&del=$print->id'><button type='button'>Delete</button></a></td>
              </tr>
            ";
          }
        ?>
      </tbody>  
    </table>
    <br>
   



    <?php
      if (isset($_GET['upr'])) {
        $upr_id = $_GET['upr'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upr_id'");
        foreach($result as $print) {
  
    $date_long = $print->date_long;

        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>

                <td width='10%'>$print->id <input type='hidden' id='uprid' name='uprid' value='$print->id'></td>




                <td width='10%'><input type='text'   id='uprdate_longinsertfieldm' name='uprdate_long' value='$print->date_long'>
                </td>

               
                <td width='10%'><button id='dateuprsubmit' name='dateuprsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=fx-table%2Fmain.php%2Flong'><button type='button'>CANCEL</button></a>
                </td>
             
              </tr>
            </form>
          </tbody>
        </table>";
      }