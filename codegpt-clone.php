<?php
/**
 * Plugin Name: CodeGPT Clone
 * Plugin URI: https://example.com/codegpt-clone
 * Description: A WordPress plugin that provides a CodeGPT-like experience for coding assistance.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'CODEGPT_CLONE_VERSION', '1.0.0' );
define( 'CODEGPT_CLONE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CODEGPT_CLONE_URL', plugin_dir_url( __FILE__ ) );

// Load plugin files
require_once CODEGPT_CLONE_DIR . 'includes/class-codegpt-api.php';
require_once CODEGPT_CLONE_DIR . 'includes/class-codegpt-api-handler.php';
require_once CODEGPT_CLONE_DIR . 'includes/class-codegpt-clone.php';
require_once CODEGPT_CLONE_DIR . 'includes/class-codegpt-settings.php';
require_once CODEGPT_CLONE_DIR . 'includes/codegpt-ui.php';

// Initialize the plugin
$codegpt_clone = CodeGPT_Clone::instance();
