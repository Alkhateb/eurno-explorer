<?php
class Serializer {
    public function init() {
        add_action( 'admin_post', array( $this, 'save' ) );
    }
    public function save() {
      // First, validate the nonce and verify the user as permission to save.
      if ( ! ( $this->has_valid_nonce() && current_user_can( 'manage_options' ) ) ) {
        wp_die( __("It seemes there has been an error, it seems to be an issue with the the browser cache, please try refreshing the page and then try again.") );
      }
      $plug = $_POST['plugin'];
      if($plug === 'refresh') {
        delete_option( 'eurno_explorer' );
        $this->redirect();

      } if(!$plug) {
      $chain = $_POST['chain'];
      if((!$_POST[$chain.'_name'] || !$_POST[$chain.'_contract'] || !$_POST[$chain.'_symbol'] || !$_POST[$chain.'_type'] || !$_POST[$chain.'_logo']) && (!isset($_POST[$chain.'_token']))){
        wp_die( __("It seems you haven't filled in all the information required to add a token. Make sure you complete all the fields.") );
      }
      $cur_tokens = get_option('eurno_explorer');
      if(isset($_POST[$chain.'_token'])) {
      $arr = $_POST[$chain.'_token'];
      foreach ($arr as $key => $cur) {
          unset($cur_tokens['eurno_data']['custom_tokens'][$chain][$key]);
        }
        update_option( 'eurno_explorer', $cur_tokens );
      }
      // If the above are valid, save the option.
      if ( wp_unslash( $_POST[$chain.'_name'] && $_POST[$chain.'_contract'] && $_POST[$chain.'_symbol'] && $_POST[$chain.'_logo'] &&  $_POST[$chain.'_type']) ) {
        $name = sanitize_text_field( $_POST[$chain.'_name'] );
        $contract = sanitize_text_field( $_POST[$chain.'_contract'] );
        $symbol = sanitize_text_field( $_POST[$chain.'_symbol'] );
        $type = $_POST[$chain.'_type'];
        $logo = esc_url($_POST[$chain.'_logo']);
        if(!isset(get_option('eurno_explorer')['eurno_data']['custom_tokens'][$chain])){
          $arr = [$chain =>
          array(
            ["name" => $name,
            "contract" => $contract,
            "symbol" => $symbol,
            "logo" => $logo,
            "type" => $type]
            )]
          ;
          $old = get_option('eurno_explorer');
          $old['eurno_data']['custom_tokens'] = $old['eurno_data']['custom_tokens']+$arr;
          $value = $old;
        } else {
          $arr = array(
            "name" => $name,
            "contract" => $contract,
            "symbol" => $symbol,
            "logo" => $logo,
            "type" => $type );
          $old = get_option('eurno_explorer');
          $old['eurno_data']['custom_tokens'][$chain][] = $arr;
          $value = $old;
        }
        update_option( 'eurno_explorer', $value );
      }
      $this->redirect();
    }
  }
    private function has_valid_nonce() {
    // If the field isn't even in the $_POST, then it's invalid.
    if ( ! isset( $_POST['eurno-explorer-message'] ) ) { // Input var okay.
        return false;
    }
    $field  = wp_unslash( $_POST['eurno-explorer-message'] );
    $action = 'eurno-explorer-save';
    return wp_verify_nonce( $field, $action );
  }
  private function redirect() {
    // To make the Coding Standards happy, we have to initialize this.
    if ( ! isset( $_POST['_wp_http_referer'] ) ) { // Input var okay.
        $_POST['_wp_http_referer'] = wp_login_url();
    }
    // Sanitize the value of the $_POST collection for the Coding Standards.
    $url = sanitize_text_field(
        wp_unslash( $_POST['_wp_http_referer'] ) // Input var okay.
    );
    // Finally, redirect back to the admin page.
    wp_safe_redirect( urldecode( $url ) );
    exit;
    }
}
?>
