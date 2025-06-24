    </main><!-- #content -->

    <footer class="bg-slate-800 text-slate-300 mt-auto">
        <div class="container mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
                <div>
                    <h4 class="text-lg font-semibold text-white" data-lang="footerLegal">Légal</h4>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" class="text-slate-400 hover:text-emerald-400 transition" data-lang="footerPrivacy">Politique de confidentialité</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white" data-lang="footerFollow">Suivez-nous</h4>
                    <div class="mt-4 flex space-x-5 justify-center md:justify-start">
                        <a href="https://www.linkedin.com/company/paldumais-labs" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-400" aria-label="LinkedIn">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"></path></svg>
                        </a>
                        <a href="https://www.reddit.com/r/LaTuque/" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-400" aria-label="Reddit">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.0001 21.6001C17.3025 21.6001 21.6001 17.3025 21.6001 12.0001C21.6001 6.69769 17.3025 2.40015 12.0001 2.40015C6.69769 2.40015 2.40015 6.69769 2.40015 12.0001C2.40015 17.3025 6.69769 21.6001 12.0001 21.6001ZM16.0381 12.0001C16.5381 12.0001 16.9381 11.6001 16.9381 11.1001C16.9381 10.6001 16.5381 10.2001 16.0381 10.2001C15.5381 10.2001 15.1381 10.6001 15.1381 11.1001C15.1381 11.6001 15.5381 12.0001 16.0381 12.0001ZM8.01609 12.0001C8.51609 12.0001 8.91609 11.6001 8.91609 11.1001C8.91609 10.6001 8.51609 10.2001 8.01609 10.2001C7.51609 10.2001 7.11609 10.6001 7.11609 11.1001C7.11609 11.6001 7.51609 12.0001 8.01609 12.0001ZM14.9311 15.6001C14.8211 15.6001 14.7101 15.5681 14.6141 15.5051C14.3401 15.3281 13.5681 14.8201 12.0301 14.8201C10.4891 14.8201 9.71509 15.3311 9.44409 15.5051C9.20109 15.6691 8.89009 15.6571 8.65809 15.4801C8.42609 15.3031 8.34909 15.0001 8.46809 14.7361C8.53009 14.6041 9.07909 13.5821 10.6271 13.1161L10.3701 11.2331C10.3341 10.9571 10.5361 10.7011 10.8121 10.6651L12.0001 10.5001L13.1881 10.6651C13.4641 10.7011 13.6661 10.9571 13.6301 11.2331L13.3731 13.1161C14.9211 13.5821 15.4701 14.6041 15.5321 14.7361C15.6511 15.0001 15.5741 15.3031 15.3421 15.4801C15.2221 15.5681 15.0761 15.6001 14.9311 15.6001Z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-slate-700 pt-8 text-center text-slate-400">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <span data-lang="footerRights">Tous droits réservés.</span></p>
            </div>
        </div>
    </footer>

    <?php get_template_part('template-parts/modal-project'); ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
