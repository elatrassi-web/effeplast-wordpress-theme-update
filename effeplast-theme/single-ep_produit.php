<?php
/**
 * The template for displaying all single posts of custom post type 'ep_produit'
 *
 * @package EffePlast
 */

get_header();

// Enqueue Medium Zoom for image click-to-zoom
wp_enqueue_script('medium-zoom', 'https://cdn.jsdelivr.net/npm/medium-zoom@1.1.0/dist/medium-zoom.min.js', array(), '1.1.0', true);

$post_id = get_the_ID();
$price = get_post_meta( $post_id, '_ep_product_price', true );
$colors_meta = get_post_meta( $post_id, '_ep_product_colors', true );
$secondary_image_id = get_post_meta( $post_id, '_ep_product_secondary_image_id', true );

// Process colors into an array
$colors = [];
if(!empty($colors_meta)) {
    $colors = array_map('trim', explode(',', $colors_meta));
}
?>

<div class="bg-ep-gray-light min-h-screen pt-32 pb-24">
    <div class="container mx-auto px-4 lg:px-8">

        <!-- Breadcrumbs -->
        <div class="mb-8 text-sm font-medium text-gray-500 flex items-center gap-2">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-ep-cyan transition-colors"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo esc_url( get_post_type_archive_link('ep_produit') ); ?>" class="hover:text-ep-cyan transition-colors">Produits</a>
            <?php
            $terms = get_the_terms( $post_id, 'ep_product_cat' );
            if($terms && !is_wp_error($terms)) {
                $term = $terms[0];
                echo '<i class="fas fa-chevron-right text-[10px]"></i>';
                echo '<a href="' . esc_url(get_term_link($term)) . '" class="hover:text-ep-cyan transition-colors">' . esc_html($term->name) . '</a>';
            }
            ?>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-ep-blue-night font-bold truncate max-w-xs"><?php the_title(); ?></span>
        </div>

        <!-- Main Product Card -->
        <div class="bg-white rounded-[2rem] shadow-modern border border-gray-100 overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-0">

                <!-- Left: Images -->
                <div class="bg-gray-50 p-8 md:p-16 flex flex-col items-center justify-center relative border-r border-gray-100 min-h-[50vh]">
                    <div class="absolute top-6 left-6 flex flex-col gap-2">
                        <span class="bg-white text-gray-400 font-bold text-xs uppercase tracking-widest px-3 py-1.5 rounded-md shadow-sm border border-gray-100">Ref: EP-<?php echo $post_id; ?></span>
                    </div>

                    <!-- Main Image with Zoom -->
                    <div class="w-full max-w-md mx-auto relative group">
                        <?php
                        $main_image_url = get_the_post_thumbnail_url($post_id, 'full');
                        if($main_image_url):
                        ?>
                            <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-auto object-contain mix-blend-multiply ep-zoom-img cursor-zoom-in transition-transform duration-500 group-hover:scale-105" data-zoom-src="<?php echo esc_url($main_image_url); ?>">
                            <div class="absolute bottom-0 right-0 bg-white/80 backdrop-blur rounded-full p-3 shadow-md pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-search-plus text-ep-cyan text-xl"></i>
                            </div>
                        <?php else: ?>
                            <div class="w-full aspect-square bg-gray-100 rounded-2xl flex items-center justify-center text-gray-300">
                                <i class="fas fa-box text-6xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Secondary Image Thumbnails -->
                    <?php if($secondary_image_id): $sec_image_url = wp_get_attachment_url($secondary_image_id); ?>
                    <div class="mt-12 flex gap-4 w-full justify-center">
                        <button class="w-20 h-20 bg-white rounded-xl border-2 border-ep-cyan shadow-md p-2 overflow-hidden hover:border-ep-cyan focus:outline-none ep-img-thumb" data-full="<?php echo esc_url($main_image_url); ?>">
                            <img src="<?php echo esc_url($main_image_url); ?>" class="w-full h-full object-contain mix-blend-multiply">
                        </button>
                        <button class="w-20 h-20 bg-white rounded-xl border-2 border-transparent shadow-sm p-2 overflow-hidden hover:border-gray-300 focus:outline-none ep-img-thumb" data-full="<?php echo esc_url($sec_image_url); ?>">
                            <img src="<?php echo esc_url($sec_image_url); ?>" class="w-full h-full object-contain mix-blend-multiply">
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Details & Add to Quote -->
                <div class="p-8 md:p-12 lg:p-16 flex flex-col">

                    <h1 class="text-3xl md:text-5xl font-black text-ep-blue-night mb-4 leading-tight">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Price -->
                    <div class="mb-8">
                        <?php if ( $price ) : ?>
                            <span class="text-3xl font-black text-gray-800 tracking-tight"><?php echo esc_html( $price ); ?> <span class="text-lg text-gray-400 font-medium">MAD</span></span>
                        <?php else : ?>
                            <span class="inline-block bg-gray-100 text-gray-600 font-bold px-4 py-2 rounded-lg uppercase tracking-wider text-sm">Sur Devis</span>
                        <?php endif; ?>
                    </div>

                    <!-- Content / Description -->
                    <div class="prose prose-gray max-w-none mb-10 text-gray-600 leading-relaxed font-light">
                        <?php the_content(); ?>
                    </div>

                    <div class="mt-auto space-y-8 bg-gray-50/50 p-6 md:p-8 rounded-3xl border border-gray-100">

                        <!-- Colors Selection -->
                        <?php if(!empty($colors)): ?>
                        <div class="space-y-3">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-palette text-ep-cyan"></i> Couleur
                            </label>
                            <div class="flex flex-wrap gap-3" id="ep-color-selector">
                                <?php foreach($colors as $index => $color): ?>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="ep_product_color" value="<?php echo esc_attr($color); ?>" class="peer sr-only" <?php echo $index === 0 ? 'checked' : ''; ?>>
                                        <div class="px-5 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-gray-600 font-bold text-sm transition-all peer-checked:border-ep-cyan peer-checked:text-ep-cyan peer-checked:shadow-md peer-checked:bg-blue-50/30 hover:border-gray-300 flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full border border-black/10 inline-block" style="background-color: <?php echo ep_get_hex_for_color_name($color); ?>"></span>
                                            <?php echo esc_html($color); ?>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            <!-- Quantity -->
                            <div class="sm:col-span-4 space-y-3">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
                                    <i class="fas fa-sort-numeric-up text-ep-cyan"></i> Quantité
                                </label>
                                <div class="flex items-center justify-between border-2 border-gray-200 rounded-xl overflow-hidden bg-white h-[52px] relative">
                                    <button type="button" id="ep-single-qty-minus" class="w-12 h-full flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 focus:outline-none transition-colors shrink-0 z-10 bg-white"><i class="fas fa-minus text-sm"></i></button>
                                    <div class="relative flex-grow h-full flex items-center justify-center border-x border-gray-200">
                                        <input type="number" id="ep-single-qty" min="1" value="1" class="w-10 h-full text-right text-gray-800 font-bold focus:outline-none appearance-none m-0 p-0 text-lg bg-transparent">
                                        <span class="text-gray-500 font-medium ml-1 mr-2 pointer-events-none select-none">colis</span>
                                    </div>
                                    <button type="button" id="ep-single-qty-plus" class="w-12 h-full flex items-center justify-center text-gray-500 hover:text-ep-cyan hover:bg-gray-50 focus:outline-none transition-colors shrink-0 z-10 bg-white"><i class="fas fa-plus text-sm"></i></button>
                                </div>
                            </div>

                            <!-- Add to Quote Button -->
                            <div class="sm:col-span-8 flex items-end">
                                <button id="ep-single-add-btn" class="ep-add-to-quote-btn w-full h-[52px] bg-ep-blue-night hover:bg-ep-cyan text-white font-bold rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center gap-3 text-lg group"
                                        data-product-id="<?php echo $post_id; ?>"
                                        data-product-name="<?php echo esc_attr(get_the_title()); ?>"
                                        data-product-image="<?php echo esc_url($main_image_url); ?>">
                                    <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                                    <span class="btn-text">Ajouter au devis</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * Helper function to map common color names to rough hex values for the visual dot indicator
 */
