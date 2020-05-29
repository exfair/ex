<?php
/**
 * Footer template
 *
 * @package Fasto
 * @author fribba
 *
 */
?>

</div><!-- end .site-grid-inner -->

<footer id="footer" role="contentinfo"><!-- start footer -->
	<div class="fasto-row" id="footer-widgets">
			<div class="col-desktop-4 col-tablet-6 col-small-tablet-6 col-mobile-12"><?php dynamic_sidebar( 'footer-widget-area-1' ); ?></div>
			<div class="col-desktop-4 col-tablet-6 col-small-tablet-6 col-mobile-12"><?php dynamic_sidebar( 'footer-widget-area-2' ); ?></div>
			<div class="col-desktop-4 col-tablet-6 col-small-tablet-6 col-mobile-12"><?php dynamic_sidebar( 'footer-widget-area-3' ); ?></div>
	</div>
</footer><!-- end footer -->

</div><!-- end .site-grid -->
<?php wp_footer(); ?>
</body>
</html>