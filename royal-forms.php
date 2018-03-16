<?php

/**
 * @link              http://www.matysanchez.com
 * @since             1.0.0
 * @package           Royal_Forms
 *
 * @wordpress-plugin
 * Plugin Name:       Royal Forms
 * Plugin URI:        https://github.com/royallegal/royal_forms
 * Description:       Create and use forms of any type in pages and posts by adding a embbed code.
 * Version:           0.1
 * Author:            Matias Sanchez Moises
 * Author URI:        http://www.matysanchez.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       royal-forms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-royal-forms-activator.php
 */
function activate_royal_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-royal-forms-activator.php';
	Royal_Forms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-royal-forms-deactivator.php
 */
function deactivate_royal_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-royal-forms-deactivator.php';
	Royal_Forms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_royal_forms' );
register_deactivation_hook( __FILE__, 'deactivate_royal_forms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-royal-forms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_royal_forms() {

	$plugin = new Royal_Forms();
	$plugin->run();

}
run_royal_forms();