function ep_get_hex_for_color_name($color_name) {
    $colors = array(
        'blanc' => '#FFFFFF',
        'noir' => '#000000',
        'bleu' => '#2563EB',
        'rouge' => '#DC2626',
        'vert' => '#16A34A',
        'jaune' => '#EAB308',
        'transparent' => 'rgba(255,255,255,0.5)',
        'gris' => '#6B7280',
        'marron' => '#9CA3AF',
        'rose' => '#EC4899',
        'violet' => '#8B5CF6',
        'orange' => '#F97316'
    );
    $key = strtolower(trim($color_name));
    return isset($colors[$key]) ? $colors[$key] : '#E5E7EB'; // default gray
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // 1. Initialize Image Zoom
    if(typeof mediumZoom !== 'undefined') {
        mediumZoom('.ep-zoom-img', {
            margin: 24,
            background: 'rgba(255, 255, 255, 0.95)',
        });
    }

    // 2. Thumbnail gallery switching
    const mainImg = document.querySelector('.ep-zoom-img');
    const thumbs = document.querySelectorAll('.ep-img-thumb');

    if(mainImg && thumbs.length > 0) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Update active state
                thumbs.forEach(t => {
                    t.classList.remove('border-ep-cyan');
                    t.classList.add('border-transparent');
                });
                this.classList.remove('border-transparent');
                this.classList.add('border-ep-cyan');

                // Swap image
                const newSrc = this.getAttribute('data-full');
                mainImg.src = newSrc;
                // Update zoom source if using medium-zoom
                if(mainImg.dataset.zoomSrc) {
                    mainImg.dataset.zoomSrc = newSrc;
                }
            });
        });
    }

    // 3. Quantity Selector Logic
    const qtyInput = document.getElementById('ep-single-qty');
    const btnMinus = document.getElementById('ep-single-qty-minus');
    const btnPlus = document.getElementById('ep-single-qty-plus');
    const addBtn = document.getElementById('ep-single-add-btn');

    if(qtyInput && btnMinus && btnPlus) {
        btnMinus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value);
            if(val > 1) {
                qtyInput.value = val - 1;
                updateButtonData();
            }
        });

        btnPlus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value);
            qtyInput.value = val + 1;
            updateButtonData();
        });

        qtyInput.addEventListener('change', () => {
            if(parseInt(qtyInput.value) < 1 || isNaN(parseInt(qtyInput.value))) qtyInput.value = 1;
            updateButtonData();
        });
    }

    // 4. Color Selection Logic
    const colorInputs = document.querySelectorAll('input[name="ep_product_color"]');

    if(colorInputs.length > 0) {
        colorInputs.forEach(input => {
            input.addEventListener('change', updateButtonData);
        });
    }

    // Function to dynamically pass color & qty to the JS Quote System
    function updateButtonData() {
        if(!addBtn) return;

        // Qty
        if(qtyInput) {
            addBtn.setAttribute('data-qty', qtyInput.value);
        }

        // Color
        const selectedColor = document.querySelector('input[name="ep_product_color"]:checked');
        if(selectedColor) {
            addBtn.setAttribute('data-color', selectedColor.value);
        } else if (colorInputs.length > 0) {
            // Fallback if colors exist but none selected (shouldn't happen with default checked)
            addBtn.removeAttribute('data-color');
        }
    }

    // Initial sync
    updateButtonData();
});
</script>

<style>
/* Remove arrows from number input */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
    -moz-appearance: textfield;
}

/* Medium zoom custom overrides */
.medium-zoom-overlay {
    z-index: 100;
}
.medium-zoom-image--opened {
    z-index: 101;
    border-radius: 1rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>

<?php get_footer(); ?>