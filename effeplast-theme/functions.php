<?php
/**
 * Effe Plast Theme functions and definitions
 *
 * @package EffePlast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Setup theme defaults and register support for various WordPress features.
 */
function effeplast_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'effeplast' ),
			'footer' => esc_html__( 'Footer Menu', 'effeplast' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// WooCommerce Support
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'effeplast_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function effeplast_theme_scripts() {
	wp_enqueue_style( 'effeplast-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Enqueue Tailwind output CSS (Assuming it's generated to 'assets/css/tailwind.css' or similar. We'll stick to style.css for simplicity if we compile it directly there)
	// If you use a separate tailwind output file:
	wp_enqueue_style( 'effeplast-tailwind', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime(get_template_directory() . '/assets/css/main.css') );

	// Add Alpine.js for interactive components (menus, modals, etc) - Very modern 2030 approach
	wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'effeplast_theme_scripts' );

/**
 * Create necessary directories
 */
add_action('after_setup_theme', function() {
    $dir = get_template_directory() . '/assets/css';
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
});

/**
 * Register Custom Post Type: Produits
 */
function effeplast_register_produits_cpt() {
    $labels = array(
        'name'                  => _x( 'Produits', 'Post Type General Name', 'effeplast' ),
        'singular_name'         => _x( 'Produit', 'Post Type Singular Name', 'effeplast' ),
        'menu_name'             => __( 'Produits Effe Plast', 'effeplast' ),
        'name_admin_bar'        => __( 'Produit', 'effeplast' ),
        'archives'              => __( 'Archives des produits', 'effeplast' ),
        'attributes'            => __( 'Attributs du produit', 'effeplast' ),
        'parent_item_colon'     => __( 'Produit parent :', 'effeplast' ),
        'all_items'             => __( 'Tous les produits', 'effeplast' ),
        'add_new_item'          => __( 'Ajouter un nouveau produit', 'effeplast' ),
        'add_new'               => __( 'Ajouter', 'effeplast' ),
        'new_item'              => __( 'Nouveau produit', 'effeplast' ),
        'edit_item'             => __( 'Modifier le produit', 'effeplast' ),
        'update_item'           => __( 'Mettre à jour le produit', 'effeplast' ),
        'view_item'             => __( 'Voir le produit', 'effeplast' ),
        'view_items'            => __( 'Voir les produits', 'effeplast' ),
        'search_items'          => __( 'Chercher un produit', 'effeplast' ),
        'not_found'             => __( 'Non trouvé', 'effeplast' ),
        'not_found_in_trash'    => __( 'Non trouvé dans la corbeille', 'effeplast' ),
        'featured_image'        => __( 'Image mise en avant', 'effeplast' ),
        'set_featured_image'    => __( 'Définir l\'image mise en avant', 'effeplast' ),
        'remove_featured_image' => __( 'Supprimer l\'image', 'effeplast' ),
        'use_featured_image'    => __( 'Utiliser comme image', 'effeplast' ),
        'insert_into_item'      => __( 'Insérer dans le produit', 'effeplast' ),
        'uploaded_to_this_item' => __( 'Téléversé sur ce produit', 'effeplast' ),
        'items_list'            => __( 'Liste des produits', 'effeplast' ),
        'items_list_navigation' => __( 'Navigation des produits', 'effeplast' ),
        'filter_items_list'     => __( 'Filtrer la liste des produits', 'effeplast' ),
    );
    $args = array(
        'label'                 => __( 'Produit', 'effeplast' ),
        'description'           => __( 'Catalogue des produits Effe Plast', 'effeplast' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies'            => array( 'ep_product_cat' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-products',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'produits',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );
    register_post_type( 'ep_produit', $args );

    // Register Custom Taxonomy: Catégorie de produit
    $tax_labels = array(
        'name'                       => _x( 'Catégories de produits', 'Taxonomy General Name', 'effeplast' ),
        'singular_name'              => _x( 'Catégorie de produit', 'Taxonomy Singular Name', 'effeplast' ),
        'menu_name'                  => __( 'Catégories', 'effeplast' ),
        'all_items'                  => __( 'Toutes les catégories', 'effeplast' ),
        'parent_item'                => __( 'Catégorie parente', 'effeplast' ),
        'parent_item_colon'          => __( 'Catégorie parente :', 'effeplast' ),
        'new_item_name'              => __( 'Nouveau nom de catégorie', 'effeplast' ),
        'add_new_item'               => __( 'Ajouter une catégorie', 'effeplast' ),
        'edit_item'                  => __( 'Modifier la catégorie', 'effeplast' ),
        'update_item'                => __( 'Mettre à jour la catégorie', 'effeplast' ),
        'view_item'                  => __( 'Voir la catégorie', 'effeplast' ),
        'separate_items_with_commas' => __( 'Séparer avec des virgules', 'effeplast' ),
        'add_or_remove_items'        => __( 'Ajouter ou supprimer', 'effeplast' ),
        'choose_from_most_used'      => __( 'Choisir parmi les plus utilisées', 'effeplast' ),
        'popular_items'              => __( 'Catégories populaires', 'effeplast' ),
        'search_items'               => __( 'Chercher des catégories', 'effeplast' ),
        'not_found'                  => __( 'Non trouvé', 'effeplast' ),
        'no_terms'                   => __( 'Aucune catégorie', 'effeplast' ),
        'items_list'                 => __( 'Liste des catégories', 'effeplast' ),
        'items_list_navigation'      => __( 'Navigation de liste', 'effeplast' ),
    );
    $tax_args = array(
        'labels'                     => $tax_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true, // Enable Gutenberg compatibility
    );
    register_taxonomy( 'ep_product_cat', array( 'ep_produit' ), $tax_args );
}
add_action( 'init', 'effeplast_register_produits_cpt', 0 );

/**
 * Register Meta Box for Products: Price & Secondary Image
 */
function effeplast_add_product_metaboxes() {
    add_meta_box(
        'ep_product_details_metabox',          // Metabox ID
        __( 'Détails du Produit', 'effeplast' ), // Title
        'ep_product_details_metabox_html',     // Callback function
        'ep_produit',                          // Post type
        'normal',                              // Context
        'high'                                 // Priority
    );
}
add_action( 'add_meta_boxes', 'effeplast_add_product_metaboxes' );

/**
 * Meta Box HTML Output
 */
function ep_product_details_metabox_html( $post ) {
    // Generate nonce for security
    wp_nonce_field( 'ep_product_metabox_nonce_action', 'ep_product_metabox_nonce' );

    // Retrieve existing values
    $price = get_post_meta( $post->ID, '_ep_product_price', true );
    $image_id = get_post_meta( $post->ID, '_ep_product_secondary_image_id', true );
    $image_url = $image_id ? wp_get_attachment_url( $image_id ) : '';
    ?>
    <style>
        .ep-metabox-wrapper { padding: 10px 0; }
        .ep-metabox-field { margin-bottom: 20px; }
        .ep-metabox-label { font-weight: 600; display: block; margin-bottom: 5px; }
        .ep-image-preview { max-width: 150px; display: block; margin-top: 10px; border: 1px solid #ddd; padding: 5px; background: #fff; }
        .ep-button-group { margin-top: 10px; }
    </style>

    <div class="ep-metabox-wrapper">
        <!-- Champ Prix -->
        <div class="ep-metabox-field">
            <label for="ep_product_price" class="ep-metabox-label"><?php _e( 'Prix du produit (MAD)', 'effeplast' ); ?></label>
            <input type="number" id="ep_product_price" name="ep_product_price" value="<?php echo esc_attr( $price ); ?>" step="0.01" min="0" style="width: 100%; max-width: 300px;">
            <p class="description"><?php _e( 'Laissez vide si le produit nécessite un devis sans prix fixe.', 'effeplast' ); ?></p>
        </div>

        <!-- Champ Image Secondaire (Upload Media) -->
        <div class="ep-metabox-field">
            <label class="ep-metabox-label"><?php _e( 'Image Secondaire / Dessin Technique', 'effeplast' ); ?></label>
            <input type="hidden" id="ep_product_secondary_image_id" name="ep_product_secondary_image_id" value="<?php echo esc_attr( $image_id ); ?>">

            <div id="ep_product_image_preview_container" <?php if(!$image_id) echo 'style="display:none;"'; ?>>
                <img id="ep_product_image_preview" src="<?php echo esc_url($image_url); ?>" class="ep-image-preview">
            </div>

            <div class="ep-button-group">
                <button type="button" class="button button-secondary" id="ep_upload_image_btn"><?php _e( 'Sélectionner une image', 'effeplast' ); ?></button>
                <button type="button" class="button button-link-delete" id="ep_remove_image_btn" <?php if(!$image_id) echo 'style="display:none;"'; ?>><?php _e( 'Supprimer', 'effeplast' ); ?></button>
            </div>
            <p class="description"><?php _e( 'Ajoutez une image supplémentaire (ex: vue de dessus, schéma technique).', 'effeplast' ); ?></p>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($){
        // Ensure WordPress Media uploader is available
        var mediaUploader;

        $('#ep_upload_image_btn').click(function(e) {
            e.preventDefault();
            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            // Extend the wp.media object
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: '<?php _e( "Choisir une image", "effeplast" ); ?>',
                button: { text: '<?php _e( "Utiliser cette image", "effeplast" ); ?>' },
                multiple: false
            });
            // When a file is selected, grab the URL and set it as the text field's value
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#ep_product_secondary_image_id').val(attachment.id);
                $('#ep_product_image_preview').attr('src', attachment.url);
                $('#ep_product_image_preview_container').show();
                $('#ep_remove_image_btn').show();
            });
            mediaUploader.open();
        });

        $('#ep_remove_image_btn').click(function(e){
            e.preventDefault();
            $('#ep_product_secondary_image_id').val('');
            $('#ep_product_image_preview').attr('src', '');
            $('#ep_product_image_preview_container').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Enqueue Media Scripts for the Metabox
 */
function effeplast_admin_scripts( $hook ) {
    global $typenow;
    if ( $typenow === 'ep_produit' ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'effeplast_admin_scripts' );

/**
 * Save Metabox Data
 */
function effeplast_save_product_metaboxes( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['ep_product_metabox_nonce'] ) ) {
        return;
    }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['ep_product_metabox_nonce'], 'ep_product_metabox_nonce_action' ) ) {
        return;
    }
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'ep_produit' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Save Price
    if ( isset( $_POST['ep_product_price'] ) ) {
        $price = sanitize_text_field( $_POST['ep_product_price'] );
        update_post_meta( $post_id, '_ep_product_price', $price );
    }

    // Save Secondary Image ID
    if ( isset( $_POST['ep_product_secondary_image_id'] ) ) {
        $image_id = absint( $_POST['ep_product_secondary_image_id'] );
        update_post_meta( $post_id, '_ep_product_secondary_image_id', $image_id );
    }
}
add_action( 'save_post', 'effeplast_save_product_metaboxes' );

