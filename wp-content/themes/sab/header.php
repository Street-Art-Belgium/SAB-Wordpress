<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta property="fb:admins" content="524186608" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=23" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="http://streetartbelgium.com/favicon.ico">

<script src="/js-global/FancyZoom.js" type="text/javascript"></script>
<script src="/js-global/FancyZoomHTML.js" type="text/javascript"></script>

<script src="/wp-content/themes/sab/js/cufon-yui.js" type="text/javascript"></script>
<script src="/wp-content/themes/sab/js/Kozuka_Gothic_Pro_OpenType_300-Kozuka_Gothic_Pro_OpenType_700font.js" type="text/javascript"></script>
<script type="text/javascript">
	Cufon.replace('#menulinks');
	Cufon.replace('h1');
	Cufon.replace('h2');
	Cufon.replace('h3');
    Cufon.replace('#colophon .text');
	Cufon.replace('#disqus_thread h3');
    Cufon.replace('.artistsandlocations div.item');
    Cufon.replace('a.readmore');
    Cufon.replace('.crumbs');
    Cufon.replace('.subcategories li');
	Cufon.replace('#wp_page_numbers');
</script>

<!--[if lt IE 9]>
<script src="<?php bloginfo( 'template_directory' ); ?>/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> onload="setupZoom()">

    <div id="topline"></div>
    
    <div id="site">
    
	
	<header id="branding" role="banner">
   		<div id="menu">
			<hgroup>
				<h1 id="logo"><a href="/"><img src="/wp-content/themes/sab/images/logo_SAB.png" width="273" height="190" alt="logo Street Art Belgium" /><span class="screen-reader-text">Street Art Belgium</span></a></h1>
			</hgroup>
                
			<nav id="access" role="navigation">
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>
	            		<div id="menulinks">
					<ul>
						<li><a href="/category/news/">news</a></li>
						<li><a href="/category/artists/">artists</a></li>
						<li><a href="/category/locations/">locations</a></li>
						<li><a href="/about-us/">about us</a></li>
						<li><a href="/submit-a-piece/">contact</a></li>
					</ul>
				</div>
			</nav>
        	
			<div id="socialmedia">
				<a href="http://feeds.feedburner.com/StreetArtBelgium" class="rss"><span class="screen-reader-text">RSS</span></a>
				<a href="http://www.facebook.com/StreetArtBel" class="facebook"><span class="screen-reader-text">Facebook</span></a>
				<a href="http://twitter.com/StreetArtBel" class="twitter"><span class="screen-reader-text">Twitter</span></a>
			</div>
        
			<hr style="clear:both; margin-left: 132px; top: -70px;"/>
		</div><!-- end menu -->
	</header><!-- #branding -->
        
        <div id="content">

<div id="page" class="hfeed">

	<div id="main">