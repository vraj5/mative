<?php
/*
* SPEEDYCACHE
* https://speedycache.com/
* (c) SpeedyCache Team
*/

if( !defined('SPEEDYCACHE_VERSION') ){
	die('Hacking Attempt!');
}

function speedycache_page_footer($tweet = false){
	
	if(!defined('SITEPAD')){
	
		if(!empty($tweet)){
			
			echo '
				<div style="width:45%;background:#FFF;padding:15px; margin:auto">
					<b>Let your followers know that you use SpeedyCache to speedup your website :</b>
					<form method="get" action="https://twitter.com/intent/tweet" id="tweet" onsubmit="return dotweet(this);">
						<textarea name="text" cols="45" row="3" style="resize:none;">I increased the page load speed of my #WordPress #site using @speedycache</textarea>
						&nbsp; &nbsp; <input type="submit" value="Tweet!" class="speedycache-btn speedycache-btn-primary" onsubmit="return false;" id="twitter-btn" style="margin-top:20px;"/>
					</form>	
				</div>
				<br />

				<script>
				function dotweet(ele){
					window.open(jQuery("#"+ele.id).attr("action")+"?"+jQuery("#"+ele.id).serialize(), "_blank", "scrollbars=no, menubar=no, height=400, width=500, resizable=yes, toolbar=no, status=no");
					return false;
				}
				</script>';
	
		}
	}
}

function speedycache_save_settings(){
	global $speedycache;
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_status']) ){
		if(empty($_POST['speedycache_status'])){
			unset($speedycache->options['status']); 
		} else{
			$speedycache->options['status'] = 1;
		}
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_automatic_cache']) ){ 
		$speedycache->options['automatic_cache'] = empty($_POST['speedycache_automatic_cache']) ? 0 : 1;
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_post_types']) ){ 
		$speedycache->options['post_types'] = empty($_POST['speedycache_post_types']) ? [] : speedycache_optpost('speedycache_post_types');
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload']) ){
		$speedycache->options['preload'] = empty($_POST['speedycache_preload']) ? 0 : 1;

		$preload_time = wp_next_scheduled('speedycache_preload');
		if(empty($speedycache->options['preload']) && !empty($preload_time)){
			wp_unschedule_event($preload_time, 'speedycache_preload');
		}
	}
	
	//Preload Settings
	
	//Preload Homepage
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_homepage']) ){
		$speedycache->options['preload_homepage'] = empty($_POST['speedycache_preload_homepage']) ? 0 : 1;
	}
	
	//Preload Post
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_post']) ){
		$speedycache->options['preload_post'] = empty($_POST['speedycache_preload_post']) ? 0 : 1;
	}
	
	//Preload Category
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_category']) ){
		$speedycache->options['preload_category'] = empty($_POST['speedycache_preload_category']) ? 0 : 1;
	}
	
	//Preload Page
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_page']) ){
		$speedycache->options['preload_page'] = empty($_POST['speedycache_preload_page']) ? 0 : 1;
	}
	
	//Preload Tag
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_tag']) ){
		$speedycache->options['preload_tag'] = empty($_POST['speedycache_preload_tag']) ? 0 : 1;
	}
	
	//Preload Attachment
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_attachment']) ){
		$speedycache->options['preload_attachment'] = empty($_POST['speedycache_preload_attachment']) ? 0 : 1;
	}
	
	//Preload Custom Post Types
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_customposttypes']) ){
		$speedycache->options['preload_custom_post_types'] = empty($_POST['speedycache_preload_custom_post_types']) ? 0 : 1;
	}
	
	//Preload Custom Post Taxonomies
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_custom_taxonomies']) ){
		$speedycache->options['preload_custom_taxonomies'] = empty($_POST['speedycache_preload_custom_taxonomies']) ? 0 : 1;
	}
	
	//Preload Number
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_number']) ){
		$speedycache->options['preload_number'] = empty($_POST['speedycache_preload_number']) ? 4 : speedycache_optpost('speedycache_preload_number');
	}
	
	//Preload Restart
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_restart']) ){
		$speedycache->options['preload_restart'] = empty($_POST['speedycache_preload_restart']) ? 0 : 1;
	}
	
	//Preload Order
	if( isset($_POST['submit']) || isset($_POST['speedycache_preload_order']) ){
		$speedycache->options['preload_order'] = empty($_POST['speedycache_preload_order']) ? '' : speedycache_optpost('speedycache_preload_order');
	}
	
	//speedycache for Logged in user
	if( isset($_POST['submit']) || isset($_POST['speedycache_logged_in_user']) ){
		$speedycache->options['logged_in_user'] = empty($_POST['speedycache_logged_in_user']) ? 0 : 1;
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_mobile']) ){
		$speedycache->options['mobile'] = empty($_POST['speedycache_mobile']) ? 0 : 1;
	}
	
	//Mobile Theme
	if( isset($_POST['submit']) || isset($_POST['speedycache_mobile_theme']) ){
		$speedycache->options['mobile_theme'] = empty($_POST['speedycache_mobile_theme']) ? 0 : 1;
	}
		
	//Mobile Theme Name
	if( isset($_POST['submit']) || isset($_POST['speedycache_mobile_theme_name']) ){
		$speedycache->options['mobile_theme_name'] = empty($_POST['speedycache_mobile_theme_name']) ? '' : speedycache_optpost('speedycache_mobile_theme_name');
	}
	
	//New Post
	if( isset($_POST['submit']) || isset($_POST['speedycache_new_post']) ){
		$speedycache->options['new_post'] = empty($_POST['speedycache_new_post']) ? 0 : 1;
	}
	
	//New Post Type 
	if( isset($_POST['submit']) || isset($_POST['speedycache_new_post_type']) ){
		$speedycache->options['new_post_type'] = empty($_POST['speedycache_new_post_type']) ? 'all' : speedycache_optpost('speedycache_new_post_type');
	}
	
	//Update Post
	if( isset($_POST['submit']) || isset($_POST['speedycache_update_post']) ){
		$speedycache->options['update_post'] = empty($_POST['speedycache_update_post']) ? 0 : 1;
	}
	
	//Update Post Type
	if( isset($_POST['submit']) || isset($_POST['speedycache_update_post_type']) ){
		$speedycache->options['update_post_type'] = empty($_POST['speedycache_update_post_type'])? 'post' : speedycache_optpost('speedycache_update_post_type');
	}
	
	// Enable Varnish
	if( isset($_POST['submit']) || isset($_POST['speedycache_purge_varnish']) ){
		$speedycache->options['purge_varnish'] = empty($_POST['speedycache_purge_varnish']) ? 0 : 1; 
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_varniship']) ){
		$speedycache->options['varniship'] = empty($_POST['speedycache_varniship']) ? '127.0.0.1' : speedycache_optpost('speedycache_varniship');
	}
	
	//Minify HTML
	if( isset($_POST['submit']) || isset($_POST['speedycache_minify_html']) ){
		$speedycache->options['minify_html'] = empty($_POST['speedycache_minify_html']) ? 0 : 1;
	}
	
	//Minify CSS
	if( isset($_POST['submit']) || isset($_POST['speedycache_minify_css']) ){
		$speedycache->options['minify_css'] = empty($_POST['speedycache_minify_css']) ? 0 : 1;
	}
	
	//Minify CSS Powerful
	if( isset($_POST['submit']) || isset($_POST['speedycache_minify_css_enhanced']) ){
		$speedycache->options['minify_css_enhanced'] = empty($_POST['speedycache_minify_css_enhanced']) ? 0 : 1;
	}
	
	//Combine CSS
	if( isset($_POST['submit']) || isset($_POST['speedycache_combine_css']) ){
		$speedycache->options['combine_css'] = empty($_POST['speedycache_combine_css']) ? 0 : 1;
	}
	
	if( isset($_POST['submit']) || isset($_POST['speedycache_minify_js']) ){
		$speedycache->options['minify_js'] = empty($_POST['speedycache_minify_js']) ? 0 : 1;
	}
	
	//Combine Js
	if( isset($_POST['submit']) || isset($_POST['speedycache_combine_js']) ){
		$speedycache->options['combine_js'] = empty($_POST['speedycache_combine_js']) ? 0 : 1;
	}
	
	//Combine Js powerful
	if( isset($_POST['submit']) || isset($_POST['speedycache_combine_js_enhanced']) ){
		$speedycache->options['combine_js_enhanced'] = empty($_POST['speedycache_combine_js_enhanced']) ? 0 : 1;
	}
	
	// Critical CSS
	if( isset($_POST['submit']) || isset($_POST['speedycache_critical_css']) ){
		$speedycache->options['critical_css'] = empty($_POST['speedycache_critical_css']) ? 0 : 1;
	}
	
	//Gzip
	if( isset($_POST['submit']) || isset($_POST['speedycache_gzip'])){
		$speedycache->options['gzip'] = empty($_POST['speedycache_gzip']) ? 0 : 1;
	}
	
	//LBC
	if( isset($_POST['submit']) || isset($_POST['speedycache_lbc']) ){
		$speedycache->options['lbc'] = empty($_POST['speedycache_lbc']) ? 0 : 1;
	}

	//Disable Emojis
	if( isset($_POST['submit']) || isset($_POST['speedycache_disable_emojis']) ){
		$speedycache->options['disable_emojis'] = empty($_POST['speedycache_disable_emojis']) ? 0 : 1;
	}
	
	//Render Blocking
	if( isset($_POST['submit']) || isset($_POST['speedycache_render_blocking']) ){
		$speedycache->options['render_blocking'] = empty($_POST['speedycache_render_blocking']) ? 0 : 1;
	}
	
	//Google Fonts
	if( isset($_POST['submit']) || isset($_POST['speedycache_google_fonts']) ){
		$speedycache->options['google_fonts'] = empty($_POST['speedycache_google_fonts']) ? 0 : 1;
	}
	
	//Lazy Load
	if( isset($_POST['submit']) || isset($_POST['speedycache_lazy_load']) ){
		$speedycache->options['lazy_load'] = empty($_POST['speedycache_lazy_load']) ? 0 : 1;
	}
	
	//Lazy Load Placeholder
	if( isset($_POST['submit']) || isset($_POST['speedycache_lazy_load_placeholder']) ){
		$speedycache->options['lazy_load_placeholder'] = empty($_POST['speedycache_lazy_load_placeholder']) ? '' : speedycache_optpost('speedycache_lazy_load_placeholder');
	}
	
	//Lazy Load Keywords
	if( isset($_POST['submit']) || isset($_POST['speedycache_lazy_load_keywords']) ){
		$speedycache->options['lazy_load_keywords'] = empty($_POST['speedycache_lazy_load_keywords']) ? '' : speedycache_optpost('speedycache_lazy_load_keywords');
	}
	
	//Lazy load custom placeholder url
	if( isset($_POST['submit']) || isset($_POST['speedycache_lazy_load_placeholder_custom_url']) ){
		$speedycache->options['lazy_load_placeholder_custom_url'] = empty($_POST['speedycache_lazy_load_placeholder_custom_url']) ? '' : speedycache_optpost('speedycache_lazy_load_placeholder_custom_url');
	}
	
	//Lazy Load Exclude Full Size IMG
	if( isset($_POST['submit']) || isset($_POST['speedycache_lazy_load_exclude_full_size_img']) ){
		$speedycache->options['lazy_load_exclude_full_size_img'] = empty($_POST['speedycache_lazy_load_exclude_full_size_img']) ? '' : speedycache_optpost('speedycache_lazy_load_exclude_full_size_img');
	}

	// Display Swap
	if( isset($_POST['submit']) || isset($_POST['speedycache_display_swap']) ){
		$speedycache->options['display_swap'] = empty($_POST['speedycache_display_swap']) ? 0 : 1;
	}	
	
	// Instant Page
	if( isset($_POST['submit']) || isset($_POST['speedycache_instant_page']) ){
		$speedycache->options['instant_page'] = empty($_POST['speedycache_instant_page']) ? 0 : 1;
	}
	
	// Local Google Fonts
	if( isset($_POST['submit']) || isset($_POST['speedycache_local_gfonts']) ){
		$speedycache->options['local_gfonts'] = empty($_POST['speedycache_local_gfonts']) ? 0 : 1;
	}
	
	// Change settings
	if(isset($_POST['submit'])){
		update_option('speedycache_options', $speedycache->options);
		$speedycache->settings['system_message'] = \SpeedyCache\htaccess::modify();
	}
	
	if(!isset($speedycache->settings['system_message'][1]) || $speedycache->settings['system_message'][1] == 'error'){
		speedycache_notify($speedycache->settings['system_message']);
		return;
	}

	$message = speedycache_check_cache_path_writeable();
	if(empty($message)){
		speedycache_notify($speedycache->settings['system_message']);
		return;
	}

	if(is_array($message)){
		$speedycache->settings['system_message'] = $message;
		speedycache_notify($speedycache->settings['system_message']);
		
		return;
	}
	
	if(!empty($speedycache->options['preload'])){
		\SpeedyCache\Precache::set();
	} else {
		delete_option('speedycache_preload');
		wp_clear_scheduled_hook('speedycache_Preload');
	}
	
	speedycache_exclude_urls();
	speedycache_notify($speedycache->settings['system_message']);
}


