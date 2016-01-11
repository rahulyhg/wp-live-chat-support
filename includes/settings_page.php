<?php wplc_stats("settings"); ?>

<?php
if (get_option("WPLC_HIDE_CHAT") == true) {
    $wplc_hide_chat = "checked";
} else {
    $wplc_hide_chat = "";
};

?>
<div class="wrap">
    <style>
        .wplc_light_grey{
            color: #666;
        }
    </style>
    <div id="icon-edit" class="icon32 icon32-posts-post">
        <br>
    </div>
    <h2><?php _e("WP Live Chat Support Settings","wplivechat")?></h2>
    <?php
        $wplc_settings = get_option("WPLC_SETTINGS");
        
        $wplc_mail_type = get_option("wplc_mail_type");
        if (!isset($wplc_mail_type) || $wplc_mail_type == "" || !$wplc_mail_type) { $wplc_mail_type = "wp_mail"; }
        if ($wplc_settings["wplc_settings_align"]) { $wplc_settings_align[intval($wplc_settings["wplc_settings_align"])] = "SELECTED"; }
        if ($wplc_settings["wplc_settings_enabled"]) { $wplc_settings_enabled[intval($wplc_settings["wplc_settings_enabled"])] = "SELECTED"; }
        if ($wplc_settings["wplc_settings_fill"]) { $wplc_settings_fill = $wplc_settings["wplc_settings_fill"]; } else { $wplc_settings_fill = "ed832f"; }
        if ($wplc_settings["wplc_settings_font"]) { $wplc_settings_font = $wplc_settings["wplc_settings_font"]; } else { $wplc_settings_font = "FFFFFF"; }
        if(get_option("WPLC_HIDE_CHAT") == true) { $wplc_hide_chat = "checked"; } else { $wplc_hide_chat = ""; };
        
     ?>
    <form action='' name='wplc_settings' method='POST' id='wplc_settings'>
    
    <div id="wplc_tabs">
      <ul>
        <?php 
          $tab_array = array(
            0 => array(
              "href" => "#tabs-1",
              "icon" => 'fa fa-gear',
              "label" => __("General Settings","wplivechat")
            ),
            1 => array(
              "href" => "#tabs-2",
              "icon" => 'fa fa-envelope',
              "label" => __("Chat Box","wplivechat")
            ),
            2 => array(
              "href" => "#tabs-3",
              "icon" => 'fa fa-book',
              "label" => __("Offline Messages","wplivechat")
            ),
            3 => array(
              "href" => "#tabs-4",
              "icon" => 'fa fa-pencil',
              "label" => __("Styling","wplivechat")
            ),
            4 => array(
              "href" => "#tabs-5",
              "icon" => 'fa fa-users',
              "label" => __("Agents","wplivechat")
            ),
            5 => array(
              "href" => "#tabs-7",
              "icon" => 'fa fa-gavel',
              "label" => __("Blocked Visitors","wplivechat")
            )
          );
          $tabs_top = apply_filters("wplc_filter_setting_tabs",$tab_array);

          foreach ($tabs_top as $tab) {
            echo "<li><a href=\"".$tab['href']."\"><i class=\"".$tab['icon']."\"></i> ".$tab['label']."</a></li>";
          }

        ?>
       
      </ul>
      <div id="tabs-1">
          <h3><?php _e("Main Settings",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                  <td width='400' valign='top'><?php _e("Chat enabled","wplivechat")?>: </td>
                  <td>
                      <select id='wplc_settings_enabled' name='wplc_settings_enabled'>
                          <option value="1" <?php if (isset($wplc_settings_enabled[1])) { echo $wplc_settings_enabled[1]; } ?>><?php _e("Yes","wplivechat"); ?></option>
                          <option value="2" <?php if (isset($wplc_settings_enabled[2])) { echo $wplc_settings_enabled[2]; }?>><?php _e("No","wplivechat"); ?></option>
                      </select>
                  </td>
              </tr>
                  <tr>
                      <td width='400' valign='top'>
                        <?php _e("Hide Chat", "wplivechat") ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Hides chat for 24hrs when user clicks X", "wplivechat") ?>"></i>
                      </td>
                      <td valign='top'>
                          <input type="checkbox" name="wplc_hide_chat" value="true" <?php echo $wplc_hide_chat ?>/>
                      </td>
                  </tr>              
                  <tr>
                  <td width='200' valign='top'>
                      <?php _e("Require Name And Email","wplivechat")?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Users will have to enter their Name and Email Address when starting a chat", "wplivechat") ?>"></i>                      
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_require_user_info" <?php if(isset($wplc_settings['wplc_require_user_info'])  && $wplc_settings['wplc_require_user_info'] == 1 ) { echo "checked"; } ?> />                    
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Input Field Replacement Text","wplivechat")?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("This is the text that will show in place of the Name And Email fields", "wplivechat") ?>"></i>                      
                  </td>
                  <td valign='top'>
                      <textarea cols="45" rows="5" name="wplc_user_alternative_text" ><?php if(isset($wplc_settings['wplc_user_alternative_text'])) { echo stripslashes($wplc_settings['wplc_user_alternative_text']); } ?></textarea>
                </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Use Logged In User Details","wplivechat")?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("A user's Name and Email Address will be used by default if they are logged in.", "wplivechat") ?>"></i>                      
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_loggedin_user_info" <?php if(isset($wplc_settings['wplc_loggedin_user_info'])  && $wplc_settings['wplc_loggedin_user_info'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Enable On Mobile Devices","wplivechat"); ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Disabling this will mean that the Chat Box will not be displayed on mobile devices. (Smartphones and Tablets)", "wplivechat") ?>"></i>                      
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_enabled_on_mobile" <?php if(isset($wplc_settings['wplc_enabled_on_mobile'])  && $wplc_settings['wplc_enabled_on_mobile'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Record a visitor's IP Address","wplivechat"); ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Disable this to enable anonymity for your visitors", "wplivechat") ?>"></i>                  
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_record_ip_address" <?php if(isset($wplc_settings['wplc_record_ip_address'])  && $wplc_settings['wplc_record_ip_address'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Play a sound when a new message is received","wplivechat"); ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Disable this to mute the sound that is played when a new chat message is received", "wplivechat") ?>"></i>
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_enable_msg_sound" <?php if(isset($wplc_settings['wplc_enable_msg_sound'])  && $wplc_settings['wplc_enable_msg_sound'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>


          </table>
          <?php do_action('wplc_hook_admin_settings_main_settings_after'); ?>
      </div>
      <div id="tabs-2">
          <h3><?php _e("Chat Window Settings",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                  <td width='420' valign='top'><?php _e("Chat box alignment","wplivechat")?>:</td>
                  <td>
                      <select id='wplc_settings_align' name='wplc_settings_align'>
                          <option value="1" <?php if (isset($wplc_settings_align[1])) { echo $wplc_settings_align[1]; } ?>><?php _e("Bottom left","wplivechat"); ?></option>
                          <option value="2" <?php if (isset($wplc_settings_align[2])) { echo $wplc_settings_align[2]; } ?>><?php _e("Bottom right","wplivechat"); ?></option>
                          <option value="3" <?php if (isset($wplc_settings_align[3])) { echo $wplc_settings_align[3]; } ?>><?php _e("Left","wplivechat"); ?></option>
                          <option value="4" <?php if (isset($wplc_settings_align[4])) { echo $wplc_settings_align[4]; } ?>><?php _e("Right","wplivechat"); ?></option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>
                      <?php _e("Auto Pop-up","wplivechat") ?> <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Expand the chat box automatically (prompts the user to enter their name and email address).","wplivechat") ?>"></i>
                  </td>
                  <td>
                      <input type="checkbox" name="wplc_auto_pop_up" value="1" <?php if(isset($wplc_settings['wplc_auto_pop_up'])  && $wplc_settings['wplc_auto_pop_up'] == 1 ) { echo "checked"; } ?>/>
                  </td>
              </tr>
              <tr>
            
              <tr>
                  <td>
                      <?php _e("Display name and avatar in chat", "wplivechat") ?> <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Display the agent and user name above each message in the chat window.", "wplivechat") ?>"></i>
                  </td>
                  <td>
                      <input type="checkbox" name="wplc_display_name" value="1" <?php if (isset($wplc_settings['wplc_display_name']) && $wplc_settings['wplc_display_name'] == 1) {
                          echo "checked";
                      } ?>/>
                  </td>
              </tr>
              <tr>
                  <td>
                      <?php _e("Only show the chat window to users that are logged in", "wplivechat") ?> <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("By checking this, only users that are logged in will be able to chat with you.", "wplivechat") ?>"></i>
                  </td>
                  <td>
                      <input type="checkbox" name="wplc_display_to_loggedin_only" value="1" <?php
                      if (isset($wplc_settings['wplc_display_to_loggedin_only']) && $wplc_settings['wplc_display_to_loggedin_only'] == 1) {
                          echo "checked";
                      }
                      ?>/>
                  </td>
              </tr>              
          </table>
          <?php do_action('wplc_hook_admin_settings_chat_box_settings_after'); ?>

      </div>
                  <div id="tabs-3">
                <h3><?php _e("Offline Messages", 'wplivechat') ?></h3> 
                <table class='form-table' width='100%'>
                    <tr>
                        <td>
<?php _e("Do not allow users to send offline messages", "wplivechat") ?> <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("The chat window will be hidden when it is offline. Users will not be able to send offline messages to you", "wplivechat") ?>"></i>
                        </td>
                        <td>
                            <input type="checkbox" name="wplc_hide_when_offline" value="1" <?php
if (isset($wplc_settings['wplc_hide_when_offline']) && $wplc_settings['wplc_hide_when_offline'] == 1) {
    echo "checked";
}
?>/>
                        </td>
                    </tr>
                    <tr>
                        <td width='400' valign='top'>
<?php _e("Email Address", "wplivechat") ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?php _e("Email address where offline messages are delivered to. Use comma separated email addresses to send to more than one email address", "wplivechat") ?>"></i>
                        </td>
                        <td>
                            <input id="wplc_pro_chat_email_address" name="wplc_pro_chat_email_address" class="regular-text" type="text" value="<?php if (isset($wplc_settings['wplc_pro_chat_email_address'])) {
    echo $wplc_settings['wplc_pro_chat_email_address']; } ?>" />
                        </td>
                    </tr>

                </table>
                <hr/>
                <table >
                    <tr>
                        <td width="400"><?php _e("Sending Method", "wplivechat") ?></td>
                        <td width="400" style="text-align: center;"><?php _e("WP Mail", "wplivechat") ?></td>
                        <td width="400" style="text-align: center;"><?php _e("PHP Mailer", "wplivechat") ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: center;"><input class="wplc_mail_type_radio" type="radio" value="wp_mail" name="wplc_mail_type" <?php if ($wplc_mail_type == "wp_mail") {
    echo "checked";
} ?>></td>
                        <td style="text-align: center;"><input id="wpcl_mail_type_php" class="wplc_mail_type_radio" type="radio" value="php_mailer" name="wplc_mail_type" <?php if ($wplc_mail_type == "php_mailer") {
    echo "checked";
} ?>></td>
                    </tr>
                </table>
                <hr/>
                <table id="wplc_smtp_details" class='form-table' width='100%'>
                    <tr>
                        <td width="400" valign="top">
