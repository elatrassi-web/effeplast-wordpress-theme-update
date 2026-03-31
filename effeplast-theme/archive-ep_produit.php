<?php
/**
 * The template for displaying archive pages for Produits (Custom Post Type)
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
            <div class="absolute top-0 right-0 w-1/2 h-full bg-ep-cyan skew-x-12 translate-x-32 hidden lg:block opacity-10"></div>
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-ep-primary rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">
                <?php
                if ( is_tax( 'ep_product_cat' ) ) {
                    single_term_title();
                } else {
                    _e( 'Notre Catalogue de Produits', 'effeplast' );
                }
                ?>
            </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light leading-relaxed">
                <?php
                if ( is_tax( 'ep_product_cat' ) ) {
                    echo term_description();
                } else {
                    _e( 'Découvrez notre large gamme de bidons, bouteilles et bouchons plastiques pour toutes les industries.', 'effeplast' );
                }
                ?>
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

        <div class="flex flex-col md:flex-row gap-8">

            <!-- Sidebar: Categories Filter -->
            <aside class="md:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                    <h3 class="text-lg font-bold text-ep-blue-night mb-6 uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-layer-group text-ep-cyan"></i> Catégories
                    </h3>
                    <ul class="space-y-3">
                        <?php
                        $terms = get_terms( array(
                            'taxonomy'   => 'ep_product_cat',
                            'hide_empty' => true,
                        ) );

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                $is_active = is_tax( 'ep_product_cat', $term->slug ) ? 'text-ep-cyan font-bold bg-blue-50/50' : 'text-gray-600 hover:text-ep-cyan hover:bg-gray-50';
                                echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '" class="flex items-center justify-between px-3 py-2 rounded-lg transition-colors ' . esc_attr($is_active) . '">';
                                echo '<span>' . esc_html( $term->name ) . '</span>';
                                echo '<span class="text-xs bg-gray-100 text-gray-500 py-1 px-2 rounded-full">' . $term->count . '</span>';
                                echo '</a></li>';
                            }
                        } else {
                            echo '<li class="text-gray-500 text-sm">Aucune catégorie disponible.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="md:w-3/4">
                <?php if ( have_posts() ) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php
                        while ( have_posts() ) : the_post();
                            // Retrieve custom meta
                            $price = get_post_meta( get_the_ID(), '_ep_product_price', true );
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-modern transition-all duration-300 group border border-gray-50 flex flex-col'); ?>>

                                <a href="<?php the_permalink(); ?>" class="block relative aspect-square bg-gray-50 p-6 flex-shrink-0">
                                    <div class="absolute inset-0 bg-gradient-to-t from-ep-blue-night/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500' ) ); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="fas fa-box text-6xl group-hover:text-ep-cyan transition-colors duration-300"></i>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Badge for category -->
                                    <?php
                                    $product_terms = get_the_terms( get_the_ID(), 'ep_product_cat' );
                                    if ( $product_terms && ! is_wp_error( $product_terms ) ) :
                                        $term = array_pop($product_terms);
                                    ?>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/90 backdrop-blur text-xs font-bold text-ep-blue-night px-3 py-1 rounded-full shadow-sm border border-gray-100">
                                            <?php echo esc_html( $term->name ); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </a>

                                <div class="p-6 flex flex-col flex-grow">
                                    <h2 class="text-lg font-bold text-ep-blue-night mb-2 line-clamp-2 group-hover:text-ep-cyan transition-colors">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <div>
                                            <?php if ( $price ) : ?>
                                                <span class="font-black text-gray-800"><?php echo esc_html( $price ); ?> MAD</span>
                                            <?php else : ?>
                                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sur Devis</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                        $image_src = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                        ?>
                                        <button class="ep-add-to-quote-btn w-10 h-10 rounded-full bg-ep-cyan/10 text-ep-cyan flex items-center justify-center hover:bg-ep-cyan hover:text-white transition-colors duration-300 tooltip-trigger"
                                                title="Ajouter au devis"
                                                data-product-id="<?php the_ID(); ?>"
                                                data-product-name="<?php echo esc_attr(get_the_title()); ?>"
                                                data-product-image="<?php echo esc_url($image_src); ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <div class="mt-12">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => __( '<i class="fas fa-chevron-left"></i>', 'effeplast' ),
                            'next_text' => __( '<i class="fas fa-chevron-right"></i>', 'effeplast' ),
                            'class'     => 'pagination flex justify-center',
                        ) );
                        ?>
                    </div>

                <?php else : ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <h2 class="text-2xl font-bold text-ep-blue-night mb-2">Aucun produit trouvé</h2>
                        <p class="text-gray-500">Nous n'avons pas de produits correspondants dans cette catégorie pour le moment.</p>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>