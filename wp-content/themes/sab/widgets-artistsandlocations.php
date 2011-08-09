<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

$pageNumber = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;

if ($pageNumber === 1) {
?>

</div>
<div class="artistsandlocations clearfix">
	<div class="artists alignleft">
		<div class="clearfix">
			<h3><a href="/category/artists/">Top Artists</a></h3>
			<div class="content">
				<?php sab_artistslist(); ?>
				<div class="item bold"><a href="/category/artists/">...</a></div>
			</div>
		</div>
	</div>
	<div class="adspace alignleft">
		<div class=""></div>
	</div>
	<div class="locations alignleft">
		<div class="clearfix">
			<h3><a href="/category/locations/">Top Locations</a></h3>
			<div class="content">
				<?php sab_locationslist(); ?>
				<div class="item bold"><a href="/category/locations/">...</a></div>
			</div>
		</div>
	</div>
</div>
<div>

<?php } ?>