<?php
ini_set('allow_url_fopen',1);
function wpb_fxs_shortcode() { 
global $wpdb;
ob_start();


$table_name = $wpdb->prefix . 'shortfxdatatable';

echo '<h3 id="longtitletlb" style="text-align:center;font-weight:700;font-size:24px;padding-top:10px;">';

$result = $wpdb->get_results("SELECT * FROM wp_sfxtabledtupdate");

   

          foreach ($result as $print) {
 

           $updatedate = $print->date_short;

           echo "<br>"."Date: " .$updatedate;
         }

 ?>

 <br>
 Short-term Portfolio
</h3>

  <table class="table">
    <thead>
      <tr class="tblhead">
        <th>Currency</th>
        <th>Action</th>
        <th>Price Entry</th>
        <th>Market Price</th>
        <th>Stop Loss</th>
        <th>Price Target</th>
        <th>Days in Market</th>
        <th>Position Size</th>
        <th>P/L (in Pips)</th>
      
        <th>P/L (in %)</th>
       
      </tr>
    </thead>


<?php


function convertCurrencys($amount,$from_currency,$to_currency){

 

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free/paid URL if you're using the free version


  $json = @file_get_contents("https://api.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey=94d136465ceb45abba2d8a13f7588ee3");




 

if ($json==true) {
  
   $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 4, '.', '');
}

else{

 $json = @file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey=06d3f637bb1e9a8401b9");

   $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
   return number_format($total, 4, '.', '');
}



}

    $result = $wpdb->get_results("SELECT * FROM $table_name");

   

          foreach ($result as $print) {
 

           $price_entry = $print->price_entry;
          $currencyname = $print->currencyname;
                $action = $print->action;
             $stop_loss = $print->stop_loss;
          $price_target = $print->price_target;
         $day_in_market = $print->day_in_market;
         $position_size = $print->position_size;



          if ($currencyname=='CADUSD') {
         
          $market_price=convertCurrencys(1, 'CAD','USD'); 
            
         }
         elseif ($currencyname=='USDCAD') {

            $market_price=convertCurrencys(1, 'USD','CAD'); 

          }

         elseif ($currencyname=='USDCHF') {

           $market_price=convertCurrencys(1, 'USD','CHF'); 

         }


         elseif ($currencyname=='NZDUSD') {
          
           $market_price=convertCurrencys(1, 'NZD','USD');

                    }



         elseif ($currencyname=='USDJPY') {
          
           $market_price=convertCurrencys(1, 'USD','JPY');

                    }


                    elseif ($currencyname=='EURUSD') {
          
           $market_price=convertCurrencys(1, 'EUR','USD');

                    }

                    elseif ($currencyname=='USDEUR') {
          
           $market_price=convertCurrencys(1, 'USD','EUR');

                    }

                      elseif ($currencyname=='USDCHF') {
          
           $market_price=convertCurrencys(1, 'USD','CHF');

                    }


                    elseif ($currencyname=='GBPUSD') {
          
           $market_price=convertCurrencys(1, 'GBP','USD');

                    }

                    elseif ($currencyname=='CADJPY') {
          
           $market_price=convertCurrencys(1, 'CAD','JPY');

                    }

                    elseif ($currencyname=='AUDUSD') {
          
           $market_price=convertCurrencys(1, 'AUD','USD');

                    }

                    elseif ($currencyname=='EURJPY') {
          
           $market_price=convertCurrencys(1, 'EUR','JPY');

                    }

                    elseif ($currencyname=='NZDJPY') {
          
           $market_price=convertCurrencys(1, 'NZD','JPY'); 

                    }


                    elseif ($currencyname=='AUDJPY') {
          
           $market_price=convertCurrencys(1, 'AUD','JPY'); 

                    }


                    elseif ($currencyname=='GBPJPY') {
          
           $market_price=convertCurrencys(1, 'GBP','JPY'); 

                    }

                    elseif ($currencyname=='CHFJPY') {
          
           $market_price=convertCurrencys(1, 'CHF','JPY'); 

                    }


                    elseif ($currencyname=='EURGBP') {
          
           $market_price=convertCurrencys(1, 'EUR','GBP'); 

                    }


                    elseif ($currencyname=='EURCHF') {
          
           $market_price=convertCurrencys(1, 'EUR','CHF'); 

                    }

                    elseif ($currencyname=='GBPCHF') {
          
           $market_price=convertCurrencys(1, 'GBP','CHF'); 

                    }


                    elseif ($currencyname=='AUDCAD') {
          
           $market_price=convertCurrencys(1, 'AUD','CAD'); 

                    }


                    elseif ($currencyname=='NZDCAD') {
          
           $market_price=convertCurrencys(1, 'NZD','CAD'); 

                    }


                    elseif ($currencyname=='CADCHF') {
          
           $market_price=convertCurrencys(1, 'CAD','CHF'); 

                    }

                    elseif ($currencyname=='GBPCAD') {
          
           $market_price=convertCurrencys(1, 'GBP','CAD');

                    }

                    elseif ($currencyname=='CADCHF') {
          
           $market_price=convertCurrencys(1, 'CAD','CHF');

                    }


                    elseif ($currencyname=='CHFNZD') {
          
           $market_price=convertCurrencys(1, 'CHF','NZD');

                    }


                    elseif ($currencyname=='NZDCHF') {
          
           $market_price=convertCurrencys(1, 'NZD','CHF');

                    }


                    elseif ($currencyname=='EURCAD') {
          
           $market_price=convertCurrencys(1, 'EUR','CAD');

                    }

                    elseif ($currencyname=='EURAUD') {
          
           $market_price=convertCurrencys(1, 'EUR','AUD');

                    }

                    elseif ($currencyname=='EURNZD') {
          
           $market_price=convertCurrencys(1, 'EUR','NZD');


                    }


                    elseif ($currencyname=='GBPAUD') {
          
           $market_price=convertCurrencys(1, 'GBP','AUD');


                    }


                    elseif ($currencyname=='GBPNZD') {
          
           $market_price=convertCurrencys(1, 'GBP','NZD');


                    }

                    elseif ($currencyname=='AUDNZD') {
          
           $market_price=convertCurrencys(1, 'AUD','NZD');


                    }

                    elseif ($currencyname=='AUDCHF') {
          
           $market_price=convertCurrencys(1, 'AUD','CHF');


                    }




   
                   else{

                   $market_price= 0.00;
                   }





          $pnl=0;



         if ($action=='BUY') {
           

           switch($currencyname)
                              {
                                  case 'CADJPY';
                                  case 'CHFJPY';
                                  case 'GBPJPY';
                                  case 'USDJPY';
                                  case 'NZDJPY';
                                  case 'AUDJPY';
                                  case 'EURJPY';

                                    $pnld=$market_price-$price_entry;
                                    $pnl=$pnld*1;
                                    $pnlk=$pnld*100;
                                     $market_price= number_format((float)$market_price, 2, '.', '');
                                   $pnlperd=$pnlk/$price_entry;
                                    $price_entry= number_format((float)$price_entry, 2, '.', '');
                                   $price_target= number_format((float)$price_target, 2, '.', '');
                                   $stop_loss= number_format((float)$stop_loss, 2, '.', '');


                                  break;
                                  default;
                                      $pnld=$market_price-$price_entry;

                                       $pnl=$pnld*10000;
                                       $pnlk=$pnld*10000;
                                       $pnlperd=($pnl*$price_entry)/100;
                                  break;
                              }
           
          }





          elseif ($action=='SELL') {



                  switch($currencyname)
                              {
                                  case 'CADJPY';
                                  case 'CHFJPY';
                                  case 'GBPJPY';
                                  case 'USDJPY';
                                  case 'NZDJPY';
                                  case 'AUDJPY';
                                  case 'EURJPY';

                                    $pnld= $price_entry-$market_price;
                                   $pnl=$pnld*1;
                                    $pnlk=$pnld*100;
                                     $market_price= number_format((float)$market_price, 2, '.', '');
                         
                                    $price_entry= number_format((float)$price_entry, 2, '.', '');
                                    $pnlperd=$pnlk/$price_entry;
                                    $price_target= number_format((float)$price_target, 2, '.', '');
                                   $stop_loss= number_format((float)$stop_loss, 2, '.', '');


                                  break;
                                  default;
                                      $pnld= $price_entry-$market_price;

                                       $pnl=$pnld*10000;
                                       $pnlk=$pnld*10000;
                                       $pnlperd=($pnl*$price_entry)/100;
                                  break;
                              }
        
            
                            }
             
          else{

           echo "Wrong Entry";
          }

          //pnl % logic
         $pnlk = round($pnlk);
          
         
      $pnlperm= number_format((float)$pnlperd, 2, '.', '');
    
          $pnlper= $pnlperm . " %";

        
          $position_sizen = $position_size . " %";



          echo "
         <tr>

        <td>$currencyname</td>
        <td>$action</td>
        <td>$price_entry</td>
        <td>$market_price</td>
        <td>$stop_loss</td>
        <td> $price_target</td>
        <td>$day_in_market</td>
        <td>$position_sizen</td>
        <td>$pnlk</td>
        
        <td>$pnlper</td>
        
        </tr>

      
      
     </tbody>


            ";

          }?>
   
  </table>


<?php
return ob_get_clean();

//echo print_r($result, true);
} 

add_shortcode('fx-table-short', 'wpb_fxs_shortcode'); 