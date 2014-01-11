<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <link href="<?php echo get_template_directory_uri(); ?>/js/swipebox/source/swipebox.css" rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

    <link href="<?php echo get_template_directory_uri(); ?>/style.css?v=4" rel='stylesheet' type='text/css'>

    <script src="<?php echo get_template_directory_uri(); ?>/js/shims.js?v=5"></script>

</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site" data-id="<?php echo get_the_ID(); ?>">

		<header id="masthead" class="site-header" role="banner">

	        <div class="nav-container">

		        <div class="nav-top">
                    <div class="cl">&nbsp;</div>
			        <img class="adapt" src="<?php echo get_template_directory_uri(); ?>/images/top.png" />
		        </div>

		        <div class="nav-inner">

                    <a href="<?php echo site_url(); ?>">

			            <img class="adapt mobile-toggle" src="<?php echo get_template_directory_uri(); ?>/images/title.png" />

			            <div class="brand-a">
				            <div class="brand-a-a mobile-toggle">The Graphic Design Portfolio of</div>
				            <hr />
				            <span class="brand-a-b">MARISA KURK</span>
			            </div>

                    </a>

			        <div class="icons-a">

                        <div class="nav-title hidden">
                            <span class="nav-title-wrap"><span class="nav-title-text">&nbsp;</span></span>
                        </div>
                        
                        <?php

                            //Find all pages that are set as a portfolio page.
                            $portfolio_pages_args = array(
                                'post_type' => 'page',
                                'post_status' => 'publish',
                                'meta_query' => array(
                                    array(
                                        'key' => '_wp_page_template',
                                        'value' => 'portfolio-template.php',
                                    )
                                )
                            );

                            $portfolio_pages = array();

                            $portfolio_pages_loop = new WP_Query($portfolio_pages_args);

                            while ( $portfolio_pages_loop->have_posts() ) : 
        
                                $portfolio_pages_loop->the_post();

                                array_push($portfolio_pages, get_the_ID());

                            endwhile;

                            wp_reset_postdata(); //This allows having multiple wp loops on one page. With this snippet we will be able to run another wp loop later in the page.  

                            //Now that we have all the pages classified as a portfolio '$portfolio_pages' we can query all of their children to show in the nav:

                            $portfolio_children = array(
                                'post_type'  => 'page',
                                'post_parent__in' => $portfolio_pages,
                                'sort_column' => 'menu_order',
                                'orderby' => 'menu_order',
                                'order' => 'ASC'
                            );

                            $portfolio_children_loop = new WP_Query( $portfolio_children );

                            $truncateThreshold = 15;

                            while ( $portfolio_children_loop->have_posts() ) : 
        
                                $portfolio_children_loop->the_post();

                                if(get_field('page_icon') != ''){

                                    $theTitle = get_the_title();

                                    $ellipsis = (strlen($theTitle) > $truncateThreshold) ? '..' : '';

                                    echo '<a href="' . get_permalink() . '" title="'. $theTitle .'" data-title-truncated="'. substr($theTitle, 0, $truncateThreshold) . $ellipsis . '" data-id="'. get_the_ID() .'">';

                                    echo '<img src="' . get_field('page_icon') . '" /></a>';
                                }

                            endwhile;
                            
                        ?>

                        <?php wp_reset_postdata(); //This allows having multiple wp loops on one page. With this snippet we will be able to run another wp loop later in the page. ?>                  
                        				
				        <div class="cl">&nbsp;</div>
			        </div>					

			        <div class="cl">&nbsp;</div>

			        <div class="icons-b mobile-toggle">

				        <nav id="site-navigation" class="navigation main-navigation" role="navigation">

                            <?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); 
 
                            $top_level_pages_args = array(
                                'post_type'  => 'page',
                                'post_parent' => '0',
                                'post_status' => 'publish',
                                'sort_column' => 'menu_order',
                                'orderby' => 'menu_order',
                                'order' => 'ASC'
                            );

                            $top_level_pages_loop = new WP_Query( $top_level_pages_args );

                            while ( $top_level_pages_loop->have_posts() ) : 
        
                                $top_level_pages_loop->the_post();

                                if(get_field('page_icon') != '' && strpos(get_page_template(), 'portfolio-template') == ''  ){

                                    echo '<a href="' . get_permalink() . '" title="'. get_the_title() .'" data-id="'. get_the_ID() .'">';

                                    echo '<img src="' . get_field('page_icon') . '" /></a>';
                                }

                            endwhile;  

                            ?>

				        </nav><!-- #site-navigation -->

                        <div class="cl">&nbsp;</div>

			        </div>

		        </div>
	        </div>

            <div class="menu-toggle">
                <span>=</span>
            </div>

            <div class="cl">&nbsp;</div>

		</header><!-- #masthead -->

		<div id="main" class="site-main">
