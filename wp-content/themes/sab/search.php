<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="boxstyle">
					<div class="boxstylecontent">
						<header class="page-header">
							<h1><?php printf( __( 'Search Results for: %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header>
					</div>
				</div>
				
				<div class="boxstyle">
					<div class="boxstylecontent clearfix" style="padding: 10px 0;">
						<?php /* Display navigation to next/previous pages when applicable */ ?>
						<?php if ( $wp_query->max_num_pages > 1 ) : ?>
							<nav id="nav-above">
								<span class="searchresult"><?php _e( 'Post navigation', 'toolbox' ); ?></h2>
								<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
							</nav><!-- #nav-above -->
						<?php endif; ?>
						
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

			<?php else : ?>

				<div class="boxstyle">
					<div class="boxstylecontent">
						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<span class="searchresults_title"><?php _e( 'Nothing Found', 'toolbox' ); ?></span>
							</header><!-- .entry-header -->
		
							<div class="entry-content">
								<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'toolbox' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
					</div>
				</div>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>