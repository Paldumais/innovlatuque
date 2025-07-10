    </main><!-- #content -->
    <footer class="bg-slate-800 text-slate-300 mt-auto">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center md:text-left">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-12 border-t border-slate-700 pt-8 text-center text-slate-400">
                <p class="text-sm"><span data-lang="creationCredit">Une création de</span> <a href="https://pxlbase.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-emerald-400 hover:underline">Pierre-Alexandre Lévesque Dumais</a></p>
                <p class="mt-2">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <span data-lang="footerRights">Tous droits réservés.</span></p>
            </div>
        </div>
    </footer>
    <?php get_template_part('template-parts/modal-project'); ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
