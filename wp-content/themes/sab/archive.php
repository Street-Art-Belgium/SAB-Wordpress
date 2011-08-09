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
							<h1 class="page-title">
								<?php if ( is_day() ) : ?>
									<?php printf( __( 'Daily Archives: <span>%s</span>', 'toolbox' ), get_the_date() ); ?>
								<?php elseif ( is_month() ) : ?>
									<?php printf( __( 'Monthly Archives: <span>%s</span>', 'toolbox' ), get_the_date( 'F Y' ) ); ?>
								<?php elseif ( is_year() ) : ?>
									<?php printf( __( 'Yearly Archives: <span>%s</span>', 'toolbox' ), get_the_date( 'Y' ) ); ?>
								<?php else : ?>
									<?php _e( 'Blog Archives', 'toolbox' ); ?>
								<?php endif; ?>
							</h1>
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