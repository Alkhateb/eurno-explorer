<?php
function begin_eurno_explorer() {
if (!isset($_GET['action'])) {
if((!empty(key($_GET))) ){
$chainName = key($_GET);
if(isset($_GET[$chainName])){
  $name = $_GET[$chainName];
}
if(isset(get_option('eurno_explorer')['eurno_data']['api'][$chainName][0])){
  $api = get_option('eurno_explorer')['eurno_data']['api'][$chainName][0];
}
if(!isset(get_option('eurno_explorer')['eurno_data']['api'][$chainName][0])) {
  $api = 'https://enu.qsx.io:443';
}
} else {
$chainName = 'enu';
$api = 'https://enu.qsx.io:443';
}
include_once "header.php";
include_once "config/search.php";
if((isset($_GET[$chainName])) && (empty($_GET[$chainName])) || (!isset($_GET[$chainName]))) {
  include_once "config/chain-info.php";
  include_once "config/block-producers.php";
  return;
} elseif(isset($_GET[$chainName]) && (strlen($_GET[$chainName]) === 64) && (ctype_xdigit($_GET[$chainName]))) {
  include_once "config/transaction.php";
  return;
} elseif((isset($_GET[$chainName])) && (strlen($_GET[$chainName]) <= 12)){
  include_once 'config/recent-transactions.php';
  return;
}
$term = implode(", ", $_GET);
$chain = key($_GET);
echo '<div class="card border border-danger mt-5">';
  echo '<div class="card-header alert alert-danger">';
    echo 'Showing results for: '.$term.' on: ' . $chain;
  echo '</div>';
  echo '<div class="card-body">';
    echo '<div class="p-4">';
      echo '<h4>Well, this is embarassing.</h4>';
      echo '<p>We can\'t seem to find anything for <b>'.$term.'</b> on the <b>'.$chain.'</b> blockchain. Are you sure you have entered a valid transaction ID or account name?.</p>';
    echo '</div>';
  echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}
}
  ?>
