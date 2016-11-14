<?php
/*
 * Adds 'Rest API' tab to settings area
*/
add_filter("wplc_filter_setting_tabs","wplc_api_settings_tab_heading_doc_suggestions");
function wplc_api_settings_tab_heading_doc_suggestions($tab_array) {
    $tab_array['doc'] = array(
      "href" => "#tabs-doc-suggest",
      "icon" => 'fa fa-lightbulb-o',
      "label" => __("Doc Suggestions","wplivechat")
    );
    return $tab_array;
}


/*
 * Adds 'Rest API' content to settings area
*/
add_action("wplc_hook_settings_page_more_tabs","wplc_hook_settings_page_more_doc_suggestions",10);
function wplc_hook_settings_page_more_doc_suggestions() {
    ?>
		<div id="tabs-doc-suggest">
			<h3><?php _e("Documentation Suggestions", "wplivechat") ?></h3>
			<table class="wp-list-table widefat fixed striped pages">
				<tbody>
					<tr>
						<td width="200" valign="top">
						  Enable Documentation Suggestions: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="When a user sends a message the plugin will automatically detect if there are posts or pages that can be suggested to the user in order for the user to get more information about what they are asking. This is useful when the user has typed their message and is still waiting for an agent to answer their chat."></i>                      
						</td>
						<td valign="top">
						  <input type="checkbox" value="1" name="wplc_doc_suggestions"> 
  						</td>
	              	</tr>
				</tbody>
			</table>
			<br>

		</div>
		
		<?php
	

}