<?php //global $wpgmza_global_array; ?>
<div class="wrap about-wrap">
<p>&nbsp;</p>
<h1><?php _e("Welcome to WP Live Chat Version 7","wplivechat"); ?></h1>

<div class="about-text"><?php _e("Chat to your visitors with the most comprehensive, cost effective Live Chat plugin.","wplivechat"); ?></div>

<div class="wplc-badge" style=''></div>

<a class="button-primary" style='padding:5px; padding-right:15px; padding-left:15px; height:inherit;' href="admin.php?page=wplivechat-menu&override=1"><?php echo __("Skip intro and start accepting chats","wplivechat"); ?></a>
<p>&nbsp;</p>

<?php
    
    if( !isset( $_GET['action'] ) ){
        $welcome_active = 'nav-tab-active';
        $credits_active = '';
    } else {
        if( $_GET['action'] == 'welcome' ){
            $welcome_active = 'nav-tab-active';
            $credits_active = '';
        } else if( $_GET['action'] == 'credits' ){
            $credits_active = 'nav-tab-active';
            $welcome_active = '';
        }
    }

?>
<h2 class="nav-tab-wrapper wp-clearfix">
    <a href="admin.php?page=wplivechat-menu&action=welcome" class="nav-tab <?php echo $welcome_active; ?>"><?php _e("Welcome","wplivechat"); ?></a>
    <a href="admin.php?page=wplivechat-menu&action=credits" class="nav-tab <?php echo $credits_active; ?>"><?php _e("Credits","wplivechat"); ?></a>

