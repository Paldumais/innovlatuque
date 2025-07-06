<?php
/**
 * Le gabarit principal pour l'index des articles de blogue.
 * @package InnovLaTuque_Thème
 */

get_header(); ?>

<div class="container mx-auto px-6 py-12">
    <header class="page-header mb-8">
		<h1 class="text-4xl font-bold text-slate-900 dark:text-white"><?php esc_html_e( 'Actualités', 'innovlatuquetheme' ); ?></h1>
	</header>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl dark:hover:shadow-emerald-900/50 transition-shadow duration-300'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="p-6">
                        <h2 class="entry-title text-2xl font-bold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-500 transition"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-summary text-slate-600 dark:text-slate-400">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
				<?php
			endwhile;
		else :
            ?>
            <p><?php esc_html_e( 'Désolé, aucun article ne correspond à vos critères.', 'innovlatuquetheme' ); ?></p>
            <?php
		endif;
		?>
	</div>
</div>

<?php get_footer(); ?>