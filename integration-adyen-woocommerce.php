<?php
/**
 * Plugin Name: Integration for Adyen with WooCommerce
 * Plugin URI: https://www.woosa.nl/product/adyen-woocommerce-plugin/
 * Description: Allows WooCommerce to take payments via Adyen platform
 * Version: 1.8.1
 * Author: Woosa
 * Author URI:  https://www.woosa.com
 * Text Domain: woosa-adyen
 * Domain Path: /languages
 * Network: false
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * WC requires at least: 3.5.0
 * WC tested up to: 4.4.1
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


define(__NAMESPACE__ . '\PREFIX', 'adn');

define(__NAMESPACE__ . '\VERSION', '1.8.1');

define(__NAMESPACE__ . '\NAME', 'Integration for Adyen with WooCommerce');

define(__NAMESPACE__ . '\DIR_URL', untrailingslashit(plugin_dir_url(__FILE__)));

define(__NAMESPACE__ . '\DIR_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

define(__NAMESPACE__ . '\DIR_NAME', plugin_basename(DIR_PATH));

define(__NAMESPACE__ . '\FILE_NAME', __FILE__);

define(__NAMESPACE__ . '\DIR_BASENAME', DIR_NAME . '/'.basename(__FILE__));

define(__NAMESPACE__ . '\SETTINGS_TAB_ID', 'adyen');

define(__NAMESPACE__ . '\SETTINGS_TAB_NAME', 'Adyen');

define(__NAMESPACE__ . '\SETTINGS_URL', admin_url('/admin.php?page=wc-settings&tab=' . SETTINGS_TAB_ID));

define(__NAMESPACE__ . '\DEBUG', get_option(PREFIX . '_debug') === 'yes' ? true:false);

define(__NAMESPACE__ . '\DEBUG_FILE', DIR_PATH . '/debug.log');


//include files
require_once DIR_PATH . '/vendor/autoload.php';

//init
Module_Core_Hook::init();