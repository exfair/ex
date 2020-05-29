<?php

do_action( 'travelers_blog_footer_top' );

travelers_blog_get_footer(); ?>

<!-- start Back To Top -->
<div id="back-to-top">
    <a href="javascript:void(0)"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end Back To Top -->

<div class="full-screen-search-box-wrap" style="display: none;">
	<div class="search-box-wrappper">
		<div class="searchform" role="search">
			<a href="javascript:void(0)" class="hide_full_search">
				<i class="fa fa-times" aria-hidden="true"></i>
			</a>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
