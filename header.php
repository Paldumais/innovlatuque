<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root { --emerald-500: #10b981; --emerald-600: #059669; }
        html.dark { --emerald-500: #34d399; --emerald-600: #10b981; }
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; background-color: #f8fafc; color: #1e293b; transition: background-color 0.3s ease, color 0.3s ease; }
        html.dark body { background-color: #0f172a; color: #e2e8f0;}
        .hero-section { position: relative; overflow: hidden; }
        #hero-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .hero-content { position: relative; z-index: 1; }
        .mobile-menu-panel { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        .mobile-menu-panel.is-open { transform: translateX(0); }
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-container { transition: transform 0.3s ease; }
        .aos-animate { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .aos-animate.is-visible { opacity: 1; transform: translateY(0); }
        .adventure-checkbox:checked + label { border-color: var(--emerald-500); background-color: var(--emerald-500); color: white !important; }
        html.dark .adventure-checkbox:checked + label { background-color: var(--emerald-600); border-color: var(--emerald-600); }
        #dark-mode-toggle #dark-mode-indicator { transition: transform 0.3s ease; }

        /* Custom Prose Styles for WordPress Content */
        .prose h1, .prose h2, .prose h3, .prose h4 { color: #111827; font-weight: 700; }
        .prose p { margin-top: 1.25em; margin-bottom: 1.25em; }
        .prose h1 { font-size: 2.25em; margin-top: 0; margin-bottom: 0.88em; }
        .prose h2 { font-size: 1.875em; margin-top: 2em; margin-bottom: 1em; }
        .prose h3 { font-size: 1.5em; margin-top: 1.6em; margin-bottom: 0.6em; }
        .prose a { color: var(--emerald-600); text-decoration: none; font-weight: 500; transition: color 0.2s ease; }
        .prose a:hover { color: var(--emerald-500); }
        .prose strong { color: inherit; font-weight: 700; }
        .prose ul { list-style-type: disc; margin-top: 1.25em; margin-bottom: 1.25em; padding-left: 1.625em; }
        .prose ol { list-style-type: decimal; margin-top: 1.25em; margin-bottom: 1.25em; padding-left: 1.625em; }
        .prose li { margin-top: 0.5em; margin-bottom: 0.5em; }
        .prose blockquote { margin-top: 1.6em; margin-bottom: 1.6em; padding-left: 1em; border-left-width: 0.25rem; border-color: #e5e7eb; font-style: italic; color: #4b5563; }
        .prose pre { background-color: #f3f4f6; border-radius: 0.5rem; padding: 1rem; margin-top: 1.6em; margin-bottom: 1.6em; overflow-x: auto; }
        .prose code { background-color: #e5e7eb; padding: 0.2em 0.4em; margin: 0; font-size: 85%; border-radius: 0.25rem; }
        .prose pre code { background-color: transparent; padding: 0; }
        /* Dark Mode Prose */
        html.dark .prose { color: #d1d5db; }
        html.dark .prose h1, html.dark .prose h2, html.dark .prose h3, html.dark .prose h4 { color: #fff; }
        html.dark .prose a { color: var(--emerald-400); }
        html.dark .prose a:hover { color: var(--emerald-500); }
        html.dark .prose blockquote { border-color: #4b5563; color: #9ca3af; }
        html.dark .prose pre { background-color: #1f2937; }
        html.dark .prose code { background-color: #374151; }
        html.dark .prose pre code { background-color: transparent; }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class("bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200"); ?>>
<?php wp_body_open(); ?>
<div id="page" class="min-h-screen flex flex-col">
    <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <div class="text-2xl font-bold text-slate-900 dark:text-white"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Innov<span class="text-emerald-600 dark:text-emerald-500">LaTuque</span>.ca</a></div>
                <nav class="hidden md:flex items-center space-x-6">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'walker'         => new Tailwind_Nav_Walker(),
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                        ]);
                    }
                    ?>
                    <button id="lang-switcher-desktop" class="ml-4 font-semibold text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-500" data-lang-switcher>EN</button>
                </nav>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-md text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Ouvrir le menu"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg></button>
                </div>
            </div>
        </div>
    </header>
    <div id="mobile-menu-panel" class="mobile-menu-panel fixed top-0 right-0 h-full w-full max-w-xs bg-white dark:bg-slate-800 shadow-lg z-[60] p-6">
        <div class="flex justify-between items-center mb-8"><h2 class="text-xl font-bold text-slate-900 dark:text-white" data-lang="menuTitle">Menu</h2><button id="mobile-menu-close-button" class="p-2 rounded-md text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700" aria-label="Fermer le menu"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
        <nav>
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col space-y-4',
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    'walker'         => new Tailwind_Nav_Walker(),
                ]);
            }
            ?>
             <button id="lang-switcher-mobile" class="w-full mt-4 bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 text-center px-4 py-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600" data-lang-switcher>EN</button>
        </nav>
    </div>
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden"></div>
    <main id="content" class="site-content flex-grow">
