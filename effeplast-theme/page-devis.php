<?php
/**
 * Template Name: Page Devis
 *
 * The template for displaying the custom Quote (Devis) page.
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <!-- Page Header -->
    <div class="bg-ep-blue-night pt-32 pb-24 relative overflow-hidden">
        <!-- Abstract BG -->
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgMGw0MCA0ME00MCAwbC00MCA0MCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjAuNSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIvPgo8L3N2Zz4=')]"></div>
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-ep-cyan rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-white/10 text-ep-cyan text-sm font-semibold tracking-wider uppercase mb-4 backdrop-blur-sm border border-white/10">
                <i class="fas fa-file-invoice mr-2"></i> Espace Client
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">Demande de Devis</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light leading-relaxed">
                Sélectionnez les produits qui vous intéressent, ajustez les quantités et soumettez votre demande. Notre équipe commerciale vous répondra dans les plus brefs délais.
            </p>
        </div>

        <!-- Curve divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
            <svg class="relative block w-full h-12 text-ep-gray-light" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.83,120.7,192.27,110.16,236.4,102.63,279.7,79.5,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-4 lg:px-8 -mt-8 relative z-30">

        <!-- Content that will be replaced by the shortcode/plugin, stylized as a placeholder/demonstration -->
        <!-- Note: In a real WordPress integration with a plugin (like YITH Quote), the [shortcode] would go here.
             We provide the hardcoded HTML version that mimics the design requested by the user so they see the 2030 design -->

        <div class="bg-white rounded-[2rem] shadow-modern border border-gray-100 p-6 md:p-10">

            <?php
            // If the user actually uses Elementor or Gutenberg, they can use the content block.
            // For now, if content is empty, show our modern template.
            if ( have_posts() && get_the_content() !== '' ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            else :
            ?>

            <!-- Modern Quote Table Interface (Vue.js / Alpine.js style structure) -->
            <div class="quote-interface">

                <!-- Search & Filters -->
                <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-filter text-ep-cyan"></i> Filtres de recherche
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-5 relative group">
                            <label class="sr-only">Mots-clés</label>
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400 group-focus-within:text-ep-cyan transition-colors"></i>
                            </div>
                            <input type="text" placeholder="Rechercher un produit (ex: 1L Javel)" class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-ep-cyan/50 focus:border-ep-cyan transition-all shadow-sm">
                        </div>
                        <div class="md:col-span-5 relative group">
                            <label class="sr-only">Catégories</label>
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <i class="fas fa-layer-group text-gray-400 group-focus-within:text-ep-cyan transition-colors"></i>
                            </div>
                            <select class="w-full pl-11 pr-10 py-3.5 bg-white border border-gray-200 rounded-xl text-gray-700 font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-ep-cyan/50 focus:border-ep-cyan transition-all shadow-sm cursor-pointer">
                                <option>Toutes les Catégories</option>
                                <option>Bidons</option>
                                <option>Bouteilles</option>
                                <option>Bouchons</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                        <div class="md:col-span-2 flex gap-2">
                            <button class="flex-1 bg-ep-blue-night hover:bg-ep-primary text-white font-semibold rounded-xl transition-colors shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                <span>Filtrer</span>
                            </button>
                            <button class="w-14 bg-white border border-gray-200 text-gray-500 hover:text-ep-cyan hover:border-ep-cyan rounded-xl transition-colors flex items-center justify-center shadow-sm" title="Réinitialiser">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table Controls -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <label class="flex items-center gap-3 cursor-pointer group bg-blue-50/50 border border-blue-100 px-4 py-2.5 rounded-lg hover:bg-blue-50 transition-colors">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" class="peer sr-only">
                                <div class="w-5 h-5 border-2 border-gray-300 rounded bg-white peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-all flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-ep-blue-night uppercase tracking-wider select-none">Tout Sélectionner</span>
                        </label>
                        <span class="text-sm text-gray-500 font-medium bg-gray-50 px-3 py-1.5 rounded-md border border-gray-100">Affichage 1 - 20 sur 24</span>
                    </div>

                    <button class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-ep-cyan to-ep-primary text-white font-bold rounded-lg shadow-md shadow-cyan-500/20 hover:shadow-cyan-500/40 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-cart-plus"></i> Ajouter la sélection
                    </button>
                </div>

                <!-- The Modern Table -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                    <th class="p-4 w-12 text-center">
                                        <!-- Header Checkbox -->
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded bg-white peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-all flex items-center justify-center cursor-pointer">
                                                <i class="fas fa-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="p-4 w-24">Image</th>
                                    <th class="p-4">Produit <i class="fas fa-sort text-gray-300 ml-1 cursor-pointer hover:text-ep-cyan"></i></th>
                                    <th class="p-4 w-32 text-center">Quantité <i class="fas fa-sort text-gray-300 ml-1 cursor-pointer hover:text-ep-cyan"></i></th>
                                    <th class="p-4 w-48 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">

                                <!-- Product Row 1 -->
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="p-4 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded bg-white peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-all flex items-center justify-center cursor-pointer shadow-sm">
                                                <i class="fas fa-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="w-16 h-16 rounded-xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center group-hover:border-ep-cyan/30 group-hover:shadow-sm transition-all">
                                            <!-- Icon placeholder -->
                                            <i class="fas fa-jug-detergent text-3xl text-gray-400 group-hover:text-ep-cyan transition-colors"></i>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-800 text-lg mb-1 group-hover:text-ep-blue-night transition-colors">1L JAVEL BF</div>
                                        <div class="text-xs text-gray-500 font-medium bg-gray-100 inline-block px-2 py-0.5 rounded-full border border-gray-200">Catégorie: Bouteilles</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center">
                                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm group-hover:border-ep-cyan/50 transition-colors">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-minus text-xs"></i></button>
                                                <input type="number" value="1" min="1" class="w-12 h-10 text-center text-gray-800 font-bold border-x border-gray-100 focus:outline-none appearance-none m-0 p-0">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-plus text-xs"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button class="w-full px-4 py-2.5 bg-white border-2 border-ep-cyan text-ep-cyan font-bold rounded-lg hover:bg-ep-cyan hover:text-white transition-all shadow-sm flex items-center justify-center gap-2 group-hover:shadow-cyan-500/20">
                                            <i class="fas fa-plus"></i> Au devis
                                        </button>
                                    </td>
                                </tr>

                                <!-- Product Row 2 -->
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="p-4 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded bg-white peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-all flex items-center justify-center cursor-pointer shadow-sm">
                                                <i class="fas fa-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="w-16 h-16 rounded-xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center group-hover:border-ep-cyan/30 group-hover:shadow-sm transition-all">
                                            <i class="fas fa-jug-detergent text-3xl text-gray-400 group-hover:text-ep-cyan transition-colors"></i>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-800 text-lg mb-1 group-hover:text-ep-blue-night transition-colors">1L ROND POIGNE</div>
                                        <div class="text-xs text-gray-500 font-medium bg-gray-100 inline-block px-2 py-0.5 rounded-full border border-gray-200">Catégorie: Bouteilles</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center">
                                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm group-hover:border-ep-cyan/50 transition-colors">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-minus text-xs"></i></button>
                                                <input type="number" value="1" min="1" class="w-12 h-10 text-center text-gray-800 font-bold border-x border-gray-100 focus:outline-none appearance-none m-0 p-0">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-plus text-xs"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button class="w-full px-4 py-2.5 bg-white border-2 border-ep-cyan text-ep-cyan font-bold rounded-lg hover:bg-ep-cyan hover:text-white transition-all shadow-sm flex items-center justify-center gap-2 group-hover:shadow-cyan-500/20">
                                            <i class="fas fa-plus"></i> Au devis
                                        </button>
                                    </td>
                                </tr>

                                <!-- Product Row 3 -->
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="p-4 text-center">
                                        <div class="relative flex items-center justify-center">
                                            <input type="checkbox" class="peer sr-only">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded bg-white peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-all flex items-center justify-center cursor-pointer shadow-sm">
                                                <i class="fas fa-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="w-16 h-16 rounded-xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center group-hover:border-ep-cyan/30 group-hover:shadow-sm transition-all">
                                            <i class="fas fa-bottle-water text-3xl text-gray-400 group-hover:text-ep-cyan transition-colors"></i>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-800 text-lg mb-1 group-hover:text-ep-blue-night transition-colors">5L CARRE POIGNE</div>
                                        <div class="text-xs text-gray-500 font-medium bg-gray-100 inline-block px-2 py-0.5 rounded-full border border-gray-200">Catégorie: Bidons</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center">
                                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm group-hover:border-ep-cyan/50 transition-colors">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-minus text-xs"></i></button>
                                                <input type="number" value="1" min="1" class="w-12 h-10 text-center text-gray-800 font-bold border-x border-gray-100 focus:outline-none appearance-none m-0 p-0">
                                                <button class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 transition-colors focus:outline-none"><i class="fas fa-plus text-xs"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <!-- Active state example -->
                                        <div class="flex flex-col gap-2 items-center justify-center w-full">
                                            <span class="text-xs font-bold text-green-500 flex items-center gap-1 bg-green-50 px-2 py-1 rounded-md">
                                                <i class="fas fa-check-circle"></i> Dans la liste
                                            </span>
                                            <a href="#" class="text-sm font-semibold text-gray-500 hover:text-ep-cyan transition-colors underline decoration-gray-300 underline-offset-4">Voir la liste</a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-8">
                    <div class="text-sm font-medium text-gray-500 hidden sm:block">
                        Page <span class="text-ep-blue-night font-bold">1</span> sur 2
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto justify-center">
                        <button class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-400 flex items-center justify-center cursor-not-allowed shadow-sm">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="w-10 h-10 rounded-xl bg-ep-cyan text-white font-bold shadow-md shadow-cyan-500/30 flex items-center justify-center transition-transform hover:-translate-y-0.5">1</button>
                        <button class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-ep-cyan hover:border-ep-cyan font-bold shadow-sm flex items-center justify-center transition-all hover:-translate-y-0.5">2</button>
                        <button class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-ep-cyan hover:border-ep-cyan shadow-sm flex items-center justify-center transition-all hover:-translate-y-0.5">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

            </div>
            <!-- End Modern Interface -->

            <?php endif; ?>

        </div>
    </div>
</div>

<style>
/* CSS to override standard WooCommerce / Quote plugin tables inside .quote-interface if they inject shortcode html here */
/* In a real scenario with YITH or NP Quote, we would map these classes using JS or target their specific classes with Tailwind via @apply */
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