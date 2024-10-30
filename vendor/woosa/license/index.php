<?php
/**
 * Index
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


//init
Module_License_Hook::init();
Module_License_Hook_Assets::init();
Module_License_Hook_AJAX::init();
Module_License_Hook_REST_API::init();
Module_License_Hook_Settings::init();
Module_License_Hook_Update::init();

//declare
Module_License::declare();