    <div>
        <div onclick="location.href='<?php the_permalink(); ?>'" class="post-link">
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="post-title"><?php the_title(); ?></h2>
                <?php
                 if ( has_post_thumbnail()) {
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                    the_post_thumbnail('thumbnail');
                    the_content( $more_link_text = null, $strip_teaser = false );
                } else {
                    the_content( $more_link_text = ' read more', $strip_teaser = false );
                } ?>
            </div>
        </div>
        <p class="tags">
            <?php the_tags();?>
        </p>
    </div>
