<?php // --- Fichier: inc/class-tailwind-nav-walker.php ---
/**
 * Walker pour le menu de navigation compatible Tailwind CSS.
 * @package InnovLaTuque_Thème
 */
class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $base_classes = ($depth === 0) 
            ? 'text-slate-600 hover:text-emerald-600 transition' 
            : 'block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700';
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $output .= '<li' . ($class_names ? ' class="' . esc_attr( $class_names ) . '"' : '') .'>';
        $atts = ['title' => $item->attr_title, 'target' => $item->target, 'rel' => $item->xfn, 'href' => $item->url, 'class' => $base_classes];
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . (('href' === $attr) ? esc_url($value) : esc_attr($value)) . '"';
            }
        }
        $item_output = $args->before . '<a'. $attributes .'>' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</a>' . $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}