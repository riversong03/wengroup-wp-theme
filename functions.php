<?php
/**
 * wengroup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wengroup
 */

if ( ! function_exists( 'wengroup_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wengroup_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wengroup, use a find and replace
		 * to change 'wengroup' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wengroup', get_template_directory() . '/languages' );

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

		function add_bootstrap_nav_class( $classes, $item ) {
			if( in_array('menu-item', $item->classes ) ) {
				$classes[] = 'nav-item';
			}
			return $classes;
		}

		add_filter( 'nav_menu_css_class', 'add_bootstrap_nav_class', 10, 4 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Header Menu', 'wengroup' ),
			'footer-menu' => esc_html( 'Footer Menu', 'wengroup' )
		) );




		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wengroup_custom_background_args', array(
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
add_action( 'after_setup_theme', 'wengroup_setup' );

/**
 * Register custom fonts.
 */
function wengroup_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Mukta Malar and Arapey, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$nanum_gothic = _x( 'on', 'Nanum Gothic font: on or off', 'wengroup' );
	$mukta_malar = _x( 'on', 'Mukta Malar font: on or off', 'wengroup' );

	$font_families = array();

	if ( 'off' !== $nanum_gothic ) {
		$font_families[] = 'Nanum+Gothic:400,700';
	}

	if ( 'off' !== $mukta_malar ) {
		$font_families[] = 'Mukta Malar:300,400,700';
	}


	if( in_array( 'on', array( $mukta_malar, $nanum_gothic ) ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Add preconnect for Google Fonts.
 *
 * @since Wen Group 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function wengroup_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'wengroup-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'wengroup_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wengroup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wengroup_content_width', 640 );
}
add_action( 'after_setup_theme', 'wengroup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wengroup_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wengroup' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wengroup' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wengroup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wengroup_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/_styles/bootstrap.min.css' );
	wp_enqueue_style( 'google-fonts', wengroup_fonts_url() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/_styles/font-awesome.css');
	wp_enqueue_style( 'wengroup-style', get_stylesheet_uri() );

	$wengroup_l10n = array(
		'quote'          => wengroup_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	wp_enqueue_script( 'wengroup-navigation', get_theme_file_uri( '/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$wengroup_l10n['expand']         = __( 'Expand child menu', 'wengroup' );
		$wengroup_l10n['collapse']       = __( 'Collapse child menu', 'wengroup' );
		$wengroup_l10n['icon']           = wengroup_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );

	wp_localize_script( 'wengroup-navigation', 'wengroupScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'wengroup' ),
		'collapse' => __( 'Collapse child menu', 'wengroup' )
	) );
	wp_enqueue_script( 'wengroup-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js' , array(), '20180227', true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wengroup_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
