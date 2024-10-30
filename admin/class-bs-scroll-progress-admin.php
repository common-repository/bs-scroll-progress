<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://neuropassenger.ru
 * @since      1.0.0
 *
 * @package    Bs_Scroll_Progress
 * @subpackage Bs_Scroll_Progress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bs_Scroll_Progress
 * @subpackage Bs_Scroll_Progress/admin
 * @author     Oleg Sokolov <box@neuropassenger.ru>
 */
class Bs_Scroll_Progress_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bs_Scroll_Progress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bs_Scroll_Progress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bs-scroll-progress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bs_Scroll_Progress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bs_Scroll_Progress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bs-scroll-progress-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function add_plugin_settings_page() {
        add_options_page(
            'Scroll Progress',
            'Scroll Progress',
            'manage_options',
            'bs_scroll_progress',
            array( $this, 'show_plugin_settings_page' )
        );
    }

    function show_plugin_settings_page() {
        ?>
        <h1 class="wp-heading-inline">
            <?php echo get_admin_page_title() ?>
        </h1>
        <form method="post" action="options.php">
        <?php
        settings_fields( 'bs_sp_general' );
        do_settings_sections( 'bs_scroll_progress' );
        submit_button();
        ?>
        </form>
        <?
    }

    public function add_plugin_settings() {
	    register_setting(
	        'bs_sp_general',
            'bs_sp_selector'
        );

        register_setting(
            'bs_sp_general',
            'bs_sp_color'
        );

        register_setting(
            'bs_sp_general',
            'bs_sp_width'
        );

	    add_settings_section(
	        'bs_sp_general',
            'General Settings',
            array( $this, 'show_general_settings_section' ),
            'bs_scroll_progress'
        );

	    add_settings_field(
	        'bs_sp_selector',
            'CSS tag selector with main content',
            array( $this, 'show_bs_sp_selector_field' ),
            'bs_scroll_progress',
            'bs_sp_general'
        );

        add_settings_field(
            'bs_sp_color',
            'Color',
            array( $this, 'show_bs_sp_color_field' ),
            'bs_scroll_progress',
            'bs_sp_general'
        );

        add_settings_field(
            'bs_sp_width',
            'Width in px',
            array( $this, 'show_bs_sp_width_field' ),
            'bs_scroll_progress',
            'bs_sp_general'
        );
    }

    function show_general_settings_section() {
        // Block before fields
    }

    function show_bs_sp_selector_field() {
        $selector = get_option( 'bs_sp_selector' );
        echo "<input type='text' class='regular-text' name='bs_sp_selector' value='" . ($selector ?? 'body') . "'>";
    }

    function show_bs_sp_color_field() {
        $color = get_option( 'bs_sp_color' );
        echo "<input type='color' class='regular-text' name='bs_sp_color' value='" . ($color ?? '#73af3d') . "'>";
    }

    function show_bs_sp_width_field() {
        $width = get_option( 'bs_sp_width' );
        echo "<input type='number' min='1' max='10' step='1' class='regular-text' name='bs_sp_width' value='" . ($width ?? '1') . "'>";
    }

}
