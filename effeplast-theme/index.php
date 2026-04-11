<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen py-24">
    <div class="container mx-auto px-4 lg:px-8">
        <header class="page-header mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-ep-blue-night mb-4">
                <?php single_post_title(); ?>
            </h1>
        </header>

        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-modern p-8 md:p-12">
            <?php
            if ( have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-lg max-w-none'); ?>>
                        <header class="entry-header mb-8">
                            <?php if ( is_singular() ) : ?>
                                <!-- Single post/page title is already shown above or handled by specific templates -->
                            <?php else : ?>
                                <h2 class="entry-title text-3xl font-bold text-ep-blue-night mb-4 hover:text-ep-cyan transition-colors">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>
                            <?php endif; ?>

                            <?php if ( 'post' === get_post_type() ) : ?>
                                <div class="entry-meta text-sm text-gray-500 mb-6 flex items-center gap-4">
                                    <span class="flex items-center gap-2"><i class="fas fa-calendar text-ep-cyan"></i> <?php echo get_the_date(); ?></span>
                                    <span class="flex items-center gap-2"><i class="fas fa-user text-ep-cyan"></i> <?php the_author(); ?></span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <?php if ( has_post_thumbnail() && !is_singular() ) : ?>
                            <div class="post-thumbnail mb-8 rounded-2xl overflow-hidden shadow-sm">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto hover:scale-105 transition-transform duration-500' ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content text-gray-600 leading-relaxed">
                            <?php
                            if ( is_singular() ) :
                                the_content();
                            else :
                                the_excerpt();
                                ?>
                                <div class="mt-6">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center text-ep-cyan font-semibold hover:text-ep-primary transition-colors">
                                        Lire la suite <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </article>
                    <?php

                    // Separator between posts if it's a list
                    if ( !is_singular() && $wp_query->current_post + 1 < $wp_query->post_count ) :
                        echo '<hr class="my-12 border-gray-100">';
                    endif;

                endwhile;

                the_posts_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'effeplast' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'effeplast' ) . '</span> <span class="nav-title">%title</span>',
                        'class'     => 'mt-12 flex justify-between items-center text-ep-blue-night font-semibold',
                    )
                );

            else :
                ?>
                <section class="no-results not-found text-center py-12">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-3xl text-gray-300"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-ep-blue-night mb-4">Rien trouvé</h2>
                    <p class="text-gray-600">Il semblerait que nous ne puissions pas trouver ce que vous cherchez. Peut-être qu'une recherche peut aider.</p>
                    <div class="mt-8 max-w-md mx-auto">
                        <?php get_search_form(); ?>
                    </div>
                </section>
                <?php
            endif;
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
