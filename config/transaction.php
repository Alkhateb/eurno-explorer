<?php
  $url = $api . '/v1/history/get_transaction';
  $search_term = $_GET[$chainName];
    $params = array(
       "id" => $search_term
    );
    $post_data = $params;
    //Encode the POST data
    $data_string = json_encode($post_data);
    // create curl resource
    $ch = curl_init();
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
    $obj = json_decode($output, true);
    // close curl resource to free up system resources
    curl_close($ch);
    $page_title = 'Showing results for: ' . $search_term;
    if(isset($obj['error'])){
      echo '<div class="card border border-danger mt-5">';
        echo '<div class="card-header alert alert-danger">';
          echo $page_title;
        echo '</div>';
        echo '<div class="card-body">';
          echo '<div class="p-4">';
            echo '<h4>Theres been an error. The server provided the following message:</h4>';
            echo '<p><i>"' . $obj['error']['details'][0]['message'] . '"</i></p>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
      return;
    }
    $raw_data = json_encode($obj, JSON_PRETTY_PRINT);
    $status = $obj['trx']['receipt']['status'];
    $cpu = $obj['trx']['receipt']['cpu_usage_us'];
    $net = $obj['trx']['receipt']['net_usage_words'];
    $type = $obj['traces'][0]['act']['name'];
    $traces = $obj['traces'];
    $id = $obj['id'];
    $time = $obj['block_time'];
    $number = $obj['block_num'];
    $last = $obj['last_irreversible_block'];
    echo '<div class="card">';
      echo '<div class="card-header">';
        echo $page_title;
      echo '</div>';
      echo '<div class="card-body">';
        echo '<div class="row">';
          if($type === "transfer"){
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">Sender: <a href="./?'. $chainName .'=' . $obj['trx']['trx']['actions'][0]['data']['from'] . '">' . $obj['trx']['trx']['actions'][0]['data']['from'] . '</a></h5>';
              echo '<h5 class="m-1">Receiver: <a href="./?'. $chainName .'=' . $obj['trx']['trx']['actions'][0]['data']['to'] . '">' . $obj['trx']['trx']['actions'][0]['data']['to'] . '</a></h5>';
              echo '<h5 class="m-1">Amount: ' . $obj['trx']['trx']['actions'][0]['data']['quantity'] . '</h5>';
              echo '<h5 class="m-1">Memo: ' . $obj['trx']['trx']['actions'][0]['data']['memo'] . '</h5>';
              echo '<h5 class="m-1">Acting Account: <a href="./?'. $chainName .'=' . $obj['trx']['trx']['actions'][0]['authorization'][0]['actor'] . '">' . $obj['trx']['trx']['actions'][0]['authorization'][0]['actor']  . '</a></h5>';
              echo '<h5 class="m-1">Permission Status: ' . $obj['trx']['trx']['actions'][0]['authorization'][0]['permission'] . '</h5>';
              echo '<h5 class="m-1">Token Contract: <a href="./?'. $chainName .'=' . $obj['trx']['trx']['actions'][0]['account'] . '">' . $obj['trx']['trx']['actions'][0]['account'] . '</a></h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          } elseif ($type === "voteproducer"){
            $txData = $obj['trx']['trx']['actions'][0];
            $auth = $txData['authorization'][0]['actor'];
            $perm = $txData['authorization'][0]['permission'];
            $voter = $txData['data']['voter'];
            $proxy = $txData['data']['proxy'];
            $voted = $txData['data']['producers'];
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">Voter: <a href="./?'. $chainName .'='. $voter .'">' . $voter . '</a></h5>';
              echo '<h5 class="m-1">Voted: <i>' . implode(", ", $voted) . '</i></h5>';
              echo '<h5 class="m-1">Proxy: ' . $proxy . '</h5>';
              echo '<h5 class="m-1">Authorisor: <a href="./?'. $chainName .'='. $auth .'">' . $auth . '</a></h5>';
              echo '<h5 class="m-1">Permission Status: ' . $perm . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          } elseif ($type === "undelegatebw") {
            $txData = $obj['trx']['trx']['actions'];
            $perm = $txData[0]['authorization'][0]['permission'];
            $actor = $txData[0]['authorization'][0]['actor'];
            $receiver = $txData[0]['data']['receiver'];
            $unstake_cpu = $txData[0]['data']['unstake_cpu_quantity'];
            $unstake_net = $txData[0]['data']['unstake_net_quantity'];
            $sender = $txData[0]['data']['from'];
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">Unstaked CPU: ' . $unstake_cpu . '</h5>';
              echo '<h5 class="m-1">Unstaked NET: ' . $unstake_net . '</h5>';
              echo '<h5 class="m-1">Actor: <a href="./?'. $chainName .'=' . $actor . '">' . $actor . '</a></h5>';
              echo '<h5 class="m-1">Sender: <a href="./?'. $chainName .'=' . $sender . '">' . $sender . '</a></h5>';
              echo '<h5 class="m-1">Receiver: <a href="./?'. $chainName .'=' . $receiver . '">' . $receiver . '</a></h5>';
              echo '<h5 class="m-1">Permission Status: ' . $perm . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          } elseif ($type === "refund") {
            $txData = $obj['traces'][1]['act'];
            $sender = $txData['data']['from'];
            $receiver = $txData['data']['to'];
            $amount = $txData['data']['quantity'];
            $memo = $txData['data']['memo'];
            $auth = $txData['authorization'][0]['actor'];
            $perm = $txData['authorization'][0]['permission'];
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">From: <a href="./?'. $chainName .'=' . $sender . '">' . $sender . '</a></h5>';
              echo '<h5 class="m-1">To: <a href="./?'. $chainName .'=' . $receiver . '">' . $receiver . '</a></h5>';
              echo '<h5 class="m-1">Amount: ' . $amount . '</h5>';
              echo '<h5 class="m-1">Memo: ' . $memo . '</h5>';
              echo '<h5 class="m-1">Actor: <a href="./?'. $chainName .'=' . $auth . '">' . $auth . '</a></h5>';
              echo '<h5 class="m-1">Permission Status: ' . $perm . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          } elseif ($type === "claimrewards") {
            $last_inline = $obj['traces'][0]['inline_traces'];
            $txData = $obj['traces'][0]['inline_traces'][count($last_inline) - 1]['act'];
            $sender = $txData['data']['from'];
            $receiver = $txData['data']['to'];
            $amount = $txData['data']['quantity'];
            $memo = $txData['data']['memo'];
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">From: <a href="./?'. $chainName .'=' . $sender . '">' . $sender . '</a></h5>';
              echo '<h5 class="m-1">To: <a href="./?'. $chainName .'=' . $receiver . '">' . $receiver . '</a></h5>';
              echo '<h5 class="m-1">Amount: ' . $amount . '</h5>';
              echo '<h5 class="m-1">Memo: ' . $memo . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          } else {
            echo '<div class="col">';
              echo '<h5 class="m-1">TX Type: ' . $type . '</h5>';
              echo '<h5 class="m-1">TX Status: ' . $status . '</h5>';
              echo '<h5 class="m-1">CPU Cost: ' . $cpu . '</h5>';
              echo '<h5 class="m-1">NET Cost: ' . $net . '</h5>';
              echo '<h5 class="m-1">Block Time: ' . $time . '</h5>';
              echo '<h5 class="m-1">Block Number:  ' . $number . '</h5>';
              echo '<h5 class="m-1">Last Irreversible Block: ' . $last . '</h5>';
              echo '<h5 class="m-1">Inline Transactions: ' . count($traces) . '</h5>';
            echo '</div>';
            echo '<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 my-auto" id="qrCode">';
            echo '</div>';
            echo '<script>
              var QRC = qrcodegen.QrCode
              var qr0 = QRC.encodeText("' . $id . '", QRC.Ecc.MEDIUM)
              var svg = qr0.toSvgString(4)
              document.getElementById("qrCode").innerHTML = svg
            </script>';
          }
        echo '</div>';
      echo '</div>';
      echo '<pre class="alert alert-info p-2 m-3 txraw" id="rawtx">';
        echo '<script>renderjson.set_show_to_level(2);document.getElementById("rawtx").appendChild(renderjson('.$raw_data.'));</script>';
      echo '</pre>';
    echo '</div>';
?>
</div>
</div>
