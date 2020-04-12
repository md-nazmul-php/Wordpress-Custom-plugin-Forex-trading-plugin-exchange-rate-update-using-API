<?php
// date function reated file

  ?>
       
<b style="text-align: center;">insert the date below, but don't add multitime </b>

       <?php
//global declare database
  global $wpdb;


$table_name = $wpdb->prefix . 'sfxtabledtupdate';

  if (isset($_POST['datesubmit'])) {


    $date_short = $_POST['date_short'];


    $wpdb->query("INSERT INTO $table_name(date_short) VALUES('$date_short')");//insert query


    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Fshort');</script>";

  }


// start update query set

if (isset($_POST['dateuprsubmit'])) {
    $id = $_POST['uprid'];
    $date_short = $_POST['uprdate_short'];
   

    $wpdb->query("UPDATE $table_name SET date_short='$date_short' WHERE id='$id'");

   echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Fshort');</script>";
  }


//delete query
  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");

    echo "<script>location.replace('admin.php?page=fx-table%2Fmain.php%2Fshort');</script>";
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

            <td><input type="text" id="date_short" name="date_short" placeholder="dd-mm-yyyy"></td>
          
            <td><button id="datesubmit" name="datesubmit" type="submit">INSERT</button></td>
          </tr>
        </form>





        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
            echo "
              <tr>
                <td width='10%'>$print->id</td>
                <td width='10%'>$print->date_short</td>
                

                <td width='15%'><a href='admin.php?page=fx-table%2Fmain.php%2Fshort&upr=$print->id'><button type='button'>Edit </button></a>

                 <a href='admin.php?page=fx-table%2Fmain.php%2Fshort&del=$print->id'><button type='button'>Delete</button></a></td>
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
  
    $date_short = $print->date_short;

        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>

                <td width='10%'>$print->id <input type='hidden' id='uprid' name='uprid' value='$print->id'></td>




                <td width='10%'><input type='text'   id='uprdate_shortinsertfieldm' name='uprdate_short' value='$print->date_short'></td>

               
                <td width='10%'><button id='dateuprsubmit' name='dateuprsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=fx-table%2Fmain.php%2Fshort'><button type='button'>CANCEL</button></a></td>
             
              </tr>
            </form>
          </tbody>
        </table>";
      }