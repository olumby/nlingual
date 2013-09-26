<?php
// ===================== //
//	Miscellaneous Hooks  //
// ===================== //

/*
 * Enqueue admin styles/scripts
 */
add_action('admin_enqueue_scripts', 'nLingual_enqueue_scripts');
function nLingual_enqueue_scripts(){
	// Settings styling
	wp_register_style('nLingual-settings', plugins_url('css/settings.css', NL_SELF), '1.0', 'screen');

	// Settings javascript
	wp_register_script('nLingual-settings-js', plugins_url('js/settings.js', NL_SELF), array('jquery-ui-sortable'), '1.0');

	// Quick-Edit javascript
	wp_register_script('nLingual-quickedit-js', plugins_url('js/quickedit.js', NL_SELF), array('inline-edit-post'), '1.0', true);

	wp_localize_script('nLingual-settings-js', 'nLingual_l10n', array(
		'DeleteLangConfirm' => 'Are you sure you wish to delete this language?',
		'ResetTranslationsConfirm' => 'Are you sure you wish to clear translations?'
	));

	wp_enqueue_style('nLingual-settings');
	wp_enqueue_script('nLingual-settings-js');
	wp_enqueue_script('nLingual-quickedit-js');
}

/*
 * Add link to settings page from plugin entry on Plugins page
 */
add_filter('plugin_action_links', 'nLingual_plugin_links', 10, 2);
function nLingual_plugin_links($links, $file){
	global $this_plugin;
	if(!$this_plugin) $this_plugin = plugin_basename(NL_SELF);

	if($file == $this_plugin){
		$settings_link = '<a href="options-general.php?page=nLingual">'.__('Settings', NL_TXTDMN).'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}