function speedycache_settings_page(){
	global $speedycache;

	speedycache_options_page_request();
	
	$cloudflare_integration_exist = false;
	
	if(!empty(speedycache_optserver('HTTP_CDN_LOOP')) && speedycache_optserver('HTTP_CDN_LOOP') == 'cloudflare'){
		$cloudflare_integration_exist = true;
		$cdn_values = get_option('speedycache_cdn');

		if($cdn_values){
			foreach($cdn_values as $key => $value){
				if($value['id'] == 'cloudflare'){
					$cloudflare_integration_exist = false;
					break;
				}
			}
		}
	}
	
	?>
	
	<div class="speedycache-wrap">
		<?php 

		settings_errors('speedycache-notice'); ?>

		<div class="speedycache-setting-content">
		<div class="speedycache-tab-group" style="width:<?php echo defined('SITEPAD') ? '100%' : '83%'?>">
			<?php
			$tabs = array(
				array('id' => 'speedycache-options', 'title' => esc_html('Settings', 'speedycache')),
				array('id' => 'speedycache-manage-cache', 'title' => esc_html('Manage Cache', 'speedycache')),
				array('id' => 'speedycache-image-optimisation', 'title' => esc_html('Image Optimization', 'speedycache' )),
				array('id' => 'speedycache-cdn', 'title' => 'CDN'),
				array('id' => 'speedycache-exclude', 'title' => esc_html('Exclude', 'speedycache')),
			);
			
			if(!defined('SITEPAD')){
				array_push($tabs, array('id' => 'speedycache-db', 'title' => 'DB'));
				array_push($tabs, array('id' => 'speedycache-support', 'title' => esc_html('Support', 'speedycache')));
			}
			
			$page_now = speedycache_optget('page');
			
			foreach($tabs as $key => $value){
				if($value['id'] == 'speedycache-image-optimisation' && !defined('SPEEDYCACHE_PRO')){
					continue;
				}
				
				if(defined('SPEEDYCACHE_PRO') && in_array($value['id'], $speedycache->settings['disabled_tabs'])){
					continue;
				}

				$checked = '';
				
				if($value['id'] == $page_now){
					$checked = 'checked';
				} else if($value['id'] === 'speedycache-options' && $page_now === 'speedycache'){
					$checked = 'checked';
				}
			
				//tab of "delete css and js" has been removed so there is need to check it
				if(!empty($_POST['speedycache_page']) && $_POST['speedycache_page'] == 'speedycache_delete_css_and_js_cache'){
					$speedycache_page = 'delete_cache';
				}

				echo '<input type="radio" id="' . esc_attr($value['id']) . '" name="speedycache_tabgroup" style="display:none;" '.esc_attr($checked).'>' . "\n";
				echo '<label for="' . esc_attr($value['id']) . '">' . esc_attr($value['title']) . '</label>' . "\n";
			}
			?>
			<br>
			
			<div class="speedycache-tab-settings">
				<form method="post">
					<?php wp_nonce_field('speedycache_nonce', 'security');  ?>

					<input type="hidden" value="options" name="speedycache_page">
					<div class="speedycache-block">
						<div class="speedycache-block-title">
							<h2><?php esc_html_e('Caching', 'speedycache'); ?></h2>
						</div>
						<div class="speedycache-option-group">
							<div class="speedycache-option-wrap">
								<label for="speedycache_status" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_status" name="speedycache_status" <?php echo (!empty($speedycache->options['status']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Enable Cache', 'speedycache'); ?> <span class="speedycache-modal-settings-link" setting-id="speedycache_status" style="display:<?php echo (!empty($speedycache->options['status']) ? 'inline-block' : 'none');?>;">- <?php esc_html_e('Settings', 'speedycache'); ?></span></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Enables caching', 'speedycache'); ?></span>
								</div>
							</div>
							
							<div class="speedycache-modal" modal-id="speedycache_status">
								<div class="speedycache-modal-wrap">
									<div class="speedycache-modal-header">
										<div><?php esc_html_e('SpeedyCache Cache', 'speedycache'); ?></div>
										<div title="Close Modal" class="speedycache-close-modal">
											<span class="dashicons dashicons-no"></span>
										</div>
									</div>
									<div class="speedycache-modal-content speedycache-info-modal">
										<h3><?php esc_html_e('Select Post Types', 'speedycache'); ?></h3>
										<p><?php esc_html_e('Only Selected Post types will be cached', 'speedycache'); ?></p>
										<?php 
											
										foreach(get_post_types(array('public' => true)) as $key => $type){
											$cache_post = $speedycache->options['post_types'];
											
											if(is_string($speedycache->options['post_types']) && strpos($speedycache->options['post_types'], ',') > -1){
												$cache_post = explode(',', $speedycache->options['post_types']);
											}

											$checked = '';
											if(in_array($type, $cache_post)){
												$checked = 'checked';
											}

											$type = ucfirst($type); 
										?>
										<div class="speedycache-auto-cache-input-wrap">
											<label for="speedycache_automatic_cache_<?php echo esc_attr($key);?>" class="speedycache-custom-checkbox">
												<input type="checkbox" id="speedycache_automatic_cache_<?php echo esc_attr($key);?>" name="speedycache_post_types[]" value="<?php echo esc_attr($key);?>" <?php echo esc_html($checked); ?>/>
												<div class="speedycache-input-slider"></div>
											</label>
											<div class="speedycache-option-info">
												<span class="speedycache-option-name"><?php esc_html_e($type, 'speedycache'); ?></span>
											</div>
										</div>
										<?php } ?>
									</div>
									<div class="speedycache-modal-footer">
										<button type="button" action="close">
											<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
										</button>
									</div>
								</div>
							</div>
							
							<div class="speedycache-option-wrap">
								<label for="speedycache_automatic_cache" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_automatic_cache" name="speedycache_automatic_cache" <?php echo (!empty($speedycache->options['automatic_cache']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
							
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Automatic Cache', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Create cache automatically after contents are saved.', 'speedycache'); ?></span>
								</div>
							</div>

							<!--Preload Starts here-->
							<div class="speedycache-option-wrap">
								<label for="speedycache_preload" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo (!empty($speedycache->options['preload']) ? ' checked' : ''); ?> id="speedycache_preload" name="speedycache_preload"/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Preload', 'speedycache'); ?>
									<span class="speedycache-modal-settings-link" setting-id="speedycache_preload" style="display:<?php echo (!empty($speedycache->options['preload']) ? 'inline-block' : 'none');?>;">- Settings</span>
									</span>
									<span class="speedycache-option-desc"><?php esc_html_e('Create the cache of all the site automatically', 'speedycache'); ?></span>
								</div>
							</div>
							
							<!--Preload Modal-->
							<div modal-id="speedycache_preload" class="speedycache-modal">
								<div class="speedycache-modal-wrap">
										<div class="speedycache-modal-header">
											<div><?php esc_html_e('Preload', 'speedycache'); ?></div>
											<div title="Close Modal" class="speedycache-close-modal">
												<span class="dashicons dashicons-no"></span>
											</div>
										</div>
									<div class="speedycache-modal-content">
										<div class="speedycache-sortable">
											<div class="speedycache-form-input" data-type="homepage">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_homepage" class="speedycache-custom-checkbox">
														<input type="checkbox" <?php echo (!empty($speedycache->options['preload_homepage']) ? ' checked' : ''); ?> id="speedycache_preload_homepage" name="speedycache_preload_homepage"/>
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Homepage', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
											
											<div class="speedycache-form-input" data-type="post">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_post" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_post" name="speedycache_preload_post" <?php echo (!empty($speedycache->options['preload_post']) ? ' checked' : ''); ?>/>
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Posts', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
											
											<div class="speedycache-form-input" data-type="category">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_category" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_category" name="speedycache_preload_category" <?php echo (!empty($speedycache->options['preload_category']) ? ' checked' : ''); ?> />
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Categories', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
											
											<div class="speedycache-form-input" data-type="page">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_page" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_page" name="speedycache_preload_page" <?php echo (!empty($speedycache->options['preload_page']) ? ' checked' : ''); ?> />
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Pages', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
											
											<div class="speedycache-form-input" data-type="tag">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_tag" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_tag" name="speedycache_preload_tag" <?php echo (!empty($speedycache->options['preload_tag']) ? ' checked' : ''); ?> />
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Tags', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
											
											<div class="speedycache-form-input" data-type="attachment">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_attachment" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_attachment" name="speedycache_preload_attachment" <?php echo (!empty($speedycache->options['preload_attachment']) ? ' checked' : ''); ?> />
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Attachments', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>

											<div class="speedycache-form-input" data-type="custom_post_types">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_custom_post_types"class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_custom_post_types" name="speedycache_preload_custom_post_types" <?php echo (!empty($speedycache->options['preload_custom_post_types']) ? ' checked' : ''); ?> />
													<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Custom Post Types', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>

											<div class="speedycache-form-input" data-type="customTaxonomies">
												<div class="speedycache-preload-input-wrap">
													<label for="speedycache_preload_custom_taxonomies" class="speedycache-custom-checkbox">
														<input type="checkbox" id="speedycache_preload_custom_taxonomies" name="speedycache_preload_custom_taxonomies" <?php echo (!empty($speedycache->options['preload_custom_taxonomies']) ? ' checked' : ''); ?> />
														<div class="speedycache-input-slider"></div>
													</label>
													<div class="speedycache-option-info">
														<span class="speedycache-option-name"><?php esc_html_e('Custom Taxonomies', 'speedycache'); ?></span>
													</div>
												</div>
												<span class="dashicons dashicons-menu"></span>
											</div>
										</div>
								
										<div class="speedycache-form-input">
											<label for="speedycache_preload_number">
												<input type="number" class="speedycache-form-spinner-input" name="speedycache_preload_number" min="0" value="<?php echo (!empty($speedycache->options['preload_number']) ? esc_attr($speedycache->options['preload_number']) : 4); ?>" />
												<?php esc_html_e('pages per minute', 'speedycache'); ?>
											</label>
										</div>

										<div class="speedycache-form-input">
											<div class="speedycache-preload-input-wrap">
												<label for="speedycache_preload_restart" class="speedycache-custom-checkbox">
													<input type="checkbox" id="speedycache_preload_restart" name="speedycache_preload_restart" <?php echo !empty($speedycache->options['preload_restart']) ? ' checked' : ''; ?> />
													<div class="speedycache-input-slider"></div>
												</label>
												<div class="speedycache-option-info">
													<span class="speedycache-option-name">
														<?php esc_html_e('Restart After Completed', 'speedycache'); ?><a style="margin-left:5px;" target="_blank" href="https://speedycache.com/docs/caching/how-to-precache/"><span class="dashicons dashicons-info"></span></a>
													</span>
												</div>
											</div>
										</div>

										<input type="hidden" value="<?php echo isset($speedycache->options['preload_order']) ? esc_attr($speedycache->options['preload_order']) : ''; ?>" id="speedycache_preload_order" name="speedycache_preload_order">

									</div>
									<div class="speedycache-modal-footer">
										<button type="button" action="close">
											<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
										</button>
									</div>
								</div>
							</div>
							<!--Preload Modal ends here-->
							
							<div class="speedycache-option-wrap">
								<label for="speedycache_lbc" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_lbc" name="speedycache_lbc" <?php echo (!empty($speedycache->options['lbc']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Browser Caching', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Reduce page load times for repeat visitors', 'speedycache'); ?></span>
								</div>
							</div>

							<div class="speedycache-option-wrap">
								<label for="speedycache_logged_in_user" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo (!empty($speedycache->options['logged_in_user']) ? ' checked' : ''); ?> id="speedycache_logged_in_user" name="speedycache_logged_in_user"/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Logged-in Users', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Don\'t show the cached version for logged-in users', 'speedycache'); ?></span>
								</div>
							</div>

							<div class="speedycache-option-wrap">
								<label for="speedycache_mobile" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo !empty($speedycache->options['mobile']) ? ' checked' : ''; ?> id="speedycache_mobile" name="speedycache_mobile"/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Mobile', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Don\'t show the cached version for desktop to mobile devices', 'speedycache'); ?></span>
								</div>
							</div>

							<?php if(defined('SPEEDYCACHE_PRO')){ ?>
								<div class="speedycache-option-wrap">
									<label for="speedycache_mobile_theme" class="speedycache-custom-checkbox">
										<input type="checkbox" <?php echo (!empty($speedycache->options['mobile_theme']) ? ' checked' : ''); ?> id="speedycache_mobile_theme" name="speedycache_mobile_theme"/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Mobile Theme', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Create cache for mobile theme', 'speedycache'); ?></span>
									</div>
								</div>

								<?php
							} else { ?>
								<div class="speedycache-option-wrap speedycache-disabled">
									<label for="speedycache_mobile_theme" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_mobile_theme" disabled/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Mobile Theme', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Create cache for mobile theme', 'speedycache'); ?></span>
									</div>
									<div class="speedycache-premium-tag">
										<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
									</div>
								</div>
							<?php } ?>
							
							<!-- SpeedyCache New Post Starts Here-->
							<div class="speedycache-option-wrap">
								<label for="speedycache_new_post" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo (!empty($speedycache->options['new_post']) ? ' checked' : ''); ?> id="speedycache_new_post" name="speedycache_new_post"/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('New Post', 'speedycache'); ?>
									<span class="speedycache-modal-settings-link" setting-id="speedycache_new_post" style="display:<?php echo (!empty($speedycache->options['new_post']) ? 'inline-block' : 'none');?>;">- Settings</span>
									</span>
									<span class="speedycache-option-desc"><?php esc_html_e('Clear cache files when a post or page is published', 'speedycache'); ?></span>
								</div>
							</div>
							
							<!--SpeedyCache NewPost Modal-->
							<div modal-id="speedycache_new_post" class="speedycache-modal">
								<div class="speedycache-modal-wrap">
									<div class="speedycache-modal-header">
										<div><?php esc_html_e('New Post', 'speedycache'); ?></div>
										<div title="Close Modal" class="speedycache-close-modal">
											<span class="dashicons dashicons-no"></span>
										</div>
									</div>
									<div class="speedycache-modal-content">
										<p style="color:#666;margin-top:0 !important;"><?php esc_html_e('What do you want to happen after publishing the new post?', 'speedycache'); ?></p>
										
										<div class="speedycache-form-input">
											<label style="margin-right: 5px;" for="speedycache_new_post_type_all">
												<input type="radio" action-id="speedycache_new_post_type_all" id="speedycache_new_post_type_all" name="speedycache_new_post_type" value="all" <?php echo isset($speedycache->options['new_post_type']) && ($speedycache->options['new_post_type'] == 'all') ? ' checked' : ''; ?>/>
												<?php esc_html_e('Clear All Cache', 'speedycache'); ?>
											</label>
										</div>
										
										<div class="speedycache-form-input">
											<label style="margin-right: 5px;" for="speedycache_new_post_type_homepage">
												<input type="radio" action-id="speedycache_new_post_type_homepage" id="speedycache_new_post_type_homepage" name="speedycache_new_post_type" value="homepage" <?php echo isset($speedycache->options['new_post_type']) && ($speedycache->options['new_post_type'] == 'homepage') ? ' checked' : ''; ?>/>
											<?php esc_html_e('Clear Cache of Homepage', 'speedycache'); ?>, 
											<?php esc_html_e('Post Categories', 'speedycache'); ?>, 
											<?php esc_html_e('Post Tags', 'speedycache'); ?>, 
											<?php esc_html_e('Pagination', 'speedycache'); ?> 
											</label>
										</div>
									</div>
									<div class="speedycache-modal-footer">
										<button class="" type="button" action="close">
											<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
										</button>
									</div>
								</div>
							</div>
							
							<!--SpeedyCache New Post Modal Ends Here-->
							<!--SpeedyCache New Post Ends here-->

							<!--SpeedyCache Update Post Starts here-->
							<div class="speedycache-option-wrap">
								<label for="speedycache_update_post" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo (!empty($speedycache->options['update_post']) ? ' checked' : ''); ?> id="speedycache_update_post" name="speedycache_update_post" />
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Update Post', 'speedycache'); ?>
									<span class="speedycache-modal-settings-link" setting-id="speedycache_update_post" style="display:<?php echo (!empty($speedycache->options['update_post']) ? 'inline-block' : 'none');?>;">- Settings</span>
									</span>
									<span class="speedycache-option-desc"><?php esc_html_e('Clear cache files when a post or page is updated', 'speedycache'); ?></span>
								</div>
							</div>
							
							<!--SpeedyCache Update Post Modal Starts Here-->
							<div modal-id="speedycache_update_post" class="speedycache-modal">
								<div class="speedycache-modal-wrap">
									<div class="speedycache-modal-header">
										<div><?php esc_html_e('Update Post', 'speedycache'); ?></div>
										<div title="Close Modal" class="speedycache-close-modal">
											<span class="dashicons dashicons-no"></span>
										</div>
									</div>
									<div class="speedycache-modal-content">
											<p style="color:#666;margin-top:0 !important;"><?php esc_html_e('What do you want to happen after update a post or a page?', 'speedycache'); ?></p>

											<div class="speedycache-form-input">
												<label>
													<input type="radio" action-id="speedycache_update_post_type_all" id="speedycache_update_post_type_all" name="speedycache_update_post_type" value="all" <?php echo isset($speedycache->options['update_post_type']) && ($speedycache->options['update_post_type'] == 'all') ? ' checked' : ''; ?>/>
													<?php esc_html_e('Clear All Cache', 'speedycache'); ?>
												</label>
											</div>
											
											<div class="speedycache-form-input">
												<label>
													<input type="radio" action-id="speedycache_update_post_type_post" id="speedycache_update_post_type_post" name="speedycache_update_post_type" value="post" <?php echo isset($speedycache->options['update_post_type']) && ($speedycache->options['update_post_type'] == 'post') ? ' checked' : ''; ?>/>
													<?php esc_html_e('Clear Cache of Post / Page', 'speedycache'); ?>, 
													<?php esc_html_e('Post Categories', 'speedycache'); ?>, 
													<?php esc_html_e('Post Tags', 'speedycache'); ?>, 
													<?php esc_html_e('Homepage', 'speedycache'); ?>
												</label>
											</div>
									</div>
									<div class="speedycache-modal-footer">
										<button type="button" action="close">
											<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
										</button>
									</div>
								</div>
							</div>
							<!--SpeedyCache Update Post Modal Starts Here-->
							<!--SpeedyCache Update Post Ends here-->
							
							<div class="speedycache-option-wrap">
								<label for="speedycache_purge_varnish" class="speedycache-custom-checkbox">
									<input type="checkbox" <?php echo (!empty($speedycache->options['purge_varnish']) ? ' checked' : ''); ?> id="speedycache_purge_varnish" name="speedycache_purge_varnish" />
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Purge Varnish', 'speedycache'); ?>
									<span class="speedycache-modal-settings-link" setting-id="speedycache_purge_varnish" style="display:<?php echo (!empty($speedycache->options['purge_varnish']) ? 'inline-block' : 'none');?>;">- Settings</span>
									</span>
									<span class="speedycache-option-desc"><?php esc_html_e('Deletes cache created by Varnish on Deletion of cache from SpeedyCache', 'speedycache'); ?></span>
								</div>
							</div>
							
							<!--SpeedyCache Update Post Modal Starts Here-->
							<div modal-id="speedycache_purge_varnish" class="speedycache-modal">
								<div class="speedycache-modal-wrap">
									<div class="speedycache-modal-header">
										<div><?php esc_html_e('Varnish Settings', 'speedycache'); ?></div>
										<div title="Close Modal" class="speedycache-close-modal">
											<span class="dashicons dashicons-no"></span>
										</div>
									</div>
									<div class="speedycache-modal-content">
										<p style="color:#666;margin-top:0 !important;"><?php esc_html_e('If you use any different IP for Varnish than the default then set it here.', 'speedycache'); ?></p>

										<div class="speedycache-form-input">
											<label style="width:100%;">
												<span style="font-weight:500; margin-bottom:5px"><?php esc_html_e('Set your Varnish IP', 'speedycache'); ?></span>
												<input type="text" name="speedycache_varniship" style="width:100%;" value="<?php echo !empty($speedycache->options['varniship']) ? esc_attr($speedycache->options['varniship']) : '127.0.0.1';?>"/><br/>
												
											</label>
										</div>
									</div>
									<div class="speedycache-modal-footer">
										<button type="button" action="close">
											<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
										</button>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class="speedycache-block">
						<div class="speedycache-block-title">
							<h2><?php esc_html_e('File Optimization', 'speedycache'); ?></h2>
						</div>
						
						<div class="speedycache-option-group">

						<?php if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_minify_html" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_minify_html" name="speedycache_minify_html" <?php echo !empty($speedycache->options['minify_html']) ? ' checked' : ''; ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Minify HTML', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Minifies HTML', 'speedycache'); ?></span>
								</div>
							</div>
						<?php } else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_minify_html" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_minify_html" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Minify HTML', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Minifies HTML', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
						<?php } ?>

						<div class="speedycache-option-wrap">
							<label for="speedycache_minify_css" class="speedycache-custom-checkbox">
								<input type="checkbox" id="speedycache_minify_css" name="speedycache_minify_css" <?php echo !empty($speedycache->options['minify_css']) ? ' checked' : ''; ?>/>
								<div class="speedycache-input-slider"></div>
							</label>
							<div class="speedycache-option-info">
								<span class="speedycache-option-name"><?php esc_html_e('Minify CSS', 'speedycache'); ?></span>
								<span class="speedycache-option-desc"><?php esc_html_e('You can decrease the size of CSS files', 'speedycache'); ?></span>
							</div>
						</div>

						<?php if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_minify_css_enhanced" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_minify_css_enhanced" name="speedycache_minify_css_enhanced" <?php echo !empty($speedycache->options['minify_css_enhanced']) ? ' checked' : ''; ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Advanced Minify CSS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Better minification of CSS', 'speedycache'); ?></span>
								</div>
							</div>
						<?php } else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_minify_css_enhanced" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_minify_css_enhanced" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Advanced Minfiy CSS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Better minification of CSS', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
						<?php } ?>

						<div class="speedycache-option-wrap">
							<label for="speedycache_combine_css" class="speedycache-custom-checkbox">
								<input type="checkbox" id="speedycache_combine_css" name="speedycache_combine_css" <?php echo (!empty($speedycache->options['combine_css']) ? ' checked' : ''); ?>/>
								<div class="speedycache-input-slider"></div>
							</label>
							<div class="speedycache-option-info">
								<span class="speedycache-option-name"><?php esc_html_e('Combine CSS', 'speedycache'); ?></span>
								<span class="speedycache-option-desc"><?php esc_html_e('Reduce HTTP requests through combined CSS files', 'speedycache'); ?></span>
							</div>
						</div>

						<?php if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_minify_js" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_minify_js" name="speedycache_minify_js" <?php echo (!empty($speedycache->options['minify_js']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Minify JS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('You can decrease the size of JS files', 'speedycache'); ?></span>
								</div>
							</div>
						<?php } else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<div class="speedycache-form-input">
									<label for="speedycache_minify_js" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_minify_js" disabled/>
										<div class="speedycache-input-slider"></div>
									</label>
								</div>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Minify JS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('You can decrease the size of JS files', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
						<?php } ?>

						<div class="speedycache-option-wrap">
							<label for="speedycache_combine_js" class="speedycache-custom-checkbox">
								<input type="checkbox" id="speedycache_combine_js" name="speedycache_combine_js" <?php echo (!empty($speedycache->options['combine_js']) ? ' checked' : ''); ?>/>
								<div class="speedycache-input-slider"></div>
							</label>
							
							<div class="speedycache-option-info">
								<span class="speedycache-option-name"><?php esc_html_e('Combine JS', 'speedycache'); ?></span>
								<span class="speedycache-option-desc"><?php esc_html_e('Reduce HTTP requests by Combining JS files in header', 'speedycache'); ?></span>
							</div>
						</div>

						<?php if(defined('SPEEDYCACHE_PRO')){ ?>
								<div class="speedycache-option-wrap">								
									<label for="speedycache_combine_js_enhanced" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_combine_js_enhanced" name="speedycache_combine_js_enhanced" <?php echo (!empty($speedycache->options['combine_js_enhanced']) ? ' checked' : ''); ?>/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Advanced Combine JS', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Reduce HTTP requests by combining JS files in footer', 'speedycache'); ?></span>
									</div>
								</div>
						<?php 
						} else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_combine_js_enhanced" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_combine_js_enhanced" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Advanced Combine JS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Reduce HTTP requests by combining JS files in footer', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
						<?php } ?>				
						
						<?php // Critical CSS Option
						if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_critical_css" class="speedycache-custom-checkbox" style="margin-top:0;">
									<input type="checkbox" id="speedycache_critical_css" name="speedycache_critical_css" <?php echo (!empty($speedycache->options['critical_css']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<?php
									echo '<span class="speedycache-option-name">'.__('Critical CSS', 'speedycache');
									
									if(!empty($speedycache->options['critical_css'])){
										echo ' - 
									<span class="speedycache-action-link" action-name="speedycache_critical_css">'.__('Create Now', 'speedycache').'</span>
									&nbsp;&nbsp;|&nbsp;&nbsp;
									<span class="speedycache-modal-settings-link" setting-id="speedycache_critical_css">'.__('Logs', 'speedycache').'</span>';
									}
									echo '</span><span class="speedycache-option-desc">'.__('It extracts the necessary CSS of the viewport on load to improve load speed.', 'speedycache').'</span>';
									?>
								</div>
							</div>
							
							<?php echo \SpeedyCache\CriticalCss::status_modal(); ?>
							
						<?php 
						} else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_combine_js_enhanced" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_combine_js_enhanced" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Critical CSS', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('It extracts the necessary CSS of the viewport on load to improve load speed.', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
					
					<div class="speedycache-block">
						<div class="speedycache-block-title">
							<h2><?php esc_html_e('Miscellaneous', 'speedycache'); ?></h2>
						</div>
						
						<div class="speedycache-option-group">
							<div class="speedycache-option-wrap">
								<label for="speedycache_gzip" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_gzip" name="speedycache_gzip" <?php echo (!empty($speedycache->options['gzip']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Gzip', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Reduce the size of files sent from your server', 'speedycache'); ?></span>
								</div>
							</div>

							<?php
							if(!empty(speedycache_optserver('SERVER_SOFTWARE')) && preg_match('/nginx/i', speedycache_optserver('SERVER_SOFTWARE'))){
								?>
								<!--SpeedyCache Gzip Modal-->
								<div modal-id="speedycache_gzip" class="speedycache-modal">
									<div class="speedycache-modal-wrap">
										<div class="speedycache-modal-header">
												<div><?php esc_html_e('Enable Gzip', 'speedycache'); ?></div>
												<div title="Close Modal">
													<div class="speedycache-close-modal"></div>
												</div>
										</div>
										<div class="speedycache-modal-content speedycache-info-modal">
											<h3><?php esc_html_e('How to Enable Gzip?', 'speedycache'); ?></h3>		
											<p><?php esc_html_e('Nginx is used in the server so you need to enable the Gzip manually. Please take a look at the following tutorial.', 'speedycache'); ?></p>
											
											<div class="speedycache-modal-highlight">
												<label>
													<a href="https://speedycache.com/docs/miscellaneous/how-to-enable-gzip-on-nginx/" target="_blank">https://speedycache.com/docs/miscellaneous/how-to-enable-gzip-on-nginx/</a>
												</label>
											</div>
										</div>
										<div class="speedycache-modal-footer">
											<button type="button" action="close">
												<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
											</button>
										</div>
									</div>
								</div>
								<!--SpeedyCache Gzip Modal Ends here-->
							<?php }
							?>
							
							<div class="speedycache-option-wrap">
								<label for="speedycache_disable_emojis" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_disable_emojis" name="speedycache_disable_emojis" <?php echo (!empty($speedycache->options['disable_emojis']) ? ' checked' : ''); ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Disable Emojis', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('You can remove the emoji inline css and wp-emoji-release.min.js', 'speedycache'); ?></span>
								</div>
							</div>

							<?php if(defined('SPEEDYCACHE_PRO')){ ?>
								<div class="speedycache-option-wrap">
									<label for="speedycache_render_blocking" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_render_blocking" name="speedycache_render_blocking" <?php echo (!empty($speedycache->options['render_blocking']) ? ' checked' : ''); ?>/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Render Blocking JS', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Defers render-blocking JavaScript resources', 'speedycache'); ?></span>
									</div>
								</div>
	
							<?php } else { ?>
								<div class="speedycache-option-wrap speedycache-disabled">
										<label for="speedycache_render_blocking" class="speedycache-custom-checkbox">
											<input type="checkbox" id="speedycache_render_blocking" name="speedycache_render_blocking" disabled/>
											<div class="speedycache-input-slider"></div>
										</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Render Blocking JS', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Defers render-blocking JavaScript resources', 'speedycache'); ?></span>
									</div>
									<div class="speedycache-premium-tag">
										<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
									</div>
								</div>
							<?php }
							
							if(defined('SPEEDYCACHE_PRO')){ ?>
								<div class="speedycache-option-wrap">
									<label for="speedycache_google_fonts" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_google_fonts" name="speedycache_google_fonts" <?php echo (!empty($speedycache->options['google_fonts']) ? ' checked' : ''); ?>/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Google Fonts', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Load Google Fonts asynchronously', 'speedycache'); ?></span>
									</div>
								</div>
							<?php 
							} else { ?>
								<div class="speedycache-option-wrap speedycache-disabled">
									<label for="speedycache_google_fonts" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_google_fonts" name="speedycache_google_fonts" disabled/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Google Fonts', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Load Google Fonts asynchronously', 'speedycache'); ?></span>
									</div>
									<div class="speedycache-premium-tag">
										<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
									</div>
								</div>
							<?php }
							
							if(defined('SPEEDYCACHE_PRO')){ ?>
								<div class="speedycache-option-wrap">
									<input type="hidden" value="<?php echo isset($speedycache->options['lazy_load_placeholder']) ? esc_attr($speedycache->options['lazy_load_placeholder']) : ''; ?>" id="speedycache_lazy_load_placeholder" name="speedycache_lazy_load_placeholder"/>
									<input style="display: none;" type="checkbox" <?php echo isset($speedycache->options['lazy_load_exclude_full_size_img']) ? esc_attr($speedycache->options['lazy_load_exclude_full_size_img']) : '';?> id="speedycache_lazy_load_exclude_full_size_img" name="speedycache_lazy_load_exclude_full_size_img">
									
									<label for="speedycache_lazy_load" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_lazy_load" name="speedycache_lazy_load" <?php echo (!empty($speedycache->options['lazy_load']) ? ' checked' : ''); ?>/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Lazy Load', 'speedycache'); ?>  <span class="speedycache-modal-settings-link" setting-id="speedycache_lazy_load" style="display:<?php echo (!empty($speedycache->options['lazy_load']) ? 'inline-block' : 'none');?>;">- Settings</span></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Load images and iframes when they enter the browsers viewport', 'speedycache'); ?></span>
									</div>
								</div>

								<!--SpeedyCache Lazy Load Modal Starts here-->
								<div modal-id="speedycache_lazy_load" class="speedycache-modal">
									<div class="speedycache-modal-wrap">
										<div class="speedycache-modal-header">
											<div><?php esc_html_e('Lazy Load Settings', 'speedycache'); ?></div>
											<div title="Close Modal" class="speedycache-close-modal">
												<span class="dashicons dashicons-no"></span>
											</div>
										</div>
										<div class="speedycache-modal-content speedycache-info-modal">
											<div class="speedycache-modal-block">
												<h4><?php esc_html_e('Image Placeholder', 'speedycache'); ?></h4>
												<p>
													<?php esc_html_e('Specify an image to be used as a placeholder while other images finish loading.', 'speedycache');?>
													<a target="_blank" href="https://speedycache.com/docs/miscellaneous/lazy-load-images-and-iframes/">
													<span class="dashicons dashicons-info"></span>
													</a>
												</p>
												<div class="speedycache-form-input">
													<select name="speedycache_lazy_load_placeholder" class="speedycache_lazy_load_placeholder speedycache-full-width" value="<?php echo !isset($speedycache->options['lazy_load_placeholder']) ? '' : esc_attr($speedycache->options['lazy_load_placeholder']); ?>">
														<option value="default" <?php echo (isset($speedycache->options['lazy_load_placeholder']) && $speedycache->options['lazy_load_placeholder'] == 'default') ? 'selected' : '';?>><?php echo preg_replace("/https?\:\/\//", '', esc_url(SPEEDYCACHE_URL)).'/assets/images/image-palceholder.png'; ?></option>
														<option value="base64" <?php echo (isset($speedycache->options['lazy_load_placeholder']) && $speedycache->options['lazy_load_placeholder'] == 'base64') ? 'selected' : '';?>>data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7</option>
														<option value="custom" <?php echo (isset($speedycache->options['lazy_load_placeholder']) && $speedycache->options['lazy_load_placeholder'] == 'custom') ? 'selected' : '';?>><?php esc_html_e('Custom Placeholder', 'speedycache'); ?></option>
													</select>
													
												</div>
												<?php 
													$hide_css_class = '';
												
													if(isset($speedycache->options['lazy_load_placeholder']) && $speedycache->options['lazy_load_placeholder'] != 'custom'){
														$hide_css_class = 'speedycache-hidden '; 
													}
												?>
												
												<div class="speedycache-form-input">
													<input type="text" class="<?php echo esc_attr($hide_css_class); ?>speedycache-full-width" placeholder="https://example.com/sample.jpg" name="speedycache_lazy_load_placeholder_custom_url" value="<?php echo !isset($speedycache->options['lazy_load_placeholder_custom_url']) ? '' : esc_attr($speedycache->options['lazy_load_placeholder_custom_url']); ?>"/>
												</div>
											</div>

											<div class="speedycache-modal-block">
												<h4><?php esc_html_e('Exclude Sources', 'speedycache'); ?></h4>
												<p><?php esc_html_e('It is enough to write a keyword such as', 'speedycache')?> <strong>home.jpg or iframe or .gif</strong> instead of full url.</p>
												<div class="speedycache-form-input">		
													<label for="speedycache-full-width">
														<?php esc_html_e('Add Keyword', 'speedycache'); ?>
														<input class="speedycache-exclude-source-keyword speedycache-full-width" type="text" placeholder="Add Keyword"/>
														<span class="speedycache-input-desc"><?php esc_html_e('Use Comma to create new keyword', 'speedycache'); ?></span>
														<div class="speedycache-tags-holder"></div>
														<input type="hidden" value="<?php echo !isset($speedycache->options['lazy_load_keywords']) ? '' : esc_attr($speedycache->options['lazy_load_keywords']); ?>" id="speedycache_lazy_load_keywords" name="speedycache_lazy_load_keywords">
													</label>
												</div>

												<?php if(isset($speedycache->options['lazy_load_exclude_full_size_img'])){ ?>
												<div class="speedycache-form-input">
													<label for="speedycache_lazy_load_exclude_full_size_img" >
														<input type="checkbox" id="speedycache_lazy_load_exclude_full_size_img" name="speedycache_lazy_load_exclude_full_size_img" <?php echo !empty($speedycache->options['lazy_load_exclude_full_size_img']) ? ' checked' : ''; ?>/>
													
														<?php esc_html_e('Exclude full size images in posts or pages', 'speedycache');?>
														<a target="_blank" href="https://speedycache.com/docs/miscellaneous/lazy-load-images-and-iframes/">
															<span class="dashicons dashicons-info"></span>
														</a>
													</label>
												</div>
												<?php } ?>
											</div>
										</div>
										<div class="speedycache-modal-footer">
											<button type="button" action="close">
												<span>
													<?php esc_html_e('Submit', 'speedycache'); ?>
												</span>
											</button>
										</div>
									</div>
								</div>
							<?php
							} else { ?>
								<div class="speedycache-option-wrap speedycache-disabled">
									<label for="speedycache_lazy_load" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_lazy_load" name="speedycache_lazy_load" disabled/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Lazy Load', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Load images and iframes when they enter the browsers viewport', 'speedycache'); ?></span>
									</div>
									<div class="speedycache-premium-tag">
										<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
									</div>
								</div>
							<?php }

							if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_display_swap" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_display_swap" name="speedycache_display_swap" <?php echo !empty($speedycache->options['display_swap']) ? 'checked' : ''; ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Display Swap', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Ensure text remains visible during Google font loads', 'speedycache'); ?></span>
								</div>
							</div>
							<?php } else { ?>
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_display_swap" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_display_swap" name="speedycache_display_swap" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Display Swap', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Ensure text remains visible during Google font loads', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
							<?php
							}

							if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_instant_page" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_instant_page" name="speedycache_instant_page" <?php echo !empty($speedycache->options['instant_page']) ? 'checked' : ''; ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Instant Page', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Improves page load speed', 'speedycache'); ?></span>
								</div>
							</div>
							<?php } else { ?>
								<div class="speedycache-option-wrap speedycache-disabled">
									<label for="speedycache_instant_page" class="speedycache-custom-checkbox">
										<input type="checkbox" id="speedycache_instant_page" disabled/>
										<div class="speedycache-input-slider"></div>
									</label>
									<div class="speedycache-option-info">
										<span class="speedycache-option-name"><?php esc_html_e('Instant Page', 'speedycache'); ?></span>
										<span class="speedycache-option-desc"><?php esc_html_e('Improves page load speed', 'speedycache'); ?></span>
									</div>
									<div class="speedycache-premium-tag">
										<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
									</div>
								</div>
							<?php }

							if(defined('SPEEDYCACHE_PRO')){ ?>
							<div class="speedycache-option-wrap">
								<label for="speedycache_local_gfonts" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_local_gfonts" name="speedycache_local_gfonts" <?php echo !empty($speedycache->options['local_gfonts']) ? 'checked' : ''; ?>/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Local Google Fonts', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Loads google fonts from your local server', 'speedycache'); ?></span>
								</div>
							</div>
							
							<?php } else { ?>	
							<div class="speedycache-option-wrap speedycache-disabled">
								<label for="speedycache_local_gfonts" class="speedycache-custom-checkbox">
									<input type="checkbox" id="speedycache_local_gfonts" name="speedycache_local_gfonts" disabled/>
									<div class="speedycache-input-slider"></div>
								</label>
								<div class="speedycache-option-info">
									<span class="speedycache-option-name"><?php esc_html_e('Local Google Fonts', 'speedycache'); ?></span>
									<span class="speedycache-option-desc"><?php esc_html_e('Loads google fonts from your local server', 'speedycache'); ?></span>
								</div>
								<div class="speedycache-premium-tag">
									<i class="fas fa-crown"></i> <?php esc_html_e('Premium', 'speedycache'); ?>
								</div>
							</div>
							<?php } ?>
							
						</div>
					</div>
					<div class="speedycache-option-wrap speedycache-submit-btn">
						<input type="submit" name="submit" value="Save Settings" class="speedycache-btn speedycache-btn-primary">
					</div>
				</form>
			</div>
			<div class="speedycache-tab-delete-cache">
				<?php if(defined('SPEEDYCACHE_PRO')){ ?>
				<div id="speedycache-toggle-logs">
					<span id="speedycache-show-delete-log"><?php esc_html_e('Show Logs', 'speedycache'); ?></span>
					<span id="speedycache-hide-delete-log"><?php esc_html_e('Hide Logs', 'speedycache'); ?></span>
				</div>
				<?php
				}

				if(defined('SPEEDYCACHE_PRO')){
					\SpeedyCache\Statistics::init();
					\SpeedyCache\Statistics::statics();
				} else {
				?>
					<div class="speedycache-block">
						<div class="speedycache-disabled-block">
							<div class="speedycache-disabled-block-info">
								<i class="fas fa-lock"></i>
								<p><?php esc_html_e('Only available in Pro version', 'speedycache'); ?></p>
								<a href="https://speedycache.com/pricing" target="_blank"><?php esc_html_e('Buy Pro Version Now', 'speedycache'); ?></a>
							</div>
						</div>
						
						<div class="speedycache-block-title">
							<h2 id="cache-statics-h2"><?php esc_html_e('Cache Statistics', 'speedycache'); ?></h2>
						</div>
						<div id="speedycache-cache-statics">
							<div id="speedycache-cache-statics-desktop" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-stats-info">
										<span><?php esc_html_e('Desktop Cache', 'speedycache'); ?></span>
										<p id="speedycache-cache-statics-desktop-data">
											<span class="speedycache-size">0Kb</span><br/>
											<span class="speedycache-files">of 0 Items</span>
										</p>
									</div>
									<div class="speedycache-stat-icon">
										<span class="dashicons dashicons-desktop"></span>
									</div>
								</div>
							</div>
							<div id="speedycache-cache-statics-mobile" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-stats-info">
										<span><?php esc_html_e('Mobile Cache', 'speedycache'); ?></span>
										<p id="speedycache-cache-statics-mobile-data">
											<span class="speedycache-size">0Kb</span><br/>
											<span class="speedycache-files">of 0 Items</span></p>
									</div>
									<div class="speedycache-stat-icon">
										<span class="dashicons dashicons-smartphone"></span>
									</div>
								</div>
							</div>
							<div id="speedycache-cache-statics-css" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-stats-info">
										<span><?php esc_html_e('Minified CSS', 'speedycache'); ?></span>
										<p id="speedycache-cache-statics-css-data">
											<span class="speedycache-size">0Kb</span><br/>
											<span class="speedycache-files">of 0 Items</span>
										</p>
									</div>
									<div class="speedycache-stat-icon"><span class="dashicons dashicons-media-code"></span></div>
								</div>
							</div>
							<div id="speedycache-cache-statics-js" class="speedycache-card">
								<div class="speedycache-card-body">	
									<div class="speedycache-stats-info">
										<span><?esc_html_e('Minified JS', 'speedycache'); ?></span>
										<p id="speedycache-cache-statics-js-data">
											<span class="speedycache-size">0Kb</span><br/>
											<span class="speedycache-files">of 0 Items</span>
										</p>
									</div>
									<div class="speedycache-stat-icon"><span class="dashicons dashicons-media-code"></span></div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2 id="delete-cache-h2"><?php esc_html_e('Delete Cache', 'speedycache'); ?></h2>
					</div>
					<form method="post">
						<?php wp_nonce_field('speedycache_group', 'security'); ?>
						
						<div class="speedycache-option-wrap">
							<label for="speedycache_delete_minified" class="speedycache-custom-checkbox">
								<input type="checkbox" id="speedycache_delete_minified" name="speedycache_delete_minified"/>
								<div class="speedycache-input-slider"></div>
							</label>
							<div class="speedycache-option-info">
								<span class="speedycache-option-name"><?php esc_html_e('Delete Minified', 'speedycache'); ?></span>
								<span class="speedycache-option-desc"><?php esc_html_e('Deletes Minfied/ Combined CSS/JS files', 'speedycache'); ?></span>
							</div>
						</div>
						<?php 
						if(defined('SPEEDYCACHE_PRO')){ ?>
						<div class="speedycache-option-wrap">
							<label for="speedycache_delete_fonts" class="speedycache-custom-checkbox">
								<input type="checkbox" id="speedycache_delete_fonts" name="speedycache_delete_fonts"/>
								<div class="speedycache-input-slider"></div>
							</label>
							<div class="speedycache-option-info">
								<span class="speedycache-option-name"><?php esc_html_e('Delete Fonts', 'speedycache'); ?></span>
								<span class="speedycache-option-desc"><?php esc_html_e('Deletes Local Google Fonts', 'speedycache'); ?></span>
							</div>
						</div>
						<?php } ?>
							
						<input type="hidden" value="delete_cache" name="speedycache_page">
						<div class="speedycache-option-wrap">
							<div class="submit">
								<input type="submit" value="<?php esc_html_e('Clear all cache and the selections', 'speedycache'); ?>" class="speedycache-btn speedycache-btn-primary"/>
							</div>
						</div>
						<div class="speedycache-option-wrap">
							<div>
								<label><?php esc_html_e('Here are the folders that will be deleted', 'speedycache'); ?></label><br>
								<label><?php esc_html_e('Target folder', 'speedycache'); ?></label> <b><?php echo esc_html(speedycache_cache_path('all')); ?></b><br>
								<label><?php esc_html_e('Target folder', 'speedycache'); ?></label> <b><?php echo esc_html(speedycache_cache_path('mobile-cache')); ?></b><br/>
								<?php if(defined('SPEEDYCACHE_PRO')){ ?>
								<label><?php esc_html_e('Target folder', 'speedycache'); ?></label> <b><?php echo esc_html(speedycache_cache_path('critical-css')); ?></b><br/>
								<?php } ?>
								<div class="speedycache-target-mini" style="display:none;">
									<label><?php esc_html_e('Target folder', 'speedycache'); ?></label> <b><?php echo esc_html(speedycache_cache_path('assets')); ?></b>
								</div>
								<div  class="speedycache-target-fonts" style="display:none;">
									<label><?php esc_html_e('Target folder', 'speedycache'); ?></label> <b><?php echo esc_html(speedycache_cache_path('fonts')); ?></b>
								</div>
							</div>
						</div>
					</form>
				</div>	
				
				<!--Logs Block-->
				<?php if(defined('SPEEDYCACHE_PRO')){
					\SpeedyCache\Logs::log('delete');
					\SpeedyCache\Logs::print_logs();
				}
				?>
				
				<?php
				$disable_wp_cron = '';
				if(defined('DISABLE_WP_CRON')){
					if((is_bool(DISABLE_WP_CRON) && DISABLE_WP_CRON == true) ||
						(is_string(DISABLE_WP_CRON) && preg_match("/^true$/i", DISABLE_WP_CRON))
					){
						$disable_wp_cron = 'disable-wp-cron="true" '; ?>

						<div modal-id="speedycache-modal-disablewpcron" class="speedycache-modal">
							<div class="speedycache-modal-wrap">
								<div class="speedycache-modal-header">
									<div><?php esc_html_e('Warning', 'speedycache'); ?></div>
									<div title="Close Modal" class="speedycache-close-modal">
										<span class="dashicons dashicons-no"></span>
									</div>
								</div>
								<div class="speedycache-modal-content">
									<h3><?php esc_html_e('Disabled Cron', 'speedycache'); ?></h3>		
									<p><?php esc_html_e('The Cron has been disabled entirely by setting', 'speedycache');?><b><a href="https://speedycache.com/docs/miscellaneous/disable-wp-cron/" target="_blank">DISABLE_WP_CRON</a></b> to true.</p>
								</div>
								<div class="speedycache-modal-footer">
									<button type="button" action="close">
										<span>
											<?php esc_html_e('Submit', 'speedycache'); ?>
										</span>
									</button>
								</div>
							</div>
						</div>
				<?php }
				}
				?>
				
				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Cache Lifespan', 'speedycache'); ?></h2>
						<button type="button" id="speedycache-timeout" <?php echo esc_html($disable_wp_cron); ?> class=" speedycache-dialog-buttons speedycache-btn">
								<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
						</button>
					</div>
					
					<div class="speedycache-timeout-list">
					</div>	
				</div>
				
				<div modal-id="speedycache-timeout" class="speedycache-modal">
					<div class="speedycache-modal-wrap">
						<div class="speedycache-modal-header">
							<div><?php esc_html_e('Cache Timeout', 'speedycache'); ?></div>
							<div title="Close Modal" class="speedycache-close-modal">
								<span class="dashicons dashicons-no"></span>
							</div>
						</div>
						<form>		
						<div class="speedycache-modal-content speedycache-info-modal">
							<div class="speedycache-modal-block">
								<label class="speedycache-timeout-request">
									<span><?php esc_html_e('If REQUEST_URI', 'speedycache'); ?></span>
									<select name="speedycache-timeout-rule-prefix">
										<option selected="" value=""></option>
										<option value="all"><?php esc_html_e('All', 'speedycache'); ?></option>
										<option value="homepage"><?php esc_html_e('Home Page', 'speedycache'); ?></option>
										<option value="startwith"><?php esc_html_e('Starts With', 'speedycache'); ?></option>
										<option value="exact"><?php esc_html_e('Is Equal To', 'speedycache'); ?></option>
										<!-- <option value="contain">_e('Contains', 'speedycache');</option> -->
									</select>
								</label>

								<label class="speedycache-timeout-rule-line-middle speedycache-full-width">
									<input type="text" name="speedycache-timeout-rule-content"  class="speedycache-full-width"/>
								</label>
							</div>
							
							<div class="speedycache-modal-block">
								<?php esc_html_e('Then', 'speedycache'); ?>
								<select name="speedycache-timeout-rule-schedule">
									<?php
										$schedules = wp_get_schedules();

										if(function_exists('wp_list_sort')){
											$schedules = wp_list_sort($schedules, 'interval', 'ASC', true);
										}
										
										$first = true;
										foreach($schedules as $key => $value){
											if(!isset($value['speedycache'])){
												continue;
											}
											
											if($first){
												echo '<option value="">'.esc_html__('Choose One', 'speedycache').'</option>';
												$first = false;
											}
											echo '<option value="'.esc_attr($key).'">'.esc_html($value['display']).'</option>';
										}
									?>
								</select> 
								<span class="speedycache-timeout-at-text" style="padding-right:5px;display:none;">at</span>
								<select name="speedycache-timeout-rule-hour" style="display:none;">
									<?php
										for ($i=0; $i < 24; $i++){ 
											?>
											<option value="<?php echo esc_attr($i); ?>"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
											<?php
										}
									?>
								</select>
								<select name="speedycache-timeout-rule-minute" style="display:none;">
									<?php
										for ($i=0; $i < 60; $i++){ 
											?>
											<option value="<?php echo esc_attr($i); ?>"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></option>
											<?php
										}
									?>
								</select>
								<span><?php esc_html_e('delete the files', 'speedycache'); ?></span>
							</div>

							<div class="speedycache-modal-block">
								<p class="speedycache-server-time"><?php esc_html_e('Server Time', 'speedycache'); ?>: <?php echo esc_html(date("H:i:s")); ?></p>
							</div>
						</div>
						</form>
						<div class="speedycache-modal-footer">
							<button type="button" action="close">
								<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
							</button>
						</div>
					</div>
				</div>

				<form method="post" name="wp_manager">
					<input type="hidden" value="timeout" name="speedycache_page">
					<div class="speedycache-timeout-rule-container"></div>
				</form>
			</div>
	
			<div class="speedycache-tab-exclude">
				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2 ><?php esc_html_e('Exclude Pages', 'speedycache'); ?></h2>

						<button data-type="page" type="button" class="speedycache-add-new-exclude-button speedycache-btn" >
						<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
					</button>
					</div>

					<div class="speedycache-exclude-page-list">
					</div>
				</div>
				
				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Exclude User-Agents', 'speedycache'); ?></h2>
						<button data-type="useragent" type="button" class="speedycache-add-new-exclude-button speedycache-btn">
							<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
						</button>
					</div>

					<div class="speedycache-exclude-useragent-list">
					</div>
				</div>

				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Exclude Cookies', 'speedycache'); ?></h2>
						<button data-type="cookie" type="button" class="speedycache-add-new-exclude-button speedycache-btn" >
							<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
						</button>
					</div>

					<div class="speedycache-exclude-cookie-list">
					</div>
				</div>
				
				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Exclude CSS', 'speedycache'); ?></h2>
						<button data-type="css" type="button" class="speedycache-add-new-exclude-button speedycache-btn">
							<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
						</button>
					</div>
					<div class="speedycache-exclude-css-list">
					</div>
				</div>

				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Exclude JS', 'speedycache'); ?></h2>
						<button data-type="js" type="button" class="speedycache-add-new-exclude-button speedycache-btn">
							<span><?php esc_html_e('Add New Rule', 'speedycache'); ?></span>
						</button>
					</div>

					<div class="speedycache-exclude-js-list">
					</div>
				</div>	
				
				<div modal-id="speedycache-exclude" class="speedycache-modal">
					<div class="speedycache-modal-wrap">
						<div class="speedycache-modal-header">
							<div><?php esc_html_e('Exclude Page', 'speedycache'); ?></div>
							<div title="Close Modal" class="speedycache-close-modal">
								<span class="dashicons dashicons-no"></span>
							</div>
						</div>

						<div id="speedycache-wizard-exclude" class="speedycache-modal-content">
							<div class="speedycache-condition-text"><?php esc_html_e('If REQUEST_URI', 'speedycache'); ?></div>
							<form>
								<div>
									<select name="speedycache-exclude-rule-prefix" class="speedycache-full-width">
										<option selected="" value=""><?php esc_html_e('Select a Value', 'speedycache'); ?></option>
										<option value="homepage"><?php esc_html_e('Home Page', 'speedycache'); ?></option>
										<option value="category"><?php esc_html_e('Categories', 'speedycache'); ?></option>
										<option value="tag"><?php esc_html_e('Tags', 'speedycache'); ?></option>
										<option value="post"><?php esc_html_e('Posts', 'speedycache'); ?></option>
										<option value="page"><?php esc_html_e('Pages', 'speedycache'); ?></option>
										<option value="archive"><?php esc_html_e('Archives', 'speedycache'); ?></option>
										<option value="attachment"><?php esc_html_e('Attachments', 'speedycache'); ?></option>
										<option value="startwith"><?php esc_html_e('Starts With', 'speedycache'); ?></option>
										<option value="contain"><?php esc_html_e('Contains', 'speedycache'); ?></option>
										<option value="exact"><?php esc_html_e('Is Equal To', 'speedycache'); ?></option>
										<option value="googleanalytics"><?php esc_html_e('has Google Analytics Parameters', 'speedycache'); ?></option>
										<option value="woocommerce_items_in_cart"><?php esc_html_e('has Woocommerce Items in Cart', 'speedycache'); ?></option>
									</select>
								</div>
								<div class="speedycache-exclude-rule-line-middle">
									<input type="text" name="speedycache-exclude-rule-content" class="speedycache-full-width">
									<input type="hidden" name="speedycache-exclude-rule-type"/>
								</div>
							</form>
						</div>
						<div class="speedycache-modal-footer">
							<button type="button" action="close">
								<span>
									<?php esc_html_e('Submit', 'speedycache'); ?>
								</span>
							</button>
						</div>
					</div>
				</div>
				
				<form method="post" name="wp_manager">
					<input type="hidden" value="exclude" name="speedycache_page">
					<div class="speedycache-exclude-rule-container"></div>
					<!-- <div class="speedycache-option-wrap qsubmit">
						<div class="submit"><input type="submit" class="speedycache-btn speedycache-btn-primary" value="Submit"></div>
					</div> -->
				</form>
			</div>

			<div class="speedycache-tab-cdn">
				<div class="speedycache-snack-bar">
					<span class="speedycache-snack-bar-msg"><?php esc_html_e('CDN Settigs Saved', 'speedycache'); ?></span>
				</div>
				
				<?php
				if(!empty($cloudflare_integration_exist)){
					echo '<div class="speedycache-notice speedycache-notice-blue"><span class="dashicons dashicons-info-outline"></span> '.__('You are using Cloudflare so you should enable Cloudflare Integration. Please take a look at the following documentation', 'speedycache').' <a href="https://speedycache.com/docs/cdn/how-to-setup-cloudflare/" target="_blank"><strong>Check How to intergate CloudFlare</strong></a></div>';
				} ?>
				<div class="speedycache-block">
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('CDN Settings', 'speedycache'); ?></h2>
					</div>
					
					<div class="speedycache-cdn-holder">
						<input type="radio" id="speedycache-cdn-tab-stackpath-input" name="speedycache-cdn-tab"/>
						<input type="radio" id="speedycache-cdn-tab-cloudflare-input" name="speedycache-cdn-tab"/>
						<input type="radio" id="speedycache-cdn-tab-bunny-input" name="speedycache-cdn-tab" checked/>
						<input type="radio" id="speedycache-cdn-tab-other-input" name="speedycache-cdn-tab"/>
						
						<div class="speedycache-cdn-tabs">
							<div speedycache-cdn-name="bunny" class="speedycache-cdn-tab">
								<label for="speedycache-cdn-tab-bunny-input">
									<div class="speedycache-cdn-tab-icon">
										<img src="<?php echo esc_url(SPEEDYCACHE_URL) . '/assets/images/bunny.svg';?>" height="32"/>
									</div>
									<div class="speedycache-cdn-tab-title">
										<div style="font-weight:bold;font-size:14px;">Bunny CDN</div>
										<p><?php esc_html_e('CDN to speed up your website', 'speedycache'); ?></p>
									</div>
								</label>	
							</div>
						
						
							<div speedycache-cdn-name="stackpath" class="speedycache-cdn-tab">
								<label for="speedycache-cdn-tab-stackpath-input">								
									<div class="speedycache-cdn-tab-icon">
										<i class="fab fa-stackpath"></i>
									</div>
									<div class="speedycache-cdn-tab-title">
										<div style="font-weight:bold;font-size:14px;">StackPath</div>
										<p><?php esc_html_e('Secure and accelerate your websites', 'speedycache'); ?></p>
									</div>
								</label>
							</div>

							<div speedycache-cdn-name="cloudflare" class="speedycache-cdn-tab">
								<label for="speedycache-cdn-tab-cloudflare-input">
									<div class="speedycache-cdn-tab-icon">
										<i class="fab fa-cloudflare"></i>
									</div>
									<div class="speedycache-cdn-tab-title">
										<div style="font-weight:bold;font-size:14px;">Cloudflare</div>
										<p><?php esc_html_e('CDN, DNS, DDoS protection and security', 'speedycache'); ?></p>
									</div>
								</label>	
							</div>
							
							<div speedycache-cdn-name="other" class="speedycache-cdn-tab">
								<label for="speedycache-cdn-tab-other-input">
									<div class="speedycache-cdn-tab-icon">
										<i class="fas fa-network-wired"></i>
									</div>
									<div class="speedycache-cdn-tab-title">
										<div style="font-weight:bold;font-size:14px;">Other CDN Providers</div>
										<p><?php esc_html_e('You can use any cdn provider.', 'speedycache'); ?></p>
									</div>
								</label>
							</div>
						</div>
						
						<div class="speedycache-cdn-tab-content">
							<div class="speedycache-cloudflare-settings">
								<form>
									<input type="hidden" name="id" value="cloudflare"/>
									<h3><?php esc_html_e('CloudFlare Settings', 'speedycache'); ?></h3>
									<?php echo speedycache_cdn_actions_tmpl('cloudflare'); ?>
									<hr/>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Enter API Keys', 'speedycache'); ?></h4>	
										<p><?php echo wp_kses_post('Please enter your <strong>API Key</strong> below to to access Cloudflare APIs.', 'speedycache'); ?></p>
										<div class="speedycache-form-input" style="display: none;">
											<label for="cdn-url">
												<?php esc_html_e('Email', 'speedycache'); ?>:
												<input type="text" name="cdn_url" value="speedycache" class="speedycache-api-key" id="cdn-url"/>
											</label>
											<span class="speedycache-error-msg"></span>
										</div>
										<div class="speedycache-form-input">
											<label for="origin-url"><?php esc_html_e('API Token', 'speedycache'); ?>:
												<input type="text" name="origin_url" value="" class="speedycache-api-key" id="origin-url"/>
												<div id="speedycache-cdn-url-loading"><i class="fas fa-circle-notch fa-spin"></i></div>
											</label>
											<span class="speedycache-error-msg"></span>
										</div>
										<p class="speedycache-bottom-note"><a target="_blank" href="https://speedycache.com/docs/cdn/how-to-setup-cloudflare/"><?php esc_html_e('Note: Please read How to Integrate Cloudflare into speedycache', 'speedycache'); ?></a></p>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Disable Auto Minify', 'speedycache'); ?></h4>
										<p><?php esc_html_e('The Auto Minify options have been disabled automatically.', 'speedycache'); ?></p>
										
										<div class="speedycache-checkbox-list">
											<img src="<?php echo esc_url(SPEEDYCACHE_URL).'/assets/images/cloudflare-auto-minify.png'?>" style="width:100%;"/>
										</div>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Disable Rocket Loader', 'speedycache'); ?></h4>
										<p><?php esc_html_e('The Rocket Loader option has been disabled automatically.', 'speedycache'); ?></p>
										<div class="speedycache-checkbox-list">
											<img src="<?php echo esc_url(SPEEDYCACHE_URL).'/assets/images/cloudflare-rocketloader.png'?>" style="width:100%;"/>
										</div>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Browser Cache Expiration', 'speedycache'); ?></h4>
										<p><?php esc_html_e('Browser Cache Expiration option has been set as 6 months.', 'speedycache'); ?></p>
										<div class="speedycache-checkbox-list">
											<img src="<?php echo esc_url(SPEEDYCACHE_URL).'/assets/images/cloudflare-browsercache.png'?>" style="width:100%;"/>
										</div>
									</div>
									<div class="speedycache-cdn-save"><button class="speedycache-btn speedycache-btn-primary"><?php esc_html_e('Save Settings', 'speedycache'); ?></button></div>
								</form>
							</div>
							
							<div class="speedycache-bunny-settings">
								<form>
									<input type="hidden" name="id" value="bunny"/>
									<h3><?php esc_html_e('Bunny CDN Settings', 'speedycache'); ?></h3>
									<?php $action_btns = false;
									
										$action_btns = speedycache_cdn_actions_tmpl('bunny');
										if(!empty($action_btns)){
											echo $action_btns;
										}
									?>
									<hr/>
									<?php if(empty($action_btns)){ ?>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Let\'s Get Started', 'speedycache'); ?></h4>
										<p>
											<?php echo wp_kses_post('Hi! If you don\'t have a <strong>Bunny CDN</strong> account, you can create one. If you already have, please continue...', 'speedycache'); ?>
										</p>
										
										<div class="speedycache-form-input" style="display:flex; align-items:center; text-align:center;">
											<a class="speedycache-green-button" href="https://panel.bunny.net/user/register/" target="_blank">
												<?php esc_html_e('Create a Bunny CDN Account', 'speedycache'); ?>
											</a>
										</div>
									</div>
									<?php } ?>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Enter CDN Url', 'speedycache'); ?></h4>
										<p><?php echo wp_kses_post('Please enter your <strong>Pull Zone</strong> below to deliver your contents via CDN.', 'speedycache'); ?></p>
									
										<div class="speedycache-form-input">
											<label for="cdn-url"><?php esc_html_e('Pull Zone', 'speedycache'); ?>:
												<input type="text" name="cdn_url" value="" class="speedycache-api-key" id="cdn-url"/>
												<div id="speedycache-cdn-url-loading"><i class="fas fa-circle-notch fa-spin"></i></div>
											</label>
											
											<span class="speedycache-error-msg"></span>
										</div>
										<div class="speedycache-form-input">
											<label for="origin-url"><?php esc_html_e('Origin Url', 'speedycache'); ?>:
												<input type="text" name="origin_url" value="" class="speedycache-api-key" id="origin-url"/>
											</label>
										</div>
										
										<div class="speedycache-form-input">
											<label for="bunny_access_key"><?php esc_html_e('Access Key', 'speedycache'); ?>:
												<input type="text" name="bunny_access_key" value="" class="speedycache-api-key" id="bunny_access_key"/>
											</label>
										</div>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('File Types', 'speedycache'); ?></h4>
										<p><?php esc_html_e('Specify the file types to host with the CDN.', 'speedycache'); ?></p>
										<?php speedycache_file_type(); ?>
									</div>
									
									<div class="speedycache-block">
										<?php speedycache_specify_source(); ?>
									</div>

									<div class="speedycache-block">
										<?php speedycache_exclude_source(); ?>
									</div>
									<div class="speedycache-cdn-save"><button class="speedycache-btn speedycache-btn-primary"><?php esc_html_e('Save Settings', 'speedycache'); ?></button></div>
								</form>
							</div>

							<div class="speedycache-other-settings">
								<form>
									<input type="hidden" name="id" value="other"/>
									<h3><?php esc_html_e('Other CDN Settings', 'speedycache'); ?></h3>
									<?php echo speedycache_cdn_actions_tmpl('other'); 
										
									?>
									<hr/>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Enter CDN Url', 'speedycache'); ?></h4>
										<p><?php echo wp_kses_post('Please enter your <strong>CDN Url</strong> below to deliver your contents via CDN.', 'speedycache'); ?></p>
									
										<div class="speedycache-form-input">
											<label for="cdn-url"><?php esc_html_e('CDN Url', 'speedycache'); ?>:
												<input type="text" name="cdn_url" value="" class="speedycache-api-key" id="cdn-url"/>
												<div id="speedycache-cdn-url-loading"><i class="fas fa-circle-notch fa-spin"></i></div>
											</label>
											
											<span class="speedycache-error-msg"></span>
										</div>
										<div class="speedycache-form-input">
											<label for="origin-url"><?php esc_html_e('Origin Url', 'speedycache'); ?>:
												<input type="text" name="origin_url" value="" class="speedycache-api-key" id="origin-url"/>
											</label>
										</div>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('File Types', 'speedycache'); ?></h4>
										<p><?php esc_html_e('Specify the file types to host with the CDN.', 'speedycache'); ?></p>
										<?php speedycache_file_type(); ?>
									</div>
									
									<div class="speedycache-block">
										<?php speedycache_specify_source(); ?>
									</div>

									<div class="speedycache-block">
										<?php speedycache_exclude_source(); ?>
									</div>
									<div class="speedycache-cdn-save"><button class="speedycache-btn speedycache-btn-primary"><?php esc_html_e('Save Settings', 'speedycache'); ?></button></div>
								</form>
							</div>

							<div class="speedycache-stackpath-settings">
								<form>
									<input type="hidden" name="id" value="stackpath"/>
									<h3><?php esc_html_e('StackPath Settings', 'speedycache'); ?></h3>
									<?php echo speedycache_cdn_actions_tmpl('stackpath'); ?>
									<hr/>
									<div class="speedycache-block">
										<h4><?php esc_html_e('Enter CDN Url', 'speedycache'); ?></h4>
										<p>
											<?php echo wp_kses_post('Please enter your <strong>StackPath CDN Url</strong> below to deliver your contents via StackPath.', 'speedycache'); ?>
										</p>	
										<div class="speedycache-form-input">
											<label for="cdn-url"><?php esc_html_e('CDN Url', 'speedycache'); ?>:
												<input type="text" name="cdn_url" value="" class="speedycache-api-key" id="cdn-url"/>
												<div id="speedycache-cdn-url-loading"><i class="fas fa-circle-notch fa-spin"></i></div>
											</label>
											
											<span class="speedycache-error-msg"></span>
										</div>
										<div class="speedycache-form-input">
											<label for="origin-url">
												<?php esc_html_e('Origin Url', 'speedycache') ?>:
												<input type="text" name="origin_url" value="" class="speedycache-api-key" id="origin-url"/>
											</label>
										</div>
									</div>
									<div class="speedycache-block">
										<h4><?php esc_html_e('File Types', 'speedycache'); ?></h4>		
										<p><?php esc_html_e('Specify the file types to host with the CDN.', 'speedycache'); ?></p>
										<?php speedycache_file_type(); ?>
									</div>
									<div class="speedycache-block">
										<?php speedycache_specify_source(); ?>
									</div>

									<div class="speedycache-block">
										<?php speedycache_exclude_source(); ?>
									</div>
									
									<div class="speedycache-cdn-save"><button class="speedycache-btn speedycache-btn-primary"><?php esc_html_e('Save Settings', 'speedycache'); ?></button></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="speedycache-tab-db">
				<div class="speedycache-block">
					<?php if(!defined('SPEEDYCACHE_PRO')){ ?>
					<div class="speedycache-disabled-block">
						<div class="speedycache-disabled-block-info">
							<i class="fas fa-lock"></i>
							<p><?php esc_html_e('Only available in Pro version', 'speedycache'); ?></p>
							<a href="https://speedycache.com/pricing" target="_blank"><?php esc_html_e('Buy Pro Version Now', 'speedycache'); ?></a>
						</div>
					</div>
					<?php } ?>
					<div class="speedycache-block-title">
						<h2><?php esc_html_e('Database Cleanup', 'speedycache'); ?></h2>
					</div>
					
					<div>
						<div class="speedycache-db-page">
							<div speedycache-db-name="all_warnings" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-database"></i>
									</div>
									<div class="speedycache-db-info db">
										<div><?php esc_html_e('ALL', 'speedycache'); ?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Run the all options', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>

							<div speedycache-db-name="post_revisions" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-file-word"></i>
									</div>
									<div class="speedycache-db-info db">
										<div><?php esc_html_e('Post Revisions', 'speedycache');?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the all post revisions', 'speedycache'); ?></p>
									</div>
								<div class="meta"></div>
								</div>
							</div>

							<div speedycache-db-name="trashed_contents" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-trash"></i>
									</div>
									<div class="speedycache-db-info db">
										<div><?php esc_html_e('Trashed Contents', 'speedycache'); ?><span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the all trashed posts & pages', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>

							<div speedycache-db-name="trashed_spam_comments" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-comments"></i>
									</div>
									<div class="speedycache-db-info db">
										<div><?php esc_html_e('Trashed & Spam Comments', 'speedycache'); ?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the all comments from trash & spam', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>

							<div speedycache-db-name="trackback_pingback" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-exchange-alt"></i>
									</div>
									<div class="speedycache-db-info db">
										<div><?php esc_html_e('Trackbacks and Pingbacks', 'speedycache'); ?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the all trackbacks and pingbacks', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>

							<div speedycache-db-name="transient_options" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-history"></i>
									</div>
									<div class="speedycache-db-info db">
										<div style="font-weight:bold;font-size:14px;"><?php esc_html_e('Transient Options', 'speedycache'); ?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the all transient options', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>
							<div speedycache-db-name="expired_transient" class="speedycache-card">
								<div class="speedycache-card-body">
									<div class="speedycache-db-icon speedycache-db-clean">
										<i class="fas fa-history"></i>
									</div>
									<div class="speedycache-db-info db">
										<div style="font-weight:bold;font-size:14px;"><?php esc_html_e('Expired Transients', 'speedycache'); ?> <span class="speedycache-db-number">(0)</span></div>
										<p><?php esc_html_e('Clean the expired transients', 'speedycache'); ?></p>
									</div>
									<div class="meta"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="speedycache-tab-image">
				<?php
				if(defined('SPEEDYCACHE_PRO') && class_exists('\SpeedyCache\Image')){
					\SpeedyCache\Image::statics();
					\SpeedyCache\Image::settings();
					\SpeedyCache\Image::list_image_html();
				} ?>
				<div id="revert-loader"></div>
				<script type="text/javascript">
					
				</script>
			</div>
			
			<div class="speedycache-tab-support">
				<div style="width:70%; margin:20px auto; display:flex; justify-content:center; flex-direction:column; align-items:center; line-height:1.5;">
					<img src="<?php echo esc_url(SPEEDYCACHE_URL) .'/assets/images/speedycache-black.png'?>" width="200"/>
					<h2><?php esc_html_e('You can contact the SpeedyCache Team via email. Our email address is', 'speedycache'); ?> <a href="mailto:support@speedycache.com">support@speedycache.com</a> <?php esc_html_e('or through Our Premium Support Ticket System at', 'speedycache'); ?> <a href="https://softaculous.deskuss.com/open.php?topicId=19" target="_blank">here</h2>
				</div>
			</div>
		
			<div modal-id="speedycache-modal-permission" class="speedycache-modal">
				<div class="speedycache-modal-wrap">
					<div class="speedycache-modal-header">
						<div><?php esc_html_e('Warning', 'speedycache'); ?></div>
						<div title="Close Modal" class="speedycache-close-modal">
							<span class="dashicons dashicons-no"></span>
						</div>
					</div>
					<div class="speedycache-modal-content speedycache-info-modal">
						<p><?php esc_html_e('The cache has <u>NOT</u> been deleted because of permissions problem please', 'speedycache'); ?> <a href='http://speedycache.com/docs/delete-cache-problem-related-to-permission/' target='_blank'><?php esc_html_e('Read More', 'speedycache'); ?></a></p>
					</div>
					<div class="speedycache-modal-footer">
						<button type="button" action="close">
							<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
						</button>
					</div>
				</div>
			</div>
			
			
			<div modal-id="speedycache-modal-toolbarsettings" class="speedycache-modal">
				<div class="speedycache-modal-wrap">
					<div class="speedycache-modal-header">
							<div><?php esc_html_e('Toolbar Settings', 'speedycache'); ?></div>
							<div title="Close Modal" class="speedycache-close-modal">
								<span class="dashicons dashicons-no"></span>
							</div>
					</div>
					<div class="speedycache-modal-content speedycache-info-modal">
						<h3><?php esc_html_e('Authorities', 'speedycache'); ?></h3>		
						<p><?php esc_html_e('This feature allows you to show the clear cache button which exists on the admin toolbar based on user roles.', 'speedycache'); ?> <a target="_blank" href="https://speedycache.com/docs/caching/how-to-delete-cache-or-minified-files/"><span class="dashicons dashicons-info"></span></a></p>

						<?php
							global $wp_roles;

							if(!isset($wp_roles)){
								$wp_roles = new WP_Roles();
							}

							$speedycache_role_names = $wp_roles->get_names();

							foreach($speedycache_role_names as $key => $value){
								if($key == 'administrator'){
									continue;
								}

								$speedycache_toolbar_element_id = 'speedycache_toolbar_'.$key;
								?>

								<div class="speedycache-form-input">
									<label for="<?php echo esc_attr($speedycache_toolbar_element_id); ?>">
										<input type="checkbox" id="<?php echo esc_attr($speedycache_toolbar_element_id); ?>" name="<?php echo esc_attr($speedycache_toolbar_element_id); ?>"/>
										<?php esc_html_e($value); ?>
									</label>
								</div>
								<?php
							}
						?>
					</div>
					<div class="speedycache-modal-footer">
						<button type="button" action="close">
							<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
						</button>
					</div>
				</div>
			</div>
			
			<div modal-id="speedycache-modal-db-confirmation" class="speedycache-modal">
				<div class="speedycache-modal-wrap">
					<div class="speedycache-modal-content">
						<i class="fas fa-info-circle"></i>
						<h1><?php esc_html_e('Clean up the Database', 'speedycache'); ?></h1>
						<p><?php esc_html_e('Once deleted the changes won\'t be reversible.', 'speedycache'); ?></p>
						<div class="speedycache-modal-db-actions">
							<button class="speedycache-btn speedycache-db-confirm-yes">Yes</button>
							<button class="speedycache-btn speedycache-db-confirm-no">No</button>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php 
				if(!defined('SITEPAD')){
					speedycache_promotion_tmpl(); 
				}?>
		</div>
	<?php
	if(!empty(speedycache_optserver('SERVER_SOFTWARE')) && !preg_match('/iis/i', speedycache_optserver('SERVER_SOFTWARE')) && !preg_match('/nginx/i', speedycache_optserver('SERVER_SOFTWARE'))){
		if(!isset($_POST['speedycache_page'])){
			speedycache_check_htaccess();
		}
	}
	
	speedycache_page_footer();
}

