<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

				<div class="boxstyle">
					<div class="boxstylecontent">
						<?php the_post(); ?>
						<header class="page-header">
							<h1 class="page-title author"><?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'toolbox' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>
						</header>
						<?php rewind_posts(); ?>		
					</div>
				</div>
				
				<div class="boxstyle">
					<div class="boxstylecontent">
						<div class="clearfix">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'archive' ); ?>
							<?php endwhile; ?>
						</div>
						
						<?php /* Display navigation to next/previous pages when applicable */ ?>
						<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<nav id="nav-below">
								<h1 class="section-heading"><?php _e( 'Post navigation', 'toolbox' ); ?></h1>
								<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
							</nav><!-- #nav-below -->
						<?php endif; ?>	
					</div>
				</div>
				
			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>