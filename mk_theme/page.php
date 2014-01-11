<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php
                        $showFeaturedImage = FALSE;
                    ?>

					<?php if ( $showFeaturedImage === TRUE && has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail('full'); ?>
					</div>
					<?php endif; ?>

                    <?php

                        $pageIcon = get_field('page_icon');
                        $pageTitleHasIconClass = '';

                        if($pageIcon != ''){
                            $pageTitleHasIconClass = 'title-icon';
                            echo '<img src="'. get_field('page_icon') .'" class="title-icon-img" alt="---" />';
                        }

                    ?>

                    <h1 class="entry-title <?php echo $pageTitleHasIconClass; ?>"><?php the_title(); ?></h1>

                    <div class="cl">&nbsp;</div>

                    <?php

                    if(get_field('project') != "-" && get_field('project') != ""){

                        echo '<table class="project-details">';
                            echo '<tr>';
                                echo '<td>[PROJECT]</td>';
                                echo '<td>' . get_field("project") . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<td>[TYPE]</td>';
                                echo '<td>' . get_field("type") . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<td>[CLASS]</td>';
                                echo '<td>' . get_field("class") . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                                echo '<td>[INSTRUCTOR]</td>';
                                echo '<td>' .  get_field("instructor") . '</td>';
                            echo '</tr>';
                        echo '</table>';

                    }            

                    ?>

					<div class="entry-content">

                        <div class="cl">&nbsp;</div>

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

<div class="cl">&nbsp;</div>

<?php get_footer(); ?>