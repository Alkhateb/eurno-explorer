<?php
  $url = $api . '/v1/chain/get_account';
  $params = array(
    "account_name"  => $name
  );
  $post_data = $params;
  //Encode the POST data
  $data_string = json_encode($post_data);
  // create curl resource
  $ch = curl_init();
  // set url
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
  // Set fallback to display an error message if there is one //
  if(isset($obj['error'])){
    echo '<div class="card border border-danger mt-5">';
      echo '<div class="card-header alert alert-danger">';
        echo 'Showing results for: '.$name.' on: ' . $chainName;
      echo '</div>';
      echo '<div class="card-body">';
        echo '<div class="p-4">';
          echo '<h4>Theres been an error. The server provided the following message:</h4>';
          echo '<p><i>"' . $obj['message'] . ', ' . "\n" . $obj['error']['what'] . '"</i></p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    // Kill the script if there is an error //
    return;
  }
  // If there isn't an error, continue. //
  if(!isset($obj['error'])){
  // Set the variables
  $page_title = 'Showing results for: </i>' . $name . '</i>';
  $cpu_available = $obj['cpu_limit']['available'];
  $cpu_max = $obj['cpu_limit']['max'];
  $cpu_used = $obj['cpu_limit']['used'];
  $cpu_weight = $obj['cpu_weight'];
  $created = date('D, M j, Y \a\t g:ia', strtotime($obj['created']));
  $net_available = $obj['net_limit']['available'];
  $net_max = $obj['net_limit']['max'];
  $net_used = $obj['net_limit']['used'];
  $net_weight = $obj['net_weight'];
  $permissions = $obj['permissions'];
  $ram_quota = $obj['ram_quota'];
  $ram_used = $obj['ram_usage'];
  $refund_request = $obj['refund_request'];
  $staked_cpu = $obj['total_resources']['cpu_weight'];
  $staked_net = $obj['total_resources']['net_weight'];
  // Voter will return null if the account hasn't voted //
  if(isset($obj['voter_info'])){
    $vote_weight = $obj['voter_info']['last_vote_weight'];
    $voted = $obj['voter_info']['producers'];
  }
  // If core liquid balance isn't set, set it to zero //
  if(isset($obj['core_liquid_balance'])){
    $liquid = $obj['core_liquid_balance'];
  } elseif (!isset($obj['core_liquid_balance'])) {
    $liquid = "0";
  }
  // Begin building the content from the top //
  echo '<div id="ex_content" class="card">';
    echo '<div class="card-header p-2" id="query-title">';
      echo '<small>';
        echo $page_title;
      echo '</small>';
    echo '</div>';
    echo '<div id="content-card" class="mx-2 p-1 my-2">';
      echo '<div class="card-body p-1">';
        echo '<div id="ac-info" class="row">';
          echo '<div class="col my-auto ml-4">';
            echo '<h5>Account Name: ' . $name . '</h5>';
            echo '<h5>Created: ' . $created . '</h5>';
            echo '<h5>Liquid Balance: ' . $liquid . '</h5>';
            echo '<h5>Staked CPU: ' . $staked_cpu . '</h5>';
            echo '<h5>Staked NET: ' . $staked_net . '</h5>';
            echo '<h5>RAM Quota: ' . $ram_quota . '</h5>';
            echo '<h5>RAM Used: ' . $ram_used . '</h5>';
            if(isset($refund_request)){
              $ref_req_date = date($refund_request['request_time']);
              $ref_req_net = $refund_request['net_amount'];
              $ref_req_cpu = $refund_request['cpu_amount'];
              echo '<h5>Refund Pending: True</h5>';
              echo '<h5>Request Date: ' . date('D, M j, Y \a\t g:ia', strtotime($ref_req_date)) . '</h5>';
              echo '<h5>Issue Date: ' . date('D, M j, Y \a\t g:ia', strtotime($ref_req_date. ' + 3 days'));
              echo '<h5>Refund NET: ' . $ref_req_net . '</h5>';
              echo '<h5>Refund CPU: ' . $ref_req_cpu . '</h5>';

            } else {
              echo '<h5>Refund Requested: False</h5>';
            }
          echo '</div>';
          echo '<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 my-auto mr-4" id="qr_Code">';
            echo '<script type="text/javascript">';
              echo 'var QRC = qrcodegen.QrCode;';
              echo 'var qr0 = QRC.encodeText( "' . $name . '" , QRC.Ecc.MEDIUM);';
              echo 'var svg = qr0.toSvgString(4);';
              echo 'document.getElementById("qr_Code").innerHTML = svg;';
            echo '</script>';
          echo '</div>';
        echo '</div>';
        recentTransactions($name, $api, $chainName);
        echo '<div class="alert alert-success m-3">';
          echo '<h6>Raw Data:</h6>';
          echo '<div id="ac-extra-data" class="ac_detail_card">';
            echo '<script>';
              echo 'renderjson.set_show_to_level(2);';
              echo 'document.getElementById("ac-extra-data").appendChild(renderjson('.json_encode($obj).'));';
            echo '</script>';
          echo '</div>';
        echo '</div>';
      echo '<script type="text/javascript">';
        echo 'balances("' . $name . '", "' . $api . '", "' . $chainName . '");';
      echo '</script>';
  }
