<?php
/**
 * The template for displaying the front page
 *
 * @package EffePlast
 */

get_header();
?>

<!-- Hero Section (Dynamic Swiper Slider) -->
<?php
$slides_query = new WP_Query(array(
    'post_type'      => 'ep_slide_accueil',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
));

if ( $slides_query->have_posts() ) :
?>
<section class="relative bg-ep-gray-light overflow-hidden flex items-center min-h-[85vh] p-0 m-0 w-full">

    <div class="swiper ep-hero-swiper w-full h-full min-h-[85vh] absolute inset-0">
        <div class="swiper-wrapper">
            <?php
            while ( $slides_query->have_posts() ) : $slides_query->the_post();
                $slide_id = get_the_ID();
                $titre = get_post_meta( $slide_id, '_ep_slide_titre', true );
                $mot_cle = get_post_meta( $slide_id, '_ep_slide_mot_cle', true );
                $desc = get_post_meta( $slide_id, '_ep_slide_desc', true );
                $btn1_txt = get_post_meta( $slide_id, '_ep_slide_btn1_text', true );
                $btn1_url = get_post_meta( $slide_id, '_ep_slide_btn1_url', true );
                $btn2_txt = get_post_meta( $slide_id, '_ep_slide_btn2_text', true );
                $btn2_url = get_post_meta( $slide_id, '_ep_slide_btn2_url', true );
                $badge = get_post_meta( $slide_id, '_ep_slide_badge', true );

                $bg_image_url = get_the_post_thumbnail_url($slide_id, 'full');
            ?>
            <div class="swiper-slide relative flex items-center w-full h-full min-h-[85vh] overflow-hidden">

                <!-- Slide Background Image with Parallax -->
                <?php if($bg_image_url): ?>
                    <div class="absolute inset-0 z-0" data-swiper-parallax="50%">
                        <img src="<?php echo esc_url($bg_image_url); ?>" alt="" class="w-full h-full object-cover">
                        <!-- Dark Overlay for text readability -->
                        <div class="absolute inset-0 bg-gradient-to-r from-ep-blue-night/90 via-ep-blue-night/70 to-transparent"></div>
                    </div>
                <?php else: ?>
                    <!-- Fallback Abstract Background if no image is set -->
                    <div class="absolute inset-0 z-0" data-swiper-parallax="50%">
                        <div class="absolute top-0 right-0 w-1/2 h-full bg-ep-blue-night skew-x-12 translate-x-32 hidden lg:block opacity-[0.03]"></div>
                        <div class="absolute -top-40 -left-40 w-96 h-96 bg-ep-cyan rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
                        <div class="absolute top-40 right-20 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
                    </div>
                <?php endif; ?>

                <!-- Slide Content -->
                <div class="container mx-auto px-4 lg:px-8 relative z-10 w-full">
                    <div class="max-w-3xl" data-swiper-parallax="-300" data-swiper-parallax-opacity="0">

                        <?php if($badge): ?>
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full <?php echo $bg_image_url ? 'bg-white/10 text-white border-white/20 backdrop-blur-md' : 'bg-blue-50 text-ep-primary border-blue-100'; ?> font-semibold text-sm mb-8 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-ep-cyan animate-pulse"></span>
                            <?php echo esc_html($badge); ?>
                        </div>
                        <?php endif; ?>

                        <h1 class="text-5xl lg:text-7xl font-extrabold <?php echo $bg_image_url ? 'text-white' : 'text-ep-blue-night'; ?> leading-[1.1] mb-6 tracking-tight drop-shadow-md">
                            <?php echo esc_html($titre); ?> <br>
                            <?php if($mot_cle): ?>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-ep-primary to-ep-cyan drop-shadow-none"><?php echo esc_html($mot_cle); ?></span>
                            <?php endif; ?>
                        </h1>

                        <?php if($desc): ?>
                        <p class="text-lg lg:text-xl <?php echo $bg_image_url ? 'text-gray-200' : 'text-gray-600'; ?> mb-10 leading-relaxed font-light max-w-2xl drop-shadow-sm">
                            <?php echo nl2br(esc_html($desc)); ?>
                        </p>
                        <?php endif; ?>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php if($btn1_txt && $btn1_url): ?>
                            <a href="<?php echo esc_url($btn1_url); ?>" class="px-8 py-4 bg-ep-cyan text-white font-bold rounded-full shadow-lg hover:shadow-cyan-500/50 hover:bg-ep-primary hover:-translate-y-1 transition-all duration-300 text-center flex items-center justify-center gap-2 group">
                                <span><?php echo esc_html($btn1_txt); ?></span>
                                <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <?php endif; ?>

                            <?php if($btn2_txt && $btn2_url): ?>
                            <a href="<?php echo esc_url($btn2_url); ?>" class="px-8 py-4 <?php echo $bg_image_url ? 'bg-white/10 text-white border-white/30 backdrop-blur hover:bg-white hover:text-ep-blue-night' : 'bg-white text-ep-blue-night border-gray-200 hover:border-ep-cyan hover:text-ep-cyan'; ?> font-bold rounded-full border shadow-sm hover:-translate-y-1 transition-all duration-300 text-center flex items-center justify-center">
                                <?php echo esc_html($btn2_txt); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php endwhile; ?>
        </div>

        <!-- Add Pagination -->
        <div class="swiper-pagination ep-hero-pagination"></div>
        <!-- Add Navigation -->
        <div class="swiper-button-prev ep-hero-prev !text-white/70 hover:!text-white after:!text-2xl ml-4 drop-shadow-md"></div>
        <div class="swiper-button-next ep-hero-next !text-white/70 hover:!text-white after:!text-2xl mr-4 drop-shadow-md"></div>
    </div>
