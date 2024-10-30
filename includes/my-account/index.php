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
My_Account_Hook::init();
My_Account_Hook_AJAX::init();
My_Account_Hook_Assets::init();