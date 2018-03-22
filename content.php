    <div>
        <div data-url="<?php the_permalink(); ?>" class="post-link" tabindex="0" role="link">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="post-title"><?php the_title(); ?></h2>
                <?php
                 if ( has_post_thumbnail()) {
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                    the_post_thumbnail('thumbnail');
                    the_excerpt();

                } else {
                    the_excerpt();
                } ?>
            </article>
        </div>
        <p class="tags">
            <?php the_tags();?>
        </p>
    </div>
