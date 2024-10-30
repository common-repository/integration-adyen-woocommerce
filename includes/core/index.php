<?php
/**
 * Index
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


//init
Core_Hook::init();
Core_Hook_AJAX::init();
Core_Hook_Assets::init();