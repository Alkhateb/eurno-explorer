<?php
class Submenu_Page {
  public function render() {
      include_once( 'views/settings.php' );
  }
  public function enu_render() {
    include_once( 'views/enu-settings.php' );
  }
  public function eos_render() {
    include_once( 'views/eos-settings.php' );
  }
  public function tlos_render() {
    include_once( 'views/tlos-settings.php' );
  }
}
?>
