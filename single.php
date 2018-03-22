<?php
/*
    Template Name: single page
*/
?>
<?php get_header(); ?>
    <section class="main" id="main">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                get_template_part( 'single-content', get_post_format() );
                wp_link_pages();
                wp_enqueue_script( "comment-reply" );
                wp_list_comments( $args );
                paginate_comments_links();
                comments_template();
                comment_form();
            endwhile; endif;
        ?>

    </section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
