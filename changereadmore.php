<?php
/**
* Plugin Name: Change Read More Text
* Plugin URI: https://simpleintelligentsystems.com/
* Description: This simple plugin changes the default 'Continue Reading' Text.
* Version: 1.0
* Author: Salil K Ghosh
* Author URI: https://simpleintelligentsystems.com/
* Text Domain:crm-txt
**/



/**
 * Adding Submenu under Settings Tab
 *
 * @since 1.0
 */
function crmfn_add_menu() {
	//add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
	add_submenu_page ( "options-general.php", "Change Readmore Text", "Change Readmore Text", "manage_options", "crmfn-change-readmore-page", "crmfn_settings_page" );
}
add_action ( "admin_menu", "crmfn_add_menu" );


/**
 * Setting Page Options
 * - add setting page
 * - save setting page
 *
 * @since 1.0
 */
function crmfn_settings_page() {
	?>
<div class="wrap">
	<h1>Change Read More Text</h1>
 
	<form method="post" action="options.php">
	<?php
		settings_fields ( "crmfn_config" );
		do_settings_sections ( "crmfn-change-readmore-page" );
		submit_button ();
	?>
    </form>
</div>
 
<?php
}

function crmfn_settings() {
	
	//add_settings_section( $id, $title, $callback, $page );
	//add_settings_field( string $id, string $title, callable $callback, string $page, string $section = 'default', array $args = array() )
	//register_setting( string $option_group, string $option_name, array $args = array() )
	
	add_settings_section("crmfn_config", "General", null, "crmfn-change-readmore-page");
	add_settings_field("crmfn-textbox", "New Read More text", "crmfn_options", "crmfn-change-readmore-page", "crmfn_config");
	register_setting("crmfn_config", "crmfn-textbox");
}

add_action("admin_init", "crmfn_settings");


function crmfn_options() {
?>
<div class="postbox" style="width: 65%; padding: 30px;">
	<input type="text" name="crmfn-textbox" value="<?php echo stripslashes_deep(esc_attr(get_option('crmfn-textbox'))); ?>" />
</div>
<?php
}


/**
Change the text
*/

function crmfn_modify_read_more_link() {

    return '<a class="more-link" href="' . get_permalink() . '">'.stripslashes_deep(esc_attr(get_option('crmfn-textbox',__( 'Click to Read!!', 'crm-txt' )))).'</a>';

}

add_filter( 'the_content_more_link', 'crmfn_modify_read_more_link' );