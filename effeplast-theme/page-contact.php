<?php
/**
 * Template Name: Page Contact
 *
 * The template for displaying the "Contact Us" page.
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <!-- Page Header -->
    <div class="bg-ep-blue-night pt-32 pb-40 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-ep-cyan rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-ep-primary rounded-full mix-blend-overlay filter blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-ep-cyan/20 text-ep-cyan text-sm font-bold tracking-wider uppercase mb-4 border border-ep-cyan/30">
                Support & Ventes
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">Contactez <span class="text-transparent bg-clip-text bg-gradient-to-r from-ep-cyan to-ep-primary">Nous</span></h1>
            <p class="text-blue-100 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Notre équipe d'experts en plasturgie est à votre disposition pour répondre à toutes vos questions et vous accompagner dans vos projets.
            </p>
        </div>

        <!-- Curve divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
            <svg class="relative block w-full h-24 text-ep-gray-light" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,120.7,192.27,110.16,236.4,102.63,279.7,79.5,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-4 lg:px-8 -mt-24 relative z-30">

        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            <!-- Contact Info Cards -->
            <div class="bg-white rounded-3xl p-8 shadow-modern hover:shadow-modern-hover transition-all duration-500 hover:-translate-y-2 group border border-gray-50 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center text-ep-cyan mb-6 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500 shadow-inner">
                    <i class="fas fa-map-marker-alt text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-ep-blue-night mb-2">Notre Usine</h3>
                <p class="text-gray-500 font-medium mb-4">Kénitra, Maroc</p>
                <a href="#map" class="text-ep-cyan font-semibold hover:text-ep-primary transition-colors text-sm uppercase tracking-widest mt-auto">Voir sur la carte <i class="fas fa-arrow-down ml-1"></i></a>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-modern hover:shadow-modern-hover transition-all duration-500 hover:-translate-y-2 group border border-gray-50 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center text-ep-cyan mb-6 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500 shadow-inner">
                    <i class="fas fa-phone-alt text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-ep-blue-night mb-2">Téléphone</h3>
                <p class="text-gray-500 font-medium mb-4">Du lundi au vendredi, 8h - 18h</p>
                <a href="tel:0537360820" class="text-ep-cyan font-bold hover:text-ep-primary transition-colors text-xl mt-auto tracking-wide">05 37 36 08 20</a>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-modern hover:shadow-modern-hover transition-all duration-500 hover:-translate-y-2 group border border-gray-50 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center text-ep-cyan mb-6 group-hover:bg-ep-cyan group-hover:text-white transition-colors duration-500 shadow-inner">
                    <i class="fas fa-envelope text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-ep-blue-night mb-2">Email</h3>
                <p class="text-gray-500 font-medium mb-4">Nous répondons sous 24h</p>
                <a href="mailto:effeplast.kenitra@gmail.com" class="text-ep-cyan font-bold hover:text-ep-primary transition-colors mt-auto break-all">effeplast.kenitra@gmail.com</a>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden relative">
            <div class="grid lg:grid-cols-2">
                <!-- Contact Form Side -->
                <div class="p-8 md:p-16">
                    <h2 class="text-3xl font-black text-ep-blue-night mb-2">Envoyez-nous un message</h2>
                    <p class="text-gray-500 mb-8 font-light">Remplissez le formulaire ci-dessous et notre équipe vous recontactera rapidement.</p>

                    <?php
                    // Check if content has shortcode for CF7, WPForms etc.
                    $content = get_the_content();
                    if( !empty($content) ) :
                        echo '<div class="prose max-w-none">';
                        the_content();
                        echo '</div>';
                    else :
                    ?>
                    <!-- Fallback Modern Form UI -->
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="nom" class="text-sm font-bold text-gray-700 tracking-wide">Nom complet</label>
                                <input type="text" id="nom" name="nom" placeholder="Votre nom" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-xl text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-gray-700 tracking-wide">Adresse email</label>
                                <input type="email" id="email" name="email" placeholder="votre@email.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-xl text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="sujet" class="text-sm font-bold text-gray-700 tracking-wide">Sujet</label>
                            <input type="text" id="sujet" name="sujet" placeholder="Sujet de votre demande" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-xl text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm">
                        </div>

                        <div class="space-y-2">
                            <label for="message" class="text-sm font-bold text-gray-700 tracking-wide">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Comment pouvons-nous vous aider ?" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-xl text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full px-8 py-4 bg-ep-blue-night hover:bg-ep-primary text-white font-bold rounded-xl shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 flex justify-center items-center gap-2 group">
                            <span>Envoyer le message</span>
                            <i class="fas fa-paper-plane text-sm group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>

                <!-- Map Side -->
                <div id="map" class="relative h-96 lg:h-auto bg-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3298.3932353803643!2d-6.6079786999999985!3d34.2385082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda75b512c9de161%3A0xcb686796dea2ae10!2sEFFE%20plast%20s.a.r.l!5e0!3m2!1sfr!2sma!4v1741792875269!5m2!1sfr!2sma"
                        class="absolute inset-0 w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700 ease-in-out mix-blend-multiply"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <!-- Floating Badge -->
                    <div class="absolute bottom-8 right-8 bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-modern border border-gray-100 max-w-xs pointer-events-none">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-ep-cyan rounded-full flex items-center justify-center text-white flex-shrink-0 mt-1 shadow-sm"><i class="fas fa-building"></i></div>
                            <div>
                                <h4 class="font-bold text-ep-blue-night text-lg mb-1">Effe Plast S.A.R.L</h4>
                                <p class="text-sm text-gray-500 leading-relaxed font-medium">Zone Industrielle,<br>Kénitra, Maroc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>