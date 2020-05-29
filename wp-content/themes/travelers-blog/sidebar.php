<?php

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="sidebar" class="sidebar-wrapper ">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>