/**
 * Enqueue JS for Quote System
 */
function effeplast_enqueue_quote_system() {
    wp_enqueue_script( 'effeplast-quote', get_template_directory_uri() . '/assets/js/quote-system.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'effeplast_enqueue_quote_system' );

/**
 * Handle Quote Form Submission
 */
function ep_handle_submit_quote() {
    // Verify nonce
    if ( ! isset( $_POST['ep_quote_nonce'] ) || ! wp_verify_nonce( $_POST['ep_quote_nonce'], 'ep_submit_quote_nonce' ) ) {
        wp_die( 'La vérification de sécurité a échoué. Veuillez réessayer.' );
    }

    // Retrieve and sanitize fields
    $company = sanitize_text_field( $_POST['company'] );
    $name = sanitize_text_field( $_POST['contact_name'] );
    $email = sanitize_email( $_POST['email'] );
    $phone = sanitize_text_field( $_POST['phone'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // Retrieve cart data (JSON string)
    $quote_data_json = stripslashes( $_POST['quote_data'] );
    $quote_items = json_decode( $quote_data_json, true );

    if ( ! is_array( $quote_items ) || empty( $quote_items ) ) {
        wp_die( 'Votre demande de devis est vide.' );
    }

    // --- 1. ENREGISTREMENT DANS LA BASE DE DONNÉES (CPT `ep_commande_devis`) ---

    // Create the post title
    $post_title = 'Devis - ' . $company . ' - ' . wp_date( 'd/m/Y H:i' );

    $post_data = array(
        'post_title'   => $post_title,
        'post_status'  => 'publish',
        'post_type'    => 'ep_commande_devis',
        'post_author'  => 1 // usually admin
    );

    // Insert the post into the database
    $post_id = wp_insert_post( $post_data );

    if ( ! is_wp_error( $post_id ) ) {
        // Save the client details as post meta
        update_post_meta( $post_id, '_ep_devis_company', $company );
        update_post_meta( $post_id, '_ep_devis_name', $name );
        update_post_meta( $post_id, '_ep_devis_email', $email );
        update_post_meta( $post_id, '_ep_devis_phone', $phone );
        update_post_meta( $post_id, '_ep_devis_message', $message );

        // Save the cart items as post meta (stored as a serialized array/JSON)
        update_post_meta( $post_id, '_ep_devis_items', $quote_data_json );

        // Mark status as 'Nouveau'
        update_post_meta( $post_id, '_ep_devis_status', 'nouveau' );
    }

    // --- 2. ENVOI DES EMAILS (Boutique et Client) ---

    // Email Boutique (Admin)
    $to_admin = 'effeplast.kenitra@gmail.com';
    $subject_admin = 'Nouvelle Demande de Devis - ' . $company;

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: ' . $name . ' <' . $email . '>';

    $body_admin = '<h2>Nouvelle demande de devis depuis le site web Effe Plast</h2>';
    $body_admin .= '<h3>Coordonnées du client :</h3>';
    $body_admin .= '<p><strong>Société :</strong> ' . $company . '</p>';
    $body_admin .= '<p><strong>Nom :</strong> ' . $name . '</p>';
    $body_admin .= '<p><strong>Email :</strong> ' . $email . '</p>';
    $body_admin .= '<p><strong>Téléphone :</strong> ' . $phone . '</p>';
    $body_admin .= '<p><strong>Message/Notes :</strong><br>' . nl2br($message) . '</p>';

    $body_admin .= '<h3>Produits demandés :</h3>';
    $body_admin .= '<table style="width: 100%; border-collapse: collapse;">';
    $body_admin .= '<thead><tr style="background-color: #f3f4f6; text-align: left;">';
    $body_admin .= '<th style="padding: 10px; border: 1px solid #ddd;">Référence</th>';
    $body_admin .= '<th style="padding: 10px; border: 1px solid #ddd;">Produit</th>';
    $body_admin .= '<th style="padding: 10px; border: 1px solid #ddd;">Quantité</th>';
    $body_admin .= '</tr></thead><tbody>';

    foreach ( $quote_items as $item ) {
        $body_admin .= '<tr>';
        $body_admin .= '<td style="padding: 10px; border: 1px solid #ddd;">EP-' . esc_html($item['id']) . '</td>';
        $body_admin .= '<td style="padding: 10px; border: 1px solid #ddd;">' . esc_html($item['name']) . '</td>';
        $body_admin .= '<td style="padding: 10px; border: 1px solid #ddd; text-align: center;">' . esc_html($item['quantity']) . '</td>';
        $body_admin .= '</tr>';
    }
    $body_admin .= '</tbody></table>';

    // Send Email to Admin
    $mail_sent = wp_mail( $to_admin, $subject_admin, $body_admin, $headers );

    // Email Client (Auto-reply)
    $subject_client = 'Confirmation de votre demande de devis - Effe Plast';
    $body_client = '<h2>Bonjour ' . $name . ',</h2>';
    $body_client .= '<p>Nous avons bien reçu votre demande de devis concernant les produits suivants. Notre équipe commerciale vous contactera très rapidement avec une offre personnalisée.</p>';
    $body_client .= $body_admin; // Reuse the table
    $body_client .= '<p>Cordialement,<br>L\'équipe Effe Plast<br>05 37 36 08 20</p>';

    wp_mail( $email, $subject_client, $body_client, array('Content-Type: text/html; charset=UTF-8') );

    // --- 3. REDIRECTION ---
    // Redirect back to the quote page with a success query arg
    $redirect_url = add_query_arg( 'quote_success', '1', home_url('/panier-devis') );
    wp_redirect( $redirect_url );
    exit();
}
add_action( 'admin_post_nopriv_ep_submit_quote', 'ep_handle_submit_quote' );
add_action( 'admin_post_ep_submit_quote', 'ep_handle_submit_quote' );

/**
 * Notice for successful quote submission and clearing cart via JS
 */
function ep_quote_success_notice() {
    if ( isset( $_GET['quote_success'] ) && $_GET['quote_success'] == '1' ) {
        echo '<div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg border border-green-600 flex items-center gap-3 animate-bounce">
                <i class="fas fa-check-circle text-2xl"></i>
                <div>
                    <h4 class="font-bold">Demande envoyée !</h4>
                    <p class="text-sm">Nous vous recontacterons très vite.</p>
                </div>
              </div>';
        // Clear local storage cart since quote was submitted
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                if(typeof QuoteSystem !== "undefined") {
                    QuoteSystem.clearCart();
                    setTimeout(function(){ window.location.href = "' . esc_url(home_url('/')) . '"; }, 4000);
                }
            });
        </script>';
    }
}
add_action( 'wp_footer', 'ep_quote_success_notice' );

/**
 * Enqueue Swiper JS and CSS for the Product Slider Page
 */
function ep_enqueue_swiper_assets() {
    if ( is_page_template( 'page-produits-slider.php' ) ) {
        // Swiper CSS
        wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.5' );
        // Swiper JS
        wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.5', true );
        // Custom Slider Script
        wp_enqueue_script( 'ep-product-slider', get_template_directory_uri() . '/assets/js/product-slider.js', array('jquery', 'swiper-js'), '1.0.0', true );

        // Pass AJAX URL to JS
        wp_localize_script( 'ep-product-slider', 'ep_ajax_obj', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'ep_enqueue_swiper_assets' );

/**
 * AJAX Handler to Fetch Products for Slider
 */
function ep_fetch_slider_products() {
    $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
    $search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';

    $args = array(
        'post_type'      => 'ep_produit',
        'posts_per_page' => 15,
        'post_status'    => 'publish',
    );

    if ( ! empty( $category ) && $category !== 'all' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'ep_product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    if ( ! empty( $search ) ) {
        $args['s'] = $search;
    }

    $products_query = new WP_Query( $args );

    if ( $products_query->have_posts() ) {
        ob_start();
        while ( $products_query->have_posts() ) {
            $products_query->the_post();

            $price = get_post_meta( get_the_ID(), '_ep_product_price', true );
            $image_src = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if(!$image_src) $image_src = 'https://via.placeholder.com/600x800?text=EP';

            $terms = get_the_terms( get_the_ID(), 'ep_product_cat' );
            $cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';

            // Output the slide HTML
            ?>
            <div class="swiper-slide group">
                <div class="relative w-full h-full bg-white rounded-[2rem] overflow-hidden shadow-xl transition-all duration-500 transform group-hover:-translate-y-4 group-hover:shadow-cyan-500/40">
                    <div class="block h-3/5 bg-gray-50 relative p-8 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-ep-blue-night/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>" class="max-h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-700">
                        <?php if($cat_name): ?>
                            <span class="absolute top-4 right-4 bg-white/90 backdrop-blur text-xs font-bold text-ep-blue-night px-3 py-1 rounded-full shadow-sm">
                                <?php echo esc_html($cat_name); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="h-2/5 p-8 flex flex-col justify-between relative z-10 bg-white border-t border-gray-100">
                        <div>
                            <span class="text-xs text-gray-400 font-bold tracking-widest uppercase mb-1 block">Ref: EP-<?php echo get_the_ID(); ?></span>
                            <h2 class="text-2xl font-black text-ep-blue-night mb-2 line-clamp-2 leading-tight group-hover:text-ep-cyan transition-colors">
                                <?php the_title(); ?>
                            </h2>
                        </div>

                        <div class="flex items-center justify-between mt-auto">
                            <?php if ( $price ) : ?>
                                <span class="text-2xl font-black text-gray-800 tracking-tight"><?php echo esc_html( $price ); ?> <span class="text-sm text-gray-400 font-medium">MAD</span></span>
                            <?php else : ?>
                                <span class="text-sm font-bold text-gray-500 uppercase tracking-widest">Sur Devis</span>
                            <?php endif; ?>

                            <!-- Integration with quote system JS -->
                            <button class="ep-add-to-quote-btn px-5 py-2.5 rounded-full bg-ep-blue-night text-white flex items-center justify-center gap-2 hover:bg-ep-cyan hover:scale-105 transition-all duration-300 shadow-md text-sm font-bold focus:outline-none flex-shrink-0 whitespace-nowrap"
                                    data-product-id="<?php the_ID(); ?>"
                                    data-product-name="<?php echo esc_attr(get_the_title()); ?>"
                                    data-product-image="<?php echo esc_url($image_src); ?>">
                                <i class="fas fa-plus"></i> <span class="btn-text">Au devis</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        $html = ob_get_clean();
        wp_send_json_success( array( 'html' => $html ) );
    } else {
        // No products found slide
        $html = '<div class="w-full flex items-center justify-center h-full">
                    <div class="text-center p-12 bg-white/10 backdrop-blur-md rounded-[2rem] border border-white/20">
                        <i class="fas fa-search text-6xl text-ep-cyan opacity-50 mb-4"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Aucun produit trouvé</h3>
                        <p class="text-blue-200 font-light">Essayez de modifier vos filtres ou votre recherche.</p>
                    </div>
                 </div>';
        wp_send_json_success( array( 'html' => $html ) );
    }
    wp_die();
}
add_action( 'wp_ajax_ep_fetch_slider_products', 'ep_fetch_slider_products' );
add_action( 'wp_ajax_nopriv_ep_fetch_slider_products', 'ep_fetch_slider_products' );

/**
 * Register Custom Post Type: Commandes Devis (Private for admin only)
 */
function ep_register_commande_devis_cpt() {
    $labels = array(
        'name'                  => _x( 'Demandes de Devis', 'Post Type General Name', 'effeplast' ),
        'singular_name'         => _x( 'Demande de Devis', 'Post Type Singular Name', 'effeplast' ),
        'menu_name'             => __( 'Devis Reçus', 'effeplast' ),
        'all_items'             => __( 'Tous les Devis', 'effeplast' ),
        'view_item'             => __( 'Voir le Devis', 'effeplast' ),
        'not_found'             => __( 'Aucun devis trouvé', 'effeplast' ),
    );
    $args = array(
        'label'                 => __( 'Demande de Devis', 'effeplast' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'custom-fields' ), // Title will be "Devis - [Company Name] - [Date]"
        'hierarchical'          => false,
        'public'                => false, // Private!
        'show_ui'               => false, // We will build a completely custom admin page instead of the default post list
        'show_in_menu'          => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'ep_commande_devis', $args );
}
add_action( 'init', 'ep_register_commande_devis_cpt', 0 );

/**
 * Custom Admin Menu for Quotes Dashboard
 */
function ep_add_devis_admin_menu() {
    add_menu_page(
        'Devis Reçus', // Page title
        'Devis Reçus', // Menu title
        'manage_options', // Capability
        'ep-devis-dashboard', // Menu slug
        'ep_devis_dashboard_page', // Callback function
        'dashicons-clipboard', // Icon
        6 // Position
    );
}
add_action( 'admin_menu', 'ep_add_devis_admin_menu' );

/**
 * Main Callback for Quotes Dashboard Page
 */
function ep_devis_dashboard_page() {
    // Determine view: list or single
    $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'list';
    $post_id = isset($_GET['id']) ? absint($_GET['id']) : 0;

    echo '<div class="wrap" style="max-width: 1200px;">';
    echo '<h1>Gestion des Devis Reçus</h1>';

    if ( $action === 'view' && $post_id > 0 ) {
        ep_render_single_devis_view( $post_id );
    } else {
        ep_render_devis_list_view();
    }

    echo '</div>';
}

/**
 * Render the Devis List Dashboard
 */
function ep_render_devis_list_view() {
    $filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
    $custom_date = isset($_GET['custom_date']) ? sanitize_text_field($_GET['custom_date']) : '';

    // Base Query Args
    $args = array(
        'post_type'      => 'ep_commande_devis',
        'posts_per_page' => 50,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    // Apply Date Filtering
    if ( !empty($custom_date) ) {
        // Specific custom date chosen from input type=date
        $args['date_query'] = array(
            array(
                'year'  => date( 'Y', strtotime( $custom_date ) ),
                'month' => date( 'm', strtotime( $custom_date ) ),
                'day'   => date( 'd', strtotime( $custom_date ) ),
            ),
        );
    } else {
        // Preset filters
        switch ($filter) {
            case 'today':
                $args['date_query'] = array(
                    array(
                        'year'  => date( 'Y' ),
                        'month' => date( 'm' ),
                        'day'   => date( 'd' ),
                    ),
                );
                break;
            case 'yesterday':
                $args['date_query'] = array(
                    array(
                        'year'  => date( 'Y', strtotime( '-1 days' ) ),
                        'month' => date( 'm', strtotime( '-1 days' ) ),
                        'day'   => date( 'd', strtotime( '-1 days' ) ),
                    ),
                );
                break;
            case 'last7':
                $args['date_query'] = array(
                    array(
                        'after' => '1 week ago',
                    ),
                );
                break;
            case 'last30':
                $args['date_query'] = array(
                    array(
                        'after' => '1 month ago',
                    ),
                );
                break;
        }
    }

    $devis_query = new WP_Query( $args );

    // UI Filters Bar
    ?>
    <div style="background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
        <form method="GET" action="admin.php" style="display:flex; flex-wrap: wrap; gap: 15px; align-items: center;">
            <input type="hidden" name="page" value="ep-devis-dashboard">

            <h3 style="margin: 0; padding-right: 10px; font-size: 14px;">Filtrer par date :</h3>

            <div style="display: flex; gap: 10px;">
                <button type="submit" name="filter" value="today" class="button <?php echo $filter == 'today' && empty($custom_date) ? 'button-primary' : ''; ?>">Aujourd'hui</button>
                <button type="submit" name="filter" value="yesterday" class="button <?php echo $filter == 'yesterday' && empty($custom_date) ? 'button-primary' : ''; ?>">Hier</button>
                <button type="submit" name="filter" value="last7" class="button <?php echo $filter == 'last7' && empty($custom_date) ? 'button-primary' : ''; ?>">7 derniers jours</button>
                <button type="submit" name="filter" value="last30" class="button <?php echo $filter == 'last30' && empty($custom_date) ? 'button-primary' : ''; ?>">Le mois dernier</button>
                <a href="?page=ep-devis-dashboard&filter=all" class="button <?php echo $filter == 'all' && empty($custom_date) ? 'button-primary' : ''; ?>">Tout voir</a>
            </div>

            <div style="margin-left: 20px; display: flex; align-items: center; gap: 10px; border-left: 1px solid #ddd; padding-left: 20px;">
                <label for="custom_date" style="font-weight: 600;">Date spécifique :</label>
                <input type="date" name="custom_date" id="custom_date" value="<?php echo esc_attr($custom_date); ?>" style="line-height: normal;">
                <button type="submit" class="button">Chercher</button>
                <?php if(!empty($custom_date)): ?>
                    <a href="?page=ep-devis-dashboard" style="color: #d63638; text-decoration: none;">&times; Effacer</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <table class="wp-list-table widefat fixed striped table-view-list">
        <thead>
            <tr>
                <th class="manage-column column-title">Réf. Devis</th>
                <th class="manage-column">Date & Heure</th>
                <th class="manage-column">Société</th>
                <th class="manage-column">Contact</th>
                <th class="manage-column">Statut</th>
                <th class="manage-column" style="width: 150px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ( $devis_query->have_posts() ) {
                while ( $devis_query->have_posts() ) {
                    $devis_query->the_post();
                    $post_id = get_the_ID();

                    $company = get_post_meta( $post_id, '_ep_devis_company', true );
                    $name = get_post_meta( $post_id, '_ep_devis_name', true );
                    $status = get_post_meta( $post_id, '_ep_devis_status', true );

                    $status_badge = $status == 'lu' ? '<span style="background:#e5f5fa; color:#005a9e; padding:3px 8px; border-radius:12px; font-size:12px; font-weight:600;">Lu</span>' : '<span style="background:#f0b849; color:#fff; padding:3px 8px; border-radius:12px; font-size:12px; font-weight:600;">Nouveau</span>';
                    ?>
                    <tr>
                        <td><strong>#EP-<?php echo $post_id; ?></strong></td>
                        <td><?php echo get_the_date('d/m/Y') . ' à ' . get_the_time('H:i'); ?></td>
                        <td><?php echo esc_html($company); ?></td>
                        <td><?php echo esc_html($name); ?></td>
                        <td><?php echo $status_badge; ?></td>
                        <td style="text-align: center;">
                            <a href="?page=ep-devis-dashboard&action=view&id=<?php echo $post_id; ?>" class="button button-primary">Voir les détails</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6" style="text-align: center; padding: 30px;">Aucun devis trouvé pour cette période.</td></tr>';
            }
            wp_reset_postdata();
            ?>
        </tbody>
    </table>
    <?php
}

/**
 * Render Single Devis Details Page
 */
function ep_render_single_devis_view($post_id) {
    // Check if post exists and is of correct type
    $post = get_post($post_id);
    if(!$post || $post->post_type !== 'ep_commande_devis') {
        echo '<div class="notice notice-error"><p>Devis introuvable.</p></div>';
        echo '<a href="?page=ep-devis-dashboard" class="button">&laquo; Retour à la liste</a>';
        return;
    }

    // Mark as read
    update_post_meta($post_id, '_ep_devis_status', 'lu');

    // Get Meta
    $company = get_post_meta($post_id, '_ep_devis_company', true);
    $name = get_post_meta($post_id, '_ep_devis_name', true);
    $email = get_post_meta($post_id, '_ep_devis_email', true);
    $phone = get_post_meta($post_id, '_ep_devis_phone', true);
    $message = get_post_meta($post_id, '_ep_devis_message', true);
    $items_json = get_post_meta($post_id, '_ep_devis_items', true);
    $items = json_decode($items_json, true);

    // Style for the admin view
    ?>
    <style>
        .ep-admin-card { background: #fff; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04); padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .ep-admin-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .ep-admin-label { font-size: 12px; font-weight: 600; color: #646970; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; display: block; }
        .ep-admin-val { font-size: 15px; color: #1d2327; margin: 0 0 15px 0; }
        .ep-prod-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .ep-prod-table th, .ep-prod-table td { padding: 12px 15px; border-bottom: 1px solid #f0f0f1; text-align: left; }
        .ep-prod-table th { background: #f6f7f7; font-weight: 600; color: #1d2327; }
    </style>

    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <a href="?page=ep-devis-dashboard" class="button">&laquo; Retour à la liste</a>
        <span style="font-size: 16px; color: #646970;">Reçu le : <strong><?php echo get_the_date('d F Y', $post) . ' à ' . get_the_time('H:i', $post); ?></strong></span>
    </div>

    <div class="ep-admin-grid">
        <!-- Client Details -->
        <div class="ep-admin-card">
            <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #f0f0f1; font-size: 18px;">Coordonnées du client</h2>

            <span class="ep-admin-label">Société / Entreprise</span>
            <p class="ep-admin-val"><strong><?php echo esc_html($company); ?></strong></p>

            <span class="ep-admin-label">Nom du contact</span>
            <p class="ep-admin-val"><?php echo esc_html($name); ?></p>

            <span class="ep-admin-label">Email</span>
            <p class="ep-admin-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>

            <span class="ep-admin-label">Téléphone</span>
            <p class="ep-admin-val"><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></p>
        </div>

        <!-- Message Details -->
        <div class="ep-admin-card">
            <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #f0f0f1; font-size: 18px;">Notes / Message</h2>
            <?php if(!empty($message)): ?>
                <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #00B4D8; font-style: italic; color: #555;">
                    <?php echo nl2br(esc_html($message)); ?>
                </div>
            <?php else: ?>
                <p style="color: #999;">Aucun message additionnel.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Products List -->
    <div class="ep-admin-card">
        <h2 style="margin-top: 0; padding-bottom: 10px; font-size: 18px; display: flex; align-items: center; justify-content: space-between;">
            Liste des Produits Demandés
            <span style="background: #00B4D8; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: bold;"><?php echo count($items); ?> Article(s)</span>
        </h2>

        <?php if(!empty($items) && is_array($items)): ?>
            <table class="ep-prod-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th style="width: 120px;">Référence</th>
                        <th>Nom du produit</th>
                        <th style="width: 100px; text-align: center;">Quantité</th>
                        <th style="width: 120px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $item): ?>
                    <tr>
                        <td>
                            <?php if(!empty($item['image'])): ?>
                                <img src="<?php echo esc_url($item['image']); ?>" style="width: 50px; height: 50px; object-fit: contain; background: #f6f7f7; border: 1px solid #ddd; border-radius: 4px; padding: 2px;">
                            <?php else: ?>
                                <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">
                                    <span class="dashicons dashicons-format-image"></span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><strong>EP-<?php echo esc_html($item['id']); ?></strong></td>
                        <td style="font-weight: 500; color: #1d2327;"><?php echo esc_html($item['name']); ?></td>
                        <td style="text-align: center; font-size: 16px; font-weight: bold; color: #00B4D8;">
                            <?php echo esc_html($item['quantity']); ?>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?php echo get_edit_post_link($item['id']); ?>" target="_blank" class="button button-small">Voir le produit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color: red;">Erreur lors de la lecture des produits.</p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 30px; text-align: right;">
        <a href="mailto:<?php echo esc_attr($email); ?>?subject=Suite à votre demande de devis sur Effe Plast" class="button button-primary button-large" style="background: #00B4D8; border-color: #00B4D8;">
            <span class="dashicons dashicons-email" style="margin-top: 4px; margin-right: 5px;"></span> Répondre au client
        </a>
    </div>
    <?php
}

/**
 * Register Custom Post Type: Messages Contact (Private for admin only)
 */
function ep_register_messages_contact_cpt() {
    $labels = array(
        'name'                  => _x( 'Messages Contact', 'Post Type General Name', 'effeplast' ),
        'singular_name'         => _x( 'Message Contact', 'Post Type Singular Name', 'effeplast' ),
        'menu_name'             => __( 'Messages Reçus', 'effeplast' ),
        'all_items'             => __( 'Tous les Messages', 'effeplast' ),
        'view_item'             => __( 'Voir le Message', 'effeplast' ),
        'not_found'             => __( 'Aucun message trouvé', 'effeplast' ),
    );
    $args = array(
        'label'                 => __( 'Message Contact', 'effeplast' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'custom-fields' ), // Title will be "Message - [Name] - [Date]"
        'hierarchical'          => false,
        'public'                => false, // Private!
        'show_ui'               => false, // We will build a custom dashboard similar to quotes
        'show_in_menu'          => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'ep_message_contact', $args );
}
add_action( 'init', 'ep_register_messages_contact_cpt', 0 );

/**
 * Custom Admin Menu for Contact Messages Dashboard
 */
function ep_add_contact_messages_admin_menu() {
    add_menu_page(
        'Messages Reçus', // Page title
        'Messages Reçus', // Menu title
        'manage_options', // Capability
        'ep-messages-dashboard', // Menu slug
        'ep_messages_dashboard_page', // Callback function
        'dashicons-email', // Icon
        7 // Position
    );
}
add_action( 'admin_menu', 'ep_add_contact_messages_admin_menu' );

/**
 * Main Callback for Messages Dashboard Page
 */
function ep_messages_dashboard_page() {
    // Determine view: list or single
    $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'list';
    $post_id = isset($_GET['id']) ? absint($_GET['id']) : 0;

    echo '<div class="wrap" style="max-width: 1200px;">';
    echo '<h1>Gestion des Messages de Contact</h1>';

    if ( $action === 'view' && $post_id > 0 ) {
        ep_render_single_message_view( $post_id );
    } else {
        ep_render_messages_list_view();
    }

    echo '</div>';
}

/**
 * Render the Messages List Dashboard
 */
function ep_render_messages_list_view() {
    $filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
    $custom_date = isset($_GET['custom_date']) ? sanitize_text_field($_GET['custom_date']) : '';

    // Base Query Args
    $args = array(
        'post_type'      => 'ep_message_contact',
        'posts_per_page' => 50,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    // Apply Date Filtering
    if ( !empty($custom_date) ) {
        $args['date_query'] = array(
            array(
                'year'  => date( 'Y', strtotime( $custom_date ) ),
                'month' => date( 'm', strtotime( $custom_date ) ),
                'day'   => date( 'd', strtotime( $custom_date ) ),
            ),
        );
    } else {
        // Preset filters
        switch ($filter) {
            case 'today':
                $args['date_query'] = array(
                    array(
                        'year'  => date( 'Y' ),
                        'month' => date( 'm' ),
                        'day'   => date( 'd' ),
                    ),
                );
                break;
            case 'yesterday':
                $args['date_query'] = array(
                    array(
                        'year'  => date( 'Y', strtotime( '-1 days' ) ),
                        'month' => date( 'm', strtotime( '-1 days' ) ),
                        'day'   => date( 'd', strtotime( '-1 days' ) ),
                    ),
                );
                break;
            case 'last7':
                $args['date_query'] = array(
                    array(
                        'after' => '1 week ago',
                    ),
                );
                break;
            case 'last30':
                $args['date_query'] = array(
                    array(
                        'after' => '1 month ago',
                    ),
                );
                break;
        }
    }

    $messages_query = new WP_Query( $args );

    // UI Filters Bar
    ?>
    <div style="background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
        <form method="GET" action="admin.php" style="display:flex; flex-wrap: wrap; gap: 15px; align-items: center;">
            <input type="hidden" name="page" value="ep-messages-dashboard">

            <h3 style="margin: 0; padding-right: 10px; font-size: 14px;">Filtrer par date :</h3>

            <div style="display: flex; gap: 10px;">
                <button type="submit" name="filter" value="today" class="button <?php echo $filter == 'today' && empty($custom_date) ? 'button-primary' : ''; ?>">Aujourd'hui</button>
                <button type="submit" name="filter" value="yesterday" class="button <?php echo $filter == 'yesterday' && empty($custom_date) ? 'button-primary' : ''; ?>">Hier</button>
                <button type="submit" name="filter" value="last7" class="button <?php echo $filter == 'last7' && empty($custom_date) ? 'button-primary' : ''; ?>">7 derniers jours</button>
                <button type="submit" name="filter" value="last30" class="button <?php echo $filter == 'last30' && empty($custom_date) ? 'button-primary' : ''; ?>">Le mois dernier</button>
                <a href="?page=ep-messages-dashboard&filter=all" class="button <?php echo $filter == 'all' && empty($custom_date) ? 'button-primary' : ''; ?>">Tout voir</a>
            </div>

            <div style="margin-left: 20px; display: flex; align-items: center; gap: 10px; border-left: 1px solid #ddd; padding-left: 20px;">
                <label for="custom_date" style="font-weight: 600;">Date spécifique :</label>
                <input type="date" name="custom_date" id="custom_date" value="<?php echo esc_attr($custom_date); ?>" style="line-height: normal;">
                <button type="submit" class="button">Chercher</button>
                <?php if(!empty($custom_date)): ?>
                    <a href="?page=ep-messages-dashboard" style="color: #d63638; text-decoration: none;">&times; Effacer</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <table class="wp-list-table widefat fixed striped table-view-list">
        <thead>
            <tr>
                <th class="manage-column column-title" style="width: 80px;">N°</th>
                <th class="manage-column" style="width: 150px;">Date & Heure</th>
                <th class="manage-column">Expéditeur</th>
                <th class="manage-column">Sujet</th>
                <th class="manage-column" style="width: 100px;">Statut</th>
                <th class="manage-column" style="width: 150px; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ( $messages_query->have_posts() ) {
                while ( $messages_query->have_posts() ) {
                    $messages_query->the_post();
                    $post_id = get_the_ID();

                    $name = get_post_meta( $post_id, '_ep_msg_name', true );
                    $subject = get_post_meta( $post_id, '_ep_msg_subject', true );
                    $status = get_post_meta( $post_id, '_ep_msg_status', true );

                    $status_badge = $status == 'lu' ? '<span style="background:#e5f5fa; color:#005a9e; padding:3px 8px; border-radius:12px; font-size:12px; font-weight:600;">Lu</span>' : '<span style="background:#f0b849; color:#fff; padding:3px 8px; border-radius:12px; font-size:12px; font-weight:600;">Nouveau</span>';
                    ?>
                    <tr>
                        <td><strong>#<?php echo $post_id; ?></strong></td>
                        <td><?php echo get_the_date('d/m/Y') . ' à ' . get_the_time('H:i'); ?></td>
                        <td><strong><?php echo esc_html($name); ?></strong></td>
                        <td><?php echo esc_html($subject); ?></td>
                        <td><?php echo $status_badge; ?></td>
                        <td style="text-align: center;">
                            <a href="?page=ep-messages-dashboard&action=view&id=<?php echo $post_id; ?>" class="button button-primary">Lire le message</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6" style="text-align: center; padding: 30px;">Aucun message trouvé pour cette période.</td></tr>';
            }
            wp_reset_postdata();
            ?>
        </tbody>
    </table>
    <?php
}

/**
 * Render Single Message Details Page
 */
function ep_render_single_message_view($post_id) {
    // Check if post exists and is of correct type
    $post = get_post($post_id);
    if(!$post || $post->post_type !== 'ep_message_contact') {
        echo '<div class="notice notice-error"><p>Message introuvable.</p></div>';
        echo '<a href="?page=ep-messages-dashboard" class="button">&laquo; Retour à la liste</a>';
        return;
    }

    // Mark as read
    update_post_meta($post_id, '_ep_msg_status', 'lu');

    // Get Meta
    $name = get_post_meta($post_id, '_ep_msg_name', true);
    $email = get_post_meta($post_id, '_ep_msg_email', true);
    $subject = get_post_meta($post_id, '_ep_msg_subject', true);
    $message = get_post_meta($post_id, '_ep_msg_content', true);

    // Style for the admin view
    ?>
    <style>
        .ep-admin-card { background: #fff; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04); padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .ep-admin-label { font-size: 12px; font-weight: 600; color: #646970; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; display: block; }
        .ep-admin-val { font-size: 15px; color: #1d2327; margin: 0 0 15px 0; }
    </style>

    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <a href="?page=ep-messages-dashboard" class="button">&laquo; Retour aux messages</a>
        <span style="font-size: 16px; color: #646970;">Reçu le : <strong><?php echo get_the_date('d F Y', $post) . ' à ' . get_the_time('H:i', $post); ?></strong></span>
    </div>

    <!-- Client Details -->
    <div class="ep-admin-card" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #f0f0f1; font-size: 18px;">Expéditeur</h2>
            <span class="ep-admin-label">Nom complet</span>
            <p class="ep-admin-val"><strong><?php echo esc_html($name); ?></strong></p>
            <span class="ep-admin-label">Email</span>
            <p class="ep-admin-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
        </div>
        <div>
            <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #f0f0f1; font-size: 18px;">Sujet</h2>
            <p class="ep-admin-val" style="margin-top: 15px; font-weight: bold;"><?php echo esc_html($subject); ?></p>
        </div>
    </div>

    <!-- Message Body -->
    <div class="ep-admin-card">
        <h2 style="margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #f0f0f1; font-size: 18px;">Message</h2>
        <div style="background: #f9f9f9; padding: 20px; border-left: 4px solid #00B4D8; color: #333; font-size: 15px; line-height: 1.6; white-space: pre-wrap;">
            <?php echo esc_html($message); ?>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: right;">
        <a href="mailto:<?php echo esc_attr($email); ?>?subject=RE: <?php echo esc_attr($subject); ?>" class="button button-primary button-large" style="background: #00B4D8; border-color: #00B4D8;">
            <span class="dashicons dashicons-email" style="margin-top: 4px; margin-right: 5px;"></span> Répondre
        </a>
    </div>
    <?php
}

/**
 * Handle Contact Form Submission
 */
function ep_handle_submit_contact() {
    // Verify nonce
    if ( ! isset( $_POST['ep_contact_nonce'] ) || ! wp_verify_nonce( $_POST['ep_contact_nonce'], 'ep_submit_contact_nonce' ) ) {
        wp_die( 'La vérification de sécurité a échoué. Veuillez réessayer.' );
    }

    // Retrieve and sanitize fields
    $name = sanitize_text_field( $_POST['nom'] );
    $email = sanitize_email( $_POST['email'] );
    $subject = sanitize_text_field( $_POST['sujet'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // Save to Database (CPT ep_message_contact)
    $post_title = 'Message de ' . $name . ' - ' . wp_date( 'd/m/Y' );

    $post_data = array(
        'post_title'   => $post_title,
        'post_status'  => 'publish',
        'post_type'    => 'ep_message_contact',
        'post_author'  => 1
    );

    $post_id = wp_insert_post( $post_data );

    if ( ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_ep_msg_name', $name );
        update_post_meta( $post_id, '_ep_msg_email', $email );
        update_post_meta( $post_id, '_ep_msg_subject', $subject );
        update_post_meta( $post_id, '_ep_msg_content', $message );
        update_post_meta( $post_id, '_ep_msg_status', 'nouveau' );
    }

    // Send Email to Admin
    $to_admin = 'effeplast.kenitra@gmail.com';
    $subject_admin = 'Nouveau Message de Contact : ' . $subject;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $headers[] = 'From: ' . $name . ' <' . $email . '>';
    $headers[] = 'Reply-To: ' . $email;

    $body_admin = '<h2>Nouveau message depuis la page Contact d\'Effe Plast</h2>';
    $body_admin .= '<p><strong>Nom :</strong> ' . $name . '</p>';
    $body_admin .= '<p><strong>Email :</strong> ' . $email . '</p>';
    $body_admin .= '<p><strong>Sujet :</strong> ' . $subject . '</p>';
    $body_admin .= '<p><strong>Message :</strong><br>' . nl2br($message) . '</p>';

    wp_mail( $to_admin, $subject_admin, $body_admin, $headers );

    // Redirect with success flag
    $redirect_url = add_query_arg( 'contact_success', '1', home_url('/contact') );
    wp_redirect( $redirect_url );
    exit();
}
add_action( 'admin_post_nopriv_ep_submit_contact', 'ep_handle_submit_contact' );
add_action( 'admin_post_ep_submit_contact', 'ep_handle_submit_contact' );
