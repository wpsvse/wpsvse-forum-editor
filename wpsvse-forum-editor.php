<?php
/*
Plugin Name: WPSV Forumredigerare
Description: En anpassad version av TinyMCE för WordPress Sveriges forum.
Version: 0.1
License: GPL
Author: WordPress Sverige
Author URI: http://wpsv.se
*/

//**************************************************
// Enable TinyMCE in bbPress
//**************************************************
if ( !is_admin() ) {
	function wpsvse_bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
		$args['teeny'] = false;
		$args['quicktags'] = false;
    return $args;
	}
	add_filter( 'bbp_after_get_the_content_parse_args', 'wpsvse_bbp_enable_visual_editor' );
}

/* Set allowed tags */
function wpsvse_kses_allowed_tags($input){
    return array_merge( $input, array(
          // paragraphs
          'p' => array(
               'style'     => array()
          ),
          'span' => array(
               'style'     => array()
          ),
          // Links
          'a' => array(
               'href'     => array(),
               'title'    => array(),
               'rel'      => array()
          ),
          // Quotes
               'blockquote'   => array(
               'cite'     => array()
          ),
          // Code
          'code'         => array(),
          'pre'          => array(),
          // Formatting
          'em'           => array(),
          'strong'       => array(),
          'del'          => array( 'datetime' => true, ),
          // Lists
          'ul'           => array(),
          'ol'           => array( 'start'    => true, ),
          'li'           => array(),
          // Images
          'img'          => array(
               'src'      => true,
               'border'   => true,
               'alt'      => true,
               'height'   => true,
               'width'    => true,
          )
     ));
}
add_filter( 'bbp_kses_allowed_tags', 'wpsvse_kses_allowed_tags', 999, 1 );

//**************************************************
// Set buttons for visual editor
//**************************************************

// Add new button
add_filter('mce_buttons', 'wpsvse_plugin_register_buttons');

function wpsvse_plugin_register_buttons($buttons) {
   array_push($buttons, 'wpsvse_pre_btn');
   return $buttons;
}
 
// Load TinyMCE plugin
add_filter('mce_external_plugins', 'wpsvse_plugin_register_tinymce_javascript');

function wpsvse_plugin_register_tinymce_javascript($plugin_array) {
   $plugin_array['wpsvse_pre_btn'] = plugins_url('/pre-button.js',__FILE__);
   return $plugin_array;
}

// Set buttons to use
if ( !is_admin() ) {
	function wpsvse_visual_editor_btns( $in ) {
		$in['toolbar1'] = 'bold, italic, underline, strikethrough, blockquote, bullist, numlist, link, unlink, image, wpsvse_pre_btn';
		$in['toolbar2'] = '';
		$in['toolbar3'] = '';
		$in['toolbar4'] = '';
	return $in;
	}
	add_filter( 'tiny_mce_before_init', 'wpsvse_visual_editor_btns' );
}
