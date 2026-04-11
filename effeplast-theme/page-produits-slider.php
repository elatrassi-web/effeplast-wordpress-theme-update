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

<!-- Overrides removed to use light theme -->
<style>
    body { background-color: #F8FAFC; overflow-x: hidden; } /* Light theme base to match brand */
</style>

<!-- Immersive Light Mode Section -->
<div class="relative min-h-[90vh] flex flex-col items-center justify-center pt-32 pb-16 overflow-hidden bg-ep-gray-light">

    <!-- Abstract 3D Background Lighting (Light Mode) -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-[40rem] h-[40rem] bg-ep-cyan rounded-full mix-blend-multiply filter blur-[150px] opacity-20 animate-blob"></div>
        <div class="absolute bottom-1/4 left-1/4 w-[40rem] h-[40rem] bg-blue-300 rounded-full mix-blend-multiply filter blur-[150px] opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMGw0MCA0ME00MCAwbC00MCA0MCIgc3Ryb2tlPSIjZTllOWU5IiBzdHJva2Utd2lkdGg9IjAuNSIgc3Ryb2tlLW9wYWNpdHk9IjAuNSIvPgo8L3N2Zz4=')] opacity-50"></div>

        <!-- Glowing central stage -->
        <div class="absolute top-[60%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-7xl h-32 bg-white blur-[100px] rounded-[100%] shadow-[0_0_100px_rgba(0,180,216,0.3)]"></div>
    </div>

    <!-- Filtering UI Container -->
    <div class="container mx-auto px-4 lg:px-8 relative z-20 mb-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-ep-blue-night to-ep-cyan mb-4 tracking-tight drop-shadow-sm">
                Notre Collection Premium
            </h1>
            <p class="text-gray-600 font-medium text-lg md:text-xl max-w-2xl mx-auto">
                Explorez notre catalogue de flacons et bidons. Faites glisser pour découvrir ou utilisez les filtres ci-dessous.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-xl border border-gray-100 p-4 md:p-6 rounded-[2rem] shadow-modern flex flex-col md:flex-row gap-4 items-center justify-between">

            <!-- Category Pills -->
            <div class="flex flex-wrap items-center justify-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0" id="ep-slider-categories">
                <button class="ep-cat-btn px-4 py-1.5 rounded-full text-xs font-bold tracking-wide transition-all bg-ep-cyan text-white shadow-md shadow-cyan-500/30 border border-ep-cyan" data-cat="all">Tous</button>
                <?php
                $categories = get_terms( array(
                    'taxonomy'   => 'ep_product_cat',
                    'hide_empty' => true,
                ) );
                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<button class="ep-cat-btn px-4 py-1.5 rounded-full text-xs font-bold tracking-wide transition-all bg-gray-50 text-gray-600 border border-gray-200 hover:border-ep-cyan hover:text-ep-cyan hover:bg-white" data-cat="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                    }
                }
                ?>
            </div>

            <!-- Sleek Search Bar -->
            <div class="relative w-full md:w-64 flex-shrink-0 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-ep-cyan transition-colors"></i>
                </div>
                <input type="text" id="ep-slider-search" placeholder="Rechercher..." class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-full text-gray-800 placeholder-gray-400 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan focus:border-ep-cyan transition-all shadow-sm">

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
            <div class="swiper-button-prev !text-ep-cyan hover:!text-white !w-16 !h-16 !bg-white/90 hover:!bg-ep-cyan backdrop-blur-md !rounded-full border border-ep-cyan/20 hover:border-ep-cyan hover:scale-110 transition-all after:!text-xl shadow-lg shadow-cyan-500/20 left-4 md:left-8"></div>
            <div class="swiper-button-next !text-ep-cyan hover:!text-white !w-16 !h-16 !bg-white/90 hover:!bg-ep-cyan backdrop-blur-md !rounded-full border border-ep-cyan/20 hover:border-ep-cyan hover:scale-110 transition-all after:!text-xl shadow-lg shadow-cyan-500/20 right-4 md:right-8"></div>

            <!-- Pagination -->
            <div class="swiper-pagination !-bottom-6"></div>
        </div>

        <!-- Swipe Indicator -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-gray-400 opacity-70 animate-bounce pointer-events-none z-40 hidden md:flex">
            <i class="fas fa-hand-pointer text-xl mb-1"></i>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                <i class="fas fa-chevron-left text-[8px]"></i> Glisser <i class="fas fa-chevron-right text-[8px]"></i>
            </div>
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