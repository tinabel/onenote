<?php


        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'custom-header' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'menus' );

        set_post_thumbnail_size( 200,200,true);
        /**
         * Registers an editor stylesheet for the theme.
         */
        function wpdocs_theme_add_editor_styles() {
            add_editor_style( 'custom-editor-style.css' );
        }

        function onenote_excerpt_length( $length ) {
            return 50;
        }
        add_filter( 'excerpt_length', 'onenote_excerpt_length', 999 );

        function onenote_excerpt_more( $more ) {
            return sprintf( '%2$s',
                get_permalink( get_the_ID() ),
                __( '<span class="read-more">read more</span>', 'onenote' )
            );
        }
        add_filter( 'excerpt_more', 'onenote_excerpt_more' );

        /**
     * Allow HTML Tags in Wordpress Excerpt
     *
     * @link http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt/141136
     */
    if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) :
        function wpse_custom_wp_trim_excerpt( $wpse_excerpt ) {
        $raw_excerpt = $wpse_excerpt;
            if ( '' == $wpse_excerpt ) {
                $wpse_excerpt = get_the_content( '' );
                $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
                $wpse_excerpt = apply_filters( 'the_content', $wpse_excerpt );
                $wpse_excerpt = str_replace( ']]>', ']]&gt;', $wpse_excerpt );
                //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 50;
                $excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count );
                $tokens = array();
                $excerptOutput = '';
                $count = 0;
                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all( '/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens );
                foreach ( $tokens[0] as $token ) {
                    if ( $count >= $excerpt_length && preg_match( '/[\,\;\?\.\!]\s*$/uS', $token ) ) {
                        // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim( $token );
                        break;
                    }
                    // Add words to complete sentence
                    $count++;
                    // Append what's left of the token
                    $excerptOutput .= $token;
                }
                $wpse_excerpt = trim( force_balance_tags( $excerptOutput ) );
                    $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf( __( 'Read more about: %s &nbsp;&raquo;', 'wpse' ), get_the_title() ) . '</a>';
                    $excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );
                    $wpse_excerpt .= $excerpt_more; /* Add read more in new paragraph */
                return $wpse_excerpt;
            }
            return apply_filters( 'wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt );
        }
    endif;
    remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
    add_filter( 'get_the_excerpt', 'wpse_custom_wp_trim_excerpt' );


    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width;
     */

     function onenote_content_width() {

        $content_width = $GLOBALS['content_width'];

        // Get layout.
        $page_layout = get_theme_mod( 'page_layout' );

        // Check if layout is one column.
        if ( 'one-column' === $page_layout ) {
            if ( is_frontpage() ) {
                $content_width = 1024;
            } elseif ( is_page() ) {
                $content_width = 1024;
            }
        }

        // Check if is single post and there is no sidebar.
        if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
            $content_width = 1024;
        }

        /**
         * Filter One Note content width of the theme.
         *
         * @since One Note 0.0.1
         *
         * @param int $content_width Content width in pixels.
         */
        $GLOBALS['content_width'] = apply_filters( 'onenote_content_width', $content_width );
    }


    function onenote_widgets_init() {
        register_sidebar( array(
            'name' => __( 'Main Sidebar', 'onenote' ),
            'id' => 'sidebar-1',
            'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'onenote' ),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
        ) );
    }

    function add_taxonomies_to_pages() {
         register_taxonomy_for_object_type( 'post_tag', 'page' );
         register_taxonomy_for_object_type( 'category', 'page' );
         }
        add_action( 'init', 'add_taxonomies_to_pages' );
         if ( ! is_admin() ) {
         add_action( 'pre_get_posts', 'category_and_tag_archives' );
    }

    function category_and_tag_archives( $wp_query ) {
        $my_post_array = array('post','page');

         if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
         $wp_query->set( 'post_type', $my_post_array );

         if ( $wp_query->get( 'tag' ) )
         $wp_query->set( 'post_type', $my_post_array );
    }

    function wpse_theme_setup() {
        add_theme_support( 'title-tag' );
    }

    function onenote_custom_header_setup() {
        $args = array(
            'default-image'      => get_template_directory_uri() . '/default-image.jpg',
            'default-text-color' => '000',
            'width'              => 1000,
            'height'             => 300,
            'flex-width'         => true,
            'flex-height'        => true,
        );
        add_theme_support( 'custom-header', $args );
    }

    function theme_setup(){
        load_theme_textdomain( 'onenote', get_template_directory() . '/languages' );
    }

    /**
     * Functions which enhance the theme by hooking into WordPress.
     */
    require get_template_directory() . '/inc/template-functions.php';

    /**
     * Customizer additions.
     */
    require get_template_directory() . '/inc/customizer.php';


add_action( 'widgets_init', 'onenote_widgets_init' );
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
add_action( 'after_setup_theme', 'onenote_custom_header_setup' );
add_action( 'after_setup_theme', 'wpse_theme_setup' );
add_action( 'template_redirect', 'onenote_content_width', 0 );
add_action( 'after_setup_theme', 'theme_setup' );
?>
