<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<article class="archivepost" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<a href="<?php the_permalink(); ?>">
			<div class="entry-image" style="background-image:url(<?php echo sab_findfirstimageurl(get_the_content()); ?>);"></div>
		</a>

		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'toolbox' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo SAB_Tools::ellips(get_the_title(), 30); ?></a></h1>
		</header><!-- .entry-header -->
	
		<span class="highlight"><time class="date entry-date" datetime="<?php the_date('c'); ?>" pubdate><?php echo get_the_date('F j, Y'); ?></time></span>
		
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
