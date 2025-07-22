<?php
/**
 * Fonctions et définitions du thème InnovLaTuque.
 * @package InnovLaTuque_Thème
 */

if ( ! defined( 'INNOVLATUQUE_VERSION' ) ) {
	define( 'INNOVLATUQUE_VERSION', '4.2.8' );
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
 * Enregistre les zones de widgets.
 */
function innovlatuque_widgets_init() {
    register_sidebar( [
        'name'          => esc_html__( 'Pied de page - Colonne 1', 'innovlatuquetheme' ), 'id' => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold text-white mb-4">', 'after_title'   => '</h4>',
    ] );
    register_sidebar( [
        'name'          => esc_html__( 'Pied de page - Colonne 2', 'innovlatuquetheme' ), 'id' => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold text-white mb-4">', 'after_title'   => '</h4>',
    ] );
    register_sidebar( [
        'name'          => esc_html__( 'Pied de page - Colonne 3', 'innovlatuquetheme' ), 'id' => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold text-white mb-4">', 'after_title'   => '</h4>',
    ] );
    register_sidebar( [
        'name'          => esc_html__( 'Pied de page - Colonne 4', 'innovlatuquetheme' ), 'id' => 'footer-4',
        'description'   => esc_html__( 'Widgets pour la quatrième colonne du pied de page.', 'innovlatuquetheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold text-white mb-4">', 'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'innovlatuque_widgets_init' );

/**
 * Enqueue les scripts et les styles.
 */
function innovlatuque_enqueue_scripts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null );
    wp_enqueue_style( 'innovlatuque-style', get_stylesheet_uri(), [], INNOVLATUQUE_VERSION );
    wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], '1.9.4' );
    wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], '8.4.5' );

    if ( is_singular() || is_archive() || is_home() ) {
        wp_enqueue_style( 'innovlatuque-typography', get_template_directory_uri() . '/assets/css/typography.css', [], INNOVLATUQUE_VERSION );
    }

    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', [], null, false );
    wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], '1.9.4', true );
    wp_enqueue_script( 'tone-js', 'https://cdnjs.cloudflare.com/ajax/libs/tone/14.7.77/Tone.js', [], '14.7.77', true );
    wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], '8.4.5', true );
    wp_enqueue_script( 'innovlatuque-main-js', get_template_directory_uri() . '/assets/js/main.js', ['leaflet-js', 'tone-js', 'swiper-js'], INNOVLATUQUE_VERSION, true );
    
    // Passe les données de PHP à JavaScript de manière sécuritaire
    wp_localize_script('innovlatuque-main-js', 'wpData', [
        'rest_url' => esc_url_raw( rest_url() ),
        'nonce'    => wp_create_nonce( 'wp_rest' ),
        'translations' => file_get_contents(get_template_directory() . '/assets/js/translations.json')
    ]);
}
add_action( 'wp_enqueue_scripts', 'innovlatuque_enqueue_scripts' );

/**
 * Exclut les articles à la une de la requête principale sur la page du blogue.
 */
function innovlatuque_exclude_featured_posts( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $featured_posts_query = new WP_Query([
            'posts_per_page' => 4,
            'post_status'    => 'publish',
        ]);
        
        if ( $featured_posts_query->have_posts() ) {
            $featured_ids = wp_list_pluck( $featured_posts_query->posts, 'ID' );
            $query->set( 'post__not_in', $featured_ids );
        }
    }
}
add_action( 'pre_get_posts', 'innovlatuque_exclude_featured_posts' );

function enqueue_swiper_assets() {
    // CSS Swiper
    wp_enqueue_style(
        'swiper-css', 
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', 
        array(), 
        '11.0.0'
    );
    
    // JS Swiper
    wp_enqueue_script(
        'swiper-js', 
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', 
        array(), 
        '11.0.0', 
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');

// Optionnel: CSS personnalisé pour le carousel
function custom_swiper_styles() {
    ?>
    <style>
    .featured-posts-swiper {
        padding-bottom: 50px !important;
    }
    
    .featured-posts-swiper .swiper-button-next,
    .featured-posts-swiper .swiper-button-prev {
        color: white !important;
        background: rgba(0, 0, 0, 0.5);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        margin-top: -22px;
    }
    
    .featured-posts-swiper .swiper-button-next:hover,
    .featured-posts-swiper .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.7);
    }
    
    .featured-posts-swiper .swiper-pagination-bullet {
        background: white;
        opacity: 0.5;
    }
    
    .featured-posts-swiper .swiper-pagination-bullet-active {
        opacity: 1;
        background: #10b981; /* Couleur émeraude */
    }
    
    /* Mode sombre */
    .dark .featured-posts-swiper .swiper-pagination-bullet-active {
        background: #34d399;
    }
    </style>
    <?php
}
add_action('wp_head', 'custom_swiper_styles');

/**
 * Charge les fichiers additionnels du thème.
 */
$theme_inc_path = get_template_directory() . '/inc';
require_once $theme_inc_path . '/customizer.php';
require_once $theme_inc_path . '/class-tailwind-nav-walker.php';
require_once $theme_inc_path . '/cpt-organisation.php';
require_once $theme_inc_path . '/rest-api.php';
