<?php
/**
 * Le gabarit pour afficher un article de blogue unique (single post).
 *
 * @package InnovLaTuque_Thème
 */

get_header();
?>

<div class="bg-white dark:bg-slate-900 py-12 lg:py-16">
    <div class="container mx-auto px-6">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-3xl mx-auto'); ?>>
                <header class="entry-header mb-8 text-center">
                    <?php the_title( '<h1 class="entry-title text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white">', '</h1>' ); ?>
                    <div class="mt-4 text-sm text-slate-500 dark:text-slate-400">
                        <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mb-8 rounded-lg overflow-hidden shadow-lg">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content prose lg:prose-xl max-w-none">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'innovlatuquetheme' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile; // End of the loop.
        ?>
    </div>
</div>

<?php
get_footer();
