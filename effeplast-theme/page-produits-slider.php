<?php
/**
 * Template Name: Page Produits (Slider Extraordinaire)
 *
 * The template for displaying an immersive, full-screen 3D product slider with filtering capabilities.
 *
 * @package EffePlast
 */

get_header();
?>

<!-- Minimalist Header Override for this specific page to keep focus on the slider -->
<style>
    .site-header { background: rgba(11, 28, 56, 0.95) !important; border-bottom: 1px solid rgba(255,255,255,0.1) !important; }
    .site-header a:not(.bg-ep-blue-night), .site-header span, .site-header i:not(.bg-ep-cyan) { color: white !important; }
    .site-header .bg-ep-blue-night { background: rgba(255,255,255,0.1) !important; border: 1px solid rgba(255,255,255,0.2) !important; }
    .site-header .bg-gradient-to-r { background: #00B4D8 !important; }
    #masthead .w-40 img { filter: brightness(0) invert(1); } /* Invert logo */
    body { background-color: #0B1C38; overflow-x: hidden; } /* Dark theme base */
</style>

<!-- Immersive Dark Mode Section -->
<div class="relative min-h-[90vh] flex flex-col items-center justify-center pt-32 pb-16 overflow-hidden">

    <!-- Abstract 3D Background Lighting -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[40rem] h-[40rem] bg-ep-primary rounded-full mix-blend-screen filter blur-[150px] opacity-30 animate-blob"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[40rem] h-[40rem] bg-ep-cyan rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMGw0MCA0ME00MCAwbC00MCA0MCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjAuNSIgc3Ryb2tlLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20"></div>

        <!-- Glowing central stage -->
        <div class="absolute top-[60%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-7xl h-32 bg-ep-cyan/20 blur-[100px] rounded-[100%]"></div>
    </div>

    <!-- Filtering UI Container -->
    <div class="container mx-auto px-4 lg:px-8 relative z-20 mb-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 mb-4 tracking-tight drop-shadow-lg">
                Notre Collection Premium
            </h1>
            <p class="text-blue-200/80 font-light text-lg md:text-xl max-w-2xl mx-auto">
                Explorez notre catalogue de flacons et bidons. Faites glisser pour découvrir ou utilisez les filtres ci-dessous.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-4 md:p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">

            <!-- Category Pills -->
            <div class="flex flex-wrap items-center justify-center gap-2 md:gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0" id="ep-slider-categories">
                <button class="ep-cat-btn px-5 py-2.5 rounded-full text-sm font-bold tracking-wide transition-all bg-ep-cyan text-white shadow-[0_0_15px_rgba(0,180,216,0.5)] border border-ep-cyan scale-105" data-cat="all">Tous</button>
                <?php
                $categories = get_terms( array(
                    'taxonomy'   => 'ep_product_cat',
                    'hide_empty' => true,
                ) );
                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<button class="ep-cat-btn px-5 py-2.5 rounded-full text-sm font-bold tracking-wide transition-all bg-transparent text-gray-300 border border-white/20 hover:border-ep-cyan hover:text-white" data-cat="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                    }
                }
                ?>
            </div>

            <!-- Sleek Search Bar -->
            <div class="relative w-full md:w-64 flex-shrink-0 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-ep-cyan transition-colors"></i>
                </div>
                <input type="text" id="ep-slider-search" placeholder="Rechercher..." class="w-full pl-11 pr-4 py-3 bg-black/40 border border-white/10 rounded-full text-white placeholder-gray-500 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan focus:border-ep-cyan transition-all shadow-inner">

                <!-- Loading spinner (hidden by default) -->
                <div id="ep-slider-loader" class="absolute inset-y-0 right-0 pr-4 flex items-center hidden">
                    <i class="fas fa-circle-notch fa-spin text-ep-cyan"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- The Swiper Container (Coverflow Effect) -->
    <div class="w-full relative z-30 pb-16">
        <div class="swiper ep-product-swiper w-full py-12 px-4 h-[650px] lg:h-[700px]">
            <div class="swiper-wrapper" id="ep-slider-wrapper">
                <!-- Slides will be injected here via AJAX. Show some skeleton loaders initially -->
                <?php for($i=0; $i<5; $i++): ?>
                <div class="swiper-slide">
                    <div class="w-full h-full bg-white/5 backdrop-blur rounded-[2rem] border border-white/10 animate-pulse"></div>
                </div>
                <?php endfor; ?>
            </div>

            <!-- Custom Navigation Arrows -->
            <div class="swiper-button-prev !text-white !w-16 !h-16 !bg-white/10 backdrop-blur-md !rounded-full border border-white/20 hover:bg-ep-cyan hover:border-ep-cyan hover:scale-110 transition-all after:!text-xl shadow-lg left-4 md:left-8"></div>
            <div class="swiper-button-next !text-white !w-16 !h-16 !bg-white/10 backdrop-blur-md !rounded-full border border-white/20 hover:bg-ep-cyan hover:border-ep-cyan hover:scale-110 transition-all after:!text-xl shadow-lg right-4 md:right-8"></div>

            <!-- Pagination -->
            <div class="swiper-pagination !-bottom-6"></div>
        </div>
    </div>

    <!-- Background wave for smooth transition to footer if needed -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
        <svg class="relative block w-full h-16 text-gray-900" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,120.7,192.27,110.16,236.4,102.63,279.7,79.5,321.39,56.44Z" fill="currentColor"></path>
        </svg>
    </div>
</div>

<style>
/* Swiper Coverflow Specific Overrides */
.ep-product-swiper .swiper-slide {
    width: 380px; /* Fixed width for the cards */
    height: 550px;
    opacity: 0.4;
    transition: opacity 0.5s;
}
.ep-product-swiper .swiper-slide-active {
    opacity: 1;
}

/* Custom Pagination dots */
.ep-product-swiper .swiper-pagination-bullet {
    background: rgba(255,255,255,0.3);
    width: 10px;
    height: 10px;
    transition: all 0.3s;
}
.ep-product-swiper .swiper-pagination-bullet-active {
    background: #00B4D8;
    width: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,180,216,0.8);
}

/* Responsive adjust */
@media (max-width: 640px) {
    .ep-product-swiper .swiper-slide { width: 300px; height: 500px; }
}
</style>

<?php get_footer(); ?>