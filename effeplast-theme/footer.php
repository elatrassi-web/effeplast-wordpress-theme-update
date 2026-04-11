    </main><!-- #primary -->

    <!-- Call to Action Before Footer -->
    <div class="bg-gradient-to-r from-ep-blue-night to-ep-primary py-16 relative overflow-hidden text-center text-white">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-ep-cyan rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold mb-6 tracking-tight">Prêt à emballer votre succès ?</h2>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-10 leading-relaxed font-light">
                Demandez un devis personnalisé pour vos besoins en bidons, flacons et bouchons plastiques.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/devis" class="px-8 py-4 bg-white text-ep-blue-night font-bold rounded-full shadow-xl hover:shadow-cyan-500/50 hover:bg-ep-gray-light hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-file-signature text-ep-cyan"></i>
                    Demander un Devis
                </a>
                <a href="/contact" class="px-8 py-4 bg-transparent border-2 border-white/50 hover:border-white text-white font-semibold rounded-full hover:bg-white/10 transition-all duration-300">
                    Contactez-nous
                </a>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer id="colophon" class="site-footer bg-gray-900 text-gray-300 pt-20 pb-10 border-t border-gray-800">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

                <!-- Brand Info -->
                <div class="col-span-1 md:col-span-2 lg:col-span-1 space-y-6">
                    <div class="mb-4">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="inline-block">
                            <!-- Use an inverted version if the logo is dark text on dark background, otherwise filter brightness or keep it as is. Assuming standard logo works on dark mode or has white version -->
                            <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/cropped-Capture_d_ecran_2025-02-17_103238-removebg-preview.webp' ) ); ?>" alt="Effe Plast Logo" class="h-12 w-auto object-contain brightness-0 invert opacity-90 hover:opacity-100 transition-opacity">
                        </a>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed font-light">
                        Expert en plasturgie depuis 1998, créant des flacons et bidons innovants qui répondent parfaitement aux besoins de chaque industrie, avec un savoir-faire inégalé au Maroc.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-ep-cyan hover:text-white transition-all duration-300 shadow-lg hover:shadow-cyan-500/30">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-ep-cyan hover:text-white transition-all duration-300 shadow-lg hover:shadow-cyan-500/30">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-ep-cyan hover:text-white transition-all duration-300 shadow-lg hover:shadow-cyan-500/30">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-white uppercase tracking-wider relative inline-block">
                        À Propos
                        <span class="absolute -bottom-2 left-0 w-1/2 h-0.5 bg-ep-cyan rounded-full"></span>
                    </h4>
                    <ul class="space-y-3 text-sm font-medium">
                        <li><a href="/" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Accueil</a></li>
                        <li><a href="/a-propos" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> À Propos de nous</a></li>
                        <li><a href="/contact" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Contact</a></li>
                        <li><a href="/devis" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Demander un Devis</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-white uppercase tracking-wider relative inline-block">
                        Nos Produits
                        <span class="absolute -bottom-2 left-0 w-1/2 h-0.5 bg-ep-cyan rounded-full"></span>
                    </h4>
                    <ul class="space-y-3 text-sm font-medium">
                        <li><a href="/bidons" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Bidons</a></li>
                        <li><a href="/bouteilles" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Bouteilles</a></li>
                        <li><a href="/les-bouchons" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Bouchons</a></li>
                        <li><a href="/produits" class="hover:text-ep-cyan transition-colors duration-200 flex items-center gap-2"><i class="fas fa-angle-right text-xs text-ep-cyan"></i> Tous les produits</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-6">
                    <h4 class="text-lg font-bold text-white uppercase tracking-wider relative inline-block">
                        Contact
                        <span class="absolute -bottom-2 left-0 w-1/2 h-0.5 bg-ep-cyan rounded-full"></span>
                    </h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li class="flex items-start gap-3 group">
                            <span class="w-8 h-8 rounded-lg bg-gray-800 flex-shrink-0 flex items-center justify-center text-ep-cyan group-hover:bg-ep-cyan group-hover:text-white transition-all duration-300">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <span class="mt-1 leading-relaxed">Av. Bahnini - Res .Taissir -A2-4-6<br>USINE : Lot. N 7 -Q.I . BirRami KENITRA</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <span class="w-8 h-8 rounded-lg bg-gray-800 flex-shrink-0 flex items-center justify-center text-ep-cyan group-hover:bg-ep-cyan group-hover:text-white transition-all duration-300">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            <a href="tel:0537360820" class="hover:text-ep-cyan transition-colors duration-200">05 37 36 08 20</a>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <span class="w-8 h-8 rounded-lg bg-gray-800 flex-shrink-0 flex items-center justify-center text-ep-cyan group-hover:bg-ep-cyan group-hover:text-white transition-all duration-300">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <a href="mailto:effeplast.kenitra@gmail.com" class="hover:text-ep-cyan transition-colors duration-200 truncate">effeplast.kenitra@gmail.com</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Footer -->
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-sm font-medium">
                <p class="text-gray-500">
                    &copy; <?php echo date('Y'); ?> <span class="text-white">Effeplast</span>, All Rights Reserved.
                </p>
                <div class="flex items-center gap-2 text-gray-500">
                    Developed by <a href="https://wesign.pro/" target="_blank" rel="noopener" class="text-white hover:text-ep-cyan transition-colors duration-200 font-bold tracking-wide">Wesign Agency</a>.
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/212537360820" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 left-6 z-[60] w-14 h-14 bg-[#25D366] text-white rounded-full flex items-center justify-center text-3xl shadow-lg shadow-green-500/30 hover:scale-110 hover:-translate-y-1 transition-all duration-300 group ep-hide-print animate-bounce" style="animation-duration: 3s;">
    <i class="fab fa-whatsapp"></i>
    <!-- Tooltip -->
    <span class="absolute left-full ml-4 top-1/2 -translate-y-1/2 px-3 py-1.5 bg-gray-900 text-white text-xs font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap shadow-md">
        Contactez-nous !
        <span class="absolute top-1/2 -left-1 -translate-y-1/2 w-2 h-2 bg-gray-900 rotate-45"></span>
    </span>
</a>

<?php wp_footer(); ?>
</body>
</html>
