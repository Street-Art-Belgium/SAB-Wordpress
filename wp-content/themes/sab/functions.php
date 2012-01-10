<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on toolbox, use a find and replace
 * to change 'toolbox' to the name of your theme in all the template files
 */
load_theme_textdomain( 'toolbox', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'toolbox' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add support for the Aside and Gallery Post Formats
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar 1', 'toolbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array (
		'name' => __( 'Sidebar 2', 'toolbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
}
add_action( 'init', 'toolbox_widgets_init' );

function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');


function dimox_breadcrumbs() {
 
  $delimiter = '<span>:</span>';
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="crumbs">';
 
    global $post;
    $homeLink = get_bloginfo('url');
  
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . '' . single_cat_title('', false) . '' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Zoekresultaten voor "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Berichten met de tag "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Berichten van ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    echo '</div>';
 
  }
} // end dimox_breadcrumbs()

/* find image url */
function sab_findfirstimageurl($text) 
{
	// The Regular Expression filter
	$regexImageUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?(\.jpg|\.png)/";

	// Check if there is a url in the text
	if (preg_match($regexImageUrl, $text, $url)) 
	{
	       // make the urls hyper links
	       return $url[0];
	}

	return "";
}

function sab_findimageurls($text) {
	// The Regular Expression filter
	$regexImageUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?(\.jpg|\.png)/";

	// Check if there is a url in the text
	if (preg_match_all($regexImageUrl, $text, $matches)) 
	{
		return array_unique($matches[0]);
	}

	return array();
}

function add_fbimage() {
	global $post;
	echo "\n\n";
	if (is_single($post)) {
		$content = $post->post_content;
		if ($content) { 
			$urls = array_slice(sab_findimageurls($content), 1);
			foreach($urls as $url) {
				echo '<meta property="og:image" content="' . $url . '"/>' . "\n";
			}
		}	
	}
	echo "\n\n";
}
add_action( 'wp_head', 'add_fbimage', 5 );

/* find facebook url */
function sab_findfacebookurl($text) 
{
	// The Regular Expression filter
	$regexUrl = "/<!--\sfacebook\:\s((http|https)\:\/\/www\.facebook\.com(\/\S*)?)\s-->/";

	// Check if there is a url in the text
	if (preg_match($regexUrl, $text, $url)) 
	{
	       // make the urls hyper links
	       return $url[1];
	}

	return "";
}

function sab_findtwittername($text) {
	// The Regular Expression filter
	$regexUrl = "/<!--\stwitter\:\s(\S*)?\s-->/";

	// Check if there is a url in the text
	if (preg_match($regexUrl, $text, $url)) 
	{
	       // make the urls hyper links
	       return $url[1];
	}

	return "";
}

function sab_findflickrname($text) {
	// The Regular Expression filter
	$regexUrl = "/<!--\sflickr\:\s(\S*)-(\S*)?\s-->/";

	// Check if there is a url in the text
	if (preg_match($regexUrl, $text, $url)) 
	{
	       // make the urls hyper links
	       return array($url[1], $url[2]);
	}

	return "";
}

function sab_findvimeousername($text) {
	// The Regular Expression filter
	$regexUrl = "/<!--\svimeo\:\s(\S*)?\s-->/";

	// Check if there is a url in the text
	if (preg_match($regexUrl, $text, $url)) 
	{
	       // make the urls hyper links
	       return $url[1];
	}

	return "";
}

function sab_printartistwidgets($text) {
	$twitterName = sab_findtwittername($text);
	if ($twitterName) {
	 	?>
			<div class="boxstyle alignright socialwidgetwrapper"><div class="boxstylecontent socialwidget">
			<h3><a href="http://twitter.com/<?php echo $twitterName; ?>"><?php single_cat_title(); ?> on twitter</a></h3>
			<div class="socialwidgetcontent">
			<script src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
			  version: 2,
			  type: 'profile',
			  rpp: 4,
			  interval: 6000,
			  width: 380,
			  height: 320,
			  theme: {
			    shell: {
			      background: '#ffffff',
			      color: '#000000'
			    },
			    tweets: {
			      background: '#ffffff',
			      color: '#000000',
			      links: '#000000'
			    }
			  },
			  features: {
			    scrollbar: false,
			    loop: false,
			    live: false,
			    hashtags: true,
			    timestamp: true,
			    avatars: false,
			    behavior: 'all'
			  }
			}).render().setUser('<?php echo $twitterName; ?>').start();
			</script>
			</div>
			</div></div>
			<?php
	}
	$facebookUrl = sab_findfacebookurl($text);
	if ($facebookUrl) {
		?>
			<div class="boxstyle alignright socialwidgetwrapper"><div class="boxstylecontent socialwidget">
			<h3><a href="<?php echo $facebookUrl; ?>"><?php single_cat_title(); ?> on facebook</a></h3>
			<div class="socialwidgetcontent">
			<fb:like-box href="<?php echo $facebookUrl; ?>" width="380" height="320" show_faces="false" border_color="#fff" stream="true" header="false"></fb:like-box>
			</div>
			</div></div>
		<?php
	}
	list($flickrName, $flickrUid) = sab_findflickrname($text);
	if ($flickrName && $flickrUid) {
		?>
			<!-- Start of Flickr Badge -->
			<div class="boxstyle alignright socialwidgetwrapper">
				<div class="boxstylecontent clearfix socialwidget">
					<h3><a href="http://www.flickr.com/photos/<?php echo $flickrName; ?>/"><?php single_cat_title(); ?> on <span id="flickr_www"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong>.com</span></a></h3>
					<div class="socialwidgetcontent">
						<div id="flickr_badge_uber_wrapper">
							<div id="flickr_badge_wrapper">
								<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&count=10&display=latest&size=s&layout=x&source=user&user=<?php echo urlencode($flickrUid); ?>"></script>
								<div id="flickr_badge_source">
									<span id="flickr_badge_source_txt">
										<nobr>Go to</nobr> <a href="http://www.flickr.com/photos/<?php echo $flickrName; ?>/"><?php single_cat_title(); ?>'s photostream</a>
									</span>
									<br clear="all" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End of Flickr Badge -->
		<?
	}
	$vimeoUserName = sab_findvimeousername($text);
	if ($vimeoUserName) {
		?>
		<!-- START Vimeo Badge ... info at http://vimeo.com/widget -->
		<div class="boxstyle alignright socialwidgetwrapper">
			<div class="boxstylecontent clearfix socialwidget">
				<h3><a href="http://vimeo.com/<?php echo $vimeoUserName; ?>/"><?php single_cat_title(); ?> on Vimeo</a></h3>
				<div class="socialwidgetcontent">
					<div class="vimeoBadge">
						<script type="text/javascript" src="http://vimeo.com/<?php echo $vimeoUserName; ?>/badgeo/?stream=uploaded&amp;stream_id=&amp;count=16&amp;thumbnail_width=80&amp;show_titles=no"></script>
						<div>
							<span>
								<nobr>Go to</nobr> <a href="http://vimeo.com/<?php echo $vimeoUserName; ?>/"><?php single_cat_title(); ?>'s videos</a>
							</span>
							<br clear="all" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Vimeo Badge -->
		<?
	}
}

