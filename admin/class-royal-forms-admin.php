<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.matysanchez.com
 * @since      1.0.0
 *
 * @package    Royal_Forms
 * @subpackage Royal_Forms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Royal_Forms
 * @subpackage Royal_Forms/admin
 * @author     Matias Sanchez Moises <matias@clubdegorras.com>
 */
class Royal_Forms_Admin {
	private $plugin_name;
	private $version;
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/royal-forms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/royal-forms-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 */

	public function add_plugin_admin_menu() {
		add_menu_page (
			'Royal Forms', // Title
			'Royal Froms', // Name in Admin dashboard
			'manage_options',
			'royal-forms', // slug
			array($this, 'render_royalform_display'), // function to render
			'dashicons-networking', // icon
			120 // position
		);
		add_submenu_page (
			'royal-forms', // pattern quiz
			'Add Quiz', // title
			'Create Form', // name in admin dashboard
			'manage_options',
			'royal-forms-add', // slug
			array($this, 'render_royalform_create') // function to render
		);
	}

	public function royalform_form_create($form_post) {
	    global $wpdb;
	    $content          = $form_post;
	    $quiz_name        = $content["quizName"];
	    $quiz_description = $content["quizDescription"];
	    // serialize the array with all questions information and data
	    $questions  = json_encode($content["question"]);
	    // define the table name
	    $table_name = $wpdb->prefix . "iraquiz";
	    // user wpdb inser function to insert data to the db (id is auto filled and autoincrement)
	    $insert = $wpdb->insert( 
	        $table_name, 
	        array( 
	            'time'             => current_time( 'mysql' ), 
	            'quiz_name'        => $quiz_name, 
	            'quiz_description' => $quiz_description, 
	            'questions'        => $questions,
	        ) 
	    );

	    $return = [];
	    $return["status"] = $insert;
	    $return["_id"]    = $wpdb->insert_id;

	    // check if the insert was true or false and return
	    if ( $insert )
	        return $return;
	    else
	        return false;

	}

	public function render_royalform_display() {
	    global $wpdb;
	    $table_name      = $wpdb->prefix . "iraquiz"; 
	    $query = $wpdb->get_results ( "SELECT * FROM $table_name" );
		include_once( 'partials/royal-forms-admin-display.php' );
	}
	
	public function render_royalform_create() {
		$form_create = false;
		if (isset($_POST) && isset($_POST["question"])) {
		    $form_create = $this->royalform_form_create($_POST);
		}
		include_once( 'partials/royal-forms-admin-create.php' );
	}

}
