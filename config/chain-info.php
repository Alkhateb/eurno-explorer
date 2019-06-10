  <script>
  window.onload = setInterval(function(){
    $s = window.location.search;
    $arr = myScript.eurnoExplorer['eurno_data'];
    $chain = $s.split('=')[0];
    $chain = $chain.split('?')[1];
    if(!$chain || $chain === "preview"){
      $chain = "enu";
    }
    url = $arr['api'][$chain][0] + '/v1/chain/get_info';
    const beReq = async () => {
      await fetch(url, {
        method: "GET"
      })
      .then((beResp) => beResp.json())
      .then(function(beData) {
        var numberArray = [];
        for(var i = 1; i <= 20; i++){
          numberArray.push(i);
        }
        var vcpu = beData.virtual_block_cpu_limit;
        var vcpu_element = document.getElementById('v-block-cpu');
        var vnet = beData.virtual_block_net_limit;
        var vnet_element = document.getElementById('v-block-net');
        var acpu = beData.block_cpu_limit;
        var acpu_element = document.getElementById('block-cpu');
        var anet = beData.block_net_limit;
        var anet_element = document.getElementById('block-net');
        var version = beData.server_version_string;
        var version_element = document.getElementById('s-version');
        var hbn = beData.head_block_num;
        var hbn_element = document.getElementById('head-block-num');
        var hbid = beData.head_block_id;
        var hbid_element = document.getElementById('head-block-id');
        var hbt = beData.head_block_time;
        var hbt_element = document.getElementById('head-block-time');
        var bn = beData.last_irreversible_block_num
        var bn_element = document.getElementById('last-block-num');
        var bid = beData.last_irreversible_block_id
        var bid_element = document.getElementById('last-block-id');
        var cbp = beData.head_block_producer;
        var cbp_element = document.getElementById('current-block-producer');
        var bps = document.getElementsByClassName("block-producer");
        hbn_element.innerHTML = hbn;
        hbid_element.innerHTML = hbid;
        hbt_element.innerHTML = hbt;
        bn_element.innerHTML = bn;
        bid_element.innerHTML = bid;
        vcpu_element.innerHTML = vcpu;
        vnet_element.innerHTML = vnet;
        acpu_element.innerHTML = acpu;
        anet_element.innerHTML = anet;
        version_element.innerHTML = version;
        cbp_element.innerHTML = '<a href="./?' + $chain + '=' + cbp + '">' + cbp + '</a>';
        var bps = document.getElementsByClassName('block-producer');
        var arr = Array.from(bps);
        arr.forEach( element => {
          if(element.id < 22) {
            if(element.innerText === document.getElementById('current-block-producer').innerText) {
              document.getElementById('status-' + element.id).classList.remove("badge-warning");
              document.getElementById('status-' + element.id).classList.add("badge-success");
              document.getElementById('status-' + element.id).innerText = "Producing";
            } if(element.innerText !== document.getElementById('current-block-producer').innerText) {
              document.getElementById('status-' + element.id).classList.remove("badge-success");
              document.getElementById('status-' + element.id).classList.add("badge-warning");
              document.getElementById('status-' + element.id).innerText = "Idle";
            }
          }
        })
      })
    }
    beReq();
  },1000);
</script>
  <?php
    echo '<div id="chain-data" class="alert alert-primary">';
      echo '<div class="row break-word">';
        echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">';
        echo '<div class="w-100">Current Block Time: <span id="head-block-time">';
        echo '</span></div>';
          echo '<div class="w-100">Active Producer: <span id="current-block-producer">';
          echo '</span></div>';
          echo '<div class="w-100">Current Block Number: <span id="head-block-num">';
          echo '</span></div>';
          echo '<div class="w-100">Last Block Number: <span id="last-block-num">';
          echo '</span></div>';
          echo '<div class="w-100">Virtual CPU: <span id="v-block-cpu">';
          echo '</span></div>';
          echo '<div class="w-100">Virtual NET: <span id="v-block-net">';
          echo '</span></div>';
          echo '<div class="w-100">Actual CPU: <span id="block-cpu">';
          echo '</span></div>';
          echo '<div class="w-100">Actual NET: <span id="block-net">';
          echo '</span></div>';
          echo '<div class="w-100">Version: <span id="s-version">';
          echo '</span></div>';
        echo '</div>';
        echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">';
          echo '<div class="w-100">Last Block ID: <span id="last-block-id">';
          echo '</span></div>';
          echo '<div class="w-100">Current Block ID: <span id="head-block-id">';
          echo '</span></div>';
          echo '<div class="w-100 row mt-5">';
            echo '<div class="mx-auto text-center">';
            echo '<h5>Change Chain</h5>';
              echo '<a href="'. get_page_link() .'?enu" title="ENU" rel="internal" class="mx-2 btn btn-light"/>ENU</a>';
              echo '<a href="'. get_page_link() .'?eos" title="EOS" rel="internal" class="mx-2 btn btn-dark"/>EOS</a>';
              echo '<a href="'. get_page_link() .'?tlos" title="TELOS" rel="internal" class="mx-2 btn btn-warning"/>TELOS</a>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
 ?>