function sab_printcategorylist($categories, $urlPrefix = '')
{
	$i = 0;
	foreach($categories as $category)
	{
		$i++;
		$class = (in_array(($i % 6), array(1, 2, 3), true)) ? 'small' : 'bold';
		
		echo "<div class=\"item $class\">";
		echo '<a href="' . $urlPrefix . '/' . $category->slug . '">' . $category->name . '</a>';
		echo "</div>";
	}
}

function sab_artistslist()
{
	$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 4,
	    'orderby'                  => 'count',
	    'order'                    => 'DESC',
	    'hide_empty'               => 1,
	    'hierarchical'             => 0,
	    'taxonomy'                 => 'category',
	    'pad_counts'               => false,
	    'number'                   => 11
	);
	sab_printcategorylist(get_categories($args), '/category/artists');
}

function sab_locationslist()
{
	$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 5,
	    'orderby'                  => 'count',
	    'order'                    => 'DESC',
	    'hide_empty'               => 1,
	    'hierarchical'             => 0,
	    'taxonomy'                 => 'category',
	    'pad_counts'               => false,
	    'number'                   => 11
	);
	sab_printcategorylist(get_categories($args), '/category/locations');
}


function sab_categoryimage()
{
	ciii_category_images(array(
		'link_images' => false
	));
}

class SAB_Tools
{
	private static $_columnName = '';
	private static $_ascending = true;

	public static function sortPropertyAlphaByColumn(&$array, $columnName, $ascending = true, $maintainKeys = false)
	{
		return self::_sortByColumn($array, $columnName, $ascending, $maintainKeys, '_comparePropertyAlphaByColumn');
	}

	/**
	 * Sort a resultset array by a certain column
	 *
	 * @param array $array
	 * @param string $columnName
	 * @param bool $ascending true / false
	 * @param bool $maintainKeys 
	 * @return array
	 */
	public static function sortAlphaByColumn(&$array, $columnName, $ascending = true, $maintainKeys = false)
	{
		return self::_sortByColumn($array, $columnName, $ascending, $maintainKeys, '_compareAlphaByColumn');
	}

	private static function _compareAlphaByColumn($a, $b)
	{	
		return ($a[self::$_columnName] > $b[self::$_columnName]) ? self::$_ascending : -self::$_ascending;
	}

	private static function _comparePropertyAlphaByColumn($a, $b)
	{	
		$columnName = self::$_columnName;
		return ($a->$columnName > $b->$columnName) ? self::$_ascending : -self::$_ascending;
	}

	private static function _sortByColumn(&$array, $columnName, $ascending = true, $maintainKeys = false, $method = '_compareNumericByColumn')
	{
		self::$_columnName = $columnName;
		self::$_ascending = $ascending ? 1 : -1;
		
		if ($maintainKeys)
		{
			uasort($array, array(self, $method));
		}
		else
		{
			usort($array, array(self, $method));
		}
		return $array;
	}

	public static function ellips($param, $len, $isBody = false, $doHtmlSpecialChars = false, $addDots = true)
	{
		if ($isBody !== false)
		{
			$param = trim($param);
			$param = strip_tags($param);
		}

		$param = (strlen($param) > (intval($len) + 1)) ? substr($param, 0, $len) . ($addDots ? "..." : "") : $param;
		// "+ 1" because there's no use in replacing the last character with "..."

		if ($doHtmlSpecialChars)
		{
			$param = htmlspecialchars($param);
		}

		return $param;
	}
}
