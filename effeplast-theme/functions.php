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
