<?php
    /*
        Template Name: index page
    */
?>
    <?php get_header(); ?>
    <div id="main" role="main">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
        ?>
    <?php endwhile; ?>
    <nav class="pagination">
        <ul>
            <li class="previous"><?php next_posts_link( 'Previous' ); ?></li>
            <li class="next"><?php previous_posts_link( 'Next' ); ?></li>
        </ul>
    </nav>
    <?php else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
