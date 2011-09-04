<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

if (function_exists('get_recent_comments')) { ?>

<div class="recentcomments boxstyle<?php if ($GLOBALS['onlyWideScreen']) { ?> onlywidescreen<?php } ?>">   
	<div class="boxstylecontent">
		<h3><?php _e('Recent Comments:'); ?></h3>
		<ul><?php get_recent_comments(); ?></ul>
	</div>
</div>

<?php } ?>