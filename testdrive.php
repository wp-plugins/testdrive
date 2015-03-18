<?php

/**
 * Plugin Name:	TestDrive
 * Plugin URI:	https://wordpress.org/plugins/testdrive/
 * Description: TestDrive is a plugin that replaces the main feature of TestFlight - installing an iOS app over-the-air on an iOS device through a simple click on a link. 
 * Version:	1.0.0
 * Author:	INform
 * Author URI:	http://inform.mk
 * License:	GPL2
 * How to:	readme.txt
 * @since	1.0.0
 * @link	https://stackoverflow.com/questions/27517288/add-update-custom-fields-after-select-pictures-in-media-window-wordpress
 * @package	TestDrive
 */

/**
 * Generate a media button that creates a download link on the fly.
 *
 * @since 1.0.0
 */
function testdrive_media_button($editor_id = 'content') {
        static $instance = 0;
        $instance++;

        $post = get_post();
        if ( ! $post && ! empty( $GLOBALS['post_ID'] ) )
                $post = $GLOBALS['post_ID'];

        wp_enqueue_media( array(
                'post' => $post
        ) );

        $img = '<span class="wp-media-buttons-icon"></span> ';

        $id_attribute = $instance === 1 ? ' id="insert-plist-file"' : '';
        printf( '<a href="#"%s class="button insert-media add_media" data-editor="%s" title="%s">%s</a>',
                $id_attribute,
                esc_attr( $editor_id ),
                esc_attr__( 'Select .plist File' ),
                $img . __( 'Select .plist File' )
        );
}

/**
 * Generate the plugin HTML and Javascript code.
 *
 * @since 1.0.0
 */
function testdrive_script() {
	// Check user permissions
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	// Output HTML
	echo '<br />';
	echo '<div id="testdrive_wrap" >';
	testdrive_media_button();
	echo '</div>';

 	echo '<script>';

	/**
	 * Add the jQuery that allows the user to select a file, and then uses
	 * the file's URL to create a download link on the fly.
	 */
	require 'download_link.js';

	echo '</script>';
	echo '<div id="link"></div>';
	echo '<div id="message"></div>';

	echo '<hr>';

	echo '<h1><a href="https://testdrive.sironaecg.com/wp-content/plugins/testdrive/testdrive.mobileconfig">Get your UDID</a></h1>';
}

/**
 * Add the plugin as a separate menu page on the Admin menu.
 *
 * @since 1.0.0
 */
function testdrive_plugin() {
	add_menu_page( 'Let\'s ride!', 'TestDrive!', 'manage_options', 'td', 'testdrive_script', '', 'bottom' );
}

/**
 * Hook the plugin to WordPress.
 *
 * @since 1.0.0
 */
add_action( 'admin_menu', 'testdrive_plugin' );
?>
