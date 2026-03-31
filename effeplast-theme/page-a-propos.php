<?php
/**
 * Template Name: Page À Propos
 *
 * The template for displaying the "About Us" page.
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <!-- Page Header -->
    <div class="bg-ep-blue-night pt-32 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-ep-cyan rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-ep-cyan/20 text-ep-cyan text-sm font-bold tracking-wider uppercase mb-4 border border-ep-cyan/30">
                L'Entreprise
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">À Propos de <span class="text-transparent bg-clip-text bg-gradient-to-r from-ep-cyan to-ep-primary">Nous</span></h1>
            <p class="text-blue-100 text-lg md:text-xl max-w-3xl mx-auto font-light leading-relaxed">
                Expert en plasturgie depuis 1998, Effe Plast crée des flacons et bidons innovants qui répondent parfaitement aux besoins de chaque industrie, avec un savoir-faire inégalé au Maroc.
            </p>
        </div>

        <!-- Curve divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
            <svg class="relative block w-full h-16 text-ep-gray-light" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-4 lg:px-8 -mt-16 relative z-30">

        <!-- Values Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <div class="bg-white rounded-3xl p-8 shadow-modern hover:shadow-modern-hover transition-all duration-500 hover:-translate-y-2 group border border-gray-50 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center text-ep-cyan mb-6 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500 shadow-inner">
                    <i class="fas fa-lightbulb text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-ep-blue-night mb-4">Créativité</h3>
                <p class="text-gray-600 font-light leading-relaxed">Conception sur mesure de solutions d'emballage qui valorisent vos produits et respectent vos exigences esthétiques.</p>
            </div>

            <div class="bg-ep-blue-night rounded-3xl p-8 shadow-modern hover:shadow-cyan-500/20 transition-all duration-500 hover:-translate-y-2 group flex flex-col items-center text-center transform md:-translate-y-8">
                <div class="w-20 h-20 rounded-2xl bg-white/10 flex items-center justify-center text-ep-cyan mb-6 shadow-inner border border-white/5 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500">
                    <i class="fas fa-microchip text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Technologie</h3>
                <p class="text-blue-100 font-light leading-relaxed">Parc machines de pointe en injection et soufflage garantissant précision, fiabilité et cadence élevée pour vos commandes.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-modern hover:shadow-modern-hover transition-all duration-500 hover:-translate-y-2 group border border-gray-50 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center text-ep-cyan mb-6 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500 shadow-inner">
                    <i class="fas fa-certificate text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-ep-blue-night mb-4">Qualité</h3>
                <p class="text-gray-600 font-light leading-relaxed">Contrôle rigoureux à chaque étape de production pour des flacons 100% étanches, robustes et conformes aux normes.</p>
            </div>
        </div>

        <!-- History/Content Section -->
        <div class="bg-white rounded-[2.5rem] p-8 md:p-16 shadow-sm border border-gray-100 mb-24 overflow-hidden relative">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-gray-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>

            <div class="grid lg:grid-cols-2 gap-16 items-center relative z-10">
                <div>
                    <h2 class="text-4xl md:text-5xl font-black text-ep-blue-night mb-6 leading-tight">Une histoire d'<span class="text-ep-cyan">innovation continue</span></h2>

                    <div class="prose prose-lg text-gray-600 font-light leading-relaxed">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                $content = get_the_content();
                                if(!empty($content)){
                                    the_content();
                                } else {
                                    ?>
                                    <p class="mb-6 font-medium text-gray-800 text-xl border-l-4 border-ep-cyan pl-6">
                                        Basée à Kénitra, Effe Plast se distingue par son savoir-faire unique dans la conception de flacons et bidons plastiques.
                                    </p>
                                    <p class="mb-6">
                                        Depuis notre création en 1998, nous accompagnons les industries cosmétiques, pharmaceutiques, chimiques et agroalimentaires dans le développement de solutions d'emballage performantes.
                                    </p>
                                    <p>
                                        Grâce à l'innovation, à des équipements de pointe et à une approche sur mesure, nous développons des solutions d'emballage qui allient performance, durabilité et design. Notre équipe d'experts est dédiée à comprendre vos besoins spécifiques pour vous fournir le produit exact qu'il vous faut, du prototype à la production en grande série.
                                    </p>
                                    <?php
                                }
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-ep-blue-night to-ep-cyan rounded-[2rem] rotate-3 opacity-10 scale-105"></div>
                    <div class="relative bg-gray-50 rounded-[2rem] aspect-[4/3] flex items-center justify-center border border-gray-200 shadow-inner overflow-hidden group">
                        <!-- Placeholder for factory/company image -->
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMGw0MCA0ME00MCAwbC00MCA0MCIgc3Ryb2tlPSIjZTllOWU5IiBzdHJva2Utd2lkdGg9IjAuNSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIvPgo8L3N2Zz4=')] opacity-50 mix-blend-multiply"></div>
                        <i class="fas fa-industry text-9xl text-gray-300 group-hover:text-ep-cyan transition-colors duration-700 group-hover:scale-110"></i>

                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/20 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-ep-cyan rounded-full flex items-center justify-center text-white font-bold text-xl"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <h4 class="font-bold text-ep-blue-night text-lg">Usine Kénitra</h4>
                                    <p class="text-sm text-gray-500 font-medium">Production 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to action inside page -->
        <div class="bg-gradient-to-r from-ep-blue-night to-ep-cyan rounded-[2rem] p-12 text-center text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10 max-w-2xl mx-auto">
                <i class="fas fa-handshake text-5xl text-white/50 mb-6"></i>
                <h3 class="text-3xl font-bold mb-4">Prêt à collaborer avec nous ?</h3>
                <p class="text-blue-100 mb-8 text-lg font-light">Contactez notre équipe commerciale pour discuter de votre projet de conditionnement sur mesure.</p>
                <a href="/contact" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-ep-blue-night font-bold rounded-full hover:shadow-xl hover:shadow-cyan-500/20 hover:-translate-y-1 transition-all duration-300">
                    Contactez-nous maintenant
                </a>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>