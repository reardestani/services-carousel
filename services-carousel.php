<?php
/**
 * Plugin Name: Services Carousel
 * Description: Services Carousel block
 * Version: 1.0.0
 * Author: Reza Ardestani
 * Author URI: https://github.com/reardestani
 * Text Domain: services-carousel
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/includes/plugin.php';

Services_Carousel\Plugin::get_instance();
