<?php

/**
 * WordsTree Pocket Navigator
 *
 * The plugin to make available for you, while you write, your Pocket favorites.
 *
 * @link              pocket.wordstree.com
 * @since             1.0.0
 * @package           WTPN__Pocket_Nav
 *
 * @wordpress-plugin
 * Plugin Name:       WordsTree Pocket Navigator
 * Plugin URI:        wordstree.com
 * Description:       This plugin shows in the post sidebar, in the admin screen, a meta box for you to have access to your favorites at Pocket, so you have your references where you need them.
 * Version:           1.0.2
 * Author:            Savio Resende
 * Author URI:        savioresende.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wtpn-pocket-nav
 * Domain Path:       /languages
 */

require_once __DIR__ . '/vendor/autoload.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
if (!defined('WTPN_POCKET_NAV_VERSION')) {
    define( 'WTPN_POCKET_NAV_VERSION', '1.0.2' );
}

// meta box
require_once plugin_dir_path(__FILE__) . 'includes/class-wtpn-pocket-nav-meta-box.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wtpn-pocket-nav-activator.php
 */
function activate_wtpn_pocket_nav() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wtpn-pocket-nav-activator.php';
	WTPN__Pocket_Nav_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wtpn-pocket-nav-deactivator.php
 */
function deactivate_wtpn_pocket_nav() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wtpn-pocket-nav-deactivator.php';
	WTPN__Pocket_Nav_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wtpn_pocket_nav' );
register_deactivation_hook( __FILE__, 'deactivate_wtpn_pocket_nav' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wtpn-pocket-nav.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wtpn_pocket_nav() {

	$plugin = new WTPN__Pocket_Nav();
	$plugin->run();

}
run_wtpn_pocket_nav();