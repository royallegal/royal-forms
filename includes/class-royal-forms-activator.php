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
	    // lets define the table name for the quiz system: iraquiz
	    $table_name      = $wpdb->prefix . "royalforms"; 
	    // use the correct charset in the db
	    $charset_collate = $wpdb->get_charset_collate();
	    // sql query
	    $sql = "CREATE TABLE $table_name (
	        id mediumint(9) NOT NULL AUTO_INCREMENT,
	        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	        quiz_name varchar(255) NOT NULL,
	        quiz_description text NOT NULL,
	        questions text NOT NULL,
	        PRIMARY KEY  (id)
	    ) $charset_collate;";
	    // if something in the table changes, we can update to the db easly with wp-include upgrade
	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	    // use dbDelta to create/upgrade the table
	    $return = dbDelta( $sql );
	    return $return;
	}

}
