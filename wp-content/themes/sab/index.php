<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

get_header();

 ?>

		<div id="primary">
			<div id="content" role="main">
			
				<?php /* Start the Loop */ 
					$postCount = 1;
				?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<div class="postwrapper post_<?php echo $postCount; ?>">
						<?php get_template_part( 'content', 'index' ); ?>
						<?php 
							if ($postCount == 2) {
								$GLOBALS['onlyWideScreen'] = true;
								get_template_part( 'widgets', 'artistsandlocations' );
								$GLOBALS['onlyWideScreen'] = false;
							}
						?>
					</div>

					<?php if ($postCount==2) { ?>
						<div class="homepagecolumnleft">
					<?php } elseif ($postCount==4) {
						$GLOBALS['onlyWideScreen'] = true;
						get_template_part( 'widgets', 'recentcomments' );
						$GLOBALS['onlyWideScreen'] = false;
					?>
						</div><div class="homepagecolumnright">
					<?php } elseif ($postCount == 7) { ?>
						</div>
					<?php } ?>
					<?php $postCount++; ?>

				<?php endwhile; ?>
				
<br style="clear: both;" />

				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<h1 class="section-heading"><?php _e( 'Post navigation', 'toolbox' ); ?></h1>
						<div class="paging">
							<?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } ?>
						</div>
					</nav><!-- #nav-below -->
				<?php endif; ?>		
				
				<div class="onlysmallscreen">
					<div>
					<?php
					get_template_part( 'widgets', 'artistsandlocations' );	
					?>
					</div>
					<?php
					get_template_part( 'widgets', 'recentcomments' );	
					?>
				</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>