    </main><!-- #content -->

    <footer class="bg-slate-800 text-slate-300 mt-auto">
        <div class="container mx-auto px-6 py-12">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
                <!-- Legal Links -->
                <div>
                    <h4 class="text-lg font-semibold text-white" data-lang="footerLegal">Légal</h4>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" class="text-slate-400 hover:text-emerald-400 transition" data-lang="footerPrivacy">Politique de confidentialité</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Link -->
                <div>
                    <h4 class="text-lg font-semibold text-white" data-lang="footerContact">Contact</h4>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="mailto:hello@pxlbase.com" class="text-slate-400 hover:text-emerald-400 transition">hello@pxlbase.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media Links -->
                <div>
                    <h4 class="text-lg font-semibold text-white" data-lang="footerFollow">Suivez-nous</h4>
                    <div class="mt-4 flex space-x-5 justify-center md:justify-start">
                        <a href="https://www.linkedin.com/company/paldumais-labs" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-400" aria-label="LinkedIn">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"></path></svg>
                        </a>
                        <a href="https://www.reddit.com/r/LaTuque/" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-emerald-400" aria-label="Reddit">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm6.233 13.278c0 .502-.406.908-.908.908-.502 0-.908-.406-.908-.908v-2.384c0-.502.406-.908.908-.908.502 0 .908.406.908.908v2.384zm-6.554-4.523c-1.133 0-2.052.92-2.052 2.053s.92 2.052 2.052 2.052c1.133 0 2.053-.92 2.053-2.052s-.92-2.053-2.053-2.053zm-3.87 6.669c.562 1.815 2.253 3.12 4.258 3.12 2.004 0 3.695-1.305 4.258-3.12H8.809zM12 4.88c-1.353 0-2.454 1.1-2.454 2.454S10.647 9.79 12 9.79s2.454-1.1 2.454-2.454S13.353 4.88 12 4.88zm-5.324 8.398c0 .502-.406.908-.908.908-.502 0-.908-.406-.908-.908v-2.384c0-.502.406-.908.908.908.502 0 .908.406.908.908v2.384z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Dark Mode Toggle -->
                <div class="flex items-center justify-center md:justify-start">
                    <span class="mr-2 text-sm text-slate-400">☀️</span>
                    <button id="dark-mode-toggle" class="relative inline-flex items-center h-6 rounded-full w-11 bg-slate-600">
                        <span class="sr-only">Mode Sombre</span>
                        <span id="dark-mode-indicator" class="inline-block w-4 h-4 transform bg-white rounded-full"></span>
                    </button>
                    <span class="ml-2 text-sm text-slate-400">🌙</span>
                </div>
            </div>

            <!-- Copyright & Credit -->
            <div class="mt-12 border-t border-slate-700 pt-8 text-center text-slate-400">
                <p class="text-sm">
                    <span data-lang="creationCredit">Une création de</span> 
                    <a href="https://pxlbase.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-emerald-400 hover:underline">Pierre-Alexandre</a>
                </p>
                <p class="mt-2">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <span data-lang="footerRights">Tous droits réservés.</span></p>
            </div>
        </div>
    </footer>
    <?php get_template_part('template-parts/modal-project'); ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>