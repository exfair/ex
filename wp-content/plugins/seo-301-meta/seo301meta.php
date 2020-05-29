<?php
/*
Plugin Name: Seo 301 Meta
Plugin URI: https://www.mianshahzeb.com/plugins/seo-301-meta/
Description: Seo 301 Meta is an easy and seo effective way to redirect your internal and external links to new posts, pages, categories and websites. This plugin helps you to redirect all kind of links to another pages or websites and add 301 redirection which is very important for seo.
Version: 1.8
Author: Mian Shahzeb
Author URI: https://www.mianshahzeb.com/
*/

/*  Copyright 2009-2020  Mian Shahzeb  (email : hi@mianshahzeb.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("Seo301Meta")) {
	
	class Seo301Meta {
		
		/**
		 * create_menu function
		 * generate the link to the options page under settings
		 * @access public
		 * @return void
		 */
		function create_menu() {
		  add_options_page('SEO 301 Meta', 'SEO 301 Meta', 'manage_options', 'seo301', array($this,'options_page'));
		}
		
		/**
		 * options_page function
		 * generate the options page in the wordpress admin
		 * @access public
		 * @return void
		 */
		function options_page() {
		?>
		<div class="wrap seo_301_meta">
			<script>
				//todo: This should be enqued
				jQuery(document).ready(function(){
					jQuery('span.s3m301-delete').html('Delete').css({'color':'white','cursor':'pointer'}).click(function(){
						var confirm_delete = confirm('Are you Sure to Delete This Redirect?');
						if (confirm_delete) {
							
							// remove element and submit
							jQuery(this).parent().parent().remove();
							jQuery('#seo_301_meta_form').submit();
							
						}
					});
					
					jQuery('.seo_301_meta .documentation').hide().before('<p><a class="reveal-documentation" href="help.php">Instructions</a></p>')
					jQuery('.reveal-documentation').click(function(){
						jQuery(this).parent().siblings('.documentation').slideToggle();
						return false;
					});
				});
			</script>
		
		<?php
			if (isset($_POST['seo_301_meta_p'])) {
				echo '<div id="message" class="updated"><p>Great, Settings saved</p></div>';
			}
		?>
		
			<h2>SEO 301 Meta</h2>
			
			<form method="post" id="seo_301_meta_form" action="options-general.php?page=seo301&savedata=true">
			
			<?php wp_nonce_field( 'save_redirects', '_s301m_nonce' ); ?>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="2">Request</th>
						<th colspan="2">Destination</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2"><small>example: /page.html</small></td>
						<td colspan="2"><small>example: <?php echo get_option('home'); ?>/page/</small></td>
					</tr>
					<?php echo $this->expand_redirects(); ?>
					<tr>
						<td style="width:35%;"><input type="text" name="seo_301_meta_p[request][]" value="" style="width:99%;" /></td>
						<td style="width:2%;">&raquo;</td>
						<td style="width:60%;"><input type="text" name="seo_301_meta_p[destination][]" value="" style="width:99%;" /></td>
						<td><span class="s3m301-delete button-primary">Delete</span></td>
					</tr>
				</tbody>
			</table>
			
			<?php $wildcard_checked = (get_option('seo_301_meta_p_wildcard') === 'true' ? ' checked="checked"' : ''); ?>
			<p><input type="checkbox" name="seo_301_meta_p[wildcard]" id="s3m301-wildcard"<?php echo $wildcard_checked; ?> />
			<label for="s3m301-wildcard"> Use Wildcards?</label></p>
			
			<p class="submit"><input type="submit" name="submit_301" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
			</form>
			<div class="documentation">
				<h2>Instructions</h2>
				<h3>Seo 301 Meta</h3>
				<p>Seo 301 Meta work similar to the format that Apache uses: the request should be relative to your WordPress root.
				The destination can be either a full URL to any page on the web, or relative to your WordPress root.</p>
				<h4>Example</h4>
				<ul>
					<li><strong>Request:</strong> /old-page/</li>
					<li><strong>Destination:</strong> /new-page/</li>
				</ul>
				
				<h3>Wildcards</h3>
				<p>To use wildcards, put an asterisk (*) after the folder name that you want to redirect.</p>
				<h4>Example</h4>
				<ul>
					<li><strong>Request:</strong> /old-folder/*</li>
					<li><strong>Destination:</strong> /redirect-everything-here/</li>
				</ul>
		
				<p>You can also use the asterisk in the destination to replace whatever it matched in the request if you like. Something like this:</p>
				<h4>Example</h4>
				<ul>
					<li><strong>Request:</strong> /old-folder/*</li>
					<li><strong>Destination:</strong> /some/other/folder/*</li>
				</ul>
				<p>Or:</p>
				<ul>
					<li><strong>Request:</strong> /old-folder/*/content/</li>
					<li><strong>Destination:</strong> /some/other/folder/*</li>
				</ul>
				<p>Redirection Box to redirect old URL to redirect new URL.</p>
<img src="https://mianshahzeb.com/wp-content/uploads/2016/12/screenshot-1.png"><br>
<p>Simple URL Redirection.</p>
<img scr="http://mianshahzeb.com/wp-content/uploads/2016/12/screenshot-2.png"><br>
<p>Wildcard URL Redirection.</p>
<img scr="http://mianshahzeb.com/wp-content/uploads/2016/12/screenshot-3.png"><hr>


<h2>Get support from Developer</h2>
<p>Please provide as much details as possible so we can best assist you. <a href="https://mianshahzeb.com/#contact" target="_blank">Send Message</a> or <a href="mailto:hi@mianshahzeb.com">Email Direct</a></p>
			</div>
		</div>
		<?php
		} // end of function options_page
		
		/**
		 * expand_redirects function
		 * utility function to return the current list of redirects as form fields
		 * @access public
		 * @return string <html>
		 */
		function expand_redirects() {
			$redirects = get_option('seo_301_meta_p');
			$output = '';
			if (!empty($redirects)) {
				foreach ($redirects as $request => $destination) {
					$output .= '
					
					<tr>
						<td><input type="text" name="seo_301_meta_p[request][]" value="'.$request.'" style="width:99%" /></td>
						<td>&raquo;</td>
						<td><input type="text" name="seo_301_meta_p[destination][]" value="'.$destination.'" style="width:99%;" /></td>
						<td><span class="s3m301-delete"></span></td>
					</tr>
					
					';
				}
			} // end if
			return $output;
		}
		
		/**
		 * save_redirects function
		 * save the redirects from the options page to the database
		 * @access public
		 * @param mixed $data
		 * @return void
		 */
		function save_redirects($data) {
			if ( !current_user_can('manage_options') )  { wp_die( 'You do not have sufficient permissions to access this page.' ); }
			check_admin_referer( 'save_redirects', '_s301m_nonce' );
			
			$data = $_POST['seo_301_meta_p'];

			$redirects = array();
			
			for($i = 0; $i < sizeof($data['request']); ++$i) {
				$request = trim( sanitize_text_field( $data['request'][$i] ) );
				$destination = trim( sanitize_text_field( $data['destination'][$i] ) );
			
				if ($request == '' && $destination == '') { continue; }
				else { $redirects[$request] = $destination; }
			}
			
			update_option('seo_301_meta_p', $redirects);
			
			if (isset($data['wildcard'])) {
				update_option('seo_301_meta_p_wildcard', 'true');
			}
			else {
				delete_option('seo_301_meta_p_wildcard');
			}
		}
		
		/**
		 * redirect function
		 * Read the list of redirects and if the current page 
		 * is found in the list, send the visitor on her way
		 * @access public
		 * @return void
		 */
		function redirect() {
			// this is what the user asked for (strip out home portion, case insensitive)
			$userrequest = str_ireplace(get_option('home'),'',$this->get_address());
			$userrequest = rtrim($userrequest,'/');
			
			$redirects = get_option('seo_301_meta_p');
			if (!empty($redirects)) {
				
				$wildcard = get_option('seo_301_meta_p_wildcard');
				$do_redirect = '';
				
				// compare user request to each 301 stored in the db
				foreach ($redirects as $storedrequest => $destination) {
					// check if we should use regex search 
					if ($wildcard === 'true' && strpos($storedrequest,'*') !== false) {
						// wildcard redirect
						
						// don't allow people to accidentally lock themselves out of admin
						if ( strpos($userrequest, '/wp-login') !== 0 && strpos($userrequest, '/wp-admin') !== 0 ) {
							// Make sure it gets all the proper decoding and rtrim action
							$storedrequest = str_replace('*','(.*)',$storedrequest);
							$pattern = '/^' . str_replace( '/', '\/', rtrim( $storedrequest, '/' ) ) . '/';
							$destination = str_replace('*','$1',$destination);
							$output = preg_replace($pattern, $destination, $userrequest);
							if ($output !== $userrequest) {
								// pattern matched, perform redirect
								$do_redirect = $output;
							}
						}
					}
					elseif(urldecode($userrequest) == rtrim($storedrequest,'/')) {
						// simple comparison redirect
						$do_redirect = $destination;
					}
					
					// redirect. the second condition here prevents redirect loops as a result of wildcards.
					if ($do_redirect !== '' && trim($do_redirect,'/') !== trim($userrequest,'/')) {
						// check if destination needs the domain prepended
						if (strpos($do_redirect,'/') === 0){
							$do_redirect = home_url().$do_redirect;
						}
						header ('HTTP/1.1 301 Moved Permanently');
						header ('Location: ' . $do_redirect);
						exit();
					}
					else { unset($redirects); }
				}
			}
		} // end funcion redirect
		
		/**
		 * getAddress function
		 * utility function to get the full address of the current request
		 * credit: http://www.phpro.org/examples/Get-Full-URL.html
		 * @access public
		 * @return void
		 */
		function get_address() {
			// return the full address
			return $this->get_protocol().'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		} // end function get_address
		
		function get_protocol() {
			// Set the base protocol to http
			$protocol = 'http';
			// check for https
			if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
    			$protocol .= "s";
			}
			
			return $protocol;
		} // end function get_protocol
		
	} // end class Seo301Meta
	
} // end check for existance of class

// instantiate
$redirect_plugin = new Seo301Meta();

if (isset($redirect_plugin)) {
	// add the redirect action, high priority
	add_action('init', array($redirect_plugin,'redirect'), 1);

	// create the menu
	add_action('admin_menu', array($redirect_plugin,'create_menu'));

	// if submitted, process the data
	if (isset($_POST['seo_301_meta_p'])) {
		add_action('admin_init', array($redirect_plugin,'save_redirects'));
	}
}

// this is here for php4 compatibility
if(!function_exists('str_ireplace')){
  function str_ireplace($search,$replace,$subject){
    $token = chr(1);
    $haystack = strtolower($subject);
    $needle = strtolower($search);
    while (($pos=strpos($haystack,$needle))!==FALSE){
      $subject = substr_replace($subject,$token,$pos,strlen($search));
      $haystack = substr_replace($haystack,$token,$pos,strlen($search));
    }
    $subject = str_replace($token,$replace,$subject);
    return $subject;
  }
}