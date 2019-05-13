<?php
echo '<div class="w-100 eno-holder" style="font-size:15px;"">';
echo "<div class='w-100'>";
echo "<form role='search'>";
  echo "<div class='p-2 input-group' id='search_enu'>";
    echo '<select id="chain-select" class="custom-select custom-select my-2 bg-light col-2" onchange="chainselect();">',
    '<option id="select-enu" value="enu">Enumivo</option>',
    '<option id="select-eos" value="eos">EOS</option>',
    '<option id="select-tlos" value="tlos">Telos</option>',
    '</select>';
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo '<input type="text" class="my-2 form-control col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8" placeholder="Enter account name/transaction ID" name="enu" id="srch-term" required {$search_value} />';
        echo "<div class=' p-0 row my-2 input-group-append col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4'>";
            echo "<button class='btn btn btn-outline-secondary' type='submit'>Submit</button>";
            echo "<a class='btn btn-outline-secondary' href=' ". get_page_link() . "'>Chain Info</a>";
      echo "</div>";
    echo "</form>";
  echo "</div>";
  if(isset($_GET[$chainName])){
    echo '<div class="alert alert-info">';
      echo '<h6 class="text-center mb-0">Currently browsing the <b>' . $chainName . '</b> blockchain</h6>';
    echo '</div>';
  } else {
    echo '<div class="alert alert-info">';
      echo '<h6 class="text-center mb-0">Currently browsing the <b>enu</b> blockchain</h6>';
    echo '</div>';
  }
?>
<script type="text/javascript">
$s = window.location.search;
$chain = $s.split('=')[0];
$chain = $chain.split('?')[1];
$query = $s.split('=')[1];
$selector = document.getElementById('chain-select');
$selector.value = $chain;
if(!$chain){
  $selector.value = "enu";
}
if($chain){
  document.getElementById('srch-term').name = $chain;
}
  function chainselect(){
    var chain = document.getElementById("chain-select").value;
    document.getElementById('srch-term').name = chain;
  }
</script>
