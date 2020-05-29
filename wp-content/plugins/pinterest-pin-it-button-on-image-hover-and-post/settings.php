<style>
#post-social-1{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-8.jpg'; ?>');
}
#post-social-2{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-1.jpg'; ?>');
}
#post-social-3{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-2.jpg'; ?>');
}
#post-social-4{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-3.jpg'; ?>');
}
#post-social-5{

	background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/pattern-1.png'; ?>') left top repeat, url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/bg1.jpg'; ?>') center center fixed;
}
}
#post-social-6{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-5.jpg'; ?>');
}
#post-social-7{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-6.jpg'; ?>');
}
#post-social-8{
	background-image: url('<?php echo WEBLIZAR_PINIT_PLUGIN_URL.'img/image-7.jpg'; ?>');
}

::-webkit-scrollbar {
	width: 12px;
}

::-webkit-scrollbar-track {
	outline: 0px solid slategrey;
	 background: transparent;
	border-radius: 0px;
	border:0px
}

::-webkit-scrollbar-thumb {
	border-radius: 0px;
	background: rgba(71,204,232,0.9);
	border:0px;
	outline: 0px solid slategrey;
}
a:focus {
	-webkit-box-shadow: none !important;
	box-shadow:none !important;
}
.wp-color-result{
	height:24px;
}
.wp-color-result:hover {
	text-underline:none;
}