function speedycache_save_button(){
	return '<div class="speedycache-cdn-save"><button></button></div>';
}

function speedycache_specify_source(){
	?>
	<h4><?php esc_html_e('Specify Sources', 'speedycache'); ?></h4>
	<p><?php esc_html_e('If you want some of the sources instead of all the sources to be served via CDN, you can specify the sources. If a source url contains any keyword below, it is served via CDN.', 'speedycache'); ?></p>
	<div class="speedycache-form-input">		
		<label>
			<?php esc_html_e('Add Keyword', 'speedycache'); ?>
			<input class="speedycache-specify-source-keyword speedycache-full-width speedycache-keyword-input" data-target="speedycache_specify_source_keywords" type="text" placeholder="Add Keyword">
			<span class="speedycache-input-desc"><?php esc_html_e('Use Comma to create new keyword', 'speedycache'); ?></span>
			<div class="speedycache-tags-holder">
			</div>
			<input type="hidden" value="" id="speedycache_specify_source_keywords" name="keywords">
		</label>
	</div>
<?php }


function speedycache_file_type(){
	?>
	<div class="speedycache-checkbox-list">
	<?php
		$types = array('aac', 'css', 'eot', 'gif', 'jpeg', 'js', 'jpg', 'less', 'mp3', 'mp4', 'ogg', 'otf', 'pdf', 'png', 'svg', 'swf', 'ttf', 'webm', 'webp', 'woff', 'woff2');

        foreach($types as $key => $value){
            ?>
            <label for="file-type-<?php echo esc_attr($value); ?>">
                <input id="file-type-<?php echo esc_attr($value); ?>" type="checkbox" value="<?php echo esc_attr($value); ?>" checked="" /><span class="">*.<?php echo esc_html($value); ?></span>
            </label>
            <?php
        }
	?>
	</div>
<?php }

