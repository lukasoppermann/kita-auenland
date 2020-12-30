<?php

/* ################################################################################################################ */
/* ################################################################################################################ */

// Swap WP-jQuery with local version
    function modify_jquery() {
        if (!is_admin()) {
            // comment out the next two lines to load the local copy of jQuery
            wp_deregister_script('jquery');
            wp_register_script('jquery', get_template_directory_uri() . '/js/libs/jquery-2.2.4.min.js', false, '2.2.4');
            wp_enqueue_script('jquery');
        }
    }


    function md_script_enqueue(){
        
        wp_enqueue_style( 'fonts-asap-1', get_stylesheet_directory_uri() . '/fonts/webfontkit-20131108-050617/stylesheet.css', '', '1.0.0', 'all' );
        wp_enqueue_style( 'fonts-asap-2', get_stylesheet_directory_uri() . '/fonts/webfontkit-20131108-050649/stylesheet.css', '', '1.0.0', 'all' );
        wp_enqueue_style( 'fonts-gochihand', get_stylesheet_directory_uri() . '/fonts/webfontkit-20180213-150648/stylesheet.css', '', '1.0.0', 'all' );
        wp_enqueue_style( 'fonts-google', 'https://fonts.googleapis.com/css?family=Boogaloo' );

        $translation_array = array( 'templateUrl' => get_template_directory_uri(), 'stylesheetUrl' => get_stylesheet_directory_uri() );
        

		
        wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'screen');
        wp_enqueue_style('magnific_css', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.0.0', 'screen');
        wp_enqueue_style('swiper_css', get_template_directory_uri() . '/js/libs/swiper-4.0.7/dist/css/swiper.min.css', array(), '4.0.7', 'screen');
	
		
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-custom.js', array(), '1.0.0', false);
        wp_enqueue_script('calc', get_template_directory_uri() . '/js/libs/calc.min.js', array(), '1.0.0', false);
        //wp_enqueue_script('move', get_template_directory_uri() . '/js/libs/jquery.event.move.js', array(), '2.0.0', false);
        //wp_enqueue_script('swipe', get_template_directory_uri() . '/js/libs/jquery.event.swipe.js', array(), '2.0.0', false);
        //wp_enqueue_script('velocity', get_template_directory_uri() . '/js/libs/velocity.min.js', array(), '2.0.0', false);
        //wp_enqueue_script('slider', get_template_directory_uri() . '/js/libs/unslider-min.js', array(), '2.0.0', false);
        wp_enqueue_script('swiper', get_template_directory_uri() . '/js/libs/swiper-4.0.7/dist/js/swiper.min.js', array(), '4.0.7', false);
        		
		wp_enqueue_script('magnific', get_template_directory_uri() . '/js/libs/jquery.magnific-popup.min.js', array(), '2.0.0', false);
        wp_enqueue_script('smooth-scroll', get_template_directory_uri() . '/js/libs/smooth-scroll.min.js', array(), '1.0.0', false);

        wp_enqueue_script('us-icons', get_template_directory_uri() . '/js/own/us-icons.js', array(), '1.0.0', false);
        wp_enqueue_script('us-columnsections', get_template_directory_uri() . '/js/own/us-columnsections.js', array(), '1.0.0', false);
        wp_enqueue_script('us-height', get_template_directory_uri() . '/js/own/us-height.js', array(), '1.0.0', false);
        wp_enqueue_script('parallax', get_template_directory_uri() . '/js/libs/parallax.min.js', array(), '1.0.0', false);

        /* Main Script Controller (app.js)*/
        wp_enqueue_script('app', get_template_directory_uri() . '/js/own/app.js', array( 'jquery' ), '1.0.0', false);
    
		wp_localize_script( 'us-icons', 'object_name', $translation_array );
		
	}

    add_action('init', 'modify_jquery');
    add_action('wp_enqueue_scripts', 'md_script_enqueue');


/* ################################################################################################################ */
/* ################################################################################################################ */

// register nav menus

	function register_my_menus() {
	  register_nav_menus(
		array(
		  'primary-nav' => __( 'Primary Navigation' ),
		  'primary-nav-2' => __( 'Primary Navigation (Part 2)' ),
		  'primary-actions-menu' => __( 'Primary Actions Menu' ),
		  'footer-nav' => __( 'Footer Navigation' ),
		  'footer-notes-nav' => __( 'Footer Notes Navigation' )
		)
	  );
	}
	add_action( 'init', 'register_my_menus' );

/* ################################################################################################################ */
/* ################################################################################################################ */

add_theme_support( 'title-tag' );

/* ################################################################################################################ */
/* ################################################################################################################ */

add_theme_support( 'post-thumbnails' ); 

?>
