<?php
  if(null === $chainName){
    $chain = "enu";
  }
  $params = array(
     "limit" => "100",
     "lower_bound" => "",
     "json" => true
  );
  $post_data = $params;
  //Encode the POST data
  $data_string = json_encode($post_data);
  // create curl resource
  $ch = curl_init();
  // set url
  $url = $api . '/v1/chain/get_producers';
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
  );
  // $output contains the output json
  $output = curl_exec($ch);
  // close curl resource to free up system resources
  curl_close($ch);
  // Deconde the return JsonSerializable
  $obj = json_decode($output, true);
  echo '<div id="prodCont" style="overflow:auto;">';
    echo '<table id="producerTable">';
      echo '<tr>';
        echo '<th>#</th>';
        echo '<th>Producer Name</th>';
        echo '<th>Status</th>';
        echo '<th>Total Votes</th>';
        echo '<th>Upaid Blocks</th>';
        echo '<th>Last Claim</th>';
      echo '</tr>';
      echo '<tbody>';
      $i = 1;
      foreach ($obj['rows'] as $bp) {
        if(($chainName === "tlos") || ($chainName === "eos")) {
          $time = $bp['last_claim_time'];
          $dateTime = new DateTime($time);
          $time = $dateTime->format('Y-m-d');
        } else {
          $time = $bp['last_claim_time'] /1000000;
          $time = date('Y-m-d', $time);
        }
        $votes = number_format((float)$bp['total_votes'], 0, '.', '');
        echo '<tr>';
          echo '<td>';
            echo $i;
          echo '</td>';
          echo '<td id="' . $i . '" class="block-producer">';
            echo '<a href="./?'. $chainName . '=' . $bp['owner'] . '#search_enu">' . $bp['owner'] . '</a>';
          echo '</td>';
          echo '<td>';
            echo '<span  id="status-' . $i . '" class="badge badge-warning mx-auto">Inactive';
          echo '</td>';
          echo '<td>';
            echo number_format($votes / 10000);
          echo '</td>';
          echo '<td>';
            echo number_format($bp['unpaid_blocks']);
          echo '</td>';
          echo '<td>';
            echo $time;
          echo '</td>';
        echo '</tr>';
        $i++;
      }
    echo '</tbody>';
  echo '</table>';
echo '</div>';
echo '<script src="'.plugins_url().'/eurno-explorer/js/pagination.js"></script>';
?>
</div>
</div>
