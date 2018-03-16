<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.matysanchez.com
 * @since      1.0.0
 *
 * @package    Royal_Forms
 * @subpackage Royal_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Royal_Forms
 * @subpackage Royal_Forms/public
 * @author     Matias Sanchez Moises <matias@clubdegorras.com>
 */
class Royal_Forms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('iraquiz', array($this, 'render_form'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/royal-forms-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/royal-forms-public.js', array( 'jquery' ), $this->version, false );

	}

	public function read_form($id) {
	    global $wpdb;
	    $table_name = $wpdb->prefix . "royalforms"; 
	    $query      = $wpdb->get_results ( "SELECT * FROM $table_name WHERE id='$id'" );
	    return $query[0];
	}

	public function render_form($props, $content) {
    	global $wpdb;

		$quiz_id = intVal($props["id"]);
		$quiz    = $this->read_form($quiz_id);

		$quiz_name        = $quiz->quiz_name;
		$quiz_description = $quiz->quiz_description;
		$quiz_questions   = json_decode($quiz->questions, false);

		$quiz = [];
		foreach ($quiz_questions as $question => $value) {
		    $answers = [];
		    foreach ($value->answer as $answer) {
		        array_push($answers, $answer);
		    }


		    array_push($quiz, [
		        "question" => $value->text,
		        "type" => $value->type,
		        "answers" => $answers,
		    ]);
		}

		// debug
		//echo "<br><br><br>";
		//print_r($quiz);

		$quiz_total = count($quiz);

		include_once( 'partials/royal-forms-public-display.php' );
	}


}

