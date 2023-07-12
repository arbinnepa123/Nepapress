<?php
/**
 * Basmil:The Milan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Basmil:The_Milan
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function irl_theme_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Basmil:The Milan, use a find and replace
	 * to change 'irl-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('irl-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'irl-theme'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'irl_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'irl_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function irl_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('irl_theme_content_width', 640);
}
add_action('after_setup_theme', 'irl_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function irl_theme_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'irl-theme'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'irl-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'irl_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function irl_theme_scripts()
{
	wp_enqueue_style('irl-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('irl-theme-style', 'rtl', 'replace');

	wp_enqueue_script('irl-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
//canva library for transparent background
function enqueue_html2canvas() {
    wp_enqueue_script( 'html2canvas', 'https://html2canvas.hertzen.com/dist/html2canvas.min.js', array(), '1.3.2', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_html2canvas' );

function enqueue_pdf_libraries() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'html2canvas', 'https://html2canvas.hertzen.com/dist/html2canvas.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_pdf_libraries' );

add_action('wp_enqueue_scripts', 'irl_theme_scripts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


function nepa_irl_meta_box()
{
	add_meta_box(
		'nepa_irl_meta_box',
		'Nepa Irl',
		'nepa_irl_meta_box_callback',
		'nepa_irl',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'nepa_irl_meta_box');

function nepa_irl_meta_box_callback($post)
{
	$irl_sel_type = get_post_meta($post->ID, '_irl_sel_type', true);
	$irl_sel_rud = get_post_meta($post->ID, '_irl_sel_rud', true);
	$irl_rud_size = get_post_meta($post->ID, '_irl_rud_size', true);
	$irl_rud_wght = get_post_meta($post->ID, '_irl_rud_wght', true);
	$irl_beads = get_post_meta($post->ID, '_irl_beads', true);
	$irl_front_img = get_post_meta($post->ID, '_irl_front_img', true);
	$irl_back_img = get_post_meta($post->ID, '_irl_back_img', true);
	$irl_wght_img = get_post_meta($post->ID, '_irl_wght_img', true);
	$irl_xray_img = get_post_meta($post->ID, '_irl_xray_img', true);

	$irl_size_grade = get_post_meta($post->ID, 'irl_size_grade', true);
	$irl_origin = get_post_meta($post->ID, 'irl_origin', true);
	$irl_vendor = get_post_meta($post->ID, 'irl_vendor', true);

	$rudrakshas = array("1 Mukhi", "1 Mukhi Kaju", "1 Mukhi Savar", "1M Double Savar", "2 Mukhi", "3 Mukhi", "4 Mukhi", "5 Mukhi", "5 Mukhi", "6 Mukhi", "7 Mukhi", "8 Mukhi", "9 Mukhi", "10 Mukhi", "11 Mukhi", "12 Mukhi", "13 Mukhi", "14 Mukhi", "15 Mukhi", "16 Mukhi", "17 Mukhi", "18 Mukhi", "19 Mukhi", "20 Mukhi", "21 Mukhi", "22 Mukhi", "23 Mukhi", "24 Mukhi", "25 Mukhi", "26 Mukhi", "27 Mukhi", "28 Mukhi", "29 Mukhi", "30 Mukhi", "Kantha Mala", "Japa Mala", "Nirakar", "Ganesh", "Gaurishankar", "Nandi", "Trijuti", "Garbha Gauri");
	$rudrakshaJapa = array("2 Mukhi", "3 Mukhi", "4 Mukhi", "5 Mukhi", "5 Mukhi", "6 Mukhi", "7 Mukhi", "8 Mukhi", "9 Mukhi", "10 Mukhi", "11 Mukhi", "12 Mukhi", "13 Mukhi", "14 Mukhi", "15 Mukhi", "16 Mukhi", "17 Mukhi", "18 Mukhi", "19 Mukhi", "20 Mukhi");
	$rudrakshaKanta = array("2 Mukhi", "3 Mukhi", "4 Mukhi", "5 Mukhi", "5 Mukhi", "6 Mukhi", "7 Mukhi", "8 Mukhi", "9 Mukhi", "Gaurishankar");

	?>
	<div>
		<p><button type="button" id="add_irl">Add Rudraksha</button></p>
		<div id="irl_fields" style="display: flex; flex-wrap: wrap; gap:20px; margin-bottom:20px;">
			<?php if ($irl_sel_rud): ?>
				<?php foreach ($irl_sel_rud as $key => $value): ?>
					<div class="selRudCon"
						style="padding:10px; display:flex; max-width:22%; flex-direction:column; gap:10px; position: relative; background:#c4c4c4;">
						<select name="_irl_sel_type[]" class="select-type-field">
							<option value="Japa Mala" <?php selected($irl_sel_type[$key], 'Japa Mala'); ?>>Japa Mala</option>
							<option value="Kantha Mala" <?php selected($irl_sel_type[$key], 'Kantha Mala'); ?>>Kantha Mala</option>
							<option value="Mala" <?php selected($irl_sel_type[$key], 'Mala'); ?>>Regular Mala</option>
							<option value="Others" <?php selected($irl_sel_type[$key], 'Others'); ?>>Others</option>
						</select>
						<select name="_irl_sel_rud[]" class="irl_select">
							<option value="" disabled>Select Rudraksha</option>
							<?php foreach ($rudrakshas as $rudraksha): ?>
								<option value="<?php echo $rudraksha ?>" <?php selected($value, $rudraksha); ?>><?php echo $rudraksha; ?></option>
							<?php endforeach; ?>

						</select>

						<input class="mala-show" type="number"
							style="display:<?php echo $irl_sel_type[$key] != "Others" ? "block" : "none" ?>;"
							placeholder="No. of Beads" name="_irl_beads[]" value="<?php echo $irl_beads[$key]; ?>">

						<input type="number" placeholder="Rudraksha Length" name="_irl_rud_size[]"
							value="<?php echo $irl_rud_size[$key]; ?>">
						<input type="number" placeholder="Rudraksha Weight" name="_irl_rud_wght[]"
							value="<?php echo $irl_rud_wght[$key]; ?>">
						<hr style="width:100%; border-top:0; margin:0; height:1px" />
						<label>Front Image</label>
						<div style="display:flex; border:1px solid grey; justify-content:space-between; align-items:center;">
							<img style="width:calc(100% - 50px); min-height:50px;"
								src="<?php echo esc_url($irl_front_img[$key]); ?>" alt="Select Front Image" />
							<input type="text" class="irl_front_img-url" name="_irl_front_img[]"
								value="<?php echo esc_attr($irl_front_img[$key]); ?>" hidden />
							<span class="upload-irl_img">
								<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g>
											<g>
												<path
													d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
												</path>
												<path
													d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
												</path>
											</g>
										</g>
									</g>
								</svg>
							</span>
						</div>

						<label>Back/Beads Image</label>
						<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
							<img style="width:calc(100% - 50px); min-height:50px;" src="<?php echo esc_url($irl_back_img[$key]); ?>"
								alt="Select Back /Beads Image" />
							<input type="text" class="irl_back_img-url" name="_irl_back_img[]"
								value="<?php echo esc_attr($irl_back_img[$key]); ?>" hidden />
							<span class="upload-irl_img">
								<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g>
											<g>
												<path
													d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
												</path>
												<path
													d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
												</path>
											</g>
										</g>
									</g>
								</svg>
							</span>
						</div>

						<label class="japa-show"
							style="display:<?php echo $irl_sel_type[$key] == "Japa Mala" ? "flex" : 'none'; ?>;">Weight
							Image</label>
						<div class="japa-show"
							style="display:<?php echo $irl_sel_type[$key] == "Japa Mala" ? "flex" : 'none'; ?>;  border:1px solid grey; justify-content:space-between; align-items:center;">
							<img style="width:calc(100% - 50px); min-height:50px;" src="<?php echo esc_url($irl_wght_img[$key]); ?>"
								alt="Select Back /Beads Image" />
							<input type="text" class="irl_wght_img-url" name="_irl_wght_img[]"
								value="<?php echo esc_attr($irl_wght_img[$key]); ?>" hidden />
							<span class="upload-irl_img">
								<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g>
											<g>
												<path
													d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
												</path>
												<path
													d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
												</path>
											</g>
										</g>
									</g>
								</svg>
							</span>
						</div>
						<label>X-ray Image</label>
						<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
							<img style="width:calc(100% - 50px); min-height:50px;" src="<?php echo esc_url($irl_xray_img[$key]); ?>"
								alt="Select X-ray" />
							<input type="text" class="irl_xray_img-url" name="_irl_xray_img[]"
								value="<?php echo esc_attr($irl_xray_img[$key]); ?>" hidden />
							<span class="upload-irl_img">
								<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<g>
											<g>
												<path
													d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
												</path>
												<path
													d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
												</path>
											</g>
										</g>
									</g>
								</svg>
							</span>
						</div>
						<button type="button" class="delete_irl">Delete</button>

					</div>

				<?php endforeach; ?>

			<?php else: ?>

				<div class="selRudCon"
					style="padding:10px; display:flex; max-width:22%; flex-direction:column; gap:10px; position: relative; background:#c4c4c4;">
					<select name="_irl_sel_type[]" class="select-type-field">
						<option value="Japa Mala">Japa Mala</option>
						<option value="Kantha Mala">Kantha Mala</option>
						<option value="Mala">Regular Mala</option>
						<option value="Others" selected>Others</option>
					</select>
					<select name="_irl_sel_rud[]" class="irl_select">
						<option value="" disabled>Select Rudraksha</option>
						<?php foreach ($rudrakshas as $rudraksha): ?>
							<option value="<?php echo $rudraksha ?>"><?php echo $rudraksha; ?></option>
						<?php endforeach; ?>
					</select>
					<input class="mala-show" type="number" style="display:none;" placeholder="No. of Beads" name="_irl_beads[]">

					<input type="text" placeholder="Rudraksha Length" name="_irl_rud_size[]" required>
					<input type="text" placeholder="Rudraksha Weight" name="_irl_rud_wght[]" required>
					<label>Front Image</label>
					<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
						<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" />
						<input type="text" class="irl_front_img-url" name="_irl_front_img[]" hidden />
						<span class="upload-irl_img">
							<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<g>
										<g>
											<path
												d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
											</path>
											<path
												d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
											</path>
										</g>
									</g>
								</g>
							</svg>
						</span>
					</div>
					<label>Back/BeadsImage</label>
					<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
						<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" />
						<input type="text" class="irl_back_img-url" name="_irl_back_img[]" hidden />
						<span class="upload-irl_img">
							<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<g>
										<g>
											<path
												d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
											</path>
											<path
												d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
											</path>
										</g>
									</g>
								</g>
							</svg>
						</span>
					</div>

					<label class="japa-show" style="display:none">Weight Image</label>
					<div class="japa-show"
						style="display:none;  border:1px solid grey; justify-content:space-between; align-items:center;">
						<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select Back /Beads Image" />
						<input type="text" class="irl_wght_img-url" name="_irl_wght_img[]" hidden />
						<span class="upload-irl_img">
							<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<g>
										<g>
											<path
												d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
											</path>
											<path
												d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
											</path>
										</g>
									</g>
								</g>
							</svg>
						</span>
					</div>
					<label>X-ray Image</label>
					<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
						<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select X-ray" />
						<input type="text" class="irl_xray_img-url" name="_irl_xray_img[]" hidden />
						<span class="upload-irl_img">
							<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
								<g id="SVGRepo_iconCarrier">
									<g>
										<g>
											<path
												d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
											</path>
											<path
												d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
											</path>
										</g>
									</g>
								</g>
							</svg>
						</span>
					</div>
					<button type="button" class="delete_irl">Delete</button>

				</div>

			<?php endif; ?>
			<style>
				.upload-irl_img:hover {
					cursor: pointer;
				}

				.upload-irl_img {
					height: 100%;
					background: #ffffffb3;
					padding: 0px 12px;
					display: flex;
					align-items: center;
				}
			</style>
			<script>
				jQuery(document).ready(function ($) {
					var container = $('#irl_fields');
					$(container).on('click', '.upload-irl_img', function () {
						var imageField = $(this).prev();
						var frame = wp.media({
							title: 'Select Image',
							multiple: false,
							library: { type: 'image' },
							button: { text: 'Select' }
						});
						frame.on('select', function () {
							var attachment = frame.state().get('selection').first().toJSON();
							$(imageField).val(attachment.url);
							$(imageField).prev().attr('src', attachment.url);
						});
						frame.open();
					});


				});
			</script>
		</div>
		<div style="padding:10px; display:flex; width:100%; ">
			<div>
				<label>Rudraksha Size Grade</label>
				<input type="text" name="irl_size_grade" value="<?php echo $irl_size_grade; ?>">
			</div>
			<div>
				<label>Rudraksha Origin</label>
				<input type="text" name="irl_origin" value="<?php echo $irl_origin; ?>">
			</div>
			<div>
				<label>Rudraksha Vendor</label>
				<input type="text" name="irl_vendor" value="<?php echo $irl_vendor; ?>">
			</div>
		</div>
	</div>

	<script>

		// Add Irl field
		jQuery('#add_irl').click(function (e) {
			e.preventDefault();
			// jQuery('#irl_fields').append('<div class="selRudCon" style="padding:10px; display:flex; max-width:22%; flex-direction:column; gap:10px; position: relative; background:#c4c4c4;"> <select name="_irl_sel_rud[]" class="irl_select"> <option value="" selected disabled>Select Rudraksha</option> <option value="1 Mukhi">1 Mukhi</option> <option value="2 Mukhi">2 Mukhi</option> <option value="3 Mukhi">3 Mukhi</option> <option value="4 Mukhi">4 Mukhi</option> <option value="5 Mukhi">5 Mukhi</option> </select> <input type="text" placeholder="Rudraksha Length" name="_irl_rud_size[]"> <input type="text" placeholder="Rudraksha Weight" name="_irl_rud_wght[]"> <label>Front Image</label> <div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;"> <img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" /> <input type="text" class="irl_front_img-url" name="_irl_front_img[]" hidden /> <span class="upload-irl_img"> <svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3"> <g id="SVGRepo_bgCarrier" stroke-width="0"></g> <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g> <g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z"> </path> <path d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z"> </path> </g> </g> </g> </svg> </span> </div> <label>Back/BeadsImage</label> <div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;"> <img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" /> <input type="text" class="irl_back_img-url" name="_irl_back_img[]" hidden /> <span class="upload-irl_img"> <svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3"> <g id="SVGRepo_bgCarrier" stroke-width="0"></g> <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g> <g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z"> </path> <path d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z"> </path> </g> </g> </g> </svg> </span> </div> <label>X-ray Image</label> <div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;"> <img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select X-ray" /> <input type="text" class="irl_xray_img-url" name="_irl_xray_img[]" hidden /> <span class="upload-irl_img"> <svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3"> <g id="SVGRepo_bgCarrier" stroke-width="0"></g> <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g> <g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z"> </path> <path d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z"> </path> </g> </g> </g> </svg> </span> </div> <button type="button" class="delete_irl">Delete</button> </div>');
			jQuery('#irl_fields').append(`
									<div class="selRudCon" style="padding:10px; display:flex; max-width:22%; flex-direction:column; gap:10px; position: relative; background:#c4c4c4;">
									<select name="_irl_sel_type[]" class="select-type-field">
									<option value="Japa Mala">Japa Mala</option>
									<option value="Kantha Mala">Kantha Mala</option>
									<option value="Mala">Regular Mala</option>
									<option value="Others" selected>Others</option>
									</select>
									<select name="_irl_sel_rud[]" class="irl_select">
									<option value="" disabled selected>Select Rudraksha</option>
									<?php foreach ($rudrakshas as $rudraksha): ?>
																<option value="<?php echo $rudraksha ?>"><?php echo $rudraksha; ?></option>
									<?php endforeach; ?>
									</select>
									<input class="mala-show" type="number" style="display:none;" placeholder="No. of Beads" name="_irl_beads[]">
									<input type="text" placeholder="Rudraksha Length" name="_irl_rud_size[]" required>
									<input type="text" placeholder="Rudraksha Weight" name="_irl_rud_wght[]" required>
									<label>Front Image</label>
									<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
									<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" />
									<input type="text" class="irl_front_img-url" name="_irl_front_img[]" hidden />
									<span class="upload-irl_img">
									<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
									<g>
									<g>
									<path
									d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
									</path>
									<path
									d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
									</path>
									</g>
									</g>
									</g>
									</svg>
									</span>
									</div>
									<label>Back/BeadsImage</label>
									<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
									<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="No image selected" />
									<input type="text" class="irl_back_img-url" name="_irl_back_img[]" hidden />
									<span class="upload-irl_img">
									<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
									<g>
									<g>
									<path
									d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
									</path>
									<path
									d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
									</path>
									</g>
									</g>
									</g>
									</svg>
									</span>
									</div>
									<label class="japa-show" style="display:none">Weight Image</label>
											<div class="japa-show" style="display:none;  border:1px solid grey; justify-content:space-between; align-items:center;">
												<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select Back /Beads Image" />
												<input type="text" class="irl_wght_img-url" name="_irl_wght_img[]" hidden />
												<span class="upload-irl_img">
													<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
														xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
														viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
														<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
														<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
														<g id="SVGRepo_iconCarrier">
															<g>
																<g>
																	<path
																		d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
																	</path>
																	<path
																		d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
																	</path>
																</g>
															</g>
														</g>
													</svg>
												</span>
											</div><label class="japa-show" style="display:none">Weight Image</label>
											<div class="japa-show" style="display:none;  border:1px solid grey; justify-content:space-between; align-items:center;">
												<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select Back /Beads Image" />
												<input type="text" class="irl_wght_img-url" name="_irl_wght_img[]" hidden />
												<span class="upload-irl_img">
													<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
														xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
														viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
														<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
														<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
														<g id="SVGRepo_iconCarrier">
															<g>
																<g>
																	<path
																		d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
																	</path>
																	<path
																		d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
																	</path>
																</g>
															</g>
														</g>
													</svg>
												</span>
											</div>
									<label>X-ray Image</label>
									<div style="display:flex;  border:1px solid grey; justify-content:space-between; align-items:center;">
									<img style="width:calc(100% - 50px); min-height:50px;" src="" alt="Select X-ray" />
									<input type="text" class="irl_xray_img-url" name="_irl_xray_img[]" hidden />
									<span class="upload-irl_img">
									<svg fill="#0077b3" height="20px" width="20px" version="1.1" id="Capa_1"
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									viewBox="0 0 490.528 490.528" xml:space="preserve" stroke="#0077b3">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
									<g>
									<g>
									<path
									d="M0.2,382.709c0.1,2.8,0,5.3,0.5,9.2c3.4,32.6,25.4,61.1,55.7,73.7c7.5,3.3,15.5,5.1,23.6,6.4c2,0.2,4.1,0.3,6.1,0.5 c2.1,0.2,4.2,0.3,5.7,0.3l10.1,0.3l40.4,0.9c53.8,1.1,107.8,1.3,161.9-0.3c13.4,0.4,26.7,0.7,40.1,1.1l31.8,0.6l15.9,0.2h2h0.5 h1.5h1l4-0.2c2.2,0,6.6-0.6,10-1.1c13.8-2.3,26.1-7.2,37.4-14.7c11.1-7.5,20.6-17.3,27.7-28.7c7.1-11.3,11.8-24.3,13.5-37.5 c0.6-3.3,0.7-6.6,0.8-9.9c0-1.6,0.2-3.5,0.1-4.8l-0.1-4l-0.3-15.9c-0.5-21.2-1.2-42.3-2.3-63.4c-1.2-24-5.8-44-14.8-42.2 c-8.3,1.6-14.4,18.7-15.3,43.3c-0.8,22.1-1.6,44.4-2.4,66.6l-0.5,16.6c-0.2,2.2-0.3,4.4-0.6,6.6c-0.5,2.1-0.6,4.3-1.3,6.4 c-2.1,8.5-6,16.4-11.3,23.3c-8.5,11.1-20.9,19.2-34.7,22.4l-4.5,0.8c-0.6,0.2-1.8,0.3-2.9,0.3l-3.3,0.2l-1.7,0.1h-0.4h-0.2h-0.3 l-3.3,0.1l-6.7,0.1l-26.8,0.5l-107.2,2.2c-32-2.9-64.2-4.6-96.5-5.6c-16.2-0.5-32.3-0.9-48.5-1.1l-12.2-0.1h-3l-2.3-0.2 c-1.5-0.2-3,0-4.5-0.4c-6-0.6-11.7-2.6-17.1-5.1c-10.9-5-19.9-13.9-25.7-24.4l-2-4c-0.6-1.4-1-2.8-1.6-4.2 c-0.6-1.4-0.9-2.9-1.3-4.3l-0.6-2.2c-0.2-0.7-0.2-1.3-0.3-1.9l-0.3-1.8c-0.1-0.6-0.3-1.1-0.3-2.3l-0.3-6.1l-0.1-11.2 c-0.1-32.5-0.1-65,0.5-97.3c0.1-5.8-3.4-14.8-5.8-17.7c-4.9-5.6-9,1.7-12.1,12.7c-5.2,18.1-8.9,38.1-11.4,59.2 c-1.3,10.5-2.3,21.3-3,32.3c-0.4,5.5-0.7,11-1,16.5l-0.2,4.2v1v0.5v1.2L0.2,382.709z">
									</path>
									<path
									d="M172.9,122.009c11-8.6,22.2-17.1,31.9-27.1c8.1-8.3,15.8-16.9,23.4-25.7c-1.4,14-2.7,28.1-2.5,42.1 c0.4,27.3,2.4,54.6,3.7,82c-11.5,49-4.9,99.1-7.3,148.6c-0.1,2.2,3.4,5.7,5.8,6.8c4.9,2.2,9-0.7,12.1-4.8 c10.3-13.8,14.8-30.6,16-47.7c2.9-41.1,7.3-82.2,4-123.6c0.4-5.1,0.8-10.2,1.1-15.3c1.3-25.5,1.9-50.9,0.1-76.3 c16.5,17.5,34.8,33.4,50.7,51.3c1.2,1.3,5.7,0.9,8-0.2c4.7-2.2,6-6.8,5.8-11.4c-0.7-15.3-7.2-28.2-16.2-38.9 c-17.5-20.8-34.3-42.3-53.9-61.2l-0.5-0.5l0,0c-7.4-7.1-19.2-6.9-26.3,0.5c-4.5,4.7-8.9,9.6-13.1,14.7c-3.2,2.7-6.5,5.3-9.6,8.1 c-19.9,17.6-39.1,36-54.8,57.6c-4.5,6.1-5.6,13.8,1.2,19.8C158.7,126.209,166.7,126.809,172.9,122.009z">
									</path>
									</g>
									</g>
									</g>
									</svg>
									</span>
									</div>
									<button type="button" class="delete_irl">Delete</button>

									</div>`
			);
		});

		// Delete Irl field
		jQuery('#irl_fields').on('click', '.delete_irl', function () {
			jQuery(this).parent().remove();
		});

		jQuery(document).on('change', '.select-type-field', function () {
			const parent = jQuery(this).parent();
			const selectElement = parent.find('.irl_select');

			selectElement.empty();

			const selected = jQuery(this).val();
			let options;

			if (selected === "Japa Mala") {
				options = `<?php foreach ($rudrakshaJapa as $rudraksha): ?><option value="<?php echo $rudraksha ?>"><?php echo $rudraksha; ?></option><?php endforeach; ?>`
				parent.find(".mala-show").css("display", "block")
				parent.find(".japa-show").css("display", "flex")
			} else if (selected === 'Mala' || selected === 'Kantha Mala') {
				options = `<?php foreach ($rudrakshaKanta as $rudraksha): ?><option value="<?php echo $rudraksha ?>"><?php echo $rudraksha; ?></option><?php endforeach; ?>`
				parent.find(".mala-show").css("display", "block")
				parent.find(".japa-show").css("display", "none")
			} else {
				options = `<?php foreach ($rudrakshas as $rudraksha): ?><option option value = "<?php echo $rudraksha ?>"><?php echo $rudraksha; ?></option><?php endforeach; ?> `;
				parent.find(".mala-show").css("display", "none")
				parent.find(".japa-show").css("display", "none")
			}

			selectElement.append(options);
		});



	</script>
	<?php
}

function save_nepa_irl_sel_rud($post_id)
{
	if (!isset($_POST['_irl_sel_rud'])) {
		delete_post_meta($post_id, '_irl_sel_rud');
		return;
	}

	$irl_sel_rud = array_map('sanitize_text_field', $_POST['_irl_sel_rud']);
	update_post_meta($post_id, '_irl_sel_rud', $irl_sel_rud);

	$irl_sel_type = array_map('sanitize_text_field', $_POST['_irl_sel_type']);
	update_post_meta($post_id, '_irl_sel_type', $irl_sel_type);

	$irl_beads = array_map('sanitize_text_field', $_POST['_irl_beads']);
	update_post_meta($post_id, '_irl_beads', $irl_beads);

	$irl_rud_size = array_map('sanitize_text_field', $_POST['_irl_rud_size']);
	update_post_meta($post_id, '_irl_rud_size', $irl_rud_size);

	$irl_rud_wght = array_map('sanitize_text_field', $_POST['_irl_rud_wght']);
	update_post_meta($post_id, '_irl_rud_wght', $irl_rud_wght);

	$irl_front_img = $_POST['_irl_front_img'];
	update_post_meta($post_id, '_irl_front_img', $irl_front_img);

	$irl_back_img = $_POST['_irl_back_img'];
	update_post_meta($post_id, '_irl_back_img', $irl_back_img);

	$irl_wght_img = $_POST['_irl_wght_img'];
	update_post_meta($post_id, '_irl_wght_img', $irl_wght_img);

	$irl_xray_img = $_POST['_irl_xray_img'];
	update_post_meta($post_id, '_irl_xray_img', $irl_xray_img);

	$irl_size_grade = $_POST['irl_size_grade'];
	update_post_meta($post_id, 'irl_size_grade', $irl_size_grade);

	$irl_origin = $_POST['irl_origin'];
	update_post_meta($post_id, 'irl_origin', $irl_origin);

	$irl_vendor = $_POST['irl_vendor'];
	update_post_meta($post_id, 'irl_vendor', $irl_vendor);



}

add_action('save_post_nepa_irl', 'save_nepa_irl_sel_rud');


function display_nepa_irl_sel_rud_shortcode($atts)
{
	$post_id = get_the_ID();
	$irl_sel_rud = get_post_meta($post_id, '_irl_sel_rud', true);
	if (!empty($irl_sel_rud)) {

		// Convert the PHP array to a JSON string
		$irl_sel_rud_json = json_encode($irl_sel_rud);

		// Output the JSON string as a JavaScript array
		echo '<script>var values = ' . $irl_sel_rud_json . '; console.log(values);</script>';

	}

}
// add_shortcode( 'nepa_irl_sel_rud', 'display_nepa_irl_sel_rud_shortcode' );


// Add custom columns to 'nepa_irl' post type
add_filter('manage_nepa_irl_posts_columns', 'nepa_irl_custom_columns');
function nepa_irl_custom_columns($columns)
{
	$columns['irl_number'] = __('IRL Number', 'text-domain');
	$columns['order_number'] = __('Order Number', 'text-domain');
	return $columns;
}

// Display data in custom columns for 'nepa_irl' post type
add_action('manage_nepa_irl_posts_custom_column', 'nepa_irl_custom_column_data', 10, 2);
function nepa_irl_custom_column_data($column, $post_id)
{
	switch ($column) {
		case 'irl_number':
			echo get_field('irl_number', $post_id);
			break;
		case 'order_number':
			echo get_field('order_number', $post_id);
			break;
	}
}

// Make custom columns sortable for 'nepa_irl' post type
add_filter('manage_edit-nepa_irl_sortable_columns', 'nepa_irl_sortable_columns');
function nepa_irl_sortable_columns($columns)
{
	$columns['irl_number'] = 'irl_number';
	$columns['order_number'] = 'order_number';
	return $columns;
}

// Define sort parameters for custom columns in 'nepa_irl' post type
add_action('pre_get_posts', 'nepa_irl_sort_columns');
function nepa_irl_sort_columns($query)
{
	if (!is_admin() || !$query->is_main_query()) {
		return;
	}

	$orderby = $query->get('orderby');

	if ('irl_number' == $orderby) {
		$query->set('meta_key', 'irl_number');
		$query->set('orderby', 'meta_value');
	}

	if ('order_number' == $orderby) {
		$query->set('meta_key', 'order_number');
		$query->set('orderby', 'meta_value');


	}


}

