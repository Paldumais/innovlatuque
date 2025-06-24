<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>/* Minimal CSS to prevent FOUC */body{font-family:'Inter',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}.mobile-menu-panel{transition:transform .3s ease-in-out;transform:translateX(100%)}.mobile-menu-panel.is-open{transform:translateX(0)}.aos-animate{opacity:0;transform:translateY(30px);transition:opacity .5s ease-out,transform .5s ease-out}.aos-animate.is-visible{opacity:1;transform:translateY(0)}</style>
    <?php wp_head(); ?>
</head>
<body <?php body_class("bg-slate-50 text-slate-800"); ?>>
<div id="page" class="min-h-screen flex flex-col">
    <header class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <div class="text-2xl font-bold text-slate-900">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Innov<span class="text-emerald-600">LaTuque</span>.ca</a>
                </div>
                
                <nav class="hidden md:flex items-center space-x-6">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'walker'         => new Tailwind_Nav_Walker(),
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                    ]);
                    ?>
                    <button id="lang-switcher-desktop" class="ml-4 text-slate-600 font-semibold hover:text-emerald-600" data-lang-switcher>EN</button>
                </nav>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-md text-slate-600 hover:bg-slate-100" aria-label="Ouvrir le menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div id="mobile-menu-panel" class="mobile-menu-panel fixed top-0 right-0 h-full w-full max-w-xs bg-white shadow-lg z-[60] p-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-bold" data-lang="menuTitle">Menu</h2>
            <button id="mobile-menu-close-button" class="p-2 rounded-md text-slate-500 hover:bg-slate-100" aria-label="Fermer le menu">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex flex-col space-y-4',
                'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                'walker'         => new Tailwind_Nav_Walker(),
            ]);
            ?>
             <button id="lang-switcher-mobile" class="w-full mt-4 bg-slate-100 text-slate-800 text-center px-4 py-2 rounded-lg hover:bg-slate-200" data-lang-switcher>EN</button>
        </nav>
    </div>
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden"></div>

    <main id="content" class="site-content flex-grow">
