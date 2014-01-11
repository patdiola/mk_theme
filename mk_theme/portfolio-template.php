<?php

/*
Template Name: Portfolio Template
*/

get_header(); ?>

<?php

    $thisPageId = $post->ID;
    
    $argsChildPages = array(
        'sort_column' => 'menu_order',
        'orderby' => 'menu_order',
        'order' => 'ASC',
	    'post_parent' => $thisPageId,
	    'post_type' => 'page',
	    'post_status' => 'publish'
    );

    $loop = new WP_Query( $argsChildPages );

    echo '<div class="portfolio-thumbs">';

    while ( $loop->have_posts() ) : 
        
        $loop->the_post();

        echo '<a href="' . get_permalink() . '" data-id="'. get_the_ID() .'">';

        echo '<div class="thumb-img">';
	
            the_post_thumbnail('full');

        echo '</div>';

        echo '<div class="cl">&nbsp;</div>';

        echo '<div class="portfolio-thumbnail-caption"><div class="inner"><div class="inner-content"><img src="' . get_field('page_icon') . '" /><h2>' . get_the_title() . '</h2></div></div></div>';

        echo '</a>';

    endwhile;

    echo '<div class="cl">&nbsp;</div></div>';

    //END Get all child pages

?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<!-- <h1 class="entry-title"><?php //the_title(); ?></h1> -->

					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>