// Section for recent transactions //
function recentTransactions($name, $api, $chain){
  $chainName = $chain;
  $url = $api . '/v1/history/get_actions';
  $name = $name;
  $params = array(
    "account_name"  => $name
  );
  $post_data = $params;
  //Encode the POST data
  $data_string = json_encode($post_data);
  // create curl resource
  $ch = curl_init();
  // set url
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
  if(isset($obj['error'])){
    echo '<div class="card border border-danger mt-5">';
      echo '<div class="card-header alert alert-danger">';
        echo 'Showing results for: '.$name;
      echo '</div>';
      echo '<div class="card-body">';
        echo '<div class="p-4">';
          echo '<h4>Theres been an error. The server provided the following message:</h4>';
          echo '<p><i>"' . $obj['message'] . ', ' . "\n" . $obj['error']['what'] . '"</i></p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    return;
  }
  if(!isset($obj['error'])){
  if((empty($obj['actions'])) && (!isset($obj['error']))) {
    echo '<h5 class="mx-5 my-5 text-center">It seems that this account has not made any transactions. If you\'d like to make your first one you can always donate to <b>eurnoproject</b> <i>wink wink</i>. </h5>';
    return;
  }
  $tx_id = '';
  $tx_type = '';
  $sender = '';
  $receiver = '';
  $amount = '';
  $tx_time = '';
  $tx_status = '';
  $prevID = null;
  $prevType = null;
  echo '<div id="recents">';
  foreach (array_reverse($obj['actions']) as $key => $obj) {
    $tx_id = $obj['action_trace']['trx_id'];
    $tx_type = $obj['action_trace']['act']['name'];
    if ($tx_type === $prevType && $prevID === $tx_id && $prevID.$prevType !== null) {
      $prevID = $tx_id;
      $prevType = $tx_type;
      continue;
    } else;
    $prevID = $tx_id;
    $prevType = $tx_type;
    if($tx_type === "transfer") {
      $sender = $obj['action_trace']['act']['data']['from'];
      $receiver = $obj['action_trace']['act']['data']['to'];
      $amount = $obj['action_trace']['act']['data']['quantity'];
      $tx_time = '';
      $block = $obj['action_trace']['block_num'];
      $block_time = $obj['action_trace']['block_time'];
      $block_id = $obj['action_trace']['producer_block_id'];
      $tx_contract = $obj['action_trace']['act']['account'];
      echo '<transfer class="card m-3 p-2 row">';
        echo '<div class="row mx-auto">';
          echo '<div class="mx-auto col-lg-2 col-md-2 col-sm-12 col-12 col-xl-2 text-center">';
            echo '<a href="./?'. $chainName .'=' . $sender . '">';
            echo '<h5 class="mx-auto text-center text-white badge badge-danger">' . $sender . '</h5>';
            echo '</a>';
          echo '</div>';
        echo '<div class="mx-auto text-center col-lg-1 col-md-1 col-sm-12 col-12 col-xl-1">';
          echo '<i class="fas fa-arrow-right"></i>';
        echo '</div>';
        echo '<div class="text-center col-lg-3 col-md-3 col-sm-12 col-12 col-xl-3">';
          echo '<h5>' . $amount . '</h5>';
        echo '</div>';
        echo '<div class="mx-auto text-center col-lg-1 col-md-1 col-sm-12 col-12 col-xl-1">';
          echo '<i class="fas fa-arrow-right"></i>';
        echo '</div>';
        echo '<div class="mx-auto col-lg-2 col-md-2 col-sm-12 col-12 col-xl-2 text-center">';
          echo '<a href="./?'. $chainName .'=' . $receiver . '">';
          echo '<h5 class="mx-auto text-center text-white badge badge-success">' . $receiver . '</h5>';
          echo '</a>';
        echo '</div>';
      echo '</div>';
      echo '<div class="text-center w-100">';
        echo '<pre class="mb-0 mt-1">Receipt: <a href="?'. $chainName .'='. $tx_id .'"><span class="mb-0">' . $tx_id . '</span></a></pre>';
      echo '</div>';
    echo '</transfer>';
  } else {
    echo '<transfer class="card m-3 p-2 row">';
      echo '<div class="row mx-auto w-100">';
        echo '<span class="mx-auto text-center text-white badge badge-primary">';
          echo $tx_type;
        echo '</span>';
          echo '<div class="text-center w-100">';
            echo '<pre class="mb-0 mt-1">Receipt: <a href="?'. $chainName .'='. $tx_id .'"><span class="mb-0">' . $tx_id . '</span></a></pre>';
          echo '</div>';
        echo '</div>';
      echo '</transfer>';
    }
  }
  echo '</div>';
    echo '<script src="'.plugins_url().'/eurno-explorer/js/recent-tx-pages.js"></script>';
  echo '</div>';
  }
}
?>
</div>
</div>
</div>
</div>
