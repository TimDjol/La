<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">

     <title><?php bloginfo('name'); ?><?php wp_title("|", true); ?></title>

    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta property="og:image" content="path/to/image.jpg">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="i<?php echo esc_url( get_template_directory_uri() ); ?>/mg/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/apple-touch-icon-114x114.png">
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <style>body { opacity: 0; overflow-x: hidden; } html { background-color: #fff; }</style>

    <?php wp_head(); ?>

</head>

<body>



<header>
       

    <nav id="w" class="navbar navbar-fixed-top">
            
        <div class="container">
            <div class="row">
                
                    <div class="container cont_head">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 phone">
                                    <p>Телефон: <? if(get_theme_mod('tel') != null){?><a href="<?php echo get_theme_mod('tel', '0777111444, 0555111000');?>"><?php echo get_theme_mod('tel', '0777111444, 0555111000');?></a><? } ?></p>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-4 col-sm-6 graf">
                                    <p>режим работы: <? if(get_theme_mod('graf') != null){?><a href="<?php echo get_theme_mod('graf', 'С 10:00 ДО 19:00');?>"><?php echo get_theme_mod('graf', 'С 10:00 ДО 19:00');?></a><? } ?></p>
                                </div>
                            </div>
                        </div>
                     
                        <header role="banner">
                            <a href="/"><img id="logo-main" src="http://la.kg/wp-content/themes/la/img/logo.png" width="200" alt="Logo Thing main logo"></a>
                        </header>
            
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#w0-collapse" aria-expanded="false">
                        <span class="sr-only">Меню</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img src="http://la.kg/wp-content/themes/la/img/logo.png" alt="logo" class="img-responsive">
                    </a>
			    </div>
                <div id="w0-collapse" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
					<?php wp_nav_menu( array( 
                                  'menu'              => 'main',
                                  'theme_location'    => 'main',
                                  'depth'             => 2,
                                  'menu_id'           => 'w1',
                                  'menu_class'        => 'navbar-nav navbar-left nav',
                                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                  'walker'            => new wp_bootstrap_navwalker())            
                        ); ?>                  
                </div>
            </div>
            
        </div>
        </div>
        </nav>
    </header>
<div class="container-fluid bag">
    <div class="row">
<!--slider-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo get_theme_mod('slidimg', '');?>" alt="">
            <div class="carousel-caption">
        		<h1><?php echo get_theme_mod('tit', '');?></h1><br>
                <p><?php echo get_theme_mod('descrip', '');?></p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<section class="logo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">

                <a class="brand" href="#"><img alt="Brand" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo11.png">
                    <span class="bgBrand"><div class="pulse"></div></span></a>
            </div>
        </div>
    </div>
</section>
