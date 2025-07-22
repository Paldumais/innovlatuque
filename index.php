<?php
/**
 * Le gabarit principal pour l'index des articles de blogue.
 * @package InnovLaTuque_Thème
 */

get_header(); 

// Requête pour les articles à la une
$featured_posts_query = new WP_Query([
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => 1
]);
?>

<div class="container mx-auto px-6 py-12">
    <?php if ( $featured_posts_query->have_posts() ) : ?>
    <section id="featured-posts-carousel" class="mb-16 aos-animate">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-8" data-lang="featuredPostsTitle">Articles à la une</h2>
        <div class="swiper featured-posts-swiper relative">
            <div class="swiper-wrapper">
                <?php while ( $featured_posts_query->have_posts() ) : $featured_posts_query->the_post(); ?>
                <div class="swiper-slide">
                    <a href="<?php the_permalink(); ?>" class="block relative rounded-lg overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent z-10"></div>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                        <?php else : ?>
                            <div class="w-full h-80 bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                <span class="text-slate-500 dark:text-slate-400">Image non disponible</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute bottom-0 left-0 p-6 z-20">
                            <h3 class="text-2xl font-bold text-white leading-tight"><?php the_title(); ?></h3>
                            <p class="text-slate-200 mt-2"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next !text-white after:!text-2xl"></div>
            <div class="swiper-button-prev !text-white after:!text-2xl"></div>
            <!-- Pagination -->
            <div class="swiper-pagination !bottom-4"></div>
        </div>
    </section>
    <?php wp_reset_postdata(); endif; ?>

    <header class="page-header mb-8 aos-animate">
		<h1 class="text-4xl font-bold text-slate-900 dark:text-white" data-lang="allPostsTitle">Tous les Articles</h1>
	</header>

	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('aos-animate bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl dark:hover:shadow-emerald-900/50 transition-shadow duration-300'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>"><div class="overflow-hidden"><?php the_post_thumbnail('medium_large', ['class' => 'w-full h-48 object-cover hover:scale-105 transition-transform duration-300']); ?></div></a>
                    <?php endif; ?>
                    <div class="p-6">
                        <div class="text-sm text-slate-500 dark:text-slate-400 mb-2"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></div>
                        <h2 class="entry-title text-xl font-bold mb-2"><a href="<?php the_permalink(); ?>" class="text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-500 transition"><?php the_title(); ?></a></h2>
                        <div class="entry-summary text-slate-600 dark:text-slate-400"><?php the_excerpt(); ?></div>
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

<!-- Script pour initialiser le carousel Swiper -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier si Swiper est disponible
    if (typeof Swiper !== 'undefined') {
        const featuredSwiper = new Swiper('.featured-posts-swiper', {
            // Paramètres de base
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            
            // Navigation
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            
            // Responsive breakpoints
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            
            // Effets
            effect: 'slide',
            speed: 300,
            
            // Accessibilité
            a11y: {
                prevSlideMessage: 'Article précédent',
                nextSlideMessage: 'Article suivant',
            },
        });
    } else {
        console.warn('Swiper.js n\'est pas chargé. Veuillez inclure la librairie Swiper.');
    }
});
</script>

<?php get_footer(); ?>