<?php _e("Host", "wplivechat") ?>: 
                        </td>
                        <td>
                            <input id="wplc_mail_host" name="wplc_mail_host" type="text" class="regular-text" value="<?php echo get_option("wplc_mail_host") ?>" placeholder="smtp.example.com" />
                        </td>
                    </tr>
                    <tr>
                        <td>
<?php _e("Port", "wplivechat") ?>: 
                        </td>
                        <td>
                            <input id="wplc_mail_port" name="wplc_mail_port" type="text" class="regular-text" value="<?php echo get_option("wplc_mail_port") ?>" placeholder="25" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                                        <?php _e("Username", "wplivechat") ?>: 
                        </td>
                        <td>
                            <input id="wplc_mail_username" name="wplc_mail_username" type="text" class="regular-text" value="<?php echo get_option("wplc_mail_username") ?>" placeholder="me@example.com" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                                        <?php _e("Password", "wplivechat") ?>: 
                        </td>
                        <td>
                            <input id="wplc_mail_password" name="wplc_mail_password" type="password" class="regular-text" value="<?php echo get_option("wplc_mail_password") ?>" placeholder="Password" />
                        </td>
                    </tr>
                </table>
                <table class='form-table' width='100%'>
                    <tr>
                        <td width="400" valign="top"><?php _e("Offline Chat Box Title", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_na" name="wplc_pro_na" type="text" size="50" maxlength="50" class="regular-text" value="<?php if (isset($wplc_settings['wplc_pro_na'])) { echo stripslashes($wplc_settings['wplc_pro_na']); } ?>" /> <br />


                        </td>
                    </tr>
                    <tr>
                        <td width="400" valign="top"><?php _e("Offline Text Fields", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_offline1" name="wplc_pro_offline1" type="text" size="50" maxlength="150" class="regular-text" value="<?php if (isset($wplc_settings['wplc_pro_offline1'])) { echo stripslashes($wplc_settings['wplc_pro_offline1']); } ?>" /> <br />
                            <input id="wplc_pro_offline2" name="wplc_pro_offline2" type="text" size="50" maxlength="50" class="regular-text" value="<?php if (isset($wplc_settings['wplc_pro_offline2'])) { echo stripslashes($wplc_settings['wplc_pro_offline2']); } ?>" /> <br />
                            <input id="wplc_pro_offline3" name="wplc_pro_offline3" type="text" size="50" maxlength="150" class="regular-text" value="<?php if (isset($wplc_settings['wplc_pro_offline3'])) { echo stripslashes($wplc_settings['wplc_pro_offline3']); } ?>" /> <br />


                        </td>
                    </tr>
                </table>

            </div>

      
      
      <div id="tabs-4">
                <style>
                    .wplc_theme_block img{
                        border: 1px solid #CCC;
                        border-radius: 5px;
                        padding: 5px;
                        margin: 5px;
                    }         
                    .wplc_theme_single{
                        width: 162px;
                        height: 162px;
                        text-align: center;
                        display: inline-block;
                        vertical-align: top;
                        margin: 5px;
                    }
                                            .wplc_animation_block div{
                            display: inline-block;
                            width: 150px;
                            height: 150px;
                            border: 1px solid #CCC;
                            border-radius: 5px;
                            text-align: center;  
                            margin: 10px;
                        }
                        .wplc_animation_block i{
                            font-size: 3em;
                            line-height: 150px;
                        }
                        .wplc_animation_block .wplc_red{
                            color: #E31230;
                        }
                        .wplc_animation_block .wplc_orange{
                            color: #EB832C;
                        }
                        .wplc_animation_active, .wplc_theme_active{
                            box-shadow: 2px 2px 2px #666666;
                        }
                </style>
          <h3><?php _e("Styling",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              
<tr style='margin-bottom: 10px;'>
                        <td><label for=""><?php _e('Choose a theme', 'sola_t'); ?></label></td>
                        <td>    
                            <div class='wplc_theme_block'>
                                <div class='wplc_theme_image' id=''>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-1.png'; ?>' title="<?php _e('Theme 1', 'wplivechat'); ?>" alt="<?php _e('Theme 1', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-1') {
                                            echo 'wplc_theme_active';
                                        } ?>' id='wplc_theme_1'/>
<?php _e('Theme 1', 'wplivechat'); ?>
                                    </div>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-2.png'; ?>' title="<?php _e('Theme 2', 'wplivechat'); ?>" alt="<?php _e('Theme 2', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-2') {
    echo 'wplc_theme_active';
} ?>' id='wplc_theme_2'/>
<?php _e('Theme 2', 'wplivechat'); ?>
                                    </div>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-3.png'; ?>' title="<?php _e('Theme 3', 'wplivechat'); ?>" alt="<?php _e('Theme 3', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-3') {
    echo 'wplc_theme_active';
} ?>' id='wplc_theme_3'/>
<?php _e('Theme 3', 'wplivechat'); ?>
                                    </div>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-4.png'; ?>' title="<?php _e('Theme 4', 'wplivechat'); ?>" alt="<?php _e('Theme 4', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-4') {
    echo 'wplc_theme_active';
} ?>' id='wplc_theme_4'/>
<?php _e('Theme 4', 'wplivechat'); ?>
                                    </div>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-5.png'; ?>' title="<?php _e('Theme 5', 'wplivechat'); ?>" alt="<?php _e('Theme 5', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-4') {
    echo 'wplc_theme_active';
} ?>' id='wplc_theme_5'/>
<?php _e('Theme 5', 'wplivechat'); ?>
                                    </div>
                                    <div class='wplc_theme_single'>
                                        <img src='<?php echo WPLC_BASIC_PLUGIN_URL.'images/themes/theme-6.png'; ?>' title="<?php _e('Theme 6', 'wplivechat'); ?>" alt="<?php _e('Theme 6', 'wplivechat'); ?>" class='<?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-5') {
    echo 'wplc_theme_active';
} ?>' id='wplc_theme_6'/>
<?php _e('Custom. Enter Colour Values Below', 'wplivechat'); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="radio" name="wplc_theme" value="theme-1" class="wplc_hide_input" id="wplc_rb_theme_1" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-1') {
    echo 'checked';
} ?>/>
                            <input type="radio" name="wplc_theme" value="theme-2" class="wplc_hide_input" id="wplc_rb_theme_2" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-2') {
    echo 'checked';
} ?>/>
                            <input type="radio" name="wplc_theme" value="theme-3" class="wplc_hide_input" id="wplc_rb_theme_3" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-3') {
    echo 'checked';
} ?>/>
                            <input type="radio" name="wplc_theme" value="theme-4" class="wplc_hide_input" id="wplc_rb_theme_4" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-4') {
    echo 'checked';
} ?>/>
                            <input type="radio" name="wplc_theme" value="theme-5" class="wplc_hide_input" id="wplc_rb_theme_5" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-5') {
    echo 'checked';
} ?>/>
                            <input type="radio" name="wplc_theme" value="theme-6" class="wplc_hide_input" id="wplc_rb_theme_6" <?php if (isset($wplc_settings['wplc_theme']) && $wplc_settings['wplc_theme'] == 'theme-6') {
    echo 'checked';
} ?>/>

                        </td>
                    </tr>
              <tr height="30">
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>                
              <tr>
                  <td width='200' valign='top'><?php _e("Chat box fill color","wplivechat")?>:</td>
                  <td>
                      <input id="wplc_settings_fill" name="wplc_settings_fill" type="text" class="color" value="<?php echo $wplc_settings_fill;?>" />
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'><?php _e("Chat box font color","wplivechat")?>:</td>
                  <td>
                      <input id="wplc_settings_font" name="wplc_settings_font" type="text" class="color" value="<?php echo $wplc_settings_font;?>" />
                  </td>
              </tr>

                    <tr>
                        <td width="200" valign="top"><?php _e("I'm using a localization plugin", "wplivechat") ?></td>
                        <td>
                            <input type="checkbox" name="wplc_using_localization_plugin" id="wplc_using_localization_plugin" value="1" <?php if (isset($wplc_settings['wplc_using_localization_plugin']) && $wplc_settings['wplc_using_localization_plugin'] == 1) { echo 'checked'; } ?>/>
                        </td>
                    </tr>

              <tr style='height:30px;'><td></td><td></td></tr>
                                <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("First Section Text", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_fst1" name="wplc_pro_fst1" type="text" size="50" maxlength="50" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_fst1']) ?>" /> <br />
                            <input id="wplc_pro_fst2" name="wplc_pro_fst2" type="text" size="50" maxlength="50" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_fst2']) ?>" /> <br />
                        </td>
                    </tr>
                    <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("Intro Text", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_intro" name="wplc_pro_intro" type="text" size="50" maxlength="150" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_intro']) ?>" /> <br />
                        </td>
                    </tr>
                    <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("Second Section Text", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_sst1" name="wplc_pro_sst1" type="text" size="50" maxlength="30" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_sst1']) ?>" /> <br />
                            <input id="wplc_pro_sst2" name="wplc_pro_sst2" type="text" size="50" maxlength="70" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_sst2']) ?>" /> <br />
                        </td>
                    </tr>
                    <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("Reactivate Chat Section Text", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_pro_tst1" name="wplc_pro_tst1" type="text" size="50" maxlength="50" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_pro_tst1']) ?>" /> <br />


                        </td>
                    </tr>
                    <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("User chat welcome", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_user_welcome_chat" name="wplc_user_welcome_chat" type="text" size="50" maxlength="150" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_user_welcome_chat']) ?>" /> <br />
                        </td>
                    </tr>
                    <tr class="wplc_localization_strings">
                        <td width="200" valign="top"><?php _e("Other text", "wplivechat") ?>:</td>
                        <td>
                            <input id="wplc_user_enter" name="wplc_user_enter" type="text" size="50" maxlength="150" class="regular-text" value="<?php echo stripslashes($wplc_settings['wplc_user_enter']) ?>" /> <?php _e('This text is shown above the user chat input field', 'wplivechat'); ?><br />
                        </td>
                    </tr>
            <style>
                .wplc_animation_block div{
                    display: inline-block;
                    width: 150px;
                    height: 150px;
                    border: 1px solid #CCC;
                    border-radius: 5px;
                    text-align: center;  
                    margin: 10px;
                }
                .wplc_animation_block i{
                    font-size: 3em;
                    line-height: 150px;
                }
                .wplc_animation_block .wplc_red{
                    color: #E31230;
                }
                .wplc_animation_block .wplc_orange{
                    color: #EB832C;
                }
                .wplc_animation_active{
                    box-shadow: 2px 2px 2px #CCC;
                }
            </style>            
                    <tr>
                        <th><label for=""><?php _e('Choose an animation', 'sola_t'); ?></label></th>

                        <td>    
                            <div class='wplc_animation_block'>
                                <div class='wplc_animation_image <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-1') {
                    echo 'wplc_animation_active';
                } ?>' id='wplc_animation_1'>
                                    <i class="fa fa-arrow-circle-up wplc_orange"></i>
                                    <p><?php _e('Slide Up', 'wplivechat'); ?></p>
                                </div>
                                <div class='wplc_animation_image <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-2') {
                    echo 'wplc_animation_active';
                } ?>' id='wplc_animation_2'>
                                    <i class="fa fa-arrows-h wplc_red"></i>
                                    <p><?php _e('Slide From The Side', 'wplivechat'); ?></p>
                                </div>
                                <div class='wplc_animation_image <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-3') {
                    echo 'wplc_animation_active';
                } ?>' id='wplc_animation_3'>
                                    <i class="fa fa-arrows-alt wplc_orange"></i>
                                    <p><?php _e('Fade In', 'wplivechat'); ?></p>
                                </div>
                                <div class='wplc_animation_image <?php if ((isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-4') || !isset($wplc_settings['wplc_animation'])) {
                    echo 'wplc_animation_active';
                } ?>' id='wplc_animation_4'>
                                    <i class="fa fa-thumb-tack wplc_red"></i>
                                    <p><?php _e('No Animation', 'wplivechat'); ?></p>
                                </div>
                            </div>
                            <input type="radio" name="wplc_animation" value="animation-1" class="wplc_hide_input" id="wplc_rb_animation_1" class='wplc_hide_input' <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-1') {
                    echo 'checked';
                } ?>/>
                            <input type="radio" name="wplc_animation" value="animation-2" class="wplc_hide_input" id="wplc_rb_animation_2" class='wplc_hide_input' <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-2') {
                    echo 'checked';
                } ?>/>
                            <input type="radio" name="wplc_animation" value="animation-3" class="wplc_hide_input" id="wplc_rb_animation_3" class='wplc_hide_input' <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-3') {
                    echo 'checked';
                } ?>/>
                            <input type="radio" name="wplc_animation" value="animation-4" class="wplc_hide_input" id="wplc_rb_animation_4" class='wplc_hide_input' <?php if (isset($wplc_settings['wplc_animation']) && $wplc_settings['wplc_animation'] == 'animation-4') {
                    echo 'checked';
                } ?>/>
                        </td>
                    </tr>
          </table>
      </div>
        <div id="tabs-5">


        <?php do_action("wplc_hook_agents_settings"); ?>

            
        </div>
        <div id="tabs-7">            
            <h3><?php _e("Blocked Visitors - Based on IP Address", "wplivechat") ?></h3>
            <textarea name="wplc_ban_users_ip" style="width: 50%; min-height: 200px;" placeholder="<?php _e('Enter each IP Address you would like to block on a new line', 'wplivechat'); ?>" autocomplete="false"><?php
                $ip_addresses = get_option('WPLC_BANNED_IP_ADDRESSES'); 
                if($ip_addresses){
                    $ip_addresses = maybe_unserialize($ip_addresses);
                    if ($ip_addresses && is_array($ip_addresses)) {
                        foreach($ip_addresses as $ip){
                            echo $ip."\n";
                        }
                    }
                }
            ?></textarea>  
            <p class="description"><?php _e('Blocking a user\'s IP Address here will hide the chat window from them, preventing them from chatting with you. Each IP Address must be on a new line', 'wplivechat'); ?></p>
        </div>

        <?php do_action("wplc_hook_settings_page_more_tabs"); ?>
        
    </div>
    <p class='submit'><input type='submit' name='wplc_save_settings' class='button-primary' value='<?php _e("Save Settings","wplivechat")?>' /></p>
    </form>
    
    </div>
