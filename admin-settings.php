<?php
if ( ! defined( 'WPINC' ) ) {
     die;
}
include_once "admin/class-submenu.php";
include_once "admin/class-submenu-page.php";
include_once "admin/class-serializer.php";
add_action( 'plugins_loaded', 'eurno_explorer_admin_settings' );
function eurno_explorer_admin_settings() {
    if(!get_option('eurno_explorer')){
      $value = array( "eurno_data" =>
      array(
        "default_tokens" => array(
          "enu" => array(
            [ "name" => "Enumivo",
            "contract" => "enu.token",
            "symbol" => "ENU",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "coin" ],
            [ "name" => "Eurno",
            "contract" => "token.eurno",
            "symbol" => "ENO",
            "logo" => plugin_dir_url(__FILE__) . "img/eno.png",
            "type" => "token" ],
            [ "name" => "EOS",
            "contract" => "stable.coin",
            "symbol" => "EOS",
            "logo" => plugin_dir_url(__FILE__) . "img/eos.png",
            "type" => "stable coin" ],
            [ "name" => "Frequent Trader Points",
            "contract" => "ftp.coin",
            "symbol" => "FTP",
            "logo" => plugin_dir_url(__FILE__) . "img/ftp.png",
            "type" => "token" ],
            [ "name" => "Enumivo Liquidity Network",
            "contract" => "eln.coin",
            "symbol" => "ELN",
            "logo" => plugin_dir_url(__FILE__) . "img/eln.png",
            "type" => "stable coin" ],
            [ "name" => "Ethereum",
            "contract" => "iou.coin",
            "symbol" => "ETH",
            "logo" => plugin_dir_url(__FILE__) . "img/eth.png",
            "type" => "coin" ],
            [ "name" => "Bitcoin",
            "contract" => "iou.coin",
            "symbol" => "BTC",
            "logo" => plugin_dir_url(__FILE__) . "img/btc.png",
            "type" => "coin" ],
            [ "name" => "ENUFTP shares",
            "contract" => "shares.coin",
            "symbol" => "ENUFTP",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "share" ],
            [ "name" => "ENUETH shares",
            "contract" => "shares.coin",
            "symbol" => "ENUETH",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "share" ],
            [ "name" => "ENUBTC shares",
            "contract" => "shares.coin",
            "symbol" => "ENUBTC",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "share" ],
            [ "name" => "ENUENO shares",
            "contract" => "shares.coin",
            "symbol" => "ENUENO",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "share" ],
            [ "name" => "ENUEOS shares",
            "contract" => "shares.coin",
            "symbol" => "ENUEOS",
            "logo" => plugin_dir_url(__FILE__) . "img/enu.png",
            "type" => "share" ]
          ),
          "eos" => array(
            [ "name" => "EOS",
            "contract" => "eosio.token",
            "symbol" => "EOS",
            "logo" => plugin_dir_url(__FILE__) . "img/eos.png",
            "type" => "coin" ],
            [ "name" => "Everipedia",
            "contract" => "everipediaiq",
            "symbol" => "IQ",
            "logo" => plugin_dir_url(__FILE__) . "img/iq.png",
            "type" => "token" ],
            [ "name" => "EOS Black",
            "contract" => "eosblackteam",
            "symbol" => "BLACK",
            "logo" => plugin_dir_url(__FILE__) . "img/black.png",
            "type" => "token" ],
            [ "name" => "Bet Dice",
            "contract" => "betdicetoken",
            "symbol" => "DICE",
            "logo" => plugin_dir_url(__FILE__) . "img/dice.png",
            "type" => "token" ],
            [ "name" => "Chaince",
            "contract" => "eosiochaince",
            "symbol" => "CET",
            "logo" => plugin_dir_url(__FILE__) . "img/chaince.png",
            "type" => "token" ],
            [ "name" => "Pro Chain",
            "contract" => "epraofficial",
            "symbol" => "EPRA",
            "logo" => plugin_dir_url(__FILE__) . "img/epra.png",
            "type" => "token" ],
            [ "name" => "EOSDAC",
            "contract" => "eosdactokens",
            "symbol" => "EOSDAC",
            "logo" => plugin_dir_url(__FILE__) . "img/eosdac.png",
            "type" => "token" ],
            [ "name" => "Bancor",
            "contract" => "bntbntbntbnt",
            "symbol" => "BNT",
            "logo" => plugin_dir_url(__FILE__) . "img/bnt.png",
            "type" => "token" ]
          ),
          "tlos" => array(
            [ "name" => "Telos",
            "contract" => "eosio.token",
            "symbol" => "TLOS",
            "logo" => plugin_dir_url(__FILE__) . "img/tlos.png",
            "type" => "coin" ]
          )
        ),
        "custom_tokens" => array(),
        "api" => array(
          "enu" => array(
            "https://enu.qsx.io:443"
          ),
          "eos" => array(
            "https://eos.greymass.com:443"
          ),
          "tlos" => array(
            "https://api.telosfoundation.io"
          )
        )
      )
    );
    update_option( 'eurno_explorer', $value, 'no' );
  }
  $serializer = new Serializer();
  $serializer->init();
  $plugin = new Submenu( new Submenu_Page( $serializer ) );
  $plugin->init();
}