function speedycache_exclude_source(){
	?>
	<h4><?php esc_html_e('Exclude Sources', 'speedycache'); ?></h4>
	<p><?php esc_html_e('If you want some of the sources NOT to be served via CDN, you can specify the sources. If a source url contains any keyword below, it is NOT served via CDN.', 'speedycache'); ?></p>

	<div class="speedycache-form-input">		
		<label>
			<?php esc_html_e('Add Keyword', 'speedycache'); ?>
			<input class="speedycache-exclude-source-keyword speedycache-full-width speedycache-keyword-input" data-target="speedycache_exclude_source_keywords" type="text" placeholder="Add Keyword">
			<span class="speedycache-input-desc"><?php esc_html_e('Use Comma to create new keyword', 'speedycache'); ?></span>
			<div class="speedycache-tags-holder">
			</div>
			<input type="hidden" value="" id="speedycache_exclude_source_keywords" name="excludekeywords">
		</label>
	</div>
<?php }


function speedycache_cdn_actions_tmpl($cdn){
	$cdn_values = get_option('speedycache_cdn');
	$action_html = '';
	
	if(empty($cdn) || empty($cdn_values)){
		return $action_html;
	}
	
	foreach($cdn_values as $value){
		if($value['id'] == $cdn && !empty($value['cdn_url'])){
			$action_html .= '<div class="speedycache-cdn-actions">';
			if(isset($value['status']) && $value['status'] == 'pause'){
				$action_html .= '<button class="speedycache-cdn-start" title="Start CDN">Start</button>';
			} else{
				$action_html .= '<button class="speedycache-cdn-pause" title="Pause CDN">Pause</button>';
			}
			
			$action_html .= '<button class="speedycache-cdn-stop" title="Stop CDN">Stop</button>';
			$action_html .= '</div>';
		}
	}
	
	return $action_html;
}