.page-wrapper {
	border-left: 1px solid #19191d;
	margin: 0 0 0 315px;
	padding: 15px 15px;
	position: inherit;
}
#no-pin-image-url {
	width: 80% !important;
}
.products p i  {
    color: #ef4238 !important;
}
a.btn.btn-primary.btn-lg.dmobtn {
    background-image: linear-gradient(to bottom, #ef4238, #441411);
    padding: 13px;
    margin-top:15px;
}

a.btn.btn-primary.btn-lg.dmobtn:hover{
    background-image: linear-gradient(to bottom, #ef4238, #441411);
background: #ed5c5c;
}


.products {
    padding-bottom: 15px;
}
.acl-rate-us  span.dashicons{
	width: 30px;
	height: 30px;
	}
	.acl-rate-us  span.dashicons-star-filled:before {
	content: "\f155";
	font-size: 30px;
	}
	.acl-rate-us {
		color : #FBD229 !important;
		padding-top:5px !important;
	}
	.acl-rate{
		color:#fff;
		margin-top:10px !important;
		margin-bottom:5px !important;
	}

</style>
<div id="sidebar-wrapper">
	<!-- Navigation -->
	<nav  class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
		<div class="navbar-header mt-60">
			<a  class="navbar-brand coming-soon-admin-title" href="#"><?php esc_html_e('Pin It Button On Image Hover And In Post', WEBLIZAR_PINIT_TD); ?></a>
		</div>
		<!-- <ul class="nav navbar-top-links navbar-right coming-soon-top">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				</a>
			</li>
		</ul> -->
		<div class="navbar-default sidebar " role="navigation">
			<div class="sidebar navbar-collapse">
				<ul class="nav " id="side-menu">
					<li class="sidebar-profile text-center ">
						<span class="sidebar-profile-picture pint-anch">
							<a href="https://www.weblizar.com" target="_blank">
								<img class="img-fluid" src="<?php echo esc_url(WEBLIZAR_PINIT_PLUGIN_URL.'img/weblizarlogo.png' ); ?>" alt="Profile Picture"/>
							</a>
						</span>
						<h5 style="color:#fff" class="acl-rate"><?php esc_html_e('Show Us Some Love (Rate Us)', WEBLIZAR_PINIT_TD); ?></h5>
						<a class="acl-rate-us" href="https://wordpress.org/plugins/pinterest-pin-it-button-on-image-hover-and-post/#reviews" target="_blank">
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
						</a>
					</li>

					<li class="sidebar-profile text-center">
						<span class="sidebar-profile-picture pint-anch">
							<a href="#" target="_blank">
								<img src="<?php echo esc_url(WEBLIZAR_PINIT_PLUGIN_URL.'img/pint.jpg' ); ?>" alt="Profile Picture"/>
							</a>
							<a href="http://demo.weblizar.com/pinterest-feed-pro/" target="_blank" class="pint-btn"><?php esc_html_e('View Demo', WEBLIZAR_PINIT_TD); ?></a>
							<a href="https://weblizar.com/plugins/pinterest-feed-pro/" target="_blank" class="pint-btn"><?php esc_html_e('Go Pro $18', WEBLIZAR_PINIT_TD); ?></a>
						</span>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="page-wrapper ui-tabs-panel active " id="option-ui-id-1">
		<div class="panel panel-default ml-4">
			<div class="panel-heading">
				<h4 class="margin-none" style="font-size: 28px;">
					<?php esc_html_e('Pin It Button Settings', WEBLIZAR_PINIT_TD); ?>
				</h4>
				<p class="margin-none text-s text-muted"><?php esc_html_e('Configure Plugin Settings Here', WEBLIZAR_PINIT_TD); ?></p>
			</div>
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-pills">
					<li class="text-m"><a data-toggle="tab" href="#pinit-settings-tab"><strong><?php esc_html_e('Settings', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-cog"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#exclude-images"><strong><?php esc_html_e('Exclude Images', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-ban"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#exclude-pages"><strong><?php esc_html_e('Exclude Pages', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-ban"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#plug-recom"><strong><?php esc_html_e('Plugin Recommendation', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-plug"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#our-product-tab"><strong><?php esc_html_e('Our Products', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-boxes"></i></span></a></li>
					<li class=""><a data-toggle="tab" href="#need-help-tab"><strong><?php esc_html_e('Need Help', WEBLIZAR_PINIT_TD); ?></strong> <span class="pull-right close-conversation margin-left "><i class="fas fa-question-circle"></i></span></a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<!-- Plugin Settings Tab -->
					<div id="pinit-settings-tab" class="tab-pane fade active in">
						<hr>
						<div>
							<p><?php esc_html_e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php esc_html_e('In Post', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItPost = get_option("WL_Enable_Pinit_Post");
							if(!isset($PinItPost)) {
								$PinItPost = 1;
							}
							?>
							<input id="pinitpost" name="pinitpost" type="radio" value="1" <?php if($PinItPost == 1) echo "checked=checked"; ?>> <?php esc_html_e('Yes', WEBLIZAR_PINIT_TD); ?>
							<input id="pinitpost" name="pinitpost" type="radio" value="0" <?php if($PinItPost == 0) echo "checked=checked"; ?>> <?php esc_html_e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>

						<div>
							<p><?php esc_html_e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php esc_html_e('In Page', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItPage = get_option("WL_Enable_Pinit_Page");
							if(!isset($PinItPage)) {
								$PinItPage = 1;
							}
							?>
							<input id="pinitpage" name="pinitpage" type="radio" value="1" <?php if($PinItPage == 1) echo "checked=checked"; ?>> <?php esc_html_e('Yes', WEBLIZAR_PINIT_TD); ?>
							<input id="pinitpage" name="pinitpage" type="radio" value="0" <?php if($PinItPage == 0) echo "checked=checked"; ?>> <?php esc_html_e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>

						<div>
							<p><?php esc_html_e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php esc_html_e('On Image Hover', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							 $PinItOnHover = get_option("WL_Pinit_Btn_On_Hover");
							if(!isset($PinItOnHover)) {
								$PinItOnHover = "true";
							}
							?>
							<input id="pinitonhover" name="pinitonhover" type="radio" value="true" <?php if($PinItOnHover == "true") echo "checked=checked"; ?>> <?php esc_html_e('Yes', WEBLIZAR_PINIT_TD); ?>
							<input id="pinitonhover" name="pinitonhover" type="radio" value="false" <?php if($PinItOnHover == "false") echo "checked=checked"; ?>> <?php esc_html_e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>

						<div>
							<p><?php esc_html_e('Show Pin It Button', WEBLIZAR_PINIT_TD); ?> <strong><?php esc_html_e('On Mobile / Portable Devices', WEBLIZAR_PINIT_TD); ?></strong></p>
							<?php
							$PinItStatus = get_option("WL_Mobile_Status");
							if(!isset($PinItStatus)) {
								$PinItStatus = 1;
							}
							?>
							<input id="pinitstatus" name="pinitstatus" type="radio" value="1" <?php if($PinItStatus == 1) echo "checked=checked"; ?>> <?php esc_html_e('Yes', WEBLIZAR_PINIT_TD); ?>
							<input id="pinitstatus" name="pinitstatus" type="radio" value="0" <?php if($PinItStatus == 0) echo "checked=checked"; ?>> <?php esc_html_e('No', WEBLIZAR_PINIT_TD); ?>
						</div>
						<hr>

						<div>
							<p><?php esc_html_e('Pin It Button Size (On Image Hover)', WEBLIZAR_PINIT_TD); ?></p>
							<?php
							$PinItSize = get_option("WL_Pinit_Btn_Size");
							if(!isset($PinItSize)) {
								$PinItSize = "small";
							}
							?>
							<select id="pinitsize" name="pinitsize">
								<option value="small" <?php if($PinItSize == "small") echo "selected=selected"; ?>><?php esc_html_e('Small', WEBLIZAR_PINIT_TD); ?></option>
								<option value="large" <?php if($PinItSize == "large") echo "selected=selected"; ?>><?php esc_html_e('Large', WEBLIZAR_PINIT_TD); ?></option>
							</select>
						</div>
						<hr>
						<?php wp_nonce_field( 'pinitsetting_nonce_action', 'pinitsetting_nonce_field' ); ?>
						<button id="pinitsave" name="pinitsave" class="button button-primary" type="button" onclick="return SaveSettings();"><strong><i class="fas fa-save"></i>&nbsp;&nbsp;<?php esc_html_e('Save', WEBLIZAR_PINIT_TD); ?></strong></button>
						<i id="loading" name="loading" style="display: none;" class="fas fa-cog fa-spin fa-3x"></i>
					</div>

					<!-- Exclude Images Tab -->
					<div id="exclude-images" class="tab-pane fade">
						<?php  require_once("exclude-images.php"); ?>
					</div>

					<!-- Exclude Images Tab -->
					<div id="exclude-pages" class="tab-pane fade">
						<?php  require_once("exclude-pages.php"); ?>
					</div>

					<!-- Plugin Recommendation Tab -->
					<div id="plug-recom" class="tab-pane fade">
						<?php  require_once("recommendations.php"); ?>
					</div>

					<!-- Our Products Tab -->
					<div id="our-product-tab" class="tab-pane fade">
						<?php  require_once("our_product.php"); ?>
					</div>

					<!-- Need Help Tab -->
					<div id="need-help-tab" class="tab-pane fade">
						<h2><?php esc_html_e('Need Help Tab', WEBLIZAR_PINIT_TD); ?></h2>
						<hr>
						<p><?php esc_html_e('Simply after install and activate plugin go on plugins Pinterest PinIt Button" admin menu page.', WEBLIZAR_PINIT_TD); ?></p>
						<p><?php esc_html_e('Select the Settings tab and configure Pin It Button settings according to you.', WEBLIZAR_PINIT_TD); ?></p>
						<p>&nbsp;</p>
						<h4><?php esc_html_e('Plugin allows to configure following settings', WEBLIZAR_PINIT_TD); ?></h4>
						<p>&nbsp;</p>
						<p><strong><?php esc_html_e('1. Enable Pin It Button In Post -', WEBLIZAR_PINIT_TD); ?></strong><?php esc_html_e(' This settings show Pinterest Pin It button after the post content. So, you can easily pined all your post content to your Pinterest Bord.', WEBLIZAR_PINIT_TD); ?></p>
						<p><strong><?php esc_html_e('2. Enable Pin It Button in Page -', WEBLIZAR_PINIT_TD); ?></strong><?php esc_html_e(' This settings show Pinterest Pin It button after the Page content. So, you can easily pined all your Page content to your Pinterest Bord.', WEBLIZAR_PINIT_TD); ?></p>
						<p><strong><?php esc_html_e('3. Show Pin It Button On Image Hover -', WEBLIZAR_PINIT_TD); ?></strong><?php esc_html_e(' Setting shows Pin It Button on each your blog Post/Page image when your hover mouse on any image.', WEBLIZAR_PINIT_TD); ?></p>
						<p><strong><?php esc_html_e('4. Show Pin It Button On Mobile -', WEBLIZAR_PINIT_TD); ?></strong> <?php esc_html_e('Settings allows to enable/disable pin button appearing on site if uer visit site using mobile devices.', WEBLIZAR_PINIT_TD); ?></p>
						<p><strong><?php esc_html_e('5. Pin It Button Size (On Image Hover) -', WEBLIZAR_PINIT_TD); ?></strong> <?php esc_html_e('This settings work if Image hover setting is enable. Through that setting you can show small or large pin it button on image.', WEBLIZAR_PINIT_TD); ?></p>
						<hr>
					</div>
					<div id="weblizar-tab" class="tab-pane fade">
						<h4>Weblizar </h4>
						<p></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function SaveSettings(){
	jQuery('#pinitsave').hide();
	jQuery('#loading').show();
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: { action: "save_pinit",
			PinItPost: jQuery("input[name=pinitpost]:radio:checked").val(),
			PinItPage: jQuery("input[name=pinitpage]:radio:checked").val(),
			PinItOnHover: jQuery("input[name=pinitonhover]:radio:checked").val(),
			PinItStatus: jQuery("input[name=pinitstatus]:radio:checked").val(),
			//PinItColor: jQuery("select#pinitcolor").val(),
			//PinItDesign: jQuery("select#pinitdesign").val(),
			PinItSize: jQuery("select#pinitsize").val(),
			PinItSettingNonce: jQuery("input#pinitsetting_nonce_field").val(),
		},
		dataType: 'html',
		complete : function() {  },
		success: function(data) {
			jQuery('#loading').hide();
			jQuery('#pinitsave').show();
		}
	});
}
</script>
