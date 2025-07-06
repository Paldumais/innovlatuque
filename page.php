<?php
/**
 * Le gabarit pour afficher toutes les pages statiques.
 *
 * @package InnovLaTuque_Thème
 */

get_header();
?>

<div class="bg-white dark:bg-slate-900">
    <div class="container mx-auto px-6 py-12 lg:py-16">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
                <header class="entry-header mb-8 text-center">
                    <?php the_title( '<h1 class="entry-title text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white">', '</h1>' ); ?>
                </header>

                <div class="entry-content prose lg:prose-xl max-w-none">
                    <?php
                    the_content();
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