function speedycache_check_htaccess(){
	global $speedycache;
	
	$path = speedycache_get_abspath();
	
	if(!is_writable($path . '.htaccess') && count($_POST) > 0){
		?>
		<div modal-id="speedycache-modal-htaccess" class="speedycache-modal">
			<div class="speedycache-modal-wrap">
				<div class="speedycache-modal-header">
					<div><?php esc_html_e('Manually Modify .htaccess', 'speedycache'); ?></div>
					<div title="Close Modal" class="speedycache-close-modal">
						<span class="dashicons dashicons-no"></span>
					</div>
				</div>
				<div class="speedycache-modal-content speedycache-info-modal">
					<h3><?php esc_html_e('.htaccess is not writeable', 'speedycache'); ?></h3>
					<p><?php esc_html_e('1. Copy the rules from the textarea below', 'speedycache'); ?></p>
					<p><?php esc_html_e('2. Remove everything from .htaccess', 'speedycache'); ?></p>
					<p><?php esc_html_e('3. Paste the rules', 'speedycache'); ?></p>
					<div class="speedycache-form-input">
						<div>
							<label class="speedycache-htaccess-label"></label>
						</div>
						<div>
							<textarea onclick="this.focus();this.select()" class="speedycache-readonly-textarea" readonly="readonly" rows="10" cols="54" style="overflow-x: hidden;">ff</textarea>
						</div>
					</div>
				</div>
				<div class="speedycache-modal-footer">
					<button type="button" action="close">
						<span><?php esc_html_e('Submit', 'speedycache'); ?></span>
					</button>
				</div>
			</div>
		</div>

		<?php
		$htaccess = @file_get_contents($path . '.htaccess');
		
		if(isset($speedycache->options['lbc'])){
			$htaccess = \SpeedyCache\htaccess::browser_cache($htaccess, array('speedycache_lbc' => 'on'));
		}
		if(isset($speedycache->options['gzip'])){
			$htaccess = \SpeedyCache\htaccess::gzip($htaccess, array('speedycache_gzip' => 'on'));
		}
		if(isset($speedycache->options['status'])){
			$htaccess = \SpeedyCache\htaccess::rewrite_rule($htaccess, array('speedycache_status' => 'on'));
		}

		$htaccess = preg_replace("/\n+/", "\n", $htaccess);

		echo '<noscript id="speedycache-htaccess-data">' . esc_html($htaccess) . '</noscript>';
		echo '<noscript id="speedycache-htaccess-path-data">' . esc_html($path) . '.htaccess' . '</noscript>';
	}
}

