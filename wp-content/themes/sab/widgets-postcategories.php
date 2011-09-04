<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<?php 

	$originalPost = $post;

	$categories = get_the_category(); 

	$categories = SAB_Tools::sortPropertyAlphaByColumn($categories, 'category_parent');

	foreach($categories as $category)
	{
		if ($category->category_parent == 4)
		{
			echo '<div class="categorydetails boxstyle clearfix" data-url="/category/locations/' . $category->slug. '"><div class="boxstylecontent">';
			echo "<h3><a href=\"/category/artists/" . $category->slug. "\" class=\"black\">" . $category->name . "</a></h3>";
			echo "<a href=\"/category/artists/" . $category->slug. "\" class=\"highlight\">More information</a></h3>";

			$original_query = $wp_query;
			$wp_query = null;
			$original_post = $post;

			// Create a new instance
			$second_query = new WP_Query( 'cat='. $category->cat_ID . '&posts_per_page=5' );

			// The Loop
			$postlist = array();
			foreach($second_query->posts as $p)
			{
				if ($p->ID !== $originalPost->ID)
				{
					$postlist[] = $p;
				}
			}
			
			$wp_query = null;
			$wp_query = $original_query;
			$post = $original_post;
			wp_reset_postdata();

			if (!empty($postlist) OR $category->category_description)
			{
				echo '<div class="categorycontent clearfix">';

				if (!empty($postlist))
				{
					echo "<ul class=\"otherpieces clearfix\">";
					foreach ($postlist as $post) {
						?> <li><a href="<?php the_permalink(); ?>">
						<div class="entry-image" style="background-image:url(
						<?php echo sab_findfirstimageurl($post->post_content); ?>);"></div></a></li> <?php
				 	}
					echo "</ul>";
				}

				if ($category->category_description)
				{
					$categorydesc = trim(preg_replace('/<!--(.*?)-->/', '', $category->category_description));
					$categorydesc = strip_tags($categorydesc);
					if ($categorydesc) {
						echo "<div class=\"description\">" . substr($category->category_description, 0, 100) . 
						"<a href=\"/category/artists/" . $category->slug. "\">&hellip;</a></div>";	
					}
					
				}
				echo '</div>';
			}
			echo '</div></div>';
		}
		elseif ($category->category_parent == 5)
		{
			echo '<div class="categorydetails clearfix boxstyle" data-url="/category/locations/' . $category->slug. '"><div class="boxstylecontent">';
			echo '<a href="javascript:jQuery(\'#locationContent\').toggle(); return false;"><span class="toggleArrow"></span></a>';
			echo "<h3><a href=\"/category/locations/" . $category->slug. "\" class=\"black\">Location</a></h3>";

			echo "<a href=\"/category/locations/" . $category->slug. "\" class=\"highlight\">" . $category->name . "</a>";

			if ($originalPost->ID && get_post_meta( absint($originalPost->ID), WPGEO_LATITUDE_META, true ))
			{
				echo '<div class="categorycontent clearfix" id="locationContent">';
				echo '	<div class="onlywidescreen" style="margin-top: 10px;">';
				echo 		get_wpgeo_post_map($originalPost->ID, "250");
				echo '	</div>';
				if (function_exists('get_wpgeo_post_static_map')) {
					echo '<div class="staticmap onlysmallscreen">';
					echo '	<a href="' . wpgeo_map_link('echo=0') . '">';
					echo 		get_wpgeo_post_static_map($originalPost->ID, "width=600&height=400");
					echo '	</a>';
					echo '</div>';
				}
				echo '</div>';	
			}

			echo '</div></div>';
		}
	}
?>

<script>
	jQuery(document).ready(function() {
		jQuery('.categorydetails').click(function(event) {
			var el = event.srcElement;
			if (jQuery(el).closest('a').length) {
				return;
			}
			if (jQuery(el).closest('#locationContent').length) {
				return;
			}
			var url = jQuery(this).data('url');
			if (url) {
				window.location = url;
				event.preventDefault();
			}
		});
	});
</script>