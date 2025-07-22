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
        .hero-section { position: relative; overflow: hidden; background-color: #f8fafc; }
        html.dark .hero-section { background-color: #0f172a; }
        #hero-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .hero-content { position: relative; z-index: 10; }
        .hero-content h1 { text-shadow: 0 1px 3px rgba(0,0,0,0.2); }
        html.dark .hero-content h1 { text-shadow: 0 1px 5px rgba(0,0,0,0.5); }
        .parallax-layer { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-position: bottom center; background-repeat: no-repeat; background-size: cover; z-index: 5; will-change: transform; }
        .mobile-menu-panel { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        .mobile-menu-panel.is-open { transform: translateX(0); }
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-container { transition: transform 0.3s ease; }
        .aos-animate { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .aos-animate.is-visible { opacity: 1; transform: translateY(0); }
        .adventure-checkbox:checked + label { border-color: var(--emerald-500); background-color: var(--emerald-500); color: white !important; }
        html.dark .adventure-checkbox:checked + label { background-color: var(--emerald-600); border-color: var(--emerald-600); }
        #dark-mode-toggle #dark-mode-indicator { transition: transform 0.3s ease; }
        /* Swiper Carousel Styles */
        .swiper-pagination-bullet { background-color: #fff; opacity: 0.7; }
        .swiper-pagination-bullet-active { background-color: var(--emerald-500); opacity: 1; }
        .swiper-button-next, .swiper-button-prev { color: #fff; }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class("bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200"); ?>>
<?php wp_body_open(); ?>
<div id="page" class="min-h-screen flex flex-col">
    <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3">
                    <svg class="h-10 w-10" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M50 95 C 60 75, 40 55, 50 35" class="stroke-sky-500 dark:stroke-sky-400" stroke-width="5" fill="none" stroke-linecap="round"/><path d="M50 45 L 20 60" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><path d="M50 45 L 80 60" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><circle cx="20" cy="60" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><circle cx="80" cy="60" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><path d="M50 60 L 30 70" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><path d="M50 60 L 70 70" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><circle cx="30" cy="70" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><circle cx="70" cy="70" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><path d="M50 75 L 40 82" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><path d="M50 75 L 60 82" class="stroke-emerald-600 dark:stroke-emerald-400" stroke-width="3" stroke-linecap="round"/><circle cx="40" cy="82" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><circle cx="60" cy="82" r="3" class="fill-emerald-700 dark:fill-emerald-500"/><circle cx="50" cy="35" r="5" class="fill-lime-400 dark:fill-lime-300"/></svg>
                    <span class="text-2xl font-bold text-slate-900 dark:text-white">Innov<span class="text-emerald-600 dark:text-emerald-500">LaTuque</span>.ca</span>
                </a>
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
