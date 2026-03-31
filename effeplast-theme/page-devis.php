<?php
/**
 * Template Name: Page Devis
 *
 * The template for displaying the custom Quote (Devis) page matching the specific client layout
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <!-- Page Header -->
    <div class="bg-ep-blue-night pt-24 pb-20 relative overflow-hidden">
        <!-- Abstract BG -->
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMGw0MCA0ME00MCAwbC00MCA0MCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjAuNSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIvPgo8L3N2Zz4=')]"></div>
            <div class="absolute top-1/2 right-1/4 w-96 h-96 bg-ep-cyan rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 tracking-tight">DEMANDE DE DEVIS</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">
                Sélectionnez vos produits et soumettez votre demande pour une offre personnalisée.
            </p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-4 lg:px-8 -mt-10 relative z-30">

        <div class="bg-white rounded-[2rem] shadow-modern border border-gray-100 p-6 md:p-10">

            <?php
            if ( have_posts() && get_the_content() !== '' ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            else :
            ?>

            <!-- Modern Quote Interface matched to the client's wireframe -->
            <div class="quote-interface max-w-6xl mx-auto">

                <!-- Search & Filters Container -->
                <div class="space-y-5 mb-6">
                    <!-- Keywords Search -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-700 tracking-wide">Mots-clés</label>
                        <div class="flex gap-2">
                            <div class="relative flex-grow">
                                <input type="text" placeholder="Mots-clés..." class="w-full px-4 py-3 bg-white border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-lg text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm">
                            </div>
                            <button class="w-12 h-auto flex-shrink-0 bg-ep-blue-night hover:bg-ep-primary text-white rounded-lg transition-colors flex items-center justify-center shadow-md">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Categories Filter -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-bold text-gray-700 tracking-wide">Catégories</label>
                        <div class="relative">
                            <select class="w-full px-4 py-3 bg-white border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-lg text-gray-700 font-medium appearance-none focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm cursor-pointer">
                                <option>Toutes les Catégories</option>
                                <option>Bidons</option>
                                <option>Bouteilles</option>
                                <option>Bouchons</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-caret-down text-gray-500"></i>
                            </div>
                        </div>
                        <!-- Empty second select from original wireframe, stylized -->
                        <div class="relative mt-2">
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-lg text-gray-500 font-medium appearance-none focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm cursor-pointer" disabled>
                                <option>Sélectionnez une sous-catégorie...</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-caret-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons & Pagination Top -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4 pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <button class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors flex items-center gap-3">
                            <div class="w-4 h-4 bg-white/20 border border-white/50 rounded-sm flex items-center justify-center"><i class="fas fa-check text-[10px] text-white opacity-0"></i></div>
                            SELECT ALL
                        </button>
                    </div>
                    <div>
                        <button class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors shadow-cyan-500/30">
                            Add To Cart (Selected)
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-3 px-2 text-sm font-bold text-ep-blue-night tracking-wide">
                    <span>Showing 1 - 20 Out Of 24</span>
                    <span>Page 1 Out Of 2</span>
                </div>

                <!-- The Modern Dark Table (matching the screenshot's color scheme & layout) -->
                <div class="rounded-xl overflow-hidden shadow-lg border border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse bg-[#222E42]">
                            <thead>
                                <tr class="bg-[#1C2638] text-white text-[13px] font-bold tracking-wider border-b border-white/10">
                                    <th class="py-4 px-6 cursor-pointer group hover:bg-white/5 transition-colors">
                                        Thumbnails <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6">Products</th>
                                    <th class="py-4 px-6 text-center cursor-pointer group hover:bg-white/5 transition-colors">
                                        Quantity <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6 text-center">Quote Request</th>
                                    <th class="py-4 px-6 text-center cursor-pointer group hover:bg-white/5 transition-colors">
                                        Action <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6 text-center w-16">
                                        <div class="w-4 h-4 bg-white rounded-sm inline-block cursor-pointer"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-white">

                                <!-- Product Row 1 -->
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-4 px-6">
                                        <div class="w-16 h-16 rounded bg-white p-1 flex items-center justify-center shadow-inner">
                                            <!-- Icon placeholder instead of missing image -->
                                            <i class="fas fa-bottle-water text-3xl text-gray-300"></i>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-[15px] tracking-wide">1L JAVEL BF</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input type="number" value="1" min="1" class="w-16 h-10 bg-black/40 text-white text-center font-bold border border-white/10 rounded focus:outline-none focus:border-ep-cyan appearance-none shadow-inner">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <button class="px-5 py-2.5 bg-[#1762A4] hover:bg-ep-cyan text-white text-sm font-bold rounded shadow-md transition-colors">
                                            Ajouter au devis
                                        </button>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <!-- Action space -->
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border border-white/20 rounded-sm bg-white cursor-pointer hover:border-ep-cyan peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-colors flex items-center justify-center">
                                                <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Product Row 2 -->
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-4 px-6">
                                        <div class="w-16 h-16 rounded bg-white p-1 flex items-center justify-center shadow-inner">
                                            <i class="fas fa-jug-detergent text-3xl text-gray-300"></i>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-[15px] tracking-wide">1L ROND POIGNE</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input type="number" value="1" min="1" class="w-16 h-10 bg-black/40 text-white text-center font-bold border border-white/10 rounded focus:outline-none focus:border-ep-cyan appearance-none shadow-inner">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <button class="px-5 py-2.5 bg-[#1762A4] hover:bg-ep-cyan text-white text-sm font-bold rounded shadow-md transition-colors">
                                            Ajouter au devis
                                        </button>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border border-white/20 rounded-sm bg-white cursor-pointer hover:border-ep-cyan peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-colors flex items-center justify-center">
                                                <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Product Row 3 -->
                                <tr class="hover:bg-white/5 transition-colors group bg-white/5">
                                    <td class="py-4 px-6">
                                        <div class="w-16 h-16 rounded bg-white p-1 flex items-center justify-center shadow-inner">
                                            <i class="fas fa-box text-3xl text-gray-300"></i>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-[15px] tracking-wide">5L CARRE POIGNE</div>
                                        <div class="text-[11px] text-ep-cyan mt-1"><i class="fas fa-check-circle"></i> Dans la liste</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center">
                                            <input type="number" value="1" min="1" class="w-16 h-10 bg-black/40 text-white text-center font-bold border border-white/10 rounded focus:outline-none focus:border-ep-cyan appearance-none shadow-inner">
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <button class="px-5 py-2.5 bg-gray-600 hover:bg-gray-500 text-white text-sm font-bold rounded shadow-md transition-colors cursor-not-allowed" disabled>
                                            Déjà ajouté
                                        </button>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <a href="#" class="text-sm text-gray-300 hover:text-white underline underline-offset-2">Voir la liste</a>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only" checked>
                                            <div class="w-4 h-4 border border-ep-cyan rounded-sm bg-ep-cyan cursor-pointer transition-colors flex items-center justify-center">
                                                <i class="fas fa-check text-[10px] text-white"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bottom Pagination (if needed) -->
                <div class="flex justify-end mt-6">
                    <button class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors shadow-cyan-500/30">
                        Add To Cart (Selected)
                    </button>
                </div>

            </div>
            <!-- End Modern Interface -->

            <?php endif; ?>

        </div>
    </div>
</div>

<style>
/* CSS to override standard WooCommerce / Quote plugin tables and input numbers */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
    -moz-appearance: textfield;
}
</style>

<?php get_footer(); ?>