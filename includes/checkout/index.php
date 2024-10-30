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
Checkout_Hook::init();
Checkout_Hook_AJAX::init();
Checkout_Hook_Assets::init();