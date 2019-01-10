<style>
.add-token {
  display: inline-block;
  width: 18%;
}
.add-token label {
  font-weight: 600;
}
.current-tokens label {
  font-weight: 600;
}
th{
  background-color: #BFE3CE;
}
tr{
  background-color: white;
}
td,th {
  min-width: 15%;
  padding-left:10px;
  padding-right:10px;
}

</style>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
        <div id="universal-message-container">
            <p>Use this page to manage the data which is displayed regarding the Enumivo blockchain. You can add custom tokens and change the API used, as well as prevent it from being displayed at all.</p>
            <div class="options">
              <div id="current-token-section">
                <h3>Current Tokens</h3>
                <p>The following tokens are already implemented to the Eurno Explorer.</p>
                <?php
                $default_tokens = get_option('eurno_explorer');
                echo '<div class="current-tokens">';
                echo '<h4>Default Tokens</h4>';
                  echo '<table>';
                    echo '<tr>';
                      echo '<th>Token Name</th>';
                      echo '<th>Token Contract</th>';
                      echo '<th>Token Symbol</th>';
                      echo '<th>Token Type</th>';
                      echo '<th>Logo</th>';
                    echo '</tr>';
                  foreach ($default_tokens['eurno_data']['default_tokens']['enu'] as $key => $token) {
                    echo '<tr>';
                      echo '<td>';
                        echo $token['name'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['contract'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['symbol'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['type'];
                      echo '</td>';
                      echo '<td>';
                        echo '<img height="20px" src="' . $token['logo'] . '" />';
                      echo '</td>';
                    echo '</tr>';
                  }
                  echo '</table>';
                echo '</div>';
                if(isset(get_option('eurno_explorer')['eurno_data']['custom_tokens']['enu'][0])){
                echo '<h4>Custom Tokens</h4>';
                  echo '<table>';
                    echo '<tr>';
                      echo '<th>Token Name</th>';
                      echo '<th>Token Contract</th>';
                      echo '<th>Token Symbol</th>';
                      echo '<th>Token Type</th>';
                      echo '<th>Logo</th>';
                      echo '<th>Remove?</th>';
                    echo '</tr>';
                  $tokens = get_option('eurno_explorer')['eurno_data']['custom_tokens']['enu'];
                  foreach ($tokens as $key => $token) {
                    echo '<tr>';
                      echo '<td>';
                        echo $token['name'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['contract'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['symbol'];
                      echo '</td>';
                      echo '<td>';
                        echo $token['type'];
                      echo '</td>';
                      echo '<td>';
                        echo '<img height="20px" src="' . $token['logo'] . '" />';
                      echo '</td>';
                      echo '<td style="text-align:center;">';
                        echo '<input type="checkbox" name="enu_token['.$key.']"/>';
                      echo '</td>';
                    echo '</tr>';
                  }
                  echo '</table>';
                echo '</div>';
              }
                ?>
              </div>
              <h3>Add an Enumivo token</h3>
              <p>Enter the details of the Enumivo token you wish to add to the Eurno Explorer.</p>
              <div id="token-input-section">
                <div class="add-token">
                  <label>Token Name</label>
                  <br />
                  <input type="text" name="enu_name"/>
                </div>
                <div class="add-token">
                  <label>Token Contract</label>
                  <br />
                  <input type="text" name="enu_contract"/>
                </div>
                <div class="add-token">
                  <label>Token Symbol</label>
                  <br />
                  <input type="text" name="enu_symbol"/>
                </div>
                <div class="add-token">
                  <label>Token Logo URL</label>
                  <br />
                  <input type="text" name="enu_logo"/>
                </div>
                <div class="add-token">
                  <label>Token Type</label>
                  <br />
                  <select name="enu_type"/>
                    <option value="token">Token</option>
                    <option value="coin">Coin</option>
                    <option value="share">Share</option>
                    <option value="stable-coin">Stable Coin</option>
                  </select>
                </div>
              </div>
        </div><!-- #universal-message-container -->
        <input type="hidden" name="chain" value="enu">
        <?php
        wp_nonce_field( 'eurno-explorer-save', 'eurno-explorer-message' );
        submit_button();
        ?>
    </form>
</div><!-- .wrap -->
