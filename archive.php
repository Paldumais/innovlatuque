<?php
/**
 * Le gabarit pour afficher les pages d'archives.
 *
 * @package InnovLaTuque_Thème
 */

get_header(); ?>

<div class="container mx-auto px-6 py-12">
    <header class="page-header mb-8 aos-animate">
		<?php
        the_archive_title( '<h1 class="text-4xl font-bold text-slate-900 dark:text-white">', '</h1>' );
        the_archive_description( '<div class="archive-description mt-2 text-lg text-slate-600 dark:text-slate-400">', '</div>' );
        ?>
	</header>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('aos-animate bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl dark:hover:shadow-emerald-900/50 transition-shadow duration-300'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="p-6">
                        <div class="text-sm text-slate-500 dark:text-slate-400 mb-2">
                            <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
                        </div>
                        <h2 class="entry-title text-2xl font-bold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-500 transition"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-summary prose prose-sm max-w-none text-slate-600 dark:text-slate-400">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
				<?php
			endwhile;
		else :
            ?>
            <p class="aos-animate"><?php esc_html_e( 'Désolé, aucun article ne correspond à vos critères.', 'innovlatuquetheme' ); ?></p>
            <?php
		endif;
		?>
	</div>
    
    <div class="mt-12">
        <?php the_posts_pagination(); ?>
    </div>

</div>

<?php get_footer(); ?>