function speedycache_promotion_tmpl(){
	
	global $speedycache;
	
	$brand_data = !empty($speedycache->settings['brand_data']) ? $speedycache->settings['brand_data'] : [];
	if(defined('SPEEDYCACHE_PRO') && !empty($brand_data)){

		echo '<div class="speedycache-promotion" style="width:13%; margin-top: 39px;">
			<div class="speedycache-promotion-content" style="padding-top:20px; margin-bottom:15px;">
				<h4 style="margin:0 0 15px 0; padding:0; text-align:center;">Brought to you by</h4>
				<div class="speedycache-co-brand-images">
					<a href="https://speedycache.com/" target="_blank"><img src="'.esc_url(SPEEDYCACHE_URL . '/assets/images/speedycache-brand.png') .'"  width="100%" /></a>';

					if(!empty($brand_data['img'])){
						echo '<a href="'.(!empty($brand_data['url']) ? esc_url($brand_data['url']) : '#').'" target="_blank"><img src="'.esc_url($brand_data['img']).'" width="100%"/></a>';
					}
				echo '</div>
			</div>
			<div class="speedycache-promotion-content speedycache-doc-block">
				<h2 style="color:white; margin:0 0 5px 0; padding:0;">'.__('Documentation', 'speedycache').'</h2>
				<p>'.__('If you face any issue or need help with the settings check our docs', 'speedycache').'</p>
				<a style="color:white; margin:0 0 5px 0; padding:0;" href="https://speedycache.com/docs/" target="_blank">Read Docs</a>
			</div>
		</div>';
		
		return;
	} 
	
?>
	<div class="speedycache-promotion" style="width:13%; margin-top: 10px;">
		<div class="speedycache-promotion-content">
				<h2 class="hndle ui-sortable-handle">
					<span><a target="_blank" href="https://pagelayer.com/?utm_source=speedycache_plugin"><img src="<?php echo esc_url(SPEEDYCACHE_URL); ?>/assets/images/pagelayer_product.png" width="100%" /></a></span>
				</h2>
				<div>
					<em>The Best WordPress <b>Site Builder</b> </em>:<br>
					<ul>
						<li>Drag & Drop Editor</li>
						<li>Widgets</li>
						<li>In-line Editing</li>
						<li>Styling Options</li>
						<li>Animations</li>
						<li>Easily customizable</li>
						<li>Real Time Design</li>
						<li>And many more ...</li>
					</ul>
					<center><a class="speedycache-btn speedycache-btn-primary" target="_blank" href="https://pagelayer.com/?utm_source=speedycache_plugin">Visit Pagelayer</a></center>
				</div>
		</div>
	
		<div class="speedycache-promotion-content" style="margin-top: 20px;">
			<h2 class="hndle ui-sortable-handle">
				<span><a target="_blank" href="https://loginizer.com/?utm_source=speedycache_plugin"><img src="<?php echo esc_url(SPEEDYCACHE_URL); ?>/assets/images/loginizer_product.png" width="100%" /></a></span>
			</h2>
			<div>
				<em><?php echo wp_kses_post('Protect your WordPress website from <b>unauthorized access and malware</b>', 'speedycache'); ?> </em>:<br>
				<ul>
					<li>BruteForce Protection</li>
					<li>reCaptcha</li>
					<li>Two Factor Authentication</li>
					<li>Black/Whitelist IP</li>
					<li>Detailed Logs</li>
					<li>Extended Lockouts</li>
					<li>2FA via Email</li>
					<li>And many more ...</li>
				</ul>
				<center><a class="speedycache-btn speedycache-btn-primary" target="_blank" href="https://loginizer.com/?utm_source=speedycache_plugin">Visit Loginizer</a></center>
			</div>
		</div>
	</div>
<?php
}


