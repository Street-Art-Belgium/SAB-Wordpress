<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<article class="featured" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="featuredcontent">

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'toolbox' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<time class="date highlight entry-date" datetime="<?php the_date('c'); ?>" pubdate>Posted on <?php echo get_the_date('F j, Y'); ?></time>

		<a href="<?php the_permalink(); ?>">
			<div class="entry-image" style="background-image:url(<?php echo sab_findfirstimageurl(get_the_content()); ?>);"></div>
		</a>

		<!-- <div class="excerpt"><?php the_excerpt(); ?></div> -->

		<div style="margin-top: 12px;">
			<div class="socialWidgets alignleft">
				<div class="twitter alignleft">
					<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="streetartbel">Tweet</a>
				</div>
				<div class="facebook alignleft">
					<fb:like href="<?php the_permalink(); ?>" send="false" layout="button_count" width="100" show_faces="false" font="arial"></fb:like>
				</div>
			</div>
	
			<div class="alignright">
				<a href="<?php the_permalink(); ?>" class="readmore">&raquo; READ MORE</a>
			</div>			
		</div>
		
	</div><!-- .entry-content -->

</div>
</article><!-- #post-<?php the_ID(); ?> -->
