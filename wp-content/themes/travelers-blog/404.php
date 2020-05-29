<?php

get_header(); ?>

<div class="breadcrumb-wrapper error-section">
	<div class="container">
	    <div class="section-title">
	        <h1><?php esc_html_e( '404', 'travelers-blog' ); ?></h1>
	        <p><?php esc_html_e( 'OOPS! - Could not Find it', 'travelers-blog' ); ?></p> 
	         <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Home' , 'travelers-blog' ); ?></a>  
	    </div>
    </div>
    <div class="overlay"></div>
</div>

<?php
get_footer();