function speedycache_add_javascript(){
	global $speedycache;
	
	wp_enqueue_script('jquery-ui-sortable');
	
	$speedycache_ajax_url = admin_url().'admin-ajax.php';
	$speedycache_nonce = wp_create_nonce('speedycache_nonce');
	$speedycache_schedules = wp_get_schedules();
	$preload_order = !isset($speedycache->options['preload_order']) ? '' : $speedycache->options['preload_order'];
	$lang = !isset($speedycache->options['language']) ? 'en' : $speedycache->options['language'];

	wp_enqueue_script('speedycache_js', SPEEDYCACHE_URL . '/assets/js/speedycache.js', array(), SPEEDYCACHE_VERSION, false);
	
	wp_localize_script('speedycache_js', 'speedycache_ajax', array(
		'url' => $speedycache_ajax_url,
		'nonce' => $speedycache_nonce,
		'schedules' => $speedycache_schedules,
		'home_url' => home_url(),
		'timeout_rules' => speedycache_get_timeout_rules(),
		'exclude_rules' => get_option('speedycache_exclude'),
		'cdn' => get_option('speedycache_cdn'),
		'preload_order' => $preload_order,
		'lang' => $lang,
		'sitepad' => defined('SITEPAD'),
		'premium' => defined('SPEEDYCACHE_PRO') ? true : false
	));
}

