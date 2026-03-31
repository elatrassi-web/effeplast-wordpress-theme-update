<?php
/**
 * The template for displaying all single posts for Custom Post Type "Produits"
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <?php
    while ( have_posts() ) :
        the_post();

        // Retrieve custom meta fields
        $price = get_post_meta( get_the_ID(), '_ep_product_price', true );
        $secondary_image_id = get_post_meta( get_the_ID(), '_ep_product_secondary_image_id', true );
        $secondary_image_url = $secondary_image_id ? wp_get_attachment_url( $secondary_image_id ) : '';

        // Retrieve terms
        $terms = get_the_terms( get_the_ID(), 'ep_product_cat' );
        $category_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : __( 'Non catégorisé', 'effeplast' );
        $category_link = $terms && ! is_wp_error( $terms ) ? get_term_link( $terms[0] ) : '#';
        ?>

        <!-- Breadcrumbs & Minimal Header -->
        <div class="bg-ep-blue-night pt-24 pb-32">
            <div class="container mx-auto px-4 lg:px-8">
                <nav class="flex items-center text-sm font-medium text-blue-100 mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-ep-cyan transition-colors"><i class="fas fa-home mr-2"></i>Accueil</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-500 mx-2 text-xs"></i>
                                <a href="<?php echo esc_url( get_post_type_archive_link( 'ep_produit' ) ); ?>" class="hover:text-ep-cyan transition-colors">Produits</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-500 mx-2 text-xs"></i>
                                <a href="<?php echo esc_url( $category_link ); ?>" class="hover:text-ep-cyan transition-colors"><?php echo esc_html( $category_name ); ?></a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-500 mx-2 text-xs"></i>
                                <span class="text-white font-bold opacity-75 truncate max-w-[200px]"><?php the_title(); ?></span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
                <svg class="relative block w-full h-16 text-ep-gray-light" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 -mt-20 relative z-10">
            <div class="bg-white rounded-3xl shadow-modern p-6 md:p-12">
                <div class="grid md:grid-cols-2 gap-12 lg:gap-16">

                    <!-- Product Images -->
                    <div class="space-y-6" x-data="{ currentImage: 0 }">
                        <div class="aspect-square bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-center p-8 relative overflow-hidden group">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php
                                $full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                ?>
                                <img src="<?php echo esc_url($full_img[0]); ?>" alt="<?php the_title_attribute(); ?>" class="max-w-full max-h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-700 ease-in-out" x-show="currentImage === 0" x-transition.opacity>
                            <?php else : ?>
                                <i class="fas fa-box text-8xl text-gray-200"></i>
                            <?php endif; ?>

                            <?php if ( $secondary_image_url ) : ?>
                                <img src="<?php echo esc_url($secondary_image_url); ?>" alt="Secondary view" class="max-w-full max-h-full object-contain mix-blend-multiply" x-show="currentImage === 1" x-transition.opacity style="display: none;">
                            <?php endif; ?>

                            <!-- Badges -->
                            <div class="absolute top-4 right-4 flex flex-col gap-2">
                                <span class="w-10 h-10 bg-white/90 backdrop-blur rounded-full shadow-sm flex items-center justify-center text-ep-blue-night font-bold tooltip-trigger" title="Recyclable">
                                    <i class="fas fa-recycle text-green-500"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Thumbnails for gallery (Alpine.js handled) -->
                        <?php if ( has_post_thumbnail() && $secondary_image_url ) : ?>
                            <div class="grid grid-cols-4 gap-4">
                                <button @click="currentImage = 0" :class="{'ring-2 ring-ep-cyan border-transparent': currentImage === 0, 'border-gray-200 hover:border-ep-cyan': currentImage !== 0}" class="aspect-square bg-gray-50 rounded-xl border p-2 transition-all flex items-center justify-center overflow-hidden">
                                    <img src="<?php echo esc_url($full_img[0]); ?>" class="max-w-full max-h-full object-contain mix-blend-multiply">
                                </button>
                                <button @click="currentImage = 1" :class="{'ring-2 ring-ep-cyan border-transparent': currentImage === 1, 'border-gray-200 hover:border-ep-cyan': currentImage !== 1}" class="aspect-square bg-gray-50 rounded-xl border p-2 transition-all flex items-center justify-center overflow-hidden">
                                    <img src="<?php echo esc_url($secondary_image_url); ?>" class="max-w-full max-h-full object-contain mix-blend-multiply">
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <div class="mb-2 inline-flex items-center gap-2">
                            <span class="text-xs font-bold text-ep-cyan uppercase tracking-widest bg-ep-cyan/10 px-3 py-1 rounded-full"><?php echo esc_html( $category_name ); ?></span>
                            <span class="text-xs font-bold text-gray-400 bg-gray-100 px-3 py-1 rounded-full"><i class="fas fa-barcode"></i> REF: EP-<?php echo get_the_ID(); ?></span>
                        </div>

                        <h1 class="text-3xl md:text-5xl font-black text-ep-blue-night leading-tight mb-4"><?php the_title(); ?></h1>

                        <div class="mb-8">
                            <?php if ( $price ) : ?>
                                <span class="text-4xl font-extrabold text-ep-blue-night tracking-tight"><?php echo esc_html( $price ); ?> <span class="text-xl text-gray-400 font-medium">MAD</span></span>
                            <?php else : ?>
                                <span class="text-xl font-bold text-gray-500 uppercase tracking-widest border-b-2 border-ep-cyan pb-1">Prix sur devis</span>
                            <?php endif; ?>
                        </div>

                        <div class="prose prose-lg text-gray-600 font-light leading-relaxed mb-10 max-w-none">
                            <?php
                            if(has_excerpt()) {
                                the_excerpt();
                            } else {
                                echo '<p>Découvrez notre ' . strtolower(get_the_title()) . ' conçu pour répondre aux exigences industrielles les plus strictes. Fabriqué avec précision dans nos installations à Kénitra.</p>';
                            }
                            ?>
                        </div>

                        <hr class="border-gray-100 mb-8">

                        <!-- Quantity and Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 mb-8">
                            <div class="flex items-center border-2 border-gray-100 rounded-xl overflow-hidden bg-gray-50 h-14 focus-within:border-ep-cyan focus-within:ring-1 focus-within:ring-ep-cyan transition-all w-32 flex-shrink-0" x-data="{ qty: 1 }">
                                <button type="button" class="w-10 h-full flex items-center justify-center text-gray-500 hover:text-ep-cyan focus:outline-none" @click="if(qty > 1) qty--"><i class="fas fa-minus text-sm"></i></button>
                                <input type="number" name="quantity" min="1" x-model="qty" class="w-full h-full text-center text-ep-blue-night font-bold text-lg bg-transparent border-none focus:ring-0 p-0 appearance-none">
                                <button type="button" class="w-10 h-full flex items-center justify-center text-gray-500 hover:text-ep-cyan focus:outline-none" @click="qty++"><i class="fas fa-plus text-sm"></i></button>
                            </div>

                            <a href="/devis" class="flex-grow flex items-center justify-center gap-3 bg-gradient-to-r from-ep-blue-night to-ep-primary hover:from-ep-cyan hover:to-blue-600 text-white font-bold text-lg h-14 rounded-xl shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/40 hover:-translate-y-1 transition-all">
                                <i class="fas fa-file-invoice"></i> Ajouter au devis
                            </a>
                        </div>

                        <!-- Trust badges -->
                        <div class="grid grid-cols-2 gap-4 mt-auto">
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 bg-gray-50/50">
                                <div class="w-10 h-10 rounded-full bg-ep-cyan/10 flex items-center justify-center text-ep-cyan"><i class="fas fa-check-shield"></i></div>
                                <div class="text-sm font-semibold text-ep-blue-night leading-tight">Qualité<br><span class="text-xs text-gray-500 font-normal">Garantie 100%</span></div>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-100 bg-gray-50/50">
                                <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-500"><i class="fas fa-truck-fast"></i></div>
                                <div class="text-sm font-semibold text-ep-blue-night leading-tight">Livraison<br><span class="text-xs text-gray-500 font-normal">Rapide au Maroc</span></div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Product Full Description Tabs -->
                <div class="mt-16 pt-16 border-t border-gray-100" x-data="{ tab: 'desc' }">
                    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-100 pb-px">
                        <button @click="tab = 'desc'" :class="{'text-ep-blue-night border-ep-cyan border-b-2 font-bold': tab === 'desc', 'text-gray-500 border-transparent hover:text-ep-cyan font-medium': tab !== 'desc'}" class="px-6 py-3 text-lg transition-all focus:outline-none">Description Complète</button>
                        <button @click="tab = 'tech'" :class="{'text-ep-blue-night border-ep-cyan border-b-2 font-bold': tab === 'tech', 'text-gray-500 border-transparent hover:text-ep-cyan font-medium': tab !== 'tech'}" class="px-6 py-3 text-lg transition-all focus:outline-none">Spécifications Techniques</button>
                    </div>

                    <div x-show="tab === 'desc'" class="prose prose-lg max-w-none text-gray-600 font-light" x-transition.opacity>
                        <?php the_content(); ?>
                        <?php if (empty(get_the_content())) : ?>
                            <p>Effe Plast s'engage à fournir des produits plastiques de la plus haute qualité. Notre processus de fabrication utilise les dernières technologies de moulage par injection et soufflage, garantissant des parois uniformes et une résistance optimale. Idéal pour les produits chimiques, alimentaires et cosmétiques.</p>
                        <?php endif; ?>
                    </div>

                    <div x-show="tab === 'tech'" class="bg-gray-50 rounded-2xl p-8 border border-gray-100" x-transition.opacity style="display: none;">
                        <ul class="grid sm:grid-cols-2 gap-4">
                            <li class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm"><span class="w-8 h-8 rounded-full bg-blue-50 text-ep-cyan flex items-center justify-center"><i class="fas fa-vial"></i></span> <span class="font-semibold text-ep-blue-night w-1/3">Matériau:</span> <span class="text-gray-600">PEHD / PET (Selon demande)</span></li>
                            <li class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm"><span class="w-8 h-8 rounded-full bg-blue-50 text-ep-cyan flex items-center justify-center"><i class="fas fa-palette"></i></span> <span class="font-semibold text-ep-blue-night w-1/3">Couleurs:</span> <span class="text-gray-600">Standard ou Personnalisé</span></li>
                            <li class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm"><span class="w-8 h-8 rounded-full bg-blue-50 text-ep-cyan flex items-center justify-center"><i class="fas fa-shield-halved"></i></span> <span class="font-semibold text-ep-blue-night w-1/3">Étanchéité:</span> <span class="text-gray-600">100% Garantie</span></li>
                            <li class="flex items-center gap-3 bg-white p-4 rounded-xl shadow-sm"><span class="w-8 h-8 rounded-full bg-blue-50 text-ep-cyan flex items-center justify-center"><i class="fas fa-industry"></i></span> <span class="font-semibold text-ep-blue-night w-1/3">Origine:</span> <span class="text-gray-600">Fabriqué au Maroc</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    <?php endwhile; ?>
</div>

<style>
/* Remove number input spinners */
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