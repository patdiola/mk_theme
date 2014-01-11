<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
            <div class="cl">&nbsp;</div>
		</div><!-- #main -->
    
        <div class="cl">&nbsp;</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
            <div class="is-mobile">Mobile-Enabled</div>
		</footer><!-- #colophon -->

        <div class="project-pagination" style="display: none;">
            <a href="#" class="project-prev">
                <div>Previous</div>
            </a>
            <a href="#" class="project-next">
                <div>Next</div>
            </a>
            <div class="cl">&nbsp;</div>
        </div>

	</div><!-- #page -->

    <?php

        if(strpos(get_page_template(), 'portfolio-template') == ''){

            echo '<div class="full-nav">';

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

                while ( $portfolio_children_loop->have_posts() ) : 
        
                    $portfolio_children_loop->the_post();

                    if(get_field('page_icon') != ''){

                        echo '<a href="' . get_permalink() . '" class="full-nav-item" title="'. get_the_title() .'" data-id="'. get_the_ID() .'">';

                        echo '<img class="full-nav-item-icon" src="' . get_field('page_icon') . '" />';

                        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

                        echo '<img class="full-nav-item-thumb" src="' . $url . '" />';

                        echo '<h2>'. get_the_title() .'</h2></a>';

                    }

                endwhile;

                echo '<div class="cl">&nbsp;</div>';

            echo '</div>';

        }

    ?>

    <div class="footer-tag">

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

                echo '<a class="footer-hotspot" href="' . get_permalink() . '" title="'. get_the_title() .'" data-id="'. get_the_ID() .'">';

                echo '<img src="'. get_field('page_icon') .'" />';

                echo '<div>'. get_the_title() .'</div></a>';
            }

        endwhile; 

        ?>

        <div class="cl">&nbsp;</div>

        <a href="<?php echo site_url(); ?>">www.marisakurk.com</a>

        <div class="cl">&nbsp;</div>

        <span>&copy; 2013 Marisa Kurk</span>

    </div>
    
    <script src="<?php echo get_template_directory_uri(); ?>/js/swipebox/source/jquery.swipebox.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/marisa.js?v=4"></script>

	<?php wp_footer(); ?>
</body>
</html>