<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$thisCat = $cat_obj->term_id;
$thisCat = get_category($thisCat);
$categoryID = $thisCat->term_id;

$specialCategories = array(4,5);
$isSpecialCategory = in_array((int) $categoryID, $specialCategories);

$categories = get_categories( array('child_of' => $thisCat->term_id, 'depth' => 1) );
$geoIsSet = false;
for ( $i = 0; $i < count($posts); $i++ ) {
	$post = $posts[$i];
	$latitude = get_post_meta($post->ID, WPGEO_LATITUDE_META, true);
	$longitude = get_post_meta($post->ID, WPGEO_LONGITUDE_META, true);
	
	if ( is_numeric($latitude) && is_numeric($longitude) ) {
		$geoIsSet = true;
	}
}

$categorydesc = category_description();
$origCategoryDesc = $categorydesc;
$categorydesc = trim(preg_replace('/<!--(.*?)-->/', '', $categorydesc));

get_header(); ?>

<section id="primary">
	<div id="content" role="main" class="clearfix">


		<?php if (($categoryID != 6) OR $geoIsSet OR $categorydesc) { ?>
			<?php if (!$isSpecialCategory) { ?><div class="clearfix"><?php } ?>
				<div class="boxstyle"
					<?php if ($isSpecialCategory) { ?> 
						style="width: 372px; float: right;"
					<?php } elseif (isset($wpgeo) && $geoIsSet) { ?>
						style="float: left; width: 471px;"
					<?php } ?>
					>
					<div class="boxstylecontent"<?php if (!$isSpecialCategory && isset($wpgeo) && $geoIsSet) { ?> style="height: 400px; overflow-y: auto;"<?php } ?>>
					
						<header class="page-header">
							<div class="clearfix">
								<?php 
									if (function_exists('dimox_breadcrumbs')) {
										dimox_breadcrumbs();
									}
								?>
							</div>
							<?php if (!$isSpecialCategory) { ?>
								<span class="highlight">About</span>
							<?php } else { ?>
								<span class="highlight">List</span>
							<?php } ?>
							<?php 
								if ( ! empty( $categorydesc ) ) {
									echo apply_filters( 
										'archive_meta', 
										'<div class="archive-meta">' . $categorydesc . '</div>'
									);
								} 
							?>
						</header>
						
						
							<?php
								 if (!empty($categories)) {
							?>
								<ul class="subcategories clearfix">
									<?php
										 $i = 0;
										 foreach($categories as $category) {
										 	$i++;
											$class = (in_array(($i % 4), array(1, 2), true)) ? 'small' : 'bold';
											echo '<li class="' . $class . '"><a href="/category/' . $thisCat->slug . '/' . $category->slug . '/">' . $category->name . '</a></li>';
										 }
									?> 
								</ul>
							<?php } ?>
						</ul>
						
					</div>
				</div>
						
				<?php
					if (!$isSpecialCategory && isset($wpgeo) && $geoIsSet) { 
				?>
					<div class="boxstyle" style="float: right; width: 471px;">
						<div class="boxstylecontent" style="padding: 0px; height: 420px;">
							<?php $wpgeo->categoryMap(array('height' => '420px')); ?>
											
						</div>
					</div>
		<?php 
				}
				if (!$isSpecialCategory) 
				{ ?>
					</div>
				<?php } 
			} 
		?>
		
		<div class="boxstyle"<?php if ($isSpecialCategory) { ?> style="width: 570px; float: left;"<?php } ?>>
			<div class="boxstylecontent clearfix">
				<div class="clearfix">
					<div class="clearfix"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
					<?php if ($categoryID != 6) { ?>
					<span class="highlight">Pieces</span>
					<?php } ?>
				</div>
			
				<div class="clearfix archivepostwrapper">
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
		
		<?php sab_printartistwidgets($origCategoryDesc); ?>

	</div><!-- #content -->
</section><!-- #primary -->

<?php get_footer(); ?>