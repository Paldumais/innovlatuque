<?php
/**
 * Fonctions et définitions du thème InnovLaTuque.
 * @package InnovLaTuque_Thème
 */

if ( ! defined( 'INNOVLATUQUE_VERSION' ) ) {
	define( 'INNOVLATUQUE_VERSION', '3.0.4' );
}

/**
 * Configure les fonctionnalités de base du thème.
 */
function innovlatuque_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( [ 'primary' => esc_html__( 'Menu Principal', 'innovlatuquetheme' ) ] );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'innovlatuque_setup' );

/**
 * Enqueue les scripts et les styles.
 */
function innovlatuque_enqueue_scripts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null );
    wp_enqueue_style( 'innovlatuque-style', get_stylesheet_uri(), [], INNOVLATUQUE_VERSION );
    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', [], null, false );
    wp_enqueue_script( 'innovlatuque-main-js', get_template_directory_uri() . '/assets/js/main.js', [], INNOVLATUQUE_VERSION, true );
    
    // Passe les données de PHP à JavaScript de manière sécuritaire
    wp_localize_script('innovlatuque-main-js', 'wpData', [
        'apiKey' => get_theme_mod('gemini_api_key', ''),
        'translations' => file_get_contents(get_template_directory() . '/assets/js/translations.json')
    ]);
}
add_action( 'wp_enqueue_scripts', 'innovlatuque_enqueue_scripts' );

/**
 * Charge les fichiers additionnels du thème.
 */
$theme_inc_path = get_template_directory() . '/inc';
require_once $theme_inc_path . '/customizer.php';
require_once $theme_inc_path . '/class-tailwind-nav-walker.php';
