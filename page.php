<?php get_header(); ?>
<section class="main" id="main">
            <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    get_template_part( 'content', get_post_format() );
                    wp_link_pages();
                endwhile; endif;
            ?>

</section>
<?php get_footer(); ?>
