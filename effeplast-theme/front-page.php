<?php
/**
 * The template for displaying the front page
 *
 * @package EffePlast
 */

get_header();
?>

<!-- Hero Section -->
<section class="relative bg-ep-gray-light overflow-hidden pt-20 pb-32 lg:pt-32 lg:pb-48 flex items-center min-h-[85vh]">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-ep-blue-night skew-x-12 translate-x-32 hidden lg:block opacity-[0.03]"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-ep-cyan rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-8 items-center">
            <!-- Text Content -->
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-ep-primary font-semibold text-sm mb-8 border border-blue-100 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-ep-cyan animate-pulse"></span>
                    Depuis 1998 au Maroc
                </div>

                <h1 class="text-5xl lg:text-7xl font-extrabold text-ep-blue-night leading-[1.1] mb-6 tracking-tight">
                    Parfaits pour vos <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-ep-primary to-ep-cyan">Projets Uniques</span>
                </h1>

                <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed font-light max-w-lg">
                    Effe Plast, spécialiste de la plasturgie, développe des flacons et des bidons innovants adaptés aux besoins spécifiques de chaque secteur, avec une compétence reconnue.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/devis" class="px-8 py-4 bg-ep-blue-night text-white font-bold rounded-full shadow-lg hover:shadow-cyan-500/30 hover:-translate-y-1 transition-all duration-300 text-center flex items-center justify-center gap-2 group">
                        <span>Demander un Devis</span>
                        <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="/produits" class="px-8 py-4 bg-white text-ep-blue-night font-bold rounded-full border border-gray-200 shadow-sm hover:border-ep-cyan hover:text-ep-cyan hover:-translate-y-1 transition-all duration-300 text-center flex items-center justify-center">
                        Explorer nos Produits
                    </a>
                </div>
            </div>

            <!-- Hero Image / Visual -->
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-gradient-to-tr from-ep-blue-night to-ep-cyan rounded-[3rem] rotate-3 opacity-10 scale-105"></div>
                <div class="relative bg-white p-8 rounded-[3rem] shadow-modern z-10 border border-gray-50 flex justify-center items-center aspect-square overflow-hidden group">
                    <!-- Temporary placeholder for bidon/bottle image -->
                    <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white"></div>
                    <div class="relative z-20 flex flex-col items-center justify-center text-center">
                        <i class="fas fa-prescription-bottle text-8xl text-ep-cyan opacity-80 mb-6 group-hover:scale-110 transition-transform duration-500"></i>
                        <span class="text-2xl font-bold text-ep-blue-night">Plasturgie d'Excellence</span>
                    </div>
                </div>

                <!-- Floating badges -->
                <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-modern z-20 animate-bounce" style="animation-duration: 3s;">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500 text-xl">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Matériaux</p>
                            <p class="font-bold text-ep-blue-night">100% Recyclables</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="bg-gray-50 aspect-[4/5] rounded-3xl overflow-hidden shadow-sm hover:shadow-modern transition-all duration-500 group flex items-center justify-center relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-ep-blue-night/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                            <i class="fas fa-industry text-6xl text-gray-300 group-hover:text-white group-hover:-translate-y-4 transition-all duration-500 relative z-20"></i>
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
                        <div class="bg-gray-50 aspect-[4/5] rounded-3xl overflow-hidden shadow-sm hover:shadow-modern transition-all duration-500 group flex items-center justify-center relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-ep-cyan/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                            <i class="fas fa-vial text-6xl text-gray-300 group-hover:text-white group-hover:-translate-y-4 transition-all duration-500 relative z-20"></i>
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
                    Basée à Kénitra, Effe Plast se distingue par son savoir-faire unique dans la conception de flacons et bidons plastiques.
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
                    <!-- Icon placeholder for Bidons -->
                    <i class="fas fa-jug-detergent text-8xl text-gray-300 group-hover:text-ep-cyan transition-colors duration-500 relative z-10 group-hover:scale-110"></i>
                </div>
                <div class="p-8 text-center relative z-20 bg-white">
                    <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Bidons</h3>
                    <p class="text-gray-500 mb-6 font-medium">Capacités de 1L à 20L</p>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-ep-blue-night group-hover:bg-ep-cyan group-hover:text-white transition-all duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>

            <!-- Category 2 -->
            <a href="/bouteilles" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-modern transition-all duration-500 hover:-translate-y-2">
                <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center p-12 relative overflow-hidden">
                    <div class="absolute w-64 h-64 bg-ep-primary rounded-full filter blur-3xl opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <!-- Icon placeholder for Bouteilles -->
                    <i class="fas fa-bottle-water text-8xl text-gray-300 group-hover:text-ep-primary transition-colors duration-500 relative z-10 group-hover:scale-110"></i>
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
                    <!-- Icon placeholder for Bouchons -->
                    <i class="fas fa-ring text-8xl text-gray-300 group-hover:text-ep-blue-night transition-colors duration-500 relative z-10 group-hover:scale-110"></i>
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
<section class="py-16 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-24">
            <div class="md:w-1/3 text-center md:text-left">
                <h3 class="text-2xl font-bold text-ep-blue-night mb-2">Partenaires de notre succès</h3>
                <p class="text-gray-500 font-medium">Ensemble, créons l'excellence</p>
            </div>
            <div class="md:w-2/3 grid grid-cols-2 md:grid-cols-3 gap-8 items-center justify-items-center opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <!-- Logos textuels (placeholder pour les vrais logos) -->
                <div class="text-2xl font-black text-gray-400 hover:text-gray-800 transition-colors">MERCURE</div>
                <div class="text-2xl font-black text-gray-400 hover:text-gray-800 transition-colors">SARAPROC</div>
                <div class="text-2xl font-black text-gray-400 hover:text-gray-800 transition-colors col-span-2 md:col-span-1">TOP-CHEF</div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>