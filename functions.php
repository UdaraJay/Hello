<?php
/**
 * hello functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hello
 */

if ( ! function_exists( 'hello_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hello_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hello, use a find and replace
		 * to change 'hello' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hello', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hello' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hello_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hello_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hello_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hello_content_width', 640 );
}
add_action( 'after_setup_theme', 'hello_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hello_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hello' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hello' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hello_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hello_scripts() {
	wp_enqueue_style( 'hello-style', get_stylesheet_uri() );
	wp_enqueue_style ('dripicon-style', get_template_directory_uri().'/asset/dripicons/webfont/webfont.css');
	wp_enqueue_style ('animatecss-style', get_template_directory_uri().'/asset/css/animate.css');
	wp_enqueue_style ('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:200,300,400,400i,500,700');


	wp_enqueue_style ('hello-navigation-style', get_template_directory_uri().'/asset/priority-nav/priority-nav-core.css');
	wp_enqueue_script( 'hello-navigation-js', get_template_directory_uri() . '/asset/priority-nav/priority-nav.min.js');

	wp_enqueue_script( 'hello-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hello_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Portfolio custom post type
 */
function work_init() {
    $args = array(
      	'label' => 'Work',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'work'),
        'query_var' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
				'register_meta_box_cb' => 'wpt_add_work_metaboxes',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'work', $args );
}
add_action( 'init', 'work_init' );

function wpt_add_work_metaboxes() {
	add_meta_box(
		'wpt_work_detials',
		'Work details',
		'wpt_work_detials',
		'work',
		'side',
		'high'
	);
}

function wpt_work_detials() {
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'work_fields' );
	// Get the location data if it's already been entered
	$tagline = get_post_meta( $post->ID, 'tagline', true );
	$color = get_post_meta( $post->ID, 'color', true );
	$year = get_post_meta( $post->ID, 'year', true );
	$field = get_post_meta( $post->ID, 'field', true );
	$link = get_post_meta( $post->ID, 'link', true );
	// Output the field

	echo '<label style="display:block; margin-bottom:5px;">Tagline:</label>';
	echo '<input type="text" name="tagline" value="' . esc_textarea( $tagline )  . '" class="widefat"><br></br>';

	echo '<label style="display:block; margin-bottom:5px;">Background Color:</label>';
	echo '<input type="text" name="color" value="' . esc_textarea( $color )  . '" class="widefat"><br></br>';

	echo '<label style="display:block; margin-bottom:5px;">Year:</label>';
	echo '<input type="text" name="year" value="' . esc_textarea( $year )  . '" class="widefat"><br></br>';

	echo '<label style="display:block; margin-bottom:5px;">Field:</label>';
	echo '<input type="text" name="field" value="' . esc_textarea( $field )  . '" class="widefat">';

	echo '<label style="display:block; margin-bottom:5px;">Link:</label>';
	echo '<input type="text" name="link" value="' . esc_textarea( $link )  . '" class="widefat"><br></br>';

}

function wpt_save_events_meta( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['tagline'] ) || ! wp_verify_nonce( $_POST['work_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['tagline'] = esc_textarea( $_POST['tagline'] );
	$events_meta['color'] = esc_textarea( $_POST['color'] );
	$events_meta['year'] = esc_textarea( $_POST['year'] );
	$events_meta['field'] = esc_textarea( $_POST['field'] );
	$events_meta['link'] = esc_textarea( $_POST['link'] );
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $events_meta as $key => $value ) :
		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'wpt_save_events_meta', 1, 2 );
