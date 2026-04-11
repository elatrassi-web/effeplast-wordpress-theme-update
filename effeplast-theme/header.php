<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-ep-gray-light font-sans text-gray-800 antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <a class="skip-link screen-reader-text sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'effeplast' ); ?></a>

    <!-- Top Bar -->
    <div class="bg-ep-blue-night text-white py-2 text-xs font-medium tracking-wide">
        <div class="container mx-auto px-4 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="mailto:effeplast.kenitra@gmail.com" class="hover:text-ep-cyan transition-colors duration-300 flex items-center">
                    <i class="fas fa-envelope mr-2 text-ep-cyan"></i> effeplast.kenitra@gmail.com
                </a>
                <a href="tel:0537360820" class="hover:text-ep-cyan transition-colors duration-300 flex items-center">
                    <i class="fas fa-phone mr-2 text-ep-cyan"></i> 05 37 36 08 20
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <span class="text-gray-400">Expert en plasturgie au Maroc</span>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header id="masthead" class="site-header bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm border-b border-gray-100 transition-all duration-300">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="site-branding flex-shrink-0">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="w-40 transition-transform duration-300 hover:scale-105">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block transition-transform duration-300 hover:scale-105">
                            <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/cropped-Capture_d_ecran_2025-02-17_103238-removebg-preview.webp' ) ); ?>" alt="Effe Plast Logo" class="h-10 md:h-12 w-auto object-contain">
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Desktop Navigation -->
                <nav id="site-navigation" class="main-navigation hidden md:block">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'menu_class'     => 'flex space-x-8 font-medium text-sm text-gray-700',
                            'fallback_cb'    => false,
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            // Custom walker can be used here for deeper Tailwind integration, but we'll stick to CSS targeting for now
                        )
                    );
                    ?>
                </nav>

                <!-- If no menu, show fallback links -->
                <?php if ( !has_nav_menu('menu-1') ) : ?>
                <nav class="hidden md:flex space-x-8 font-semibold text-[15px] text-ep-blue-night">
                    <a href="/" class="hover:text-ep-cyan transition-colors duration-300 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-0.5 after:bg-ep-cyan after:transition-all after:duration-300 hover:after:w-full">Accueil</a>
                    <a href="/a-propos" class="hover:text-ep-cyan transition-colors duration-300 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-0.5 after:bg-ep-cyan after:transition-all after:duration-300 hover:after:w-full">À Propos</a>
                    <a href="/produits" class="hover:text-ep-cyan transition-colors duration-300 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-0.5 after:bg-ep-cyan after:transition-all after:duration-300 hover:after:w-full">Produits</a>
                    <a href="/contact" class="hover:text-ep-cyan transition-colors duration-300 relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-0.5 after:bg-ep-cyan after:transition-all after:duration-300 hover:after:w-full">Contact</a>
                </nav>
                <?php endif; ?>

                <!-- Call to Action / Devis Button -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="/panier-devis" class="relative text-ep-blue-night hover:text-ep-cyan transition-colors" title="Voir ma demande de devis">
                        <i class="fas fa-file-invoice text-xl"></i>
                        <span class="ep-quote-count absolute -top-2 -right-2 w-5 h-5 bg-ep-cyan text-white text-[10px] font-bold rounded-full flex items-center justify-center hidden">0</span>
                    </a>
                    <a href="/devis" class="group relative px-6 py-2.5 font-semibold text-white bg-ep-blue-night rounded-full overflow-hidden shadow-lg hover:shadow-cyan-500/30 transition-all duration-300">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-ep-blue-night to-ep-cyan opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            <i class="fas fa-clipboard-list text-sm"></i> Nos Produits Devis
                        </span>
                    </a>
                </div>

                <!-- Mobile Menu Button (AlpineJS) -->
                <div class="md:hidden flex items-center" x-data="{ mobileMenuOpen: false }">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-ep-blue-night p-2 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Mobile Menu Overlay -->
                    <div x-show="mobileMenuOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-5"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-5"
                         @click.away="mobileMenuOpen = false"
                         class="absolute top-20 left-0 w-full bg-white shadow-xl border-t border-gray-100 p-6 flex flex-col space-y-4 font-medium text-lg text-ep-blue-night" style="display: none;">
                        <a href="/" class="pb-2 border-b border-gray-50 hover:text-ep-cyan">Accueil</a>
                        <a href="/a-propos" class="pb-2 border-b border-gray-50 hover:text-ep-cyan">À Propos</a>
                        <a href="/produits" class="pb-2 border-b border-gray-50 hover:text-ep-cyan">Produits</a>
                        <a href="/contact" class="pb-2 border-b border-gray-50 hover:text-ep-cyan">Contact</a>
                        <a href="/devis" class="mt-4 text-center px-6 py-3 font-semibold text-white bg-gradient-to-r from-ep-blue-night to-ep-cyan rounded-xl shadow-md">
                            Demander un Devis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="primary" class="site-main flex-grow">
