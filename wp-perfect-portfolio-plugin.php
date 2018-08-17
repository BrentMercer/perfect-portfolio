<?php
/*
 * Plugin Name:	WP Perfect Portfolio Plugin
 * Description:	Adds portfolio custom post type to WordPress
 * Plugin URI:	http://brentmercer.com/wp-perfect-portfolio-plugin/
 * Author:		Brent Mercer
 * Author URI:	http://brentmercer.com
 * Version:		1.0.0
 * License:		GPLv2 or later
 * License URI:	https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:	wp-perfect-portfolio-plugin
 * Domain Path:	/languages

Perfect Portfolio is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Perfect Portfolio is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Perfect Portfolio. If not, see https://www.gnu.org/licenses/gpl-2.0.txt.
*/

// Exit is accessed directly.
if ( !defined( 'ABSPATH' ) ) exit;

class WP_Perfect_Portfolio {
	private static $_instance = null;
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	private function __construct() {
		// place hooks here
		add_action( 'init', 'wpppp_register_post_type');
		add_action( 'init', 'wpppp_create_taxonomy' );
	}
	/**
	* Register Portfolio post type.
	*
	*
	**/
	function wpppp_register_post_type(){
		$labels = array(
			'name'               => _x( 'Portfolio', 'post type general name', 'wp-perfect-portfolio-plugin' ),
			'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'wp-perfect-portfolio-plugin' ),
			'menu_name'          => _x( 'Portfolio Items', 'admin menu', 'wp-perfect-portfolio-plugin' ),
			'name_admin_bar'     => _x( 'Portfolio Items', 'add new on admin bar', 'wp-perfect-portfolio-plugin' ),
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'wp-perfect-portfolio-plugin' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'portfolio' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_icon'			 => 'dashicons-screenoptions'
		);
		register_post_type( 'wpppp_portfolio', $args );

		/*
		* Register Item Type Taxonomy.
		*
		*
		*/
		function wpppp_create_taxonomy(){
			// Add new taxonomy, make it hierarchical (like categories)
			$labels = array(
				'name'              => _x( 'Item Types', 'taxonomy general name', 'wp-perfect-portfolio-plugin' ),
				'singular_name'     => _x( 'Item Type', 'taxonomy singular name', 'wp-perfect-portfolio-plugin' ),
			);
			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'item type' ),
			);
			register_taxonomy( 'pp_item_type', 'wpppp_portfolio', $args );
		}
	}
}

add_action( 'plugins_loaded', 'WP_Perfect_Portfolio::instance' );