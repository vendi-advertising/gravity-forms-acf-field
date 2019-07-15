<?php
/*
Plugin Name: Advanced Custom Fields: Gravity Forms Field
Plugin URI: https://github.com/vendi-advertising/gravity-forms-acf-field
Description: ACF field to select one or many Gravity Forms
Version: 1.1.0
Author: @adam_pope of @stormuk
Author URI: http://www.stormconsultancy.co.uk
License: MIT
License URI: http://opensource.org/licenses/MIT
*/

//No WordPress. Huh, weird.
if(!defined('ABSPATH')){
	return;
}

//No ACF
if(!class_exists('acf_field')){
	return;
}

//No Gravity forms
if(!class_exists('RGFormsModel')){
	return;
}

add_action(
	'acf/include_field_types',
	function(){
		require_once __DIR__ . '/src/gravity_forms_base.php';
		require_once __DIR__ . '/src/v5/gravity_forms-v5.php';
		new acf_field_gravity_forms();
	}
);

//Really, this should just be killed off now
add_action(
	'acf/register_fields',
	function() {
		require_once __DIR__ . '/src/gravity_forms_base.php';
  		require_once __DIR__ . '/src/v4/gravity_forms-v4.php';
  		new acf_field_gravity_forms();
	}
);