</section>

<?php else : ?>
<!-- Fallback Hero Section if no slides are published -->
<section class="relative bg-ep-gray-light overflow-hidden pt-20 pb-32 lg:pt-32 lg:pb-48 flex items-center min-h-[85vh]">
    <div class="container mx-auto px-4 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl font-bold text-gray-400">Aucune slide d'accueil publiée.</h1>
        <p class="text-gray-500 mt-4">Veuillez ajouter des slides dans l'interface d'administration sous "Slides Accueil".</p>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<!-- About Section -->
<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="bg-gray-50 aspect-[4/5] rounded-3xl overflow-hidden shadow-sm hover:shadow-modern transition-all duration-500 group flex items-center justify-center relative p-8">
                            <div class="absolute inset-0 bg-gradient-to-t from-ep-blue-night/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/creativity-1.png')); ?>" alt="Créativité Effe Plast" class="w-full h-full object-contain filter group-hover:brightness-0 group-hover:invert group-hover:-translate-y-2 transition-all duration-500 relative z-20">
                        </div>
                        <div class="bg-ep-cyan aspect-square rounded-3xl p-8 text-white flex flex-col justify-end hover:shadow-modern-hover transition-all duration-300 hover:-translate-y-2">
                            <span class="text-4xl font-black mb-2">+25</span>
                            <span class="font-medium text-blue-50">Années d'expérience</span>
                        </div>
                    </div>
                    <div class="space-y-4 pt-12">
                        <div class="bg-ep-blue-night aspect-square rounded-3xl p-8 text-white flex flex-col justify-end hover:shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 hover:-translate-y-2">
                            <i class="fas fa-medal text-4xl text-ep-cyan mb-4"></i>
                            <span class="font-bold text-xl">Qualité Certifiée</span>
                        </div>
                        <div class="bg-gray-50 aspect-[4/5] rounded-3xl overflow-hidden shadow-sm hover:shadow-modern transition-all duration-500 group flex items-center justify-center relative p-8">
                            <div class="absolute inset-0 bg-gradient-to-t from-ep-cyan/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/quality.png')); ?>" alt="Qualité Effe Plast" class="w-full h-full object-contain filter group-hover:brightness-0 group-hover:invert group-hover:-translate-y-2 transition-all duration-500 relative z-20">
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <h4 class="text-ep-cyan font-bold uppercase tracking-widest text-sm mb-3 flex items-center gap-2">
                    <span class="w-8 h-0.5 bg-ep-cyan"></span> À Propos de Nous
                </h4>
                <h2 class="text-4xl md:text-5xl font-bold text-ep-blue-night mb-8 leading-tight">
                    Créativité <br>
                    <span class="text-ep-primary">Technologie & Qualité</span>
                </h2>

                <p class="text-gray-600 mb-6 text-lg leading-relaxed font-light">
                    Basée à Av. Bahnini - Res .Taissir -A2-4-6 USINE : Lot. N 7 -Q.I . BirRami KENITRA, Effe Plast se distingue par son savoir-faire unique dans la conception de flacons et bidons plastiques.
                </p>
                <p class="text-gray-600 mb-10 leading-relaxed">
                    Grâce à l'innovation, à des équipements de pointe et à une approche sur mesure, nous accompagnons les industries dans le développement de solutions d'emballage qui allient performance, durabilité et design.
                </p>

                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-4">
                        <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-ep-cyan">
                            <i class="fas fa-check text-sm"></i>
                        </span>
                        <span class="font-medium text-gray-800">Équipements de pointe et technologie moderne</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-ep-cyan">
                            <i class="fas fa-check text-sm"></i>
                        </span>
                        <span class="font-medium text-gray-800">Solutions sur mesure pour chaque secteur</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-ep-cyan">
                            <i class="fas fa-check text-sm"></i>
                        </span>
                        <span class="font-medium text-gray-800">Engagement fort envers le développement durable</span>
                    </li>
                </ul>

                <a href="/a-propos" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white font-semibold rounded-full hover:bg-ep-primary hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    Découvrir plus
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-24 bg-ep-gray-light">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h4 class="text-ep-cyan font-bold uppercase tracking-widest text-sm mb-3 flex items-center justify-center gap-2">
                <span class="w-8 h-0.5 bg-ep-cyan"></span> Notre Catalogue <span class="w-8 h-0.5 bg-ep-cyan"></span>
            </h4>
            <h2 class="text-4xl md:text-5xl font-bold text-ep-blue-night mb-6">Explorer Nos Produits</h2>
            <p class="text-gray-600 text-lg">Découvrez notre large gamme de solutions d'emballage plastique adaptées à vos besoins industriels.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Category 1 -->
            <a href="/bidons" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-modern transition-all duration-500 hover:-translate-y-2">
                <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-12 relative overflow-hidden">
                    <div class="absolute w-64 h-64 bg-ep-cyan rounded-full filter blur-3xl opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <i class="fas fa-jug-detergent text-ep-cyan group-hover:scale-110 transition-transform duration-500 relative z-10" style="font-size: 120px;"></i>
                </div>
                <div class="p-8 text-center relative z-20 bg-white">
                    <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Bidons</h3>
                    <p class="text-gray-500 mb-6 font-medium">Capacités de 1L à 5L</p>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-ep-blue-night group-hover:bg-ep-cyan group-hover:text-white transition-all duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>

            <!-- Category 2 -->
            <a href="/bouteilles" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-modern transition-all duration-500 hover:-translate-y-2">
                <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-12 relative overflow-hidden">
                    <div class="absolute w-64 h-64 bg-ep-primary rounded-full filter blur-3xl opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <i class="fas fa-bottle-water text-ep-primary group-hover:scale-110 transition-transform duration-500 relative z-10" style="font-size: 120px;"></i>
                </div>
                <div class="p-8 text-center relative z-20 bg-white">
                    <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Bouteilles</h3>
                    <p class="text-gray-500 mb-6 font-medium">Formats variés et sur-mesure</p>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-ep-blue-night group-hover:bg-ep-primary group-hover:text-white transition-all duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>

            <!-- Category 3 -->
            <a href="/les-bouchons" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-modern transition-all duration-500 hover:-translate-y-2">
                <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-12 relative overflow-hidden">
                    <div class="absolute w-64 h-64 bg-ep-blue-night rounded-full filter blur-3xl opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <i class="fas fa-ring text-ep-blue-night group-hover:scale-110 transition-transform duration-500 relative z-10" style="font-size: 120px;"></i>
                </div>
                <div class="p-8 text-center relative z-20 bg-white">
                    <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Bouchons</h3>
                    <p class="text-gray-500 mb-6 font-medium">Sécurité et étanchéité garanties</p>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-gray-400 group-hover:bg-ep-blue-night group-hover:text-white transition-all duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <div class="text-center mt-12">
            <a href="/produits" class="inline-flex font-semibold text-ep-blue-night hover:text-ep-cyan transition-colors duration-300 border-b-2 border-transparent hover:border-ep-cyan pb-1">
                Voir tous nos produits <i class="fas fa-arrow-right ml-2 mt-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-16 bg-white border-t border-gray-100 overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between">

            <div class="w-full md:w-[30%] text-center md:text-left shrink-0 relative z-10 bg-white mb-8 md:mb-0 md:pr-12">
                <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Partenaires de notre succès</h3>
                <p class="text-gray-500 font-medium">Ensemble, créons l'excellence</p>
            </div>

            <!-- Infinite Scrolling Logos -->
            <div class="w-full md:w-[70%] relative overflow-hidden" style="min-width: 0;">
                <!-- Gradient Masks for smooth scroll fading -->
                <div class="absolute left-0 top-0 bottom-0 w-16 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none hidden md:block"></div>
                <div class="absolute right-0 top-0 bottom-0 w-16 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none hidden md:block"></div>

                <div class="ep-logo-slider">
                    <div class="ep-logo-track flex items-center w-max" style="gap: 4rem;">

                        <?php
                        // Array of partner logos
                        $partner_logos = array(
                            home_url('/wp-content/uploads/2026/04/LOGO-SARAPROC.jpg'),
                            home_url('/wp-content/uploads/2026/04/LOGO-TOP-CHEF-remove.jpg'),
                            'https://www.effeplast.upkeep.ma/wp-content/uploads/2026/04/mercure.jpg',
                            'https://www.effeplast.upkeep.ma/wp-content/uploads/2026/04/OUSSOUD-AL-MAGHRIB.png'
                        );

                        // Output the logos twice (or more) to create a seamless infinite scroll loop
                        for($i=0; $i<3; $i++) {
                            foreach($partner_logos as $logo_url) {
                                ?>
                                <div class="group flex items-center justify-center" style="flex: 0 0 100px; width: 100px; height: 80px;">
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="Partenaire Effe Plast" class="max-w-[100px] max-h-[80px] object-contain transition-transform duration-300 hover:scale-110 cursor-pointer">
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.ep-logo-slider {
    width: 100%;
    overflow: hidden;
}
.ep-logo-track {
    animation: epScrollLogos 25s linear infinite;
}
.ep-logo-track:hover {
    animation-play-state: paused;
}

@keyframes epScrollLogos {
    0% { transform: translateX(0); }
    100% { transform: translateX(calc(-33.33% - 4rem)); /* Translates exactly one full set of logos (1/3 of the track) */ }
}

@media (min-width: 768px) {
    @keyframes epScrollLogos {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-33.33% - 5rem)); /* Adjust for md:gap-20 */ }
    }
}
</style>

<?php get_footer(); ?>