<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<div class="clearfix">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="articlecolumnleft">
		<div class="boxstyle">
			<div class="boxstylecontent">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<span class="highlight">
					<time class="date entry-date" datetime="<?php the_date('c'); ?>" pubdate>Posted on <?php echo get_the_date('F j, Y'); ?></time>
					<?php
						printf( 'by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
							get_author_posts_url( get_the_author_meta( 'ID' ) ),
							sprintf( esc_attr__( 'View all posts by %s', 'toolbox' ), get_the_author() ),
							get_the_author()
						);
					?>
					</span>
				</header><!-- .entry-header -->
			
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			
				<footer class="entry-meta">
					<div class="socialWidgets clearfix">
						<div class="twitter alignleft">
							<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="horizontal" data-via="streetartbel">Tweet</a>
						</div>
						<div class="facebook alignleft">
							<fb:like href="<?php the_permalink(); ?>" send="false" layout="button_count" width="100" show_faces="false" font="arial"></fb:like>
						</div>
					</div>
				
					<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="highlight edit-link">', '</span>' ); ?>
			
				</footer><!-- .entry-meta -->
		
			</div>
		</div>
	
		<div class="boxstyle">
			<div class="boxstylecontent">
				<?php comments_template( '', true ); ?>
			</div>
		</div>

	</div>

	<div class="articlecolumnright">
		<?php get_template_part( 'widgets', 'postcategories' ); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->

</div>
