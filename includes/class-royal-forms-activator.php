<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.matysanchez.com
 * @since      1.0.0
 *
 * @package    Royal_Forms
 * @subpackage Royal_Forms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Royal_Forms
 * @subpackage Royal_Forms/includes
 * @author     Matias Sanchez Moises <matias@clubdegorras.com>
 */
class Royal_Forms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	    // $wpdb is to handle wp database
	    global $wpdb;
	    // use the correct charset in the db
	    $charset_collate = $wpdb->get_charset_collate();
	    // sql query
	    $sql = NULL;
	    // Table structure for Royal Forms
	    $table_name      = $wpdb->prefix . "royalforms_content"; 
	    $sql.= "CREATE TABLE $table_name (
	        id mediumint(9) NOT NULL AUTO_INCREMENT,
	        created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	        createdby varchar(255) NOT NULL,
	        lastedit datetime,
	        lasteditby varchar(255),
	        form_name varchar(255) NOT NULL,
	        form_description varchar(255),
	        form_config text NOT NULL,
	        form_content text NOT NULL,
	        PRIMARY KEY  (id)
	    ) $charset_collate;";

	    // Table structure for global config
	    $table_name      = $wpdb->prefix . "royalforms_config"; 
	    $sql.= "CREATE TABLE $table_name (
	        global_config text NOT NULL
	    ) $charset_collate;";

	    // Table structure for themes
	    $table_name      = $wpdb->prefix . "royalforms_themes"; 
	    $sql.= "CREATE TABLE $table_name (
	        id mediumint(9) NOT NULL AUTO_INCREMENT,
	        created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	        createdby varchar(255) NOT NULL,
	        lastedit datetime,
	        lasteditby varchar(255),
	        theme_name varchar(255) NOT NULL,
	        theme_description varchar(255),
	        theme_content text NOT NULL,
	        theme_intro text NOT NULL,
	        theme_thank text NOT NULL,
	        theme_css text NOT NULL,
	        theme_js text NOT NULL,
	        PRIMARY KEY  (id)
	    ) $charset_collate;";

	    // if something in the table changes, we can update to the db easly with wp-include upgrade
	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	    // use dbDelta to create/upgrade the table
	    $return = dbDelta( $sql );
	    return $return;
	}

}
