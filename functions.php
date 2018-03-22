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
            return 40;
        }
        add_filter( 'excerpt_length', 'onenote_excerpt_length', 999 );

        function onenote_excerpt_more( $more ) {
            return sprintf( '%2$s',
                get_permalink( get_the_ID() ),
                __( '...', 'onenote' )
            );
        }
        add_filter( 'excerpt_more', 'onenote_excerpt_more' );
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
                $content_width = 1000;
            } elseif ( is_page() ) {
                $content_width = 1000;
            }
        }

        // Check if is single post and there is no sidebar.
        if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
            $content_width = 1000;
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
            'default-image'      => get_template_directory_uri() . '/default-image.png',
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

add_action( 'widgets_init', 'onenote_widgets_init' );
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
add_action( 'after_setup_theme', 'onenote_custom_header_setup' );
add_action( 'after_setup_theme', 'wpse_theme_setup' );
add_action( 'template_redirect', 'onenote_content_width', 0 );
add_action( 'after_setup_theme', 'theme_setup' );
?>
