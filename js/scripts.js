function balances($account_name, $api, $chainName) {
    $default = myScript.eurnoExplorer['eurno_data']['default_tokens'][$chainName];
    $arr = [];
    $i = 0;
    if($default){
      $default.forEach(function(default_tokens){
      $code = default_tokens['contract'];
      $symbol = default_tokens['symbol'];
        $arr[$i] = new Object({code : $code, account : $account_name, symbol : $symbol});
      $i++;
      $joint = $default;
    });
    if(myScript.eurnoExplorer['eurno_data']['custom_tokens'][$chainName]){
        $custom = myScript.eurnoExplorer['eurno_data']['custom_tokens'][$chainName];
        $custom.forEach(function(cust_tokens){
          $code = cust_tokens['contract'];
          $symbol = cust_tokens['symbol'];
            $arr[$i] = new Object({code : $code, account : $account_name, symbol : $symbol});
          $i++;
          $joint = $default.concat($custom);
        })
      }
    var contNode = document.createElement('div');
    contNode.setAttribute("class", "my-2 row");
    var referenceNode = document.getElementById('ac-info');
    referenceNode.after(contNode);
    var ac_info = {
      "account_name" : $account_name
    };
    const url = $api + '/v1/chain/get_currency_balance';
    $arr.forEach(function($bal_info, i) {
    const btcreq = async () => {
      await fetch(url, {
        method: "POST",
        async: true,
        body: JSON.stringify($bal_info),
      })
      .then(function(response) {
        if (!response.ok) {
        throw Error(response.statusText);
      }
        return response;
      })
      .then((btcresp) => btcresp.json())
      .then(function(btcdata) {
        $balance = btcdata[0];
        if($balance){
          $balanceCheck = (btcdata[0]).replace(/[^0-9.]/ig,"");
          if($balanceCheck > 0){
            $label = $joint[i]['type'];
            $img = $joint[i]['logo'];
            $check = $balance.replace( /[^a-z]/ig, "");
            if($label.toLowerCase() === "coin"){
              $curType = "badge badge-success";
            }
            else;
            if($label.toLowerCase() === "share"){
              $curType = "badge badge-warning";
            }
            else;
            if($label.toLowerCase() === "stable coin"){
              $curType = "badge badge-danger";
            }
            else;
            if($label.toLowerCase() === "token"){
              $curType = "badge badge-secondary";
            }
            newImg = document.createElement("img");
            newImg.setAttribute("height", "30px");
            newImg.setAttribute("src", $img);
            var newNode0 = document.createElement('div'),
            newNode1 = document.createElement('div'),
            newNode2 = document.createElement('div'),
            newNode3 = document.createElement('div'),
            newNode4 = document.createElement('div'),
            newBold = document.createElement('b'),
            newContent = document.createTextNode(btcdata[0]);
            newNode0.setAttribute("id", "btc-bal");
            newNode0.setAttribute("class", " mx-auto card p-1 my-2 col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5");
            newNode1.setAttribute("class", "card-body p-1");
            newNode2.setAttribute("class", "row");
            newNode3.setAttribute("class", "col-2 mr-3");
            newNode4.setAttribute("class", "col");
            newNode0.appendChild(newNode1);
            newNode1.appendChild(newNode2);
            newNode2.appendChild(newNode3);
            newNode3.appendChild(newImg);
            newNode2.appendChild(newNode4);
            newBold.appendChild(newContent);
            newNode4.appendChild(newBold);
            contNode.appendChild(newNode0);
            var statusCont = document.createTextNode($label);
            var statusNode = document.createElement('p');
            statusNode.setAttribute("class", $curType);
            statusNode.appendChild(statusCont);
            newNode2.appendChild(statusNode);
          }
        }
      })
      .catch(function(error) {
        console.log(error);
      });
    }
    btcreq();
  });
  }
}
