<?php
/**
 * Plugin Name: Change_WP_Welcome_Banner
 * Description: Chanegs WordPress's welcome banner and adds a custom title and message.
 * Plugin URI: 
 * Author: Brent Mercer
 * Author URI: http://brentmercer.com/
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or exit;

class Change_WP_Welcome_Banner {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private function __construct() {
		// place hooks here
		remove_action( 'welcome_panel', 'wp_welcome_panel' );
		add_action( 'welcome_panel', array( $this, 'new_welcome' ))
	}

	function new_welcome(){
		?>
		<div id="welcome-panel" class="welcome-panel">
			<input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce" value="098b66b86d" />
			<a class="welcome-panel-close" href="http://vertalifesciences.com/wp-admin/?welcome=0" aria-label="Dismiss the welcome panel">Dismiss</a>
			<div class="welcome-panel-content">
				<h2>Enter custom welcome title</h2>
				<p>Enter custom welcome message</p>
			</div>
		</div>
		<?php
	}
}

add_action( 'plugins_loaded', 'Change_WP_Welcome_Banner::instance' );
register_activation_hook( __FILE__, 'Change_WP_Welcome_Banner::do_activate' );
register_deactivation_hook( __FILE__, 'Change_WP_Welcome_Banner::do_deactivate' );
register_uninstall_hook( __FILE__, 'Change_WP_Welcome_Banner::do_uninstall' );
		