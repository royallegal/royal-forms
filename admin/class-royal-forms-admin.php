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
            array($this, 'forms_display'), // function to render
            'dashicons-welcome-view-site', // icon
            120 // position
        );
        add_submenu_page (
            'royal-forms', // pattern quiz
            'Create Form', // title
            'Create Form', // name in admin dashboard
            'manage_options',
            'royal-forms-add', // slug
            array($this, 'forms_create') // function to render
        );
        add_submenu_page (
            'royal-forms', // pattern quiz
            'Themes', // title
            'Themes', // name in admin dashboard
            'manage_options',
            'royal-forms-themes', // slug
            array($this, 'themes_display') // function to render
        );
        add_submenu_page (
            'royal-forms', // pattern quiz
            'Global Config', // title
            'Global Config', // name in admin dashboard
            'manage_options',
            'royal-forms-config', // slug
            array($this, 'config_display') // function to render
        );
    }

    public function royalform_form_create($form_post) {
        global $wpdb;
        $content          = $form_post;
        $user_id          = get_current_user_id();
        $form_name        = $content["formName"];
        $form_description = $content["formDescription"];
        // Serialize with json encode
        $form_config      = json_encode($content["config"]);
        $form_content     = json_encode($content["question"]);
        // define the table name
        $table_name = $wpdb->prefix . "royalforms_content";
        // user wpdb inser function to insert data to the db (id is auto filled and autoincrement)

        $insert = $wpdb->insert( 
            $table_name, 
            array( 
                'created'          => current_time( 'mysql' ), 
                'createdby'        => $user_id, 
                'lastedit'         => NULL, 
                'lasteditby'       => NULL, 
                'form_name'        => $form_name, 
                'form_description' => $form_description, 
                'form_config'      => $form_config,
                'form_content'     => $form_content,
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


    // Royal Forms: forms
    public function forms_display() {
        global $wpdb;
        $table_name      = $wpdb->prefix . "royalforms_content"; 
        $query = $wpdb->get_results ( "SELECT * FROM $table_name" );
        include_once( 'partials/forms-display.php' );
    }
    
    public function forms_create() {
        $form_create = false;
        if (isset($_POST) && isset($_POST["question"])) {
            $form_create = $this->royalform_form_create($_POST);
        }
        include_once( 'partials/forms-create.php' );
    }

    // Royal Forms: themes & pages
    public function themes_display() {
        global $wpdb;
        $table_name      = $wpdb->prefix . "royalforms_themes"; 
        $query = $wpdb->get_results ( "SELECT * FROM $table_name" );
        include_once( 'partials/themes-display.php' );
    }

    // Royal Forms: global config
    public function config_display() {
        global $wpdb;
        $table_name      = $wpdb->prefix . "royalforms_config"; 

        if ( isset($_POST) && isset($_POST["config"]) ) {
            $delete = $wpdb->query("TRUNCATE TABLE $table_name");
            $insert = $wpdb->insert( 
                $table_name,
                array( 
                    'global_config' => json_encode($_POST["config"])
                ) 
            );
            if ( $insert == TRUE )
                $updateConfig = TRUE;
        }

        $query = $wpdb->get_results ( "SELECT * FROM $table_name" );
        include_once( 'partials/config-display.php' );
    }

    public function get_config_param($param) {
        if ( !isset($param) )
            return false;
        else {
            global $wpdb;
            $table_name      = $wpdb->prefix . "royalforms_config";
            $query = $wpdb->get_results ( "SELECT * FROM $table_name" );
            $params = json_decode($query[0]->global_config, true);

            if ( isset($params[$param]) )
                return $params[$param];
            else
                return false;
        }
    }

}
