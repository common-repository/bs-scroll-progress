<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://neuropassenger.ru
 * @since      1.0.0
 *
 * @package    Bs_Scroll_Progress
 * @subpackage Bs_Scroll_Progress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bs_Scroll_Progress
 * @subpackage Bs_Scroll_Progress/public
 * @author     Oleg Sokolov <box@neuropassenger.ru>
 */
class Bs_Scroll_Progress_Public {

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

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bs-scroll-progress-public.css', array(), $this->version, 'all' );

        $selector = get_option( 'bs_sp_selector' );
        $color = get_option( 'bs_sp_color' );
        $width = get_option( 'bs_sp_width' );

        if ( $selector && $color && $width ) {
            $css = "#bs_progress-bar {background-color: {$color}; height: {$width}px;}";
            wp_add_inline_style( $this->plugin_name, $css );
        }

    }

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bs-scroll-progress-public.js', array( 'jquery' ), $this->version, false );

        $selector = get_option( 'bs_sp_selector' );
        if ( $selector ) {
            $script = "const bsSPSelector = '{$selector}';";
            wp_add_inline_script( $this->plugin_name, $script, 'before' );
        }

    }

	public function show_progress_bar() {

	    include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/bs-scroll-progress-public-display.php';

    }

}
