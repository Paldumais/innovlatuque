<?php // --- Fichier: inc/customizer.php ---
/**
 * Options de l'outil de personnalisation du thème.
 * @package InnovLaTuque_Thème
 */
function innovlatuque_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'theme_settings_section', [
        'title'    => __( 'Paramètres InnovLaTuque', 'innovlatuquetheme' ),
        'priority' => 30,
    ] );
    $wp_customize->add_setting( 'gemini_api_key', [ 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'gemini_api_key', [
        'label'    => __( 'Clé API Gemini', 'innovlatuquetheme' ),
        'section'  => 'theme_settings_section',
        'type'     => 'text',
    ] );
}
add_action( 'customize_register', 'innovlatuque_customize_register' );