</h2>
<?php if( !isset( $_GET['action'] ) || ( isset( $_GET['action'] ) && $_GET['action'] == 'welcome' ) ){ ?>
<div class="feature-section three-col">
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-university" aria-hidden="true"></i><br/><h4><?php _e("Departments","wplivechat"); ?></h4></div>
        
        <p><?php _e("Allow visitors to select a department they'd like to speak to. Assign agents to a department with ease.","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-pencil" aria-hidden="true"></i><br/><h4><?php _e("Custom Fields","wplivechat"); ?></h4></div>
        
        <p><?php _e("Get as much information from your visitor as you need, before they even start a chat!","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-clock-o" aria-hidden="true"></i><br/><h4><?php _e("Business Hours","wplivechat"); ?></h4></div>
        
        <p><?php _e("Display the chat between specific times, only when you're available.","wplivechat"); ?></p>        
    </div>
</div>
<div class="feature-section three-col">
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-envelope" aria-hidden="true"></i><br/><h4><?php _e("Light Weight Message Delivery","wplivechat"); ?></h4></div>
        
        <p><?php _e("Messages are now send using some of the newest, greatest technology on the internet!","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-info-circle" aria-hidden="true"></i><br/><h4><?php _e("Documentation Suggestions","wplivechat"); ?></h4></div>
        
        <p><?php _e("Allow our plugin to help your visitors before your agent accepts a chat. Give your visitors documentation suggestions based on their request","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-code" aria-hidden="true"></i><br/><h4><?php _e("Custom Scripts","wplivechat"); ?></h4></div>
        
        <p><?php _e("Add custom JavaScript and CSS to the plugin without losing any changes after an update.","wplivechat"); ?></p>        
    </div>
</div>
<div class="feature-section three-col">
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-random" aria-hidden="true"></i><br/><h4><?php _e("Chat Transfers","wplivechat"); ?></h4></div>
        
        <p><?php _e("Transfer your chat between and agent or department with the click of a button. ","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-reply" aria-hidden="true"></i><br/><h4><?php _e("Chat Redirects","wplivechat"); ?></h4></div>
        
        <p><?php _e("Redirect your visitors to a new page after the chat has ended. ","wplivechat"); ?></p>        
    </div>
    <div class="col">
        <div style='text-align: center;' ><i class="fa-4x fa fa-pie-chart" aria-hidden="true"></i><br/><h4><?php _e("Google Analytics Integration","wplivechat"); ?></h4></div>
        
        <p><?php _e("Keep track of your visitors events with our new Google Analytics Integration","wplivechat"); ?></p>        
    </div>
</div>

<hr />

<div class="feature-section normal clear" >
    <div class="changelog ">
        <?php //if ($wpgmza_global_array['code'] != "100") { ?>
                    
<!--         <h3 style='margin-top:20px;'><?php _e("How did you find out about us?","wp-google-maps"); ?></h3>

        <div class="feature-section normal">
            <form action='' method='POST' name='wpgmaps_feedback'>                                            
            <p><ul class="wpgmza_welcome_poll" style="list-style: none outside none;">
                <li style="list-style: none outside none;">
                    <input type="radio" id="wpgmaps_findus_repository" value="repository" name="wpgmaps_findus">
                    <label for="wpgmaps_search_term"><?php _e("WordPress.org plugin repository","wp-google-maps"); ?></label>
                    <br /><input type="text" id="wpgmaps_search_term" class="regular-text" style='margin-top:5px; margin-left:40px;'  name="wpgmaps_search_term" placeholder="<?php _e("What search term did you use?","wp-google-maps"); ?>">
                </li>
                <li style="list-style: none outside none;">
                    <input type="radio" id="wpgmaps_findus_searchengine" value="search_engine" name="wpgmaps_findus">
                    <label for="wpgmaps_findus_searchengine"><?php _e("Google or other search engine","wp-google-maps"); ?></label>
                </li>
                <li style="list-style: none outside none;">
                    <input type="radio" id="wpgmaps_findus_friend" value="friend" name="wpgmaps_findus">
                    <label for="wpgmaps_findus_friend"><?php _e("Friend recommendation","wp-google-maps"); ?></label>
                </li>
                <li style="list-style: none outside none;">
                    <input type="radio" id="wpgmaps_findus_other" value="other" name="wpgmaps_findus">
                    <label for="wpgmaps_findus_other"><?php _e("Other","wp-google-maps"); ?></label>
                    <br /><input type="text" id="wpgmaps_findus_other_url" class="regular-text"  style='margin-top:5px; margin-left:40px;'  name="wpgmaps_findus_other_url" placeholder="<?php _e("Please explain","wp-google-maps"); ?>">

                </li>
                
                
            </ul></p>
            <input class='button-primary' type='submit' name='wpgmza_save_feedback' value='<?php _e("Submit and start accepting chats","wp-google-maps"); ?>'> 
            
        </form>
        </div> -->
        <?php //} else { ?>
        <!-- <div class="wpgm_notice_message">
            <ul>
                <li>
                    <?php //echo $wpgmza_global_array['message']; ?>
                </li>
            </ul>
        </div> -->
        <?php //} ?>

        <div class="feature-section three-col">
            <div class='col'>
                <h4><?php _e("New to WP Live Chat Support?","wplivechat"); ?></h4>
                <p><?php _e("You may want to","wp-google-maps"); ?> <a href='https://wp-livechat.com/documentation/' target='_blank' title='Documentation'><?php _e("review our documentation","wplivechat"); ?></a> <?php _e("before you get started. If you're a tech-savvy individual, you may skip this step.","wplivechat"); ?></p>
            </div>
            <div class='col'>
                <h4><?php _e("Help me!","wplivechat"); ?></h4>
                <p><?php _e("Visit our","wplivechat"); ?> <a title='Support Desk' target='_blank' href='https://wp-livechat.com/contact-us/'><?php _e("Support Desk","wplivechat"); ?></a> <?php _e("for quick and friendly help. We'll answer your request within 24hours.","wplivechat"); ?></p>
            </div>
            <div class='col'>
                <h4><?php _e("Feedback","wp-google-maps"); ?></h4>
                <p><?php _e("We need you to help us make this plugin better.","wplivechat"); ?> <a href='https://wp-livechat.com/contact-us/' title='Feedback' target='_BLANK'><?php _e("Send us your feedback","wplivechat"); ?></a> <?php _e("and we'll act on it as soon as humanly possible.","wplivechat"); ?></p>
            </div>
        </div>
        
        <a class="button-primary" style='padding:5px; padding-right:15px; padding-left:15px; height:inherit;' href="admin.php?page=wplivechat-menu&override=1"><?php echo __("OK! Let's start","wplivechat"); ?></a>

    </div>
</div>

</div>
<?php } else {
    $path = plugin_dir_path(__FILE__).'credits.php';    
    include $path;
} ?>