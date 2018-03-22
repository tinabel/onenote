<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="author" content="<?php echo get_bloginfo('author'); ?>">

    <link href="<?php echo get_template_directory_uri();?>/onenote.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head();?>
</head>
    <body <?php body_class(); ?>>
        <div class="grid-container">
            <header class="masthead" style="background: transparent; background-image:url(<?php header_image(); ?>); background-repeat:no-repeat;background-position: center center">
                <a class="skip-link" href="#navigation">Skip to navigation</a>
                <a class="skip-link" href="#main">Skip to content</a>
                <h1 class="title">
                    <a href="<?php echo esc_url( site_url());?>">
                        <?php echo get_bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <p class="lead description"><?php echo get_bloginfo( 'description' ); ?></p>
            </header>
            <div id="navigation" class="site-navigation">
                    <nav class="nav">
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'header-menu',
                                'container_class' => 'header-menu'
                            )
                        ); ?>
                    </nav>
            </div>
