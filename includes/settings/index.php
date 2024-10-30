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
Settings_Hook_General::init();
Settings_Hook_Webhooks::init();