function speedycache_options_page_request(){
	
	$post = speedycache_clean($_POST);
	
	if(empty($post)){
		return;
	}
	
	if(empty($post['speedycache_page'])){
		return;
	}

	include_once ABSPATH .WPINC. '/capabilities.php';
	include_once ABSPATH .WPINC. '/pluggable.php';
	
	

	if(isset($post['submit']) && !wp_verify_nonce($post['security'], 'speedycache_nonce')){
		speedycache_notify(array('Security Check Failed', 'error'));
		return;
	}
	
	if(!current_user_can('manage_options')){
		speedycache_notify(array('Must be admin to perform this task', 'error'));
		return;
	}
	
	switch($post['speedycache_page']){
		case 'options':
			speedycache_exclude_urls();
			speedycache_save_settings();
			break;
			
		case 'delete_cache':				
			$delete_fonts = false;
			$delete_minified = false;
			
			if(isset($post['speedycache_delete_fonts'])){
				$delete_fonts = true;
			}
			
			if(isset($post['speedycache_delete_minified'])){
				$delete_minified = true;
			}

			speedycache_delete_cache($delete_minified, $delete_fonts);
			break;
	}
}

function speedycache_get_timeout_rules(){
	$schedules_rules = array();
	$crons = _get_cron_array();

	foreach((array)$crons as $cron_key => $cron_value){
		foreach((array) $cron_value as $hook => $events){
			
			if(!preg_match('/^speedycache(.*)/', $hook, $id)){
				continue;
			}

			if(!empty($id[1]) && !preg_match("/^\_(\d+)$/", $id[1])){
				continue;
			}

			$tmp_array = array();
			foreach((array) $events as $event_key => $event){
				if(empty($id[1])){
					break;
				}

				// new cronjob which is (speedycache_d+)
				$tmp_std = $event['args'][0];

				$tmp_array = array(
					'schedule' => $event['schedule'],
					'prefix' => $tmp_std['prefix'],
					'content' => esc_attr($tmp_std['content'])
				);

				if(isset($tmp_std['hour']) && isset($tmp_std['minute'])){
					$tmp_array['hour'] = $tmp_std['hour'];
					$tmp_array['minute'] = $tmp_std['minute'];
				}
			}
	
			array_push($schedules_rules, $tmp_array);
		}
	}
	
	return $schedules_rules;
}

speedycache_set_custom_interval();