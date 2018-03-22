<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="post-meta"><?php the_date(); ?>
        <a href="<?php get_bloginfo('author'); ?>"><?php the_author(); ?></a>
    </p>

    <?php the_content( $more_link_text = null, $strip_teaser = false ); ?>
    Category: <?php the_category( $separator = '', $parents = '', $post_id = false ); ?>
    <p class="tags">
        <?php the_tags( 'Tags: ', ', ', '<br />' );?>
    </p>
</article>
