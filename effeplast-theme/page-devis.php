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

                <!-- Formulaire de filtres avec soumission GET -->
                <form id="quote-filter-form" method="GET" action="<?php echo esc_url( home_url( '/devis' ) ); ?>" class="space-y-5 mb-6">
                    <!-- Keywords Search -->
                    <div class="flex flex-col gap-2">
                        <label for="s" class="text-sm font-bold text-gray-700 tracking-wide">Mots-clés</label>
                        <div class="flex gap-2">
                            <div class="relative flex-grow">
                                <input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="Ex: 1L Javel..." class="w-full px-4 py-3 bg-white border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-lg text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm">
                            </div>
                            <button type="submit" class="w-12 h-auto flex-shrink-0 bg-ep-blue-night hover:bg-ep-primary text-white rounded-lg transition-colors flex items-center justify-center shadow-md">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="<?php echo esc_url( home_url( '/devis' ) ); ?>" class="w-12 h-auto flex-shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg transition-colors flex items-center justify-center shadow-sm" title="Réinitialiser">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Categories Filter -->
                    <div class="flex flex-col gap-2">
                        <label for="cat" class="text-sm font-bold text-gray-700 tracking-wide">Catégories</label>
                        <div class="relative">
                            <select name="cat" id="cat" onchange="document.getElementById('quote-filter-form').submit();" class="w-full px-4 py-3 bg-white border border-gray-200 hover:border-ep-cyan focus:border-ep-cyan rounded-lg text-gray-700 font-medium appearance-none focus:outline-none focus:ring-1 focus:ring-ep-cyan transition-all shadow-sm cursor-pointer">
                                <option value="">Toutes les Catégories</option>
                                <?php
                                $categories = get_terms( array(
                                    'taxonomy'   => 'ep_product_cat',
                                    'hide_empty' => true,
                                ) );
                                $selected_cat = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';

                                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                    foreach ( $categories as $category ) {
                                        $selected = ($selected_cat === $category->slug) ? 'selected' : '';
                                        echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fas fa-caret-down text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Action Buttons & Pagination Top -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4 pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <button id="ep-select-all" class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors flex items-center gap-3">
                            <div class="w-4 h-4 bg-white/20 border border-white/50 rounded-sm flex items-center justify-center"><i class="fas fa-check text-[10px] text-white opacity-0" id="ep-select-all-icon"></i></div>
                            TOUT SÉLECTIONNER
                        </button>
                    </div>
                    <div>
                        <button id="ep-add-selected" class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors shadow-cyan-500/30">
                            Ajouter la sélection au devis
                        </button>
                    </div>
                </div>

                <?php
                // Configuration de la requête pour les produits
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                    'post_type'      => 'ep_produit',
                    'posts_per_page' => 20,
                    'paged'          => $paged,
                    'post_status'    => 'publish',
                );

                // Filtre par recherche
                if ( isset($_GET['s']) && !empty($_GET['s']) ) {
                    $args['s'] = sanitize_text_field($_GET['s']);
                }

                // Filtre par catégorie
                if ( isset($_GET['cat']) && !empty($_GET['cat']) ) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'ep_product_cat',
                            'field'    => 'slug',
                            'terms'    => sanitize_text_field($_GET['cat']),
                        ),
                    );
                }

                $products_query = new WP_Query( $args );
                $total_posts = $products_query->found_posts;

                // Calcul de l'affichage
                $start_item = ($paged - 1) * 20 + 1;
                $end_item = min($paged * 20, $total_posts);
                if($total_posts == 0) {
                    $start_item = 0;
                    $end_item = 0;
                }
                ?>

                <div class="flex justify-between items-center mb-3 px-2 text-sm font-bold text-ep-blue-night tracking-wide">
                    <span>Affichage <?php echo $start_item; ?> - <?php echo $end_item; ?> sur <?php echo $total_posts; ?></span>
                    <span>Page <?php echo $paged; ?> sur <?php echo max(1, $products_query->max_num_pages); ?></span>
                </div>

                <!-- The Modern Dark Table (matching the screenshot's color scheme & layout) -->
                <div class="rounded-xl overflow-hidden shadow-lg border border-gray-800 relative min-h-[400px]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse bg-[#222E42]">
                            <thead>
                                <tr class="bg-[#1C2638] text-white text-[13px] font-bold tracking-wider border-b border-white/10 uppercase">
                                    <th class="py-4 px-6 cursor-pointer group hover:bg-white/5 transition-colors">
                                        Miniatures <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6">Produits</th>
                                    <th class="py-4 px-6 text-center cursor-pointer group hover:bg-white/5 transition-colors">
                                        Quantité <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6 text-center">Demande de devis</th>
                                    <th class="py-4 px-6 text-center cursor-pointer group hover:bg-white/5 transition-colors">
                                        Action <i class="fas fa-sort text-gray-500 ml-1 group-hover:text-white"></i>
                                    </th>
                                    <th class="py-4 px-6 text-center w-16">
                                        <!-- Case à cocher globale invisible ou purement décorative comme sur la maquette -->
                                        <div class="w-4 h-4 bg-white/20 rounded-sm inline-block cursor-pointer"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-white" id="ep-products-tbody">

                                <?php if ( $products_query->have_posts() ) : ?>
                                    <?php while ( $products_query->have_posts() ) : $products_query->the_post();
                                        $image_src = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                    ?>
                                    <tr class="hover:bg-white/5 transition-colors group product-row">
                                        <td class="py-4 px-6">
                                            <div class="w-16 h-16 rounded bg-white p-1 flex items-center justify-center shadow-inner overflow-hidden">
                                                <?php if($image_src): ?>
                                                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>" class="max-w-full max-h-full object-contain">
                                                <?php else: ?>
                                                    <i class="fas fa-bottle-water text-3xl text-gray-300"></i>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-[15px] tracking-wide"><a href="<?php the_permalink(); ?>" class="hover:text-ep-cyan transition-colors"><?php the_title(); ?></a></div>
                                            <div class="ep-cart-status text-[11px] text-ep-cyan mt-1 hidden"><i class="fas fa-check-circle"></i> Dans la liste</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex justify-center">
                                                <input type="number" value="1" min="1" class="ep-qty-input w-16 h-10 bg-black/40 text-white text-center font-bold border border-white/10 rounded focus:outline-none focus:border-ep-cyan appearance-none shadow-inner">
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <!-- The script quote-system.js handles the state mapping via data attributes -->
                                            <button class="ep-add-to-quote-btn px-5 py-2.5 bg-[#1762A4] hover:bg-ep-cyan text-white text-sm font-bold rounded shadow-md transition-colors"
                                                    data-product-id="<?php the_ID(); ?>"
                                                    data-product-name="<?php echo esc_attr(get_the_title()); ?>"
                                                    data-product-image="<?php echo esc_url($image_src); ?>">
                                                Ajouter au devis
                                            </button>
                                        </td>
                                        <td class="py-4 px-6 text-center ep-view-list-container">
                                            <!-- Dynamically filled via JS if added -->
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <div class="relative flex items-center justify-center">
                                                <input type="checkbox" class="peer sr-only product-checkbox" value="<?php the_ID(); ?>">
                                                <div class="w-4 h-4 border border-white/20 rounded-sm bg-white cursor-pointer hover:border-ep-cyan peer-checked:bg-ep-cyan peer-checked:border-ep-cyan transition-colors flex items-center justify-center checkbox-ui">
                                                    <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-gray-400">
                                            <i class="fas fa-box-open text-4xl mb-3 opacity-50"></i>
                                            <p class="font-medium">Aucun produit ne correspond à vos critères de recherche.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php wp_reset_postdata(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bottom Pagination -->
                <?php if ( $products_query->max_num_pages > 1 ) : ?>
                <div class="flex justify-center mt-8">
                    <?php
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $products_query->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="fas fa-chevron-left mr-2"></i> Précédent', 'effeplast' ) ),
                        'next_text'    => sprintf( '%1$s <i></i>', __( 'Suivant <i class="fas fa-chevron-right ml-2"></i>', 'effeplast' ) ),
                        'add_args'     => false,
                        'add_fragment' => '',
                    ) );
                    ?>
                </div>
                <style>
                    /* Style the WordPress pagination to match the theme */
                    .page-numbers { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; margin: 0 4px; border-radius: 8px; background: white; border: 1px solid #e5e7eb; color: #4b5563; font-weight: bold; transition: all 0.2s; }
                    .page-numbers.current { background: #00B4D8; color: white; border-color: #00B4D8; box-shadow: 0 4px 6px -1px rgba(0, 180, 216, 0.3); }
                    .page-numbers:hover:not(.current) { border-color: #00B4D8; color: #00B4D8; }
                    .page-numbers.prev, .page-numbers.next { width: auto; padding: 0 16px; }
                </style>
                <?php endif; ?>

                <div class="flex justify-end mt-6">
                    <button id="ep-add-selected-bottom" class="px-6 py-2.5 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-md shadow-sm transition-colors shadow-cyan-500/30">
                        Ajouter la sélection au devis
                    </button>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Logic for "Select All"
                    const selectAllBtn = document.getElementById('ep-select-all');
                    const selectAllIcon = document.getElementById('ep-select-all-icon');
                    const checkboxes = document.querySelectorAll('.product-checkbox');
                    let allSelected = false;

                    // Manual checkbox click handler to sync UI
                    document.querySelectorAll('.checkbox-ui').forEach(ui => {
                        ui.addEventListener('click', function(e) {
                            // Let the default label behavior handle the input check, or toggle it manually
                            const input = this.previousElementSibling;
                            input.checked = !input.checked;
                        });
                    });

                    selectAllBtn.addEventListener('click', function() {
                        allSelected = !allSelected;
                        checkboxes.forEach(cb => cb.checked = allSelected);

                        if(allSelected) {
                            selectAllIcon.classList.remove('opacity-0');
                            selectAllIcon.classList.add('opacity-100');
                            selectAllBtn.classList.add('bg-ep-primary');
                        } else {
                            selectAllIcon.classList.remove('opacity-100');
                            selectAllIcon.classList.add('opacity-0');
                            selectAllBtn.classList.remove('bg-ep-primary');
                        }
                    });

                    // Logic for "Add Selected"
                    function addSelectedItems() {
                        let selectedCount = 0;
                        document.querySelectorAll('.product-row').forEach(row => {
                            const checkbox = row.querySelector('.product-checkbox');
                            if(checkbox && checkbox.checked) {
                                const addBtn = row.querySelector('.ep-add-to-quote-btn');
                                if(addBtn && !addBtn.hasAttribute('disabled')) {
                                    addBtn.click(); // Trigger the logic from quote-system.js
                                    selectedCount++;
                                }
                                checkbox.checked = false; // Uncheck after adding
                            }
                        });

                        // Reset Select All UI
                        allSelected = false;
                        selectAllIcon.classList.remove('opacity-100');
                        selectAllIcon.classList.add('opacity-0');
                        selectAllBtn.classList.remove('bg-ep-primary');

                        if(selectedCount > 0) {
                            // Optional: Global notification override if quote-system triggers too many
                        } else {
                            alert("Veuillez sélectionner au moins un produit non encore ajouté.");
                        }
                    }

                    document.getElementById('ep-add-selected').addEventListener('click', addSelectedItems);
                    document.getElementById('ep-add-selected-bottom').addEventListener('click', addSelectedItems);
                });
                